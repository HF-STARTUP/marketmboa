<div class="container rtl">
    <div class="row g-4 pt-2 mt-0 pb-2 __deal-of align-items-start">
        <?php if(isset($dealOfTheDay->product) || isset($recommendedProduct->discount_type)): ?>
            <div class="col-xl-3 col-md-4">
                <div class="deal_of_the_day h-100 bg--light">
                    <?php if(isset($dealOfTheDay->product)): ?>
                        <div class="d-flex justify-content-center align-items-center py-4">
                            <h2 class="font-bold fs-16 m-0 align-items-center text-uppercase text-center px-2 web-text-primary h4">
                                <?php echo e(translate('deal_of_the_day')); ?>

                            </h2>
                        </div>
                        <div class="recommended-product-card mt-0 min-height-auto">
                            <div class="d-flex justify-content-center align-items-center __pt-20 __m-20-r">
                                <div class="position-relative">
                                    <img class="__rounded-top aspect-1 h-auto" alt=""
                                         src="<?php echo e(getStorageImages(path: $dealOfTheDay?->product?->thumbnail_full_url, type: 'product')); ?>">
                                    <?php if(getProductPriceByType(product: $dealOfTheDay?->product, type: 'discount', result: 'value') > 0): ?>
                                        <span class="for-discount-value p-1 pl-2 pr-2 font-bold fs-13">
                                    <span class="direction-ltr d-block">
                                        -<?php echo e(getProductPriceByType(product: $dealOfTheDay?->product, type: 'discount', result: 'string')); ?>

                                    </span>
                                </span>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="__i-1 bg-transparent text-center mb-0">
                                <div class="px-0">
                                    <?php ($overallRating = getOverallRating($dealOfTheDay->product['reviews'])); ?>
                                    <?php if($overallRating[0] != 0 ): ?>
                                        <div class="rating-show">
                                    <span class="d-inline-block font-size-sm text-body">
                                        <?php for($inc=1;$inc<=5;$inc++): ?>
                                            <?php if($inc <= (int)$overallRating[0]): ?>
                                                <i class="tio-star text-warning"></i>
                                            <?php elseif($overallRating[0] != 0 && $inc <= (int)$overallRating[0] + 1.1): ?>
                                                <i class="tio-star-half text-warning"></i>
                                            <?php else: ?>
                                                <i class="tio-star-outlined text-warning"></i>
                                            <?php endif; ?>
                                        <?php endfor; ?>
                                        <label
                                            class="badge-style">( <?php echo e(count($dealOfTheDay->product['reviews'])); ?> )</label>
                                    </span>
                                        </div>
                                    <?php endif; ?>
                                    <h3 class="font-semibold pt-1 h6">
                                        <?php echo e(Str::limit($dealOfTheDay->product['name'], 80)); ?>

                                    </h3>
                                    <h4 class="mb-4 pt-1 d-flex flex-wrap justify-content-center align-items-center text-center gap-8 lh-1 letter-spacing-0">

                                        <?php if(getProductPriceByType(product: $dealOfTheDay?->product, type: 'discount', result: 'value') > 0): ?>
                                            <del class="fs-14 font-semibold __color-9B9B9B">
                                                <?php echo e(webCurrencyConverter(amount: $dealOfTheDay?->product?->unit_price)); ?>

                                            </del>
                                        <?php endif; ?>
                                        <span class="text-accent fs-18 font-bold text-dark">
                                    <?php echo e(getProductPriceByType(product: $dealOfTheDay?->product, type: 'discounted_unit_price', result: 'string')); ?>

                                </span>
                                    </h4>
                                    <button
                                        class="btn btn--primary font-bold px-4 rounded-10 text-uppercase get-view-by-onclick"
                                        data-link="<?php echo e(route('product',$dealOfTheDay->product->slug)); ?>">
                                        <?php echo e(translate('buy_now')); ?>

                                    </button>

                                </div>
                            </div>
                        </div>
                    <?php elseif(isset($recommendedProduct->discount_type)): ?>
                        <div class="d-flex justify-content-center align-items-center py-4">
                            <h2 class="font-bold fs-16 m-0 align-items-center text-uppercase text-center px-2 web-text-primary h4">
                                <?php echo e(translate('recommended_product')); ?>

                            </h2>
                        </div>
                        <div class="recommended-product-card mt-0">

                            <div class="d-flex justify-content-center align-items-center __pt-20 __m-20-r">
                                <div class="position-relative">
                                    <img
                                        src="<?php echo e(getStorageImages(path: $recommendedProduct?->thumbnail_full_url, type: 'product')); ?>"
                                        alt="">
                                    <?php if($recommendedProduct->discount > 0): ?>
                                        <span class="for-discount-value p-1 pl-2 pr-2 font-bold fs-13">
                                    <span class="direction-ltr d-block">
                                        <?php if($recommendedProduct->discount_type == 'percent'): ?>
                                            -<?php echo e(round($recommendedProduct->discount,(!empty($decimal_point_settings) ? $decimal_point_settings: 0))); ?>

                                            %
                                        <?php elseif($recommendedProduct->discount_type =='flat'): ?>
                                            -<?php echo e(webCurrencyConverter(amount: $recommendedProduct->discount)); ?>

                                        <?php endif; ?>
                                    </span>
                                </span>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="__i-1 bg-transparent text-center mb-0 min-height-auto">
                                <div class="px-0 pb-0">
                                    <?php ($overallRating = getOverallRating($recommendedProduct['reviews'])); ?>
                                    <?php if($overallRating[0] != 0 ): ?>
                                        <div class="rating-show">
                                    <span class="d-inline-block font-size-sm text-body">
                                        <?php for($inc=0;$inc<5;$inc++): ?>
                                            <?php if($inc <= (int)$overallRating[0]): ?>
                                                <i class="tio-star text-warning"></i>
                                            <?php elseif($overallRating[0] != 0 && $inc <= (int)$overallRating[0] + 1.1 && $overallRating[0] > ((int)$overallRating[0])): ?>
                                                <i class="tio-star-half text-warning"></i>
                                            <?php else: ?>
                                                <i class="tio-star-outlined text-warning"></i>
                                            <?php endif; ?>
                                        <?php endfor; ?>
                                        <label class="badge-style">( <?php echo e(count($recommendedProduct->reviews)); ?> )</label>
                                    </span>

                                        </div>
                                    <?php endif; ?>
                                    <h3 class="font-semibold pt-1 h6">
                                        <?php echo e(Str::limit($recommendedProduct['name'],30)); ?>

                                    </h3>
                                    <h4 class="mb-4 pt-1 d-flex flex-wrap justify-content-center align-items-center text-center gap-8 lh-1 letter-spacing-0">
                                        <?php if($recommendedProduct->discount > 0): ?>
                                            <del class="__text-12px __color-9B9B9B">
                                                <?php echo e(webCurrencyConverter(amount: $recommendedProduct->unit_price)); ?>

                                            </del>
                                        <?php endif; ?>
                                        <span class="text-accent __text-22px text-dark">
                                    <?php echo e(webCurrencyConverter(amount:
                                        $recommendedProduct->unit_price-(getProductDiscount(product: $recommendedProduct, price: $recommendedProduct->unit_price))
                                    )); ?>

                                </span>
                                    </h4>
                                    <button
                                        class="btn btn--primary font-bold px-4 rounded-10 text-uppercase get-view-by-onclick"
                                        data-link="<?php echo e(route('product',$recommendedProduct->slug)); ?>">
                                        <?php echo e(translate('buy_now')); ?>

                                    </button>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        <?php endif; ?>

        <div
            class="<?php echo e((isset($dealOfTheDay->product) || isset($recommendedProduct->discount_type)) ? 'col-xl-9 col-md-8' : 'col-12'); ?>">
            <div class="latest-product-margin">
                <div class="d-flex justify-content-between align-items-baseline mb-14px">
                    <h2 class="text-center mb-0">
                    <span class="for-feature-title __text-22px font-bold text-center">
                        <?php echo e(translate('latest_products')); ?>

                    </span>
                    </h2>
                    <div class="mr-1">
                        <a class="text-capitalize view-all-text web-text-primary"
                           href="<?php echo e(route('products',['data_from'=>'latest'])); ?>">
                            <?php echo e(translate('view_all')); ?>

                            <i class="czi-arrow-<?php echo e(Session::get('direction') === "rtl" ? 'left mr-1 ml-n1 mt-1 float-left' : 'right ml-1 mr-n1'); ?>"></i>
                        </a>
                    </div>
                </div>

                <div class="row mt-0 g-2">
                    <?php ($latestProductsListIndex=0); ?>
                    <?php $__currentLoopData = $latestProductsList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if($latestProductsListIndex < 8): ?>
                            <?php ($latestProductsListIndex++); ?>
                            <div class="col-xl-3 col-sm-4 col-md-6 col-lg-4 col-6">
                                <div>
                                    <?php echo $__env->make('web-views.partials._inline-single-product',['product'=>$product,'decimal_point_settings'=>$decimal_point_settings], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                </div>
                            </div>
                        <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php /**PATH /opt/projects/Genius/MarketMboa/code/resources/themes/default/web-views/partials/_deal-of-the-day.blade.php ENDPATH**/ ?>