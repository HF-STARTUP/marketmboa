<div class="__inline-9 rtl">
    <div class="text-center pb-4">
        <div class="max-w-1160px mx-auto footer-slider-container">
            <div class="container">
                <div class="footer-slider owl-theme owl-carousel"
                     data-item="<?php echo e(Route::has('frontend.blog.index') && getWebConfig(name: 'blog_feature_active_status') ? 4 : 3); ?>">
                    <?php if($web_config['business_pages']?->firstWhere('slug', 'about-us')): ?>
                        <div class="footer-slide-item">
                            <div>
                                <a href="<?php echo e(route('business-page.view', ['slug' => 'about-us'])); ?>">
                                    <div class="text-center text-primary">
                                        <img class="object-contain svg" width="36" height="36"
                                             src="<?php echo e(theme_asset(path: "public/assets/front-end/img/icons/about-us.svg")); ?>"
                                             alt="">
                                    </div>
                                    <div class="text-center">
                                        <h2 class="m-0 mt-2 heading">
                                            <?php echo e(translate('about_us')); ?>

                                        </h2>
                                        <p class="d-none d-sm-block des mb-0"><?php echo e(translate('Know_about_our_company_more.')); ?></p>
                                    </div>
                                </a>
                            </div>
                        </div>
                    <?php endif; ?>

                    <div class="footer-slide-item">
                        <div>
                            <a href="<?php echo e(route('contacts')); ?>">
                                <div class="text-center text-primary">
                                    <img class="object-contain svg" width="36" height="36"
                                         src="<?php echo e(theme_asset(path: "public/assets/front-end/img/icons/contact-us.svg")); ?>"
                                         alt="">
                                </div>
                                <div class="text-center">
                                    <p class="m-0 mt-2">
                                        <?php echo e(translate('contact_Us')); ?>

                                    </p>
                                    <small class="d-none d-sm-block"><?php echo e(translate('We_are_Here_to_Help')); ?></small>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="footer-slide-item">
                        <div>
                            <a href="<?php echo e(route('helpTopic')); ?>">
                                <div class="text-center text-primary">
                                    <img class="object-contain svg" width="36" height="36"
                                         src="<?php echo e(theme_asset(path: "public/assets/front-end/img/icons/faq-icon.svg")); ?>"
                                         alt="">
                                </div>
                                <div class="text-center">
                                    <p class="m-0 mt-2">
                                        <?php echo e(translate('FAQ')); ?>

                                    </p>
                                    <small class="d-none d-sm-block"><?php echo e(translate('Get_all_Answers')); ?></small>
                                </div>
                            </a>
                        </div>
                    </div>

                    <?php if(Route::has('frontend.blog.index') && getWebConfig(name: 'blog_feature_active_status')): ?>
                        <div class="footer-slide-item">
                            <div>
                                <a href="<?php echo e(route('frontend.blog.index')); ?>">
                                    <div class="text-center text-primary">
                                        <img class="object-contain svg" width="36" height="36"
                                             src="<?php echo e(theme_asset(path: "public/assets/front-end/img/icons/blog-icon.svg")); ?>"
                                             alt="">
                                    </div>
                                    <div class="text-center">
                                        <p class="m-0 mt-2">
                                            <?php echo e(translate('Blog')); ?>

                                        </p>
                                        <small class="d-none d-sm-block"><?php echo e(translate('Check_Latest_Blogs')); ?></small>
                                    </div>
                                </a>
                            </div>
                        </div>
                    <?php endif; ?>

                </div>
            </div>
        </div>
    </div>

    <footer class="page-footer font-small mdb-color rtl">
        <div class="pt-4 custom-light-primary-color-20">
            <div class="container text-center __pb-13px">

                <div
                    class="row mt-3 pb-3 ">
                    <div class="col-md-3 footer-web-logo text-center text-md-start ">
                        <a class="d-block" href="<?php echo e(route('home')); ?>">
                            <img class="<?php echo e(Session::get('direction') === "rtl" ? 'right-align' : ''); ?>"
                                 src="<?php echo e(getStorageImages(path: $web_config['footer_logo'], type: 'logo')); ?>"
                                 alt="<?php echo e($web_config['company_name']); ?>"/>
                        </a>
                        <?php if((isset($web_config['ios']['status']) && $web_config['ios']['status']) || (isset($web_config['android']['status']) &&  $web_config['android']['status'])): ?>
                            <div class="mt-4 pt-lg-4">
                                <h6 class="text-uppercase font-weight-bold footer-header align-items-center text-start">
                                    <?php echo e(translate('download_our_app')); ?>

                                </h6>
                            </div>
                        <?php endif; ?>

                        <div class="store-contents d-flex justify-content-center pr-lg-4">
                            <?php if(isset($web_config['ios']['status']) && $web_config['ios']['status']): ?>
                                <div class="me-2 mb-2">
                                    <a class="" href="<?php echo e($web_config['ios']['link']); ?>" role="button">
                                        <img width="100"
                                             src="<?php echo e(theme_asset(path: "public/assets/front-end/png/apple_app.png")); ?>"
                                             alt="">
                                    </a>
                                </div>
                            <?php endif; ?>

                            <?php if(isset($web_config['android']['status']) && $web_config['android']['status']): ?>
                                <div class="me-2 mb-2">
                                    <a href="<?php echo e($web_config['android']['link']); ?>" role="button">
                                        <img width="100"
                                             src="<?php echo e(theme_asset(path: "public/assets/front-end/png/google_app.png")); ?>"
                                             alt="">
                                    </a>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="col-md-9">
                        <div class="row">
                            <div class="col-sm-3 col-6 footer-padding-bottom text-start">
                                <h6 class="text-uppercase mobile-fs-12 font-semi-bold footer-header"><?php echo e(translate('quick_links')); ?></h6>
                                <ul class="widget-list __pb-10px">
                                    <?php if(auth('customer')->check()): ?>
                                        <li class="widget-list-item">
                                            <a class="widget-list-link" href="<?php echo e(route('user-account')); ?>">
                                                <?php echo e(translate('profile_info')); ?>

                                            </a>
                                        </li>
                                        <li class="widget-list-item">
                                            <a class="widget-list-link" href="<?php echo e(route('wishlists')); ?>">
                                                <?php echo e(translate('wish_list')); ?>

                                            </a>
                                        </li>
                                    <?php else: ?>
                                        <li class="widget-list-item">
                                            <a class="widget-list-link" href="<?php echo e(route('customer.auth.login')); ?>">
                                                <?php echo e(translate('profile_info')); ?>

                                            </a>
                                        </li>
                                    <?php endif; ?>
                                    <?php if($web_config['flash_deals'] && count($web_config['flash_deals_products']) > 0): ?>
                                        <li class="widget-list-item">
                                            <a class="widget-list-link"
                                               href="<?php echo e(route('flash-deals',[$web_config['flash_deals']['id']])); ?>">
                                                <?php echo e(translate('flash_deal')); ?>

                                            </a>
                                        </li>
                                    <?php endif; ?>
                                    <li class="widget-list-item">
                                        <a class="widget-list-link"
                                           href="<?php echo e(route('products',['data_from'=>'featured','page'=>1])); ?>">
                                            <?php echo e(translate('featured_products')); ?>

                                        </a>
                                    </li>
                                    <li class="widget-list-item">
                                        <a class="widget-list-link"
                                           href="<?php echo e(route('products',['data_from'=>'best-selling','page'=>1])); ?>">
                                            <?php echo e(translate('best_selling_product')); ?>

                                        </a>
                                    </li>
                                    <li class="widget-list-item">
                                        <a class="widget-list-link"
                                           href="<?php echo e(route('products',['data_from'=>'latest','page'=>1])); ?>">
                                            <?php echo e(translate('latest_products')); ?>

                                        </a>
                                    </li>
                                    <li class="widget-list-item">
                                        <a class="widget-list-link"
                                           href="<?php echo e(route('products',['data_from'=>'top-rated','page'=>1])); ?>">
                                            <?php echo e(translate('top_rated_product')); ?>

                                        </a>
                                    </li>


                                    <li class="widget-list-item">
                                        <a class="widget-list-link"
                                           href="<?php echo e(route('track-order.index')); ?>"><?php echo e(translate('track_order')); ?></a>
                                    </li>
                                </ul>
                            </div>
                            <div class="col-sm-4 col-6 footer-padding-bottom text-start">
                                <h6 class="text-uppercase mobile-fs-12 font-semi-bold footer-header">
                                    <?php echo e(translate('other')); ?>

                                </h6>

                                <ul class="widget-list __pb-10px">
                                    <?php $__currentLoopData = $web_config['business_pages']->where('default_status', 1); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $businessPage): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <li class="widget-list-item">
                                                <a class="widget-list-link"
                                                   href="<?php echo e(route('business-page.view', ['slug' => $businessPage['slug']])); ?>">
                                                    <?php echo e(Str::limit($businessPage['title'], 25, '...')); ?>

                                                </a>
                                            </li>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </ul>
                            </div>
                            <div class="col-sm-5 footer-padding-bottom offset-max-sm--1 pb-3 pb-sm-0">
                                <div class="mb-2">
                                    <h6 class="text-uppercase mobile-fs-12 font-semi-bold footer-header text-center text-sm-start"><?php echo e(translate('newsletter')); ?></h6>
                                    <div
                                        class="text-center text-sm-start mobile-fs-12"><?php echo e(translate('subscribe_to_our_new_channel_to_get_latest_updates')); ?></div>
                                </div>
                                <div class="text-nowrap mb-4 position-relative">
                                    <form action="<?php echo e(route('subscription')); ?>" method="post">
                                        <?php echo csrf_field(); ?>
                                        <input type="email" name="subscription_email"
                                               class="form-control subscribe-border text-align-direction p-12px"
                                               placeholder="<?php echo e(translate('your_Email_Address')); ?>" required>
                                        <button class="subscribe-button" type="submit">
                                            <?php echo e(translate('subscribe')); ?>

                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row g-4 <?php echo e(Session::get('direction') === "rtl" ? ' flex-row-reverse' : ''); ?>">
                    <div class="col-xl-5 col-md-6">
                        <div
                            class="d-flex align-items-center mobile-view-center-align text-start justify-content-between">
                            <div class="">
                                <span
                                    class="mb-4 font-weight-bold footer-header text-capitalize"><?php echo e(translate('start_a_conversation')); ?></span>
                            </div>
                            <div
                                class="flex-grow-1 d-none d-md-block <?php echo e(Session::get('direction') === "rtl" ? 'me-2 ' : 'ml-2'); ?>">
                                <hr>
                            </div>
                        </div>
                        <div class="row text-start">
                            <div class="col-12 start_address ">
                                <div class="">
                                    <a class="widget-list-link" href="<?php echo e('tel:'.$web_config['phone']); ?>">
                                        <span class="">
                                            <i class="fa fa-phone  me-2 mt-2 mb-2"></i>
                                            <span class="direction-ltr">
                                                <?php echo e(getWebConfig(name: 'company_phone')); ?>

                                            </span>
                                        </span>
                                    </a>
                                </div>
                                <div>
                                    <a class="widget-list-link"
                                       href="<?php echo e('mailto:'.getWebConfig(name: 'company_email')); ?>">
                                        <span>
                                            <i class="fa fa-envelope  me-2 mt-2 mb-2"></i>
                                            <?php echo e(getWebConfig(name: 'company_email')); ?>

                                        </span>
                                    </a>
                                </div>
                                <div class="pe-3">
                                    <?php if(auth('customer')->check()): ?>
                                        <a class="widget-list-link" href="<?php echo e(route('account-tickets')); ?>">
                                            <span><i class="fa fa-user-o  me-2 mt-2 mb-2"></i> <?php echo e(translate('support_ticket')); ?> </span>
                                        </a>
                                        <br class="d-none d-md-block"/>
                                    <?php else: ?>
                                        <a class="widget-list-link" href="<?php echo e(route('customer.auth.login')); ?>">
                                            <span><i class="fa fa-user-o  me-2 mt-2 mb-2"></i> <?php echo e(translate('support_ticket')); ?> </span>
                                        </a>
                                        <br class="d-none d-md-block"/>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-md-6 text-start">
                        <div
                            class="row d-flex align-items-center mobile-view-center-align justify-content-center justify-content-md-start pb-0">
                            <div class="d-none d-md-block">
                                <span class="mb-4 font-weight-bold footer-header"><?php echo e(translate('address')); ?></span>
                            </div>
                            <div
                                class="flex-grow-1 d-none d-md-block <?php echo e(Session::get('direction') === "rtl" ? 'me-2 ' : 'ml-2'); ?>">
                                <hr class="address_under_line d-block"/>
                            </div>
                        </div>
                        <div>
                            <span
                                class="__text-14px d-flex align-items-center">
                                <i class="fa fa-map-marker me-2 mt-2 mb-2"></i>
                                <span><?php echo e(getWebConfig(name: 'shop_address')); ?></span>
                            </span>
                        </div>
                    </div>
                    <div class="col-xl-3">
                        <div class="max-sm-100 justify-content-center d-flex flex-wrap mt-md-3 mt-0 mb-md-3">
                            <?php if($web_config['social_media']): ?>
                                <?php $__currentLoopData = $web_config['social_media']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <span class="social-media ">
                                        <?php if($item->name == "twitter"): ?>
                                            <a class="social-btn text-white sb-light sb-<?php echo e($item->name); ?> me-2 mb-2 d-flex justify-content-center align-items-center"
                                               target="_blank" href="<?php echo e($item->link); ?>">
                                                <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="16"
                                                     height="16" viewBox="0 0 24 24">
                                                    <g opacity=".3">
                                                        <polygon fill="#fff" fill-rule="evenodd"
                                                                 points="16.002,19 6.208,5 8.255,5 18.035,19"
                                                                 clip-rule="evenodd">
                                                        </polygon>
                                                        <polygon points="8.776,4 4.288,4 15.481,20 19.953,20 8.776,4">
                                                        </polygon>
                                                    </g>
                                                    <polygon fill-rule="evenodd"
                                                             points="10.13,12.36 11.32,14.04 5.38,21 2.74,21"
                                                             clip-rule="evenodd">
                                                    </polygon>
                                                    <polygon fill-rule="evenodd"
                                                             points="20.74,3 13.78,11.16 12.6,9.47 18.14,3"
                                                             clip-rule="evenodd">
                                                    </polygon>
                                                    <path
                                                        d="M8.255,5l9.779,14h-2.032L6.208,5H8.255 M9.298,3h-6.93l12.593,18h6.91L9.298,3L9.298,3z"
                                                        fill="currentColor">
                                                    </path>
                                                </svg>
                                            </a>
                                        <?php else: ?>
                                            <a class="social-btn text-white sb-light sb-<?php echo e($item->name); ?> me-2 mb-2"
                                               target="_blank" href="<?php echo e($item->link); ?>">
                                                <i class="<?php echo e($item->icon); ?>" aria-hidden="true"></i>
                                            </a>
                                        <?php endif; ?>
                                    </span>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-white-overlay-50 py-4">
            <div class="container">
                <div class="row">
                    <div class="col"></div>
                    <div class="col-md-10">
                        <div class="d-flex flex-column gap-3">
                            <div>
                                <p class="fs-14 text-center m-0"><?php echo e($web_config['copyright_text']); ?></p>
                            </div>
                            <?php if(count($web_config['business_pages']->where('default_status', 0)) > 0): ?>
                                <ul class="d-flex fs-12 flex-wrap flex-column flex-sm-row justify-content-center align-content-center gap-2 column-gap-4 mb-0 p-0">
                                    <?php $__currentLoopData = $web_config['business_pages']->where('default_status', 0); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $businessPage): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <li class="opacity-70">
                                            <a class="widget-list-link"
                                               href="<?php echo e(route('business-page.view', ['slug' => $businessPage['slug']])); ?>">
                                                <span><?php echo e(Str::limit($businessPage['title'], 25, '...')); ?></span>
                                            </a>
                                        </li>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </ul>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="col"></div>
                </div>
            </div>
        </div>

        <?php ($cookie = $web_config['cookie_setting'] ? json_decode($web_config['cookie_setting']['value'], true) : null); ?>
        <?php if($cookie && $cookie['status']==1): ?>
            <section id="cookie-section"></section>
        <?php endif; ?>
    </footer>
</div>
<?php /**PATH /opt/projects/Genius/MarketMboa/code/resources/themes/default/layouts/front-end/partials/_footer.blade.php ENDPATH**/ ?>