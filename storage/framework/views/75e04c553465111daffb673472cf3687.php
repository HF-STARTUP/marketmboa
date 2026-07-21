<?php ($fcmCredentials = getWebConfig('fcm_credentials')); ?>
<span id="Firebase_Configuration_Config" data-api-key="<?php echo e($fcmCredentials['apiKey'] ?? ''); ?>"
    data-auth-domain="<?php echo e($fcmCredentials['authDomain'] ?? ''); ?>"
    data-project-id="<?php echo e($fcmCredentials['projectId'] ?? ''); ?>"
    data-storage-bucket="<?php echo e($fcmCredentials['storageBucket'] ?? ''); ?>"
    data-messaging-sender-id="<?php echo e($fcmCredentials['messagingSenderId'] ?? ''); ?>"
    data-app-id="<?php echo e($fcmCredentials['appId'] ?? ''); ?>"
    data-measurement-id="<?php echo e($fcmCredentials['measurementId'] ?? ''); ?>"
    data-csrf-token="<?php echo e(csrf_token()); ?>"
    data-route="<?php echo e(route('system.subscribeToTopic')); ?>"
    data-recaptcha-store="<?php echo e(route('g-recaptcha-response-store')); ?>"
    data-favicon="<?php echo e($web_config['fav_icon']['path']); ?>"
    data-firebase-service-worker-file="<?php echo e(dynamicAsset(path: 'firebase-messaging-sw.js')); ?>"
    data-firebase-service-worker-scope="<?php echo e(dynamicAsset(path: 'firebase-cloud-messaging-push-scope')); ?>"
    >
</span>

<script src="<?php echo e(theme_asset(path: 'public/assets/front-end/vendor/firebase/firebase.min.js')); ?>"></script>
<script src="<?php echo e('https://www.gstatic.com/firebasejs/8.3.2/firebase-app.js'); ?>"></script>
<script src="<?php echo e('https://www.gstatic.com/firebasejs/8.3.2/firebase-auth.js'); ?>"></script>
<script src="<?php echo e('https://www.gstatic.com/firebasejs/8.3.2/firebase-messaging.js'); ?>"></script>
<script>
    try {
        let firebaseConfigurationConfig = $('#Firebase_Configuration_Config');
        var firebaseConfig = {
            apiKey: firebaseConfigurationConfig.data('api-key'),
            authDomain: firebaseConfigurationConfig.data('auth-domain'),
            projectId: firebaseConfigurationConfig.data('project-id'),
            storageBucket: firebaseConfigurationConfig.data('storage-bucket'),
            messagingSenderId: firebaseConfigurationConfig.data('messaging-sender-id'),
            appId: firebaseConfigurationConfig.data('app-id'),
            measurementId: firebaseConfigurationConfig.data('measurement-id'),
        };
        firebase.initializeApp(firebaseConfig);
        const messaging = firebase.messaging();

        var recaptchaVerifiers = {};

        function initializeFirebaseGoogleRecaptcha(containerId, action) {
            try {
                var recaptchaContainer = document.getElementById(containerId);

                if (recaptchaVerifiers[containerId]) {
                    recaptchaVerifiers[containerId].clear();
                }

                if (recaptchaContainer && recaptchaContainer.innerHTML.trim() === "") {
                    recaptchaVerifiers[containerId] = new firebase.auth.RecaptchaVerifier(containerId, {
                        size: 'normal',  // Use 'invisible' for invisible reCAPTCHA
                        callback: function(response) {
                            console.log('reCAPTCHA solved for ' + containerId + ' with action ' + action);
                            storeRecaptchaVerifierResponse(containerId, response);
                        },
                        'expired-callback': function() {
                            console.error('reCAPTCHA expired for ' + containerId);
                        }
                    });

                    recaptchaVerifiers[containerId].render().then(function(widgetId) {
                        console.log('reCAPTCHA widget rendered for ' + containerId);
                    }).catch(function(error) {
                        console.error('Error rendering reCAPTCHA for ' + containerId + ':', error);
                    });
                } else {
                    console.log("reCAPTCHA container " + containerId + " is either not found or already contains inner elements!");
                }
            } catch (e) {
                console.log(e)
            }
        }

        <?php if($web_config['firebase_otp_verification'] && $web_config['firebase_otp_verification']['status']): ?>
            window.onload = function() {
                initializeFirebaseGoogleRecaptcha('recaptcha-container-otp', 'OTP Verification');
                initializeFirebaseGoogleRecaptcha('recaptcha-container-manual-login', 'Manual Login');
                initializeFirebaseGoogleRecaptcha('recaptcha-container-verify-token', 'Token Verification');
            };
        <?php endif; ?>

        function storeRecaptchaVerifierResponse(containerId, response) {
            console.log('Response from ' + containerId + ': ' + response);
        }

        try {

            function requestNotificationPermission() {
                return Notification.requestPermission().then(permission => {
                    if (permission === 'granted') {
                        console.log('Notification permission granted.');
                        return true;
                    } else {
                        console.error('Notification permission denied.');
                        return false;
                    }
                });
            }

            function startFCM(topics) {
                requestNotificationPermission().then(permissionGranted => {
                    if (permissionGranted) {
                        messaging.getToken().then(token => {
                            topics.forEach(topic => {
                                subscribeTokenToBackend(token, topic);
                            });
                        }).catch(error => {
                            console.error('Error getting token:', error);
                        });
                    }
                });
            }

            function subscribeTokenToBackend(token, topic) {
                fetch(firebaseConfigurationConfig.data('route'), {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': firebaseConfigurationConfig.data('csrf-token')
                    },
                    body: JSON.stringify({
                        token: token,
                        topic: topic
                    })
                }).then(response => {
                    if (response.status < 200 || response.status >= 400) {
                        return response.text().then(text => {
                            throw new Error(`Error subscribing to topic: ${response.status} - ${text}`);
                        });
                    }
                    console.log(`Subscribed to "${topic}"`);
                }).catch(error => {
                    console.error('Subscription error:', error);
                });
            }

            // List of topics to subscribe to
            const topics = <?php echo json_encode(getFCMTopicListToSubscribe()); ?>;
            startFCM(topics);

            messaging.onMessage(function (payload) {

                // Check if the notification is related to a specific topic
                if (payload?.data?.type?.includes('product_restock')) {
                    productRestockStockLimitStatus(payload.data);
                }

                // You can also display the notification directly
                if (payload.data) {
                    displayNotification(payload.data);
                }
            });

        } catch (e) {
            console.log(e)
        }

    } catch (e) {
        console.log(e);
    }

    try {
        function displayNotification(notification) {
            const options = {
                body: notification.body,
                icon: $('#Firebase_Configuration_Config').data('favicon'),
            };
            new Notification(notification.title, options);
        }
    } catch (e) {
        console.log(e);
    }
</script>
<?php /**PATH /opt/projects/Genius/MarketMboa/code/resources/themes/default/layouts/front-end/partials/_firebase-script.blade.php ENDPATH**/ ?>