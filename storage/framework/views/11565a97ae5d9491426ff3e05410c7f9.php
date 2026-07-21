<?php ($announcement=getWebConfig(name: 'announcement')); ?>

<?php if(isset($announcement) && $announcement['status']==1): ?>
    <div class="text-center position-relative px-4 py-1 d--none" id="announcement"
         style="background-color: <?php echo e($announcement['color']); ?>;color:<?php echo e($announcement['text_color']); ?>">
        <span><?php echo e($announcement['announcement']); ?> </span>
        <span class="__close-announcement web-announcement-slideUp">X</span>
    </div>
<?php endif; ?>

<header class="rtl __inline-10">
    <div class="topbar">
        <div class="container">
            <div>
                <div class="topbar-text dropdown d-md-none ms-auto">
                    <a class="topbar-link direction-ltr" href="tel: <?php echo e($web_config['phone']); ?>">
                        <i class="fa fa-phone"></i> <?php echo e($web_config['phone']); ?>

                    </a>
                </div>
                <div class="d-none d-md-block mr-2 text-nowrap">
                    <a class="topbar-link d-none d-md-inline-block direction-ltr" href="tel:<?php echo e($web_config['phone']); ?>">
                        <i class="fa fa-phone"></i> <?php echo e($web_config['phone']); ?>

                    </a>
                </div>
            </div>

            <div>
                <?php ($currency_model = getWebConfig(name: 'currency_model')); ?>
                <?php if($currency_model=='multi_currency'): ?>
                    <div class="topbar-text dropdown disable-autohide mr-4">
                        <a class="topbar-link dropdown-toggle" href="#" data-toggle="dropdown">
                            <span><?php echo e(session('currency_code')); ?> <?php echo e(session('currency_symbol')); ?></span>
                        </a>
                        <ul class="text-align-direction dropdown-menu dropdown-menu-<?php echo e(Session::get('direction') === "rtl" ? 'right' : 'left'); ?> min-width-160px">
                            <?php $__currentLoopData = \App\Models\Currency::where('status', 1)->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $currency): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li class="dropdown-item cursor-pointer get-currency-change-function"
                                    data-code="<?php echo e($currency['code']); ?>">
                                    <?php echo e($currency->name); ?>

                                </li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    </div>
                <?php endif; ?>

                <div class="topbar-text dropdown disable-autohide  __language-bar text-capitalize">
                    <a class="topbar-link dropdown-toggle" href="#" data-toggle="dropdown">
                        <?php $__currentLoopData = $web_config['language']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php if($data['code'] == getDefaultLanguage()): ?>
                                <img class="mr-2" width="20"
                                     src="<?php echo e(theme_asset(path: 'public/assets/front-end/img/flags/'.$data['code'].'.png')); ?>"
                                     alt="<?php echo e($data['name']); ?>">
                                <?php echo e($data['name']); ?>

                            <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </a>
                    <ul class="text-align-direction dropdown-menu dropdown-menu-<?php echo e(Session::get('direction') === "rtl" ? 'right' : 'left'); ?>">
                        <?php $__currentLoopData = $web_config['language']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key =>$data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php if($data['status']==1): ?>
                                <li class="change-language" data-action="<?php echo e(route('change-language')); ?>" data-language-code="<?php echo e($data['code']); ?>">
                                    <a class="dropdown-item pb-1" href="javascript:">
                                        <img class="mr-2"
                                             width="20"
                                             src="<?php echo e(theme_asset(path: 'public/assets/front-end/img/flags/'.$data['code'].'.png')); ?>"
                                             alt="<?php echo e($data['name']); ?>"/>
                                        <span class="text-capitalize"><?php echo e($data['name']); ?></span>
                                    </a>
                                </li>
                            <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="navbar-sticky bg-light mobile-head">
        <div class="navbar navbar-expand-md navbar-light">
            <div class="container ">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <a class="navbar-brand d-none d-sm-block me-3 flex-shrink-0 __min-w-7rem"
                   href="<?php echo e(route('home')); ?>">
                    <img class="__inline-11"
                         src="<?php echo e(getStorageImages(path: $web_config['web_logo'], type: 'logo')); ?>"
                         alt="<?php echo e($web_config['company_name']); ?>">
                </a>
                <a class="navbar-brand d-sm-none"
                   href="<?php echo e(route('home')); ?>">
                    <img class="mobile-logo-img"
                         src="<?php echo e(getStorageImages(path: $web_config['mob_logo'], type: 'logo')); ?>"
                         alt="<?php echo e($web_config['company_name']); ?>"/>
                </a>

                <div class="input-group-overlay mx-lg-4 search-form-mobile text-align-direction">
                    <form action="<?php echo e(route('products')); ?>" type="submit" class="search_form">
                        <div class="d-flex align-items-center gap-2">
                            <input class="form-control appended-form-control search-bar-input" type="search"
                                   autocomplete="off" data-given-value=""
                                   placeholder="<?php echo e(translate("search_for_items")); ?>..."
                                   name="name" value="<?php echo e(request('name')); ?>">

                            <input type="hidden" name="global_search_input" value="1">

                            <button class="input-group-append-overlay search_button d-none d-md-block" type="submit">
                                <span class="input-group-text __text-20px">
                                    <i class="czi-search text-white"></i>
                                </span>
                            </button>

                            <span class="close-search-form-mobile fs-14 font-semibold text-muted d-md-none text-nowrap" type="submit">
                                <?php echo e(translate('cancel')); ?>

                            </span>
                        </div>

                        <input name="data_from" value="search" hidden>
                        <input name="page" value="1" hidden>
                        <diV class="card search-card mobile-search-card">
                            <div class="card-body">
                                <div class="search-result-box __h-400px overflow-x-hidden overflow-y-auto"></div>
                            </div>
                        </diV>
                    </form>
                </div>

                <div class="navbar-toolbar d-flex flex-shrink-0 align-items-center">
                    <a class="navbar-tool navbar-stuck-toggler" href="#">
                        <span class="navbar-tool-tooltip"><?php echo e(translate('expand_Menu')); ?></span>
                        <div class="navbar-tool-icon-box">
                            <i class="navbar-tool-icon czi-menu open-icon"></i>
                            <i class="navbar-tool-icon czi-close close-icon"></i>
                        </div>
                    </a>
                    <div class="navbar-tool open-search-form-mobile d-lg-none <?php echo e(Session::get('direction') === "rtl" ? 'mr-md-3' : 'ml-md-3'); ?>">
                        <a class="navbar-tool-icon-box bg-secondary" href="javascript:">
                            <i class="tio-search"></i>
                        </a>
                    </div>
                    <div class="navbar-tool dropdown d-none d-md-block <?php echo e(Session::get('direction') === "rtl" ? 'mr-md-3' : 'ml-md-3'); ?>">
                        <a class="navbar-tool-icon-box bg-secondary dropdown-toggle" href="<?php echo e(route('wishlists')); ?>">
                            <span class="navbar-tool-label">
                                <span class="countWishlist">
                                    <?php echo e(session()->has('wish_list')?count(session('wish_list')):0); ?>

                                </span>
                           </span>
                            <i class="navbar-tool-icon czi-heart"></i>
                        </a>
                    </div>
                    <?php if(auth('customer')->check()): ?>
                        <div class="dropdown">
                            <a class="navbar-tool ml-3" type="button" data-toggle="dropdown" aria-haspopup="true"
                               aria-expanded="false">
                                <div class="navbar-tool-icon-box bg-secondary">
                                    <div class="navbar-tool-icon-box bg-secondary">
                                        <img class="img-profile rounded-circle __inline-14" alt=""
                                             src="<?php echo e(getStorageImages(path: auth('customer')->user()->image_full_url, type: 'avatar')); ?>">
                                    </div>
                                </div>
                                <div class="navbar-tool-text">
                                    <small>
                                        <?php echo e(translate('hello')); ?>, <?php echo e(Str::limit(auth('customer')->user()->f_name, 10)); ?>

                                    </small>
                                    <?php echo e(translate('dashboard')); ?>

                                </div>
                            </a>
                            <div class="dropdown-menu dropdown-menu-<?php echo e(Session::get('direction') === "rtl" ? 'left' : 'right'); ?>"
                                 aria-labelledby="dropdownMenuButton">
                                <a class="dropdown-item"
                                   href="<?php echo e(route('account-oder')); ?>"> <?php echo e(translate('my_Order')); ?> </a>
                                <a class="dropdown-item"
                                   href="<?php echo e(route('user-account')); ?>"> <?php echo e(translate('my_Profile')); ?></a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item"
                                   href="<?php echo e(route('customer.auth.logout')); ?>"><?php echo e(translate('logout')); ?></a>
                            </div>
                        </div>
                    <?php else: ?>
                        <div class="dropdown">
                            <a class="navbar-tool <?php echo e(Session::get('direction') === "rtl" ? 'mr-md-3' : 'ml-md-3'); ?>"
                               type="button" data-toggle="dropdown" aria-haspopup="true" href="#" rel="nofollow"
                               aria-expanded="false">
                                <div class="navbar-tool-icon-box bg-secondary">
                                    <div class="navbar-tool-icon-box bg-secondary">
                                        <svg width="16" height="17" viewBox="0 0 16 17" fill="none"
                                             xmlns="http://www.w3.org/2000/svg">
                                            <path d="M4.25 4.41675C4.25 6.48425 5.9325 8.16675 8 8.16675C10.0675 8.16675 11.75 6.48425 11.75 4.41675C11.75 2.34925 10.0675 0.666748 8 0.666748C5.9325 0.666748 4.25 2.34925 4.25 4.41675ZM14.6667 16.5001H15.5V15.6667C15.5 12.4509 12.8825 9.83341 9.66667 9.83341H6.33333C3.11667 9.83341 0.5 12.4509 0.5 15.6667V16.5001H14.6667Z"
                                                  fill="<?php echo e($web_config['primary_color'] ?? '#1B7FED'); ?>"/>
                                        </svg>

                                    </div>
                                </div>
                            </a>
                            <div class="text-align-direction dropdown-menu __auth-dropdown dropdown-menu-<?php echo e(Session::get('direction') === "rtl" ? 'left' : 'right'); ?>"
                                 aria-labelledby="dropdownMenuButton">
                                <a class="dropdown-item" href="<?php echo e(route('customer.auth.login')); ?>">
                                    <i class="fa fa-sign-in mr-2"></i> <?php echo e(translate('sign_in')); ?>

                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="<?php echo e(route('customer.auth.sign-up')); ?>">
                                    <i class="fa fa-user-circle mr-2"></i><?php echo e(translate('sign_up')); ?>

                                </a>
                            </div>
                        </div>
                    <?php endif; ?>
                    <div id="cart_items">
                        <?php echo $__env->make('layouts.front-end.partials._cart', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="navbar navbar-expand-md navbar-stuck-menu">
            <div class="container px-10px">
                <div class="collapse navbar-collapse text-align-direction" id="navbarCollapse">
                    <div class="w-100 d-md-none text-align-direction">
                        <button class="navbar-toggler p-0" type="button" data-toggle="collapse"
                                data-target="#navbarCollapse">
                            <i class="tio-clear __text-26px"></i>
                        </button>
                    </div>

                    <ul class="navbar-nav d-block d-md-none">
                        <li class="nav-item dropdown <?php echo e(request()->is('/')?'active':''); ?>">
                            <a class="nav-link" href="<?php echo e(route('home')); ?>"><?php echo e(translate('home')); ?></a>
                        </li>
                    </ul>

                    <?php ($categories = \App\Utils\CategoryManager::getCategoriesWithCountingAndPriorityWiseSorting(dataLimit: 11)); ?>

                    <ul class="navbar-nav mega-nav pr-lg-2 pl-lg-2 mr-2 d-none d-md-block __mega-nav">
                        <li class="nav-item <?php echo e(!request()->is('/')?'dropdown':''); ?>">

                            <a class="nav-link dropdown-toggle category-menu-toggle-btn ps-0"
                               href="javascript:">
                                <svg width="21" height="21" viewBox="0 0 21 21" fill="none"
                                     xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                          d="M9.875 12.9195C9.875 12.422 9.6775 11.9452 9.32563 11.5939C8.97438 11.242 8.4975 11.0445 8 11.0445C6.75875 11.0445 4.86625 11.0445 3.625 11.0445C3.1275 11.0445 2.65062 11.242 2.29937 11.5939C1.9475 11.9452 1.75 12.422 1.75 12.9195V17.2945C1.75 17.792 1.9475 18.2689 2.29937 18.6202C2.65062 18.972 3.1275 19.1695 3.625 19.1695H8C8.4975 19.1695 8.97438 18.972 9.32563 18.6202C9.6775 18.2689 9.875 17.792 9.875 17.2945V12.9195ZM19.25 12.9195C19.25 12.422 19.0525 11.9452 18.7006 11.5939C18.3494 11.242 17.8725 11.0445 17.375 11.0445C16.1337 11.0445 14.2413 11.0445 13 11.0445C12.5025 11.0445 12.0256 11.242 11.6744 11.5939C11.3225 11.9452 11.125 12.422 11.125 12.9195V17.2945C11.125 17.792 11.3225 18.2689 11.6744 18.6202C12.0256 18.972 12.5025 19.1695 13 19.1695H17.375C17.8725 19.1695 18.3494 18.972 18.7006 18.6202C19.0525 18.2689 19.25 17.792 19.25 17.2945V12.9195ZM16.5131 9.66516L19.1206 7.05766C19.8525 6.32578 19.8525 5.13828 19.1206 4.4064L16.5131 1.79891C15.7813 1.06703 14.5937 1.06703 13.8619 1.79891L11.2544 4.4064C10.5225 5.13828 10.5225 6.32578 11.2544 7.05766L13.8619 9.66516C14.5937 10.397 15.7813 10.397 16.5131 9.66516ZM9.875 3.54453C9.875 3.04703 9.6775 2.57015 9.32563 2.2189C8.97438 1.86703 8.4975 1.66953 8 1.66953C6.75875 1.66953 4.86625 1.66953 3.625 1.66953C3.1275 1.66953 2.65062 1.86703 2.29937 2.2189C1.9475 2.57015 1.75 3.04703 1.75 3.54453V7.91953C1.75 8.41703 1.9475 8.89391 2.29937 9.24516C2.65062 9.59703 3.1275 9.79453 3.625 9.79453H8C8.4975 9.79453 8.97438 9.59703 9.32563 9.24516C9.6775 8.89391 9.875 8.41703 9.875 7.91953V3.54453Z"
                                          fill="currentColor"/>
                                </svg>
                                <span class="category-menu-toggle-btn-text">
                                    <?php echo e(translate('categories')); ?>

                                </span>
                            </a>
                        </li>
                    </ul>

                    <ul class="navbar-nav mega-nav1 pr-md-2 pl-md-2 d-block d-xl-none">
                        <li class="nav-item dropdown d-md-none">
                            <a class="nav-link dropdown-toggle ps-0"
                               href="javascript:" data-toggle="dropdown">
                                <i class="czi-menu align-middle mt-n1 me-2"></i>
                                <span class="me-4">
                                    <?php echo e(translate('categories')); ?>

                                </span>
                            </a>
                            <ul class="dropdown-menu __dropdown-menu-2 text-align-direction">
                                <?php ($categoryIndex=0); ?>
                                <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php ($categoryIndex++); ?>
                                    <?php if($categoryIndex < 10): ?>
                                        <li class="dropdown">

                                            <a href="<?php echo e(route('products',['category_id'=> $category['id'],'data_from'=>'category','page'=>1])); ?>" class="d-flex gap-10px align-items-center">
                                                <img class="aspect-1 rounded-circle" width="20" src="<?php echo e(getStorageImages(path: $category?->icon_full_url, type: 'category')); ?>" alt="<?php echo e($category['name']); ?>">
                                                <span><?php echo e($category['name']); ?></span>
                                            </a>
                                            <?php if($category->childes->count() > 0): ?>
                                                <a data-toggle='dropdown' class='__ml-50px'>
                                                    <i class="czi-arrow-<?php echo e(Session::get('direction') === "rtl" ? 'left' : 'right'); ?> __inline-16"></i>
                                                </a>
                                            <?php endif; ?>

                                            <?php if($category->childes->count()>0): ?>
                                                <ul class="dropdown-menu text-align-direction">
                                                    <?php $__currentLoopData = $category['childes']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subCategory): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <li class="dropdown">
                                                            <a href="<?php echo e(route('products',['sub_category_id'=> $subCategory['id'],'data_from'=>'category','page'=>1])); ?>">
                                                                <span><?php echo e($subCategory['name']); ?></span>
                                                            </a>

                                                            <?php if($subCategory->childes->count()>0): ?>
                                                                <a class="header-subcategories-links"
                                                                   data-toggle='dropdown'>
                                                                    <i class="czi-arrow-<?php echo e(Session::get('direction') === "rtl" ? 'left' : 'right'); ?> __inline-16"></i>
                                                                </a>
                                                                <ul class="dropdown-menu">
                                                                    <?php $__currentLoopData = $subCategory['childes']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subSubCategory): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                        <li>
                                                                            <a class="dropdown-item"
                                                                               href="<?php echo e(route('products',['sub_sub_category_id'=> $subSubCategory['id'],'data_from'=>'category','page'=>1])); ?>"><?php echo e($subSubCategory['name']); ?></a>
                                                                        </li>
                                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                </ul>
                                                            <?php endif; ?>
                                                        </li>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </ul>
                                            <?php endif; ?>
                                        </li>
                                    <?php endif; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <li class="__inline-17">
                                    <div>
                                        <a class="dropdown-item web-text-primary" href="<?php echo e(route('categories')); ?>">
                                            <?php echo e(translate('view_more')); ?>

                                        </a>
                                    </div>
                                </li>
                            </ul>
                        </li>
                    </ul>

                    <ul class="navbar-nav">
                        <li class="nav-item dropdown d-none d-md-block <?php echo e(request()->is('/')?'active':''); ?>">
                            <a class="nav-link" href="<?php echo e(route('home')); ?>"><?php echo e(translate('home')); ?></a>
                        </li>

                        <?php if(getWebConfig(name: 'product_brand')): ?>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#"
                                   data-toggle="dropdown"><?php echo e(translate('brand')); ?></a>
                                <ul class="text-align-direction dropdown-menu __dropdown-menu-sizing dropdown-menu-<?php echo e(Session::get('direction') === "rtl" ? 'right' : 'left'); ?> scroll-bar">
                                    <?php ($brandIndex=0); ?>
                                    <?php $__currentLoopData = \App\Utils\BrandManager::getActiveBrandWithCountingAndPriorityWiseSorting(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $brand): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php ($brandIndex++); ?>
                                        <?php if($brandIndex < 10): ?>
                                            <li class="__inline-17">
                                                <div>
                                                    <a class="dropdown-item"
                                                       href="<?php echo e(route('products',['brand_id'=> $brand['id'],'data_from'=>'brand','page'=>1])); ?>">
                                                        <?php echo e($brand['name']); ?>

                                                    </a>
                                                </div>
                                                <div class="align-baseline">
                                                    <?php if($brand['brand_products_count'] > 0 ): ?>
                                                        <span class="count-value px-2">( <?php echo e($brand['brand_products_count']); ?> )</span>
                                                    <?php endif; ?>
                                                </div>
                                            </li>
                                        <?php endif; ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <li class="__inline-17">
                                        <div>
                                            <a class="dropdown-item web-text-primary" href="<?php echo e(route('brands')); ?>">
                                                <?php echo e(translate('view_more')); ?>

                                            </a>
                                        </div>
                                    </li>
                                </ul>
                            </li>
                        <?php endif; ?>

                        <?php if(
                            count(getFeaturedDealsProductList()) > 0 &&
                            !(($web_config['flash_deals'] || count($web_config['flash_deals_products']) > 0) || $web_config['discount_product'] > 0 || $web_config['clearance_sale_product_count'] > 0)): ?>
                            <li class="nav-item dropdown">
                                <a class="nav-link text-capitalize"
                                   href="<?php echo e(route('products',['offer_type'=>'featured_deal'])); ?>">
                                    <?php echo e(translate('featured_Deal')); ?>

                                </a>
                            </li>
                        <?php elseif(
                            ($web_config['flash_deals'] && count($web_config['flash_deals_products']) > 0) &&
                            !(count(getFeaturedDealsProductList()) > 0 || $web_config['discount_product'] > 0 || $web_config['clearance_sale_product_count'] > 0)
                            ): ?>
                            <li class="nav-item dropdown">
                                <a class="nav-link text-capitalize"
                                   href="<?php echo e(route('flash-deals', [$web_config['flash_deals']['id'] ?? 0])); ?>">
                                    <?php echo e(translate('flash_deal')); ?>

                                </a>
                            </li>
                        <?php elseif(
                            ($web_config['discount_product'] > 0) &&
                            !(count(getFeaturedDealsProductList()) > 0 || ($web_config['flash_deals'] && count($web_config['flash_deals_products']) > 0) || $web_config['clearance_sale_product_count'] > 0)
                            ): ?>
                            <li class="nav-item dropdown">
                                <a class="nav-link text-capitalize"
                                   href="<?php echo e(route('products', ['offer_type' => 'discounted', 'page' => 1])); ?>">
                                    <?php echo e(translate('discounted_products')); ?>

                                </a>
                            </li>
                        <?php elseif(
                            ($web_config['clearance_sale_product_count'] > 0) &&
                            !(count(getFeaturedDealsProductList()) > 0 || ($web_config['flash_deals'] || count($web_config['flash_deals_products']) > 0) || $web_config['discount_product'] > 0)
                            ): ?>
                            <li class="nav-item dropdown">
                                <a class="nav-link text-capitalize"
                                   href="<?php echo e(route('products', ['offer_type' => 'clearance_sale', 'page' => 1])); ?>">
                                    <?php echo e(translate('clearance_Sale')); ?>

                                </a>
                            </li>
                        <?php elseif(count(getFeaturedDealsProductList()) > 0 || ($web_config['flash_deals'] && count($web_config['flash_deals_products']) > 0) || $web_config['discount_product'] > 0 || $web_config['clearance_sale_product_count'] > 0): ?>
                            <li class="nav-item">
                                <div class="dropdown">
                                    <button class="btn dropdown-toggle text-white text-max-md-dark text-capitalize ps-2"
                                            type="button" id="dropdownMenuButton"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <?php echo e(translate('offers')); ?>

                                    </button>
                                    <div class="dropdown-menu __dropdown-menu-3 __min-w-165px text-align-direction"
                                         aria-labelledby="dropdownMenuButton">
                                        <?php if(count(getFeaturedDealsProductList()) > 0): ?>
                                            <a class="dropdown-item text-nowrap text-capitalize" href="<?php echo e(route('products',['offer_type'=>'featured_deal'])); ?>">
                                                <?php echo e(translate('featured_Deal')); ?>

                                            </a>
                                        <?php endif; ?>

                                        <?php if($web_config['flash_deals'] && count($web_config['flash_deals_products']) > 0): ?>
                                            <?php if(count(getFeaturedDealsProductList()) > 0): ?>
                                                <div class="dropdown-divider"></div>
                                            <?php endif; ?>
                                            <a class="dropdown-item text-nowrap text-capitalize" href="<?php echo e(route('flash-deals',[ $web_config['flash_deals']['id'] ?? 0])); ?>">
                                                <?php echo e(translate('flash_deal')); ?>

                                            </a>
                                        <?php endif; ?>

                                        <?php if($web_config['discount_product'] > 0): ?>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item text-nowrap text-capitalize" href="<?php echo e(route('products', ['offer_type' => 'discounted', 'page' => 1])); ?>">
                                                <?php echo e(translate('discounted_products')); ?>

                                            </a>
                                        <?php endif; ?>

                                        <?php if($web_config['clearance_sale_product_count'] > 0): ?>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item text-nowrap" href="<?php echo e(route('products', ['offer_type' => 'clearance_sale', 'page' => 1])); ?>">
                                                <?php echo e(translate('clearance_Sale')); ?>

                                            </a>
                                        <?php endif; ?>

                                    </div>
                                </div>
                            </li>
                        <?php endif; ?>

                        <?php if($web_config['digital_product_setting'] && count($web_config['publishing_houses']) == 1): ?>
                            <li class="nav-item dropdown d-none d-md-block <?php echo e(request()->is('/')?'active':''); ?>">
                                <a class="nav-link" href="<?php echo e(route('products',['publishing_house_id' => 0, 'product_type' => 'digital', 'page'=>1])); ?>">
                                    <?php echo e(translate('Publication_House')); ?>

                                </a>
                            </li>
                        <?php elseif($web_config['digital_product_setting'] && count($web_config['publishing_houses']) > 1): ?>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown">
                                    <?php echo e(translate('Publication_House')); ?>

                                </a>
                                <ul class="text-align-direction dropdown-menu __dropdown-menu-sizing dropdown-menu-<?php echo e(Session::get('direction') === "rtl" ? 'right' : 'left'); ?> scroll-bar">
                                    <?php ($publishingHousesIndex=0); ?>
                                    <?php $__currentLoopData = $web_config['publishing_houses']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $publishingHouseItem): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php if($publishingHousesIndex < 10 && $publishingHouseItem['name'] != 'Unknown'): ?>
                                            <?php ($publishingHousesIndex++); ?>
                                            <li class="__inline-17">
                                                <div>
                                                    <a class="dropdown-item"
                                                       href="<?php echo e(route('products',['publishing_house_id'=> $publishingHouseItem['id'], 'product_type' => 'digital', 'page'=>1])); ?>">
                                                        <?php echo e($publishingHouseItem['name']); ?>

                                                    </a>
                                                </div>
                                                <div class="align-baseline">
                                                    <?php if($publishingHouseItem['publishing_house_products_count'] > 0 ): ?>
                                                        <span class="count-value px-2">( <?php echo e($publishingHouseItem['publishing_house_products_count']); ?> )</span>
                                                    <?php endif; ?>
                                                </div>
                                            </li>
                                        <?php endif; ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <li class="__inline-17">
                                        <div>
                                            <a class="dropdown-item web-text-primary"
                                               href="<?php echo e(route('products', ['product_type' => 'digital', 'page' => 1])); ?>">
                                                <?php echo e(translate('view_more')); ?>

                                            </a>
                                        </div>
                                    </li>
                                </ul>
                            </li>
                        <?php endif; ?>

                        <?php ($businessMode = getWebConfig(name: 'business_mode')); ?>
                        <?php if($businessMode == 'multi'): ?>
                            <li class="nav-item dropdown <?php echo e(request()->is('/')?'active':''); ?>">
                                <a class="nav-link text-capitalize"
                                   href="<?php echo e(route('vendors')); ?>"><?php echo e(translate('all_vendors')); ?></a>
                            </li>
                        <?php endif; ?>

                        <?php if(auth('customer')->check()): ?>
                            <li class="nav-item d-md-none">
                                <a href="<?php echo e(route('user-account')); ?>" class="nav-link text-capitalize">
                                    <?php echo e(translate('user_profile')); ?>

                                </a>
                            </li>
                            <li class="nav-item d-md-none">
                                <a href="<?php echo e(route('wishlists')); ?>" class="nav-link">
                                    <?php echo e(translate('Wishlist')); ?>

                                </a>
                            </li>
                        <?php else: ?>
                            <li class="nav-item d-md-none">
                                <a class="dropdown-item pl-2" href="<?php echo e(route('customer.auth.login')); ?>">
                                    <i class="fa fa-sign-in mr-2"></i> <?php echo e(translate('sign_in')); ?>

                                </a>
                                <div class="dropdown-divider"></div>
                            </li>
                            <li class="nav-item d-md-none">
                                <a class="dropdown-item pl-2" href="<?php echo e(route('customer.auth.sign-up')); ?>">
                                    <i class="fa fa-user-circle mr-2"></i><?php echo e(translate('sign_up')); ?>

                                </a>
                            </li>
                        <?php endif; ?>
                        <?php if($businessMode == 'multi'): ?>
                            <?php if(getWebConfig(name: 'seller_registration')): ?>
                                <li class="nav-item">
                                    <div class="dropdown">
                                        <button class="btn dropdown-toggle text-white text-max-md-dark text-capitalize ps-2"
                                                type="button" id="dropdownMenuButton"
                                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <?php echo e(translate('vendor_zone')); ?>

                                        </button>
                                        <div class="dropdown-menu __dropdown-menu-3 __min-w-165px text-align-direction"
                                             aria-labelledby="dropdownMenuButton">
                                            <a class="dropdown-item text-nowrap text-capitalize" href="<?php echo e(route('vendor.auth.registration.index')); ?>">
                                                <?php echo e(translate('become_a_vendor')); ?>

                                            </a>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item text-nowrap" href="<?php echo e(route('vendor.auth.login')); ?>">
                                                <?php echo e(translate('vendor_login')); ?>

                                            </a>
                                        </div>
                                    </div>
                                </li>
                            <?php endif; ?>
                        <?php endif; ?>
                    </ul>
                    <?php if(auth('customer')->check()): ?>
                        <div class="logout-btn mt-auto d-md-none">
                            <hr>
                            <a href="<?php echo e(route('customer.auth.logout')); ?>" class="nav-link">
                                <strong class="text-base"><?php echo e(translate('logout')); ?></strong>
                            </a>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <div class="megamenu-wrap">
            <div class="container">
                <div class="category-menu-wrap">
                    <ul class="category-menu">
                        <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li>
                                <a href="<?php echo e(route('products',['category_id'=> $category['id'],'data_from'=>'category','page'=>1])); ?>">
                                    <span class="d-flex gap-10px justify-content-start align-items-center">
                                        <img class="aspect-1 rounded-circle" width="20" src="<?php echo e(getStorageImages(path: $category?->icon_full_url, type: 'category')); ?>" alt="<?php echo e($category['name']); ?>">
                                        <span class="line--limit-2"><?php echo e($category->name); ?></span>
                                    </span>
                                </a>
                                <?php if($category->childes->count() > 0): ?>
                                    <div class="mega_menu z-2">
                                        <?php $__currentLoopData = $category->childes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sub_category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <div class="mega_menu_inner">
                                                <h6>
                                                    <a href="<?php echo e(route('products',['sub_category_id'=> $sub_category['id'],'data_from'=>'category','page'=>1])); ?>"><?php echo e($sub_category->name); ?></a>
                                                </h6>
                                                <?php if($sub_category->childes->count() >0): ?>
                                                    <?php $__currentLoopData = $sub_category->childes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sub_sub_category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <div>
                                                            <a href="<?php echo e(route('products',['sub_sub_category_id'=> $sub_sub_category['id'],'data_from'=>'category','page'=>1])); ?>"><?php echo e($sub_sub_category->name); ?></a>
                                                        </div>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                <?php endif; ?>
                                            </div>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </div>
                                <?php endif; ?>
                            </li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <li class="text-center">
                            <a href="<?php echo e(route('categories')); ?>" class="text-primary font-weight-bold justify-content-center">
                                <?php echo e(translate('View_All')); ?>

                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</header>

<?php $__env->startPush('script'); ?>
    <script>
        "use strict";

        $(".category-menu").find(".mega_menu").parents("li")
            .addClass("has-sub-item").find("> a")
            .append("<i class='czi-arrow-<?php echo e(Session::get('direction') === "rtl" ? 'left' : 'right'); ?>'></i>");
    </script>
<?php $__env->stopPush(); ?>
<?php /**PATH /opt/projects/Genius/MarketMboa/code/resources/themes/default/layouts/front-end/partials/_header.blade.php ENDPATH**/ ?>