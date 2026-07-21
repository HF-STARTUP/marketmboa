<?php $__env->startSection('title', $web_config['company_name'].' '.translate('online_Shopping').' | '.$web_config['company_name'].' '.translate('ecommerce')); ?>

<?php $__env->startPush('css_or_js'); ?>
    <meta name="robots" content="index, follow">
    <meta property="og:image" content="<?php echo e($web_config['web_logo']['path']); ?>"/>
    <meta property="og:title" content="Welcome To <?php echo e($web_config['company_name']); ?> Home"/>
    <meta property="og:url" content="<?php echo e(env('APP_URL')); ?>">
    <meta name="description" content="<?php echo e($web_config['meta_description']); ?>">
    <meta property="og:description" content="<?php echo e($web_config['meta_description']); ?>">
    <meta property="twitter:card" content="<?php echo e($web_config['web_logo']['path']); ?>"/>
    <meta property="twitter:title" content="Welcome To <?php echo e($web_config['company_name']); ?> Home"/>
    <meta property="twitter:url" content="<?php echo e(env('APP_URL')); ?>">
    <meta property="twitter:description" content="<?php echo e($web_config['meta_description']); ?>">
    <link rel="stylesheet" href="<?php echo e(theme_asset(path: 'public/assets/front-end/css/home.css')); ?>"/>
    <link rel="stylesheet" href="<?php echo e(theme_asset(path: 'public/assets/front-end/css/owl.carousel.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(theme_asset(path: 'public/assets/front-end/css/owl.theme.default.min.css')); ?>">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
    <div class="__inline-61">
        <?php ($decimalPointSettings = !empty(getWebConfig(name: 'decimal_point_settings')) ? getWebConfig(name: 'decimal_point_settings') : 0); ?>

        <?php echo $__env->make('web-views.partials._home-top-slider',['bannerTypeMainBanner'=>$bannerTypeMainBanner], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php if($flashDeal['flashDeal'] && $flashDeal['flashDealProducts'] && count($flashDeal['flashDealProducts']) > 0): ?>
            <?php echo $__env->make('web-views.partials._flash-deal', ['decimal_point_settings'=>$decimalPointSettings], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php endif; ?>

        <?php if($featuredProductsList->count() > 0 ): ?>
            <div class="container pt-4 rtl px-0 px-md-3">
                <div class="__inline-62 pt-3">
                    <h2 class="feature-product-title mt-0 web-text-primary mb-0 letter-spacing-0">
                        <?php echo e(translate('featured_products')); ?>

                    </h2>
                    <div class="text-end px-3 d-none d-md-block">
                        <a class="text-capitalize view-all-text web-text-primary" href="<?php echo e(route('products',['data_from'=>'featured','page'=>1])); ?>">
                            <?php echo e(translate('view_all')); ?>

                            <i class="czi-arrow-<?php echo e(Session::get('direction') === 'rtl' ? 'left mr-1 ml-n1 mt-1' : 'right ml-1'); ?>"></i>
                        </a>
                    </div>
                    <div class="feature-product">
                        <div class="carousel-wrap p-1">
                            <div class="owl-carousel owl-theme" id="featured_products_list"
                                 data-loop="<?php echo e(count($featuredProductsList) > 6 ? 'true' : 'false'); ?>">
                                <?php $__currentLoopData = $featuredProductsList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div>
                                        <?php echo $__env->make('web-views.partials._feature-product',['product'=>$product, 'decimal_point_settings'=>$decimalPointSettings], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </div>
                        <div class="text-center pt-2 d-md-none">
                            <a class="text-capitalize view-all-text web-text-primary" href="<?php echo e(route('products',['data_from'=>'featured','page'=>1])); ?>">
                                <?php echo e(translate('view_all')); ?>

                                <i class="czi-arrow-<?php echo e(Session::get('direction') === "rtl" ? 'left mr-1 ml-n1 mt-1' : 'right ml-1'); ?>"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>

        <?php echo $__env->make('web-views.partials._category-section-home', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

        <?php if(getFeaturedDealsProductList() && (count(getFeaturedDealsProductList())>0)): ?>
            <section class="featured_deal">
                <div class="container">
                    <div class="__featured-deal-wrap bg--light">
                        <div class="d-flex flex-wrap justify-content-between gap-8 mb-3">
                            <div class="w-0 flex-grow-1">
                                <span class="featured_deal_title font-bold text-dark"><?php echo e(translate('featured_deal')); ?></span>
                                <br>
                                <span class="text-left text-nowrap"><?php echo e(translate('see_the_latest_deals_and_exciting_new_offers')); ?>!</span>
                            </div>
                            <div>
                                <a class="text-capitalize view-all-text web-text-primary" href="<?php echo e(route('products',['offer_type'=>'featured_deal'])); ?>">
                                    <?php echo e(translate('view_all')); ?>

                                    <i class="czi-arrow-<?php echo e(Session::get('direction') === 'rtl' ? 'left mr-1 ml-n1 mt-1' : 'right ml-1'); ?>"></i>
                                </a>
                            </div>
                        </div>
                        <div class="owl-carousel owl-theme new-arrivals-product">
                            <?php $__currentLoopData = getFeaturedDealsProductList(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php echo $__env->make('web-views.partials._product-card-1',['product'=>$product, 'decimal_point_settings'=>$decimalPointSettings], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>
                </div>
            </section>
        <?php endif; ?>

        <?php echo $__env->make('web-views.partials._clearance-sale-products', ['clearanceSaleProducts' => $clearanceSaleProducts], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <?php if(isset($bannerTypeMainSectionBanner)): ?>
            <div class="container rtl pt-4 px-0 px-md-3">
                <a href="<?php echo e($bannerTypeMainSectionBanner->url); ?>" target="_blank"
                    class="cursor-pointer d-block">
                    <img class="d-block footer_banner_img __inline-63" alt=""
                         src="<?php echo e(getStorageImages(path:$bannerTypeMainSectionBanner->photo_full_url, type: 'wide-banner')); ?>">
                </a>
            </div>
        <?php endif; ?>

        <?php ($businessMode = getWebConfig(name: 'business_mode')); ?>
        <?php if($businessMode == 'multi' && count($topVendorsList) > 0): ?>
            <?php echo $__env->make('web-views.partials._top-sellers', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php endif; ?>

        <?php echo $__env->make('web-views.partials._deal-of-the-day', ['decimal_point_settings' => $decimalPointSettings], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

        <section class="new-arrival-section">

            <?php if($newArrivalProducts->count() >0 ): ?>
                <div class="container rtl mt-4">
                    <div class="section-header">
                        <h2 class="arrival-title d-block mb-1">
                            <div class="text-capitalize">
                                <?php echo e(translate('new_arrivals')); ?>

                            </div>
                        </h2>
                    </div>
                </div>
                <div class="container rtl mb-3 overflow-hidden">
                    <div class="py-2">
                        <div class="new_arrival_product">
                            <div class="carousel-wrap">
                                <div class="owl-carousel owl-theme new-arrivals-product">
                                    <?php $__currentLoopData = $newArrivalProducts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=> $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php echo $__env->make('web-views.partials._product-card-2',['product'=>$product,'decimal_point_settings'=>$decimalPointSettings], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>

            <div class="container rtl px-0 px-md-3">
                <div class="row g-3 mx-max-md-0">

                    <?php if($bestSellProduct->count() >0): ?>
                        <?php echo $__env->make('web-views.partials._best-selling', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    <?php endif; ?>

                    <?php if($topRatedProducts->count() >0): ?>
                        <?php echo $__env->make('web-views.partials._top-rated', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    <?php endif; ?>
                </div>
            </div>
        </section>


        <?php if(count($bannerTypeFooterBanner) > 1): ?>
            <div class="container rtl pt-4">
                <div class="promotional-banner-slider owl-carousel owl-theme">
                    <?php $__currentLoopData = $bannerTypeFooterBanner; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $banner): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <a href="<?php echo e($banner['url']); ?>" class="d-block" target="_blank">
                            <img class="footer_banner_img __inline-63"  alt="" src="<?php echo e(getStorageImages(path:$banner->photo_full_url, type: 'banner')); ?>">
                        </a>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        <?php else: ?>
            <div class="container rtl pt-4">
                <div class="row">
                    <?php $__currentLoopData = $bannerTypeFooterBanner; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $banner): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="col-md-6">
                            <a href="<?php echo e($banner['url']); ?>" class="d-block" target="_blank">
                                <img class="footer_banner_img __inline-63"  alt="" src="<?php echo e(getStorageImages(path:$banner->photo_full_url, type: 'banner')); ?>">
                            </a>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        <?php endif; ?>

        <?php if($web_config['brand_setting'] && $brands->count() > 0): ?>
            <section class="container rtl pt-4">

                <div class="section-header align-items-center mb-1">
                    <h2 class="text-black font-bold __text-22px mb-0">
                        <span> <?php echo e(translate('brands')); ?></span>
                    </h2>
                    <div class="__mr-2px">
                        <a class="text-capitalize view-all-text web-text-primary" href="<?php echo e(route('brands')); ?>">
                            <?php echo e(translate('view_all')); ?>

                            <i class="czi-arrow-<?php echo e(Session::get('direction') === 'rtl' ? 'left mr-1 ml-n1 mt-1 float-left' : 'right ml-1 mr-n1'); ?>"></i>
                        </a>
                    </div>
                </div>

                <div class="mt-sm-3 mb-3 brand-slider">
                    <div class="owl-carousel owl-theme p-2 brands-slider">
                        <?php ($brandCount=0); ?>
                        <?php $__currentLoopData = $brands; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $brand): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php if($brandCount < 15): ?>
                                <div class="text-center">
                                    <a href="<?php echo e(route('products',['brand_id'=> $brand['id'],'data_from'=>'brand','page'=>1])); ?>"
                                       class="__brand-item">
                                        <img alt="<?php echo e($brand->image_alt_text); ?>"
                                             src="<?php echo e(getStorageImages(path: $brand->image_full_url, type: 'brand')); ?>">
                                    </a>
                                </div>
                            <?php endif; ?>
                            <?php ($brandCount++); ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
            </section>
        <?php endif; ?>

        <?php if($homeCategories->count() > 0): ?>
            <?php $__currentLoopData = $homeCategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php echo $__env->make('web-views.partials._category-wise-product', ['decimal_point_settings'=>$decimalPointSettings], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php endif; ?>

        <?php ($companyReliability = getWebConfig(name: 'company_reliability')); ?>
        <?php if($companyReliability != null): ?>
            <?php echo $__env->make('web-views.partials._company-reliability', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php endif; ?>
    </div>

    <span id="direction-from-session" data-value="<?php echo e(session()->get('direction')); ?>"></span>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('script'); ?>
    <script src="<?php echo e(theme_asset(path: 'public/assets/front-end/js/owl.carousel.min.js')); ?>"></script>
    <script src="<?php echo e(theme_asset(path: 'public/assets/front-end/js/home.js')); ?>"></script>
<?php $__env->stopPush(); ?>


<?php echo $__env->make('layouts.front-end.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /opt/projects/Genius/MarketMboa/code/resources/themes/default/web-views/home.blade.php ENDPATH**/ ?>