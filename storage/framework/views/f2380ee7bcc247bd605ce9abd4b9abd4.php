<aside class="col-lg-4 pt-4 pt-lg-2 px-max-md-0 order-summery-aside">
    <div class="__cart-total __cart-total_sticky">
        <div class="cart_total p-0">
            <?php ($shippingMethod=getWebConfig(name: 'shipping_method')); ?>
            <?php ($subTotal=0); ?>
            <?php ($totalTax=0); ?>
            <?php ($totalShippingCost=0); ?>
            <?php ($orderWiseShippingDiscount=\App\Utils\CartManager::order_wise_shipping_discount()); ?>
            <?php ($totalDiscountOnProduct=0); ?>
            <?php ($cart=\App\Utils\CartManager::getCartListQuery(type: 'checked')); ?>
            <?php ($cartGroupIds=\App\Utils\CartManager::get_cart_group_ids()); ?>
            <?php ($getShippingCost=\App\Utils\CartManager::get_shipping_cost(type: 'checked')); ?>
            <?php ($getShippingCostSavedForFreeDelivery=\App\Utils\CartManager::getShippingCostSavedForFreeDelivery(type: 'checked')); ?>
            <?php if($cart->count() > 0): ?>
                <?php $__currentLoopData = $cart; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $cartItem): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php ($subTotal+=$cartItem['price']*$cartItem['quantity']); ?>
                    <?php ($totalTax+=$cartItem['tax_model']=='exclude' ? ($cartItem['tax']*$cartItem['quantity']):0); ?>
                    <?php ($totalDiscountOnProduct+=$cartItem['discount']*$cartItem['quantity']); ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                <?php if(session()->missing('coupon_type') || session('coupon_type') !='free_delivery'): ?>
                    <?php ($totalShippingCost=$getShippingCost - $getShippingCostSavedForFreeDelivery); ?>
                <?php else: ?>
                    <?php ($totalShippingCost=$getShippingCost); ?>
                <?php endif; ?>
            <?php endif; ?>

            <?php ($totalSavedAmount = $totalDiscountOnProduct); ?>

            <?php if(session()->has('coupon_discount') && session('coupon_discount') > 0 && session('coupon_type') !='free_delivery'): ?>
                <?php ($totalSavedAmount += session('coupon_discount')); ?>
            <?php endif; ?>

            <?php if($getShippingCostSavedForFreeDelivery > 0): ?>
                <?php ($totalSavedAmount += $getShippingCostSavedForFreeDelivery); ?>
            <?php endif; ?>

            <?php if($totalSavedAmount > 0): ?>
                <h6 class="text-center text-primary mb-4 d-flex align-items-center justify-content-center gap-2">
                    <img src="<?php echo e(theme_asset(path: 'public/assets/front-end/img/icons/offer.svg')); ?>" alt="">
                    <?php echo e(translate('you_have_Saved')); ?>

                    <strong><?php echo e(webCurrencyConverter(amount: $totalSavedAmount)); ?>!</strong>
                </h6>
            <?php endif; ?>

            <div class="d-flex justify-content-between">
                <span class="cart_title"><?php echo e(translate('sub_total')); ?></span>
                <span class="cart_value">
                    <?php echo e(webCurrencyConverter(amount: $subTotal)); ?>

                </span>
            </div>
            <div class="d-flex justify-content-between">
                <span class="cart_title"><?php echo e(translate('tax')); ?></span>
                <span class="cart_value">
                    <?php echo e(webCurrencyConverter(amount: $totalTax)); ?>

                </span>
            </div>
            <div class="d-flex justify-content-between">
                <span class="cart_title"><?php echo e(translate('shipping')); ?></span>
                <span class="cart_value">
                    <?php echo e(webCurrencyConverter(amount: $totalShippingCost)); ?>

                </span>
            </div>
            <div class="d-flex justify-content-between">
                <span class="cart_title"><?php echo e(translate('discount_on_product')); ?></span>
                <span class="cart_value">
                    - <?php echo e(webCurrencyConverter(amount: $totalDiscountOnProduct)); ?>

                </span>
            </div>
            <?php ($coupon_dis=0); ?>
            <?php if(auth('customer')->check()): ?>

                <?php if(session()->has('coupon_discount')): ?>
                    <?php ($couponDiscount = session()->has('coupon_discount')?session('coupon_discount'):0); ?>

                    <div class="d-flex justify-content-between">
                            <span class="cart_title"><?php echo e(translate('coupon_discount')); ?></span>
                            <span class="cart_value">
                                - <?php echo e(webCurrencyConverter(amount: $couponDiscount + $orderWiseShippingDiscount)); ?>

                            </span>
                    </div>

                    <div class="pt-2">
                        <div class="d-flex align-items-center form-control rounded-pill pl-3 p-1">
                            <img width="24" height="24" src="<?php echo e(theme_asset(path: 'public/assets/front-end/img/icons/coupon.svg')); ?>" alt="">
                            <div class="px-2 d-flex justify-content-between w-100">
                                <div>
                                    <?php echo e(session('coupon_code')); ?>

                                    <span class="text-primary small">( -<?php echo e(webCurrencyConverter(amount: $couponDiscount + $orderWiseShippingDiscount)); ?> )</span>
                                </div>
                                <div class="bg-transparent text-danger cursor-pointer px-2 get-view-by-onclick" data-link="<?php echo e(route('coupon.remove')); ?>">x</div>
                            </div>
                        </div>
                    </div>
                    <?php ($coupon_dis=session('coupon_discount')); ?>
                <?php else: ?>
                    <div class="pt-2">
                        <form class="needs-validation coupon-code-form" action="javascript:" method="post" novalidate
                              id="coupon-code-ajax">
                            <div class="d-flex form-control rounded-pill ps-3 p-1">
                                <img width="24" src="<?php echo e(theme_asset(path: 'public/assets/front-end/img/icons/coupon.svg')); ?>" alt="">
                                <input class="input_code border-0 px-2 text-dark bg-transparent outline-0 w-100"
                                       type="text" name="code" placeholder="<?php echo e(translate('coupon_code')); ?>" required>
                                <button class="btn btn--primary rounded-pill text-uppercase py-1 fs-12" type="button" id="apply-coupon-code">
                                        <?php echo e(translate('apply')); ?>

                                    </button>
                            </div>
                            <div class="invalid-feedback"><?php echo e(translate('please_provide_coupon_code')); ?></div>
                        </form>
                    </div>
                    <?php ($coupon_dis=0); ?>
                <?php endif; ?>
            <?php endif; ?>
            <hr class="my-2">
            <div class="d-flex justify-content-between">
                <span class="cart_title text-primary font-weight-bold"><?php echo e(translate('total')); ?></span>
                <span class="cart_value">
                <?php echo e(webCurrencyConverter(amount: $subTotal+$totalTax+$totalShippingCost-$coupon_dis-$totalDiscountOnProduct-$orderWiseShippingDiscount)); ?>

                </span>
            </div>
        </div>
        <?php ($company_reliability = getWebConfig(name: 'company_reliability')); ?>
        <?php if($company_reliability != null): ?>
            <div class="pt-5">
                <div class="footer-slider owl-theme owl-carousel">
                    <?php $__currentLoopData = $company_reliability; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if($value['status'] == 1 && !empty($value['title'])): ?>
                            <div class="">
                                <img class="order-summery-footer-image" alt=""
                                     src="<?php echo e(getStorageImages(path: imagePathProcessing(imageData: $value['image'],path:'company-reliability'), type: 'source', source: theme_asset(path: 'public/assets/front-end/img').'/'.$value['item'].'.png')); ?>">
                                <div class="deal-title"><?php echo e(translate($value['title'])); ?></div>
                            </div>
                        <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        <?php endif; ?>

        <div class="pt-4">
            <a class="btn btn--primary btn-block proceed_to_next_button <?php echo e($cart->count() <= 0 ? 'custom-disabled' : ''); ?> action-checkout-function"><?php echo e(translate('proceed_to_Checkout')); ?></a>
        </div>

        <div class="d-flex justify-content-center mt-3">
            <a href="<?php echo e(route('home')); ?>" class="d-flex align-items-center gap-2 text-primary font-weight-bold">
                <i class="tio-back-ui fs-12"></i> <?php echo e(translate('continue_Shopping')); ?>

            </a>
        </div>

    </div>
</aside>

<div class="bottom-sticky3 bg-white p-3 shadow-sm w-100 d-lg-none">
    <div class="d-flex justify-content-center align-items-center fs-14 mb-2">
        <div class="product-description-label fw-semibold text-capitalize"><?php echo e(translate('total_price')); ?> :</div>
        &nbsp; <strong
                class="text-base"><?php echo e(webCurrencyConverter(amount: $subTotal+$totalTax+$totalShippingCost-$coupon_dis-$totalDiscountOnProduct-$orderWiseShippingDiscount)); ?></strong>
    </div>
    <a data-route="<?php echo e(Route::currentRouteName()); ?>"
       class="btn btn--primary btn-block proceed_to_next_button text-capitalize <?php echo e($cart->count() <= 0 ? 'custom-disabled' : ''); ?> action-checkout-function"><?php echo e(translate('proceed_to_checkout')); ?></a>
</div>

<?php $__env->startPush('script'); ?>
    <script>
        "use strict";
        $(document).ready(function () {
            orderSummaryStickyFunction();
        });
    </script>
<?php $__env->stopPush(); ?><?php /**PATH /opt/projects/Genius/MarketMboa/code/resources/themes/default/web-views/partials/_order-summary.blade.php ENDPATH**/ ?>