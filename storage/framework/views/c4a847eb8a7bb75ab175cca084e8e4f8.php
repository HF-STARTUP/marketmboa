<h3 class="mt-4 mb-3 text-center text-lg-left mobile-fs-20 fs-18 font-bold"><?php echo e(translate('shopping_cart')); ?></h3>

<?php ($shippingMethod=getWebConfig(name: 'shipping_method')); ?>
<?php ($cart=\App\Utils\CartManager::getCartListGroupQuery()); ?>

<div class="row g-3 mx-max-md-0 mb-3">
    <section class="col-lg-8 px-max-md-0">
        <?php if(count($cart)==0): ?>
            <?php ($isPhysicalProductExist = false); ?>
        <?php endif; ?>

        <div class="table-responsive d-none d-lg-block">
            <table
                class="table table-borderless table-thead-bordered table-nowrap table-align-middle card-table __cart-table">
                <thead class="thead-light">
                <tr class="">
                    <th class="font-weight-bold __w-45">
                        <div class="pl-3">
                            <?php echo e(translate('product')); ?>

                        </div>
                    </th>
                    <th class="font-weight-bold pl-0 __w-15p text-capitalize"><?php echo e(translate('unit_price')); ?></th>
                    <th class="font-weight-bold __w-15p">
                        <span class="pl-3"><?php echo e(translate('qty')); ?></span>
                    </th>
                    <th class="font-weight-bold __w-15p text-end">
                        <div class="pr-3">
                            <?php echo e(translate('total')); ?>

                        </div>
                    </th>
                </tr>
                </thead>
            </table>
            <?php $__currentLoopData = $cart; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $group_key=>$group): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="card __card cart_information __cart-table mb-3">
                        <?php
                        $isPhysicalProductExist = false;
                        $total_shipping_cost = 0;
                        foreach ($group as $row) {
                            if ($row->product_type == 'physical' && $row->is_checked) {
                                $isPhysicalProductExist = true;
                            }
                            if ($row->product_type == 'physical' && $row->is_checked && $row->shipping_type != "order_wise") {
                                $total_shipping_cost += $row->shipping_cost;
                            }
                        }

                        ?>

                    <?php $__currentLoopData = $group; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cart_key => $cartItem): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if($shippingMethod=='inhouse_shipping'): ?>
                            <?php
                                $admin_shipping = \App\Models\ShippingType::where('seller_id', 0)->first();
                                $shipping_type = isset($admin_shipping) == true ? $admin_shipping->shipping_type : 'order_wise';
                            ?>
                        <?php else: ?>
                            <?php
                                if ($cartItem->seller_is == 'admin') {
                                    $admin_shipping = \App\Models\ShippingType::where('seller_id', 0)->first();
                                    $shipping_type = isset($admin_shipping) == true ? $admin_shipping->shipping_type : 'order_wise';
                                } else {
                                    $seller_shipping = \App\Models\ShippingType::where('seller_id', $cartItem->seller_id)->first();
                                    $shipping_type = isset($seller_shipping) == true ? $seller_shipping->shipping_type : 'order_wise';
                                }
                            ?>
                        <?php endif; ?>

                        <?php if($cart_key==0): ?>
                            <div
                                class="card-header d-flex flex-wrap justify-content-between align-items-center gap-2 px-12">
                                <?php ($verify_status = \App\Utils\OrderManager::verifyCartListMinimumOrderAmount($request, $group_key)); ?>
                                <?php if($cartItem->seller_is=='admin'): ?>
                                    <div class="d-flex gap-2">
                                        <div class="d-flex gap-3 align-items-center">
                                            <input type="checkbox" class="shop-head-check shop-head-check-desktop">
                                            <a href="<?php echo e(route('shopView',['id'=>0])); ?>"
                                                class="text-primary d-flex align-items-center gap-2 fs-16">
                                                 <img src="<?php echo e(theme_asset(path: 'public/assets/front-end/img/cart-store.png')); ?>" alt="">
                                                 <?php echo e(getWebConfig(name: 'company_name')); ?>

                                             </a>
                                        </div>
                                        <?php if($verify_status['minimum_order_amount'] > $verify_status['amount']): ?>
                                            <span class="pl-1 text-danger pulse-button minimum-order-amount-message" data-toggle="tooltip"
                                                  data-placement="right"
                                                  data-title="<?php echo e(translate('minimum_Order_Amount')); ?> <?php echo e(webCurrencyConverter(amount: $verify_status['minimum_order_amount'])); ?> <?php echo e(translate('for')); ?> <?php if($cartItem->seller_is=='admin'): ?> <?php echo e(getWebConfig(name: 'company_name')); ?> <?php else: ?> <?php echo e(\App\Utils\get_shop_name($cartItem['seller_id'])); ?> <?php endif; ?>"
                                                  title="<?php echo e(translate('minimum_Order_Amount')); ?> <?php echo e(webCurrencyConverter(amount: $verify_status['minimum_order_amount'])); ?> <?php echo e(translate('for')); ?> <?php if($cartItem->seller_is=='admin'): ?> <?php echo e(getWebConfig(name: 'company_name')); ?> <?php else: ?> <?php echo e(\App\Utils\get_shop_name($cartItem['seller_id'])); ?> <?php endif; ?>">
                                                    <i class="czi-security-announcement"></i>
                                                </span>
                                        <?php endif; ?>
                                    </div>
                                <?php else: ?>
                                    <?php
                                        $shopIdentity = \App\Models\Shop::where(['seller_id'=>$cartItem['seller_id']])->first();
                                    ?>
                                    <div class="d-flex gap-2">
                                        <?php if($shopIdentity): ?>
                                        <div class="d-flex gap-3 align-items-center">
                                            <input type="checkbox" class="shop-head-check shop-head-check-desktop">
                                            <a href="<?php echo e(route('shopView',['id' => $shopIdentity->id])); ?>"
                                                class="text-primary d-flex align-items-center gap-2 fs-16">
                                                 <img src="<?php echo e(theme_asset(path: 'public/assets/front-end/img/cart-store.png')); ?>" alt="">
                                                     <?php echo e($shopIdentity->name); ?>

                                            </a>
                                        </div>

                                            <?php if($verify_status['minimum_order_amount'] > $verify_status['amount']): ?>
                                                <span class="pl-1 text-danger pulse-button minimum-order-amount-message" data-toggle="tooltip"
                                                      data-placement="right"
                                                      data-title="<?php echo e(translate('minimum_Order_Amount')); ?> <?php echo e(webCurrencyConverter(amount: $verify_status['minimum_order_amount'])); ?> <?php echo e(translate('for')); ?> <?php if($cartItem->seller_is=='admin'): ?> <?php echo e(getWebConfig(name: 'company_name')); ?> <?php else: ?> <?php echo e(\App\Utils\get_shop_name($cartItem['seller_id'])); ?> <?php endif; ?>"
                                                      title="<?php echo e(translate('minimum_Order_Amount')); ?> <?php echo e(webCurrencyConverter(amount: $verify_status['minimum_order_amount'])); ?> <?php echo e(translate('for')); ?> <?php if($cartItem->seller_is=='admin'): ?> <?php echo e(getWebConfig(name: 'company_name')); ?> <?php else: ?> <?php echo e(\App\Utils\get_shop_name($cartItem['seller_id'])); ?> <?php endif; ?>">
                                                    <i class="czi-security-announcement"></i>
                                                </span>
                                            <?php endif; ?>
                                        <?php else: ?>
                                            <a href="javascript:"
                                               class="text-primary d-flex align-items-center gap-2 fs-16">
                                                <img src="<?php echo e(theme_asset(path: 'public/assets/front-end/img/cart-store.png')); ?>" alt="">
                                                <span class="text-danger"><?php echo e(translate('vendor_not_available')); ?></span>
                                            </a>
                                        <?php endif; ?>
                                    </div>
                                <?php endif; ?>

                                <?php ($chosenShipping=\App\Models\CartShipping::where(['cart_group_id'=>$cartItem['cart_group_id']])->first()); ?>
                                <div class=" bg-white select-method-border rounded">
                                    <?php if($isPhysicalProductExist && $shippingMethod=='sellerwise_shipping' && $shipping_type == 'order_wise'): ?>
                                        <?php if(isset($chosenShipping)==false): ?>
                                            <?php ($chosenShipping['shipping_method_id']=0); ?>
                                        <?php endif; ?>
                                        <?php ($shippings=\App\Utils\Helpers::getShippingMethods($cartItem['seller_id'], $cartItem['seller_is'])); ?>
                                        <?php if($isPhysicalProductExist && $shippingMethod=='sellerwise_shipping' && $shipping_type == 'order_wise'): ?>

                                            <div class="d-sm-flex">
                                                <?php if(isset($chosenShipping['shipping_cost'])): ?>
                                                    <div class="text-sm-nowrap mx-sm-2 mt-sm-2 mb-1">
                                                        <span class="font-weight-bold">
                                                            <?php echo e(translate('shipping_cost')); ?>

                                                        </span>:
                                                        <span>
                                                            <?php echo e(webCurrencyConverter($chosenShipping['shipping_cost'])); ?>

                                                        </span>
                                                    </div>
                                                <?php endif; ?>

                                                <?php if(count($shippings) > 0): ?>
                                                    <div class="">
                                                        <div class="dropdown">
                                                            <a class="bg-white border select-method-border rounded py-2 text-dark d-flex flex-wrap align-items-center" href="javascript:" data-toggle="dropdown">
                                                                    <?php
                                                                    $shippingTitle = translate('choose_shipping_method');
                                                                    foreach ($shippings as $shipping) {
                                                                        if ($chosenShipping['shipping_method_id'] == $shipping['id']) {
                                                                            $shippingTitle = ucfirst($shipping['title']) . ' ( ' . $shipping['duration'] . ' ) ' . webCurrencyConverter($shipping['cost']);
                                                                        }
                                                                    }
                                                                    ?>
                                                                <div class="flex-middle flex-nowrap fw-semibold text-dark px-2 text-capitalize">
                                                                    <i class="fa fa-truck"></i>
                                                                    <?php echo e(translate('shipping_method')); ?> :
                                                                </div>
                                                                <span class="px-1 max-width-200px text-nowrap text-truncate"><?php echo e($shippingTitle); ?></span>
                                                            </a>
                                                            <div class="dropdown-menu m-0 pb-0 w-100">
                                                                <ul class="list-unstyled mb-0">
                                                                    <?php $__currentLoopData = $shippings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $shipping): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                        <li class="cursor-pointer text-dark px-3 py-1 setShippingIdFunctionCartDetails font-semi-bold fs-14"
                                                                            data-id="<?php echo e($shipping['id']); ?>"
                                                                            data-cart-group="<?php echo e($cartItem['cart_group_id']); ?>"
                                                                        >
                                                                            <?php echo e(ucfirst($shipping['title']).' ( '.$shipping['duration'].' ) '.webCurrencyConverter($shipping['cost'])); ?>

                                                                        </li>
                                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                </ul>
                                                            </div>

                                                        </div>
                                                    </div>
                                                <?php else: ?>
                                                    <span class="text-danger d-flex align-items-center gap-1 fs-14 font-semi-bold user-select-none" data-toggle="tooltip"
                                                                  data-placement="top"
                                                                  title="<?php echo e(translate('No_shipping_options_available_at_this_shop')); ?>, <?php echo e(translate('please_remove_all_items_from_this_shop')); ?>">
                                                        <i class="czi-security-announcement"></i> <?php echo e(translate('shipping_Not_Available')); ?>

                                                    </span>
                                                <?php endif; ?>

                                            </div>
                                        <?php endif; ?>
                                    <?php else: ?>
                                        <?php if($isPhysicalProductExist && $shipping_type != 'order_wise'): ?>
                                            <div class="">
                                                <span class="font-weight-bold"><?php echo e(translate('total_shipping_cost')); ?></span>
                                                :
                                                <span><?php echo e(webCurrencyConverter(amount: $total_shipping_cost)); ?></span>
                                            </div>
                                        <?php elseif($isPhysicalProductExist && $shipping_type == 'order_wise' && $chosenShipping): ?>
                                            <div class="">
                                                <span class="font-weight-bold"><?php echo e(translate('total_shipping_cost')); ?></span>
                                                :
                                                <span><?php echo e(webCurrencyConverter(amount: $chosenShipping->shipping_cost)); ?></span>
                                            </div>
                                        <?php endif; ?>
                                    <?php endif; ?>

                                </div>
                            </div>
                        <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <table
                        class="table table-borderless table-thead-bordered table-nowrap table-align-middle card-table __cart-table">
                        <tbody>
                            <?php
                            $isPhysicalProductExist = false;
                            foreach ($group as $row) {
                                if ($row->product_type == 'physical' && $row->is_checked) {
                                    $isPhysicalProductExist = true;
                                }
                            }
                            ?>
                        <?php $__currentLoopData = $group; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cart_key=>$cartItem): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php ($product = $cartItem->allProducts); ?>

                            <?php
                                $getProductCurrentStock = $product->current_stock;
                                if(!empty($product->variation)) {
                                    foreach(json_decode($product->variation, true) as $productVariantSingle) {
                                        if($productVariantSingle['type'] == $cartItem->variant) {
                                            $getProductCurrentStock = $productVariantSingle['qty'];
                                        }
                                    }
                                }
                            ?>

                            <?php
                                $checkProductStatus = $cartItem->allProducts?->status ?? 0;
                                if($cartItem->seller_is == 'admin') {
                                    $inhouseTemporaryClose = getWebConfig(name: 'temporary_close') ? getWebConfig(name: 'temporary_close')['status'] : 0;
                                    $inhouseVacation = getWebConfig(name: 'vacation_add');
                                    $vacationStartDate = $inhouseVacation['vacation_start_date'] ? date('Y-m-d', strtotime($inhouseVacation['vacation_start_date'])) : null;
                                    $vacationEndDate = $inhouseVacation['vacation_end_date'] ? date('Y-m-d', strtotime($inhouseVacation['vacation_end_date'])) : null;
                                    $vacationStatus = $inhouseVacation['status'] ?? 0;
                                    if ($inhouseTemporaryClose || ($vacationStatus && (date('Y-m-d') >= $vacationStartDate) && (date('Y-m-d') <= $vacationEndDate))) {
                                        $checkProductStatus = 0;
                                    }
                                }else{
                                    if (!isset($cartItem->allProducts->seller) || (isset($cartItem->allProducts->seller) && $cartItem->allProducts->seller->status != 'approved')) {
                                        $checkProductStatus = 0;
                                    }
                                    if (!isset($cartItem->allProducts->seller->shop) || $cartItem->allProducts->seller->shop->temporary_close) {
                                        $checkProductStatus = 0;
                                    }
                                    if(isset($cartItem->allProducts->seller->shop) && ($cartItem->allProducts->seller->shop->vacation_status && (date('Y-m-d') >= $cartItem->allProducts->seller->shop->vacation_start_date) && (date('Y-m-d') <= $cartItem->allProducts->seller->shop->vacation_end_date))) {
                                        $checkProductStatus = 0;
                                    }
                                }
                            ?>

                            <tr>
                                <td class="__w-45">
                                    <div class="d-flex gap-3 align-items-center">
                                        <input type="checkbox" class="shop-item-check shop-item-check-desktop" value="<?php echo e($cartItem['id']); ?>" <?php echo e($cartItem['is_checked'] ? 'checked' : ''); ?>>

                                        <div class="d-flex gap-3">
                                            <div class="">
                                                <a href="<?php echo e($checkProductStatus == 1 ? route('product', $cartItem['slug']) : 'javascript:'); ?>"
                                                   class="position-relative overflow-hidden">
                                                    <img class="rounded __img-62 <?php echo e($checkProductStatus == 0?'custom-cart-opacity-50':''); ?>"
                                                         src="<?php echo e(getStorageImages(path: $cartItem?->product?->thumbnail_full_url, type: 'product')); ?>"
                                                        alt="<?php echo e(translate('product')); ?>">
                                                    <?php if($checkProductStatus == 0): ?>
                                                        <span class="temporary-closed position-absolute text-center p-2">
                                                            <span class="fs-12 font-weight-bolder"><?php echo e(translate('N/A')); ?></span>
                                                        </span>
                                                    <?php endif; ?>
                                                </a>
                                            </div>
                                            <div class="d-flex flex-column gap-1">
                                                <div
                                                    class="text-break __line-2 __w-18rem <?php echo e($checkProductStatus == 0?'custom-cart-opacity-50':''); ?>">
                                                    <a href="<?php echo e($checkProductStatus == 1 ? route('product', $cartItem['slug']) : 'javascript:'); ?>">
                                                        <?php echo e($cartItem['name']); ?>

                                                    </a>
                                                    <?php if(!empty($cartItem['variant'])): ?>
                                                        <div>
                                                            <span class="__text-12px"><?php echo e(translate('variant')); ?> : <?php echo e($cartItem['variant']); ?></span>
                                                        </div>
                                                    <?php endif; ?>
                                                </div>

                                                <?php if($product->product_type == 'physical' && $shipping_type != 'order_wise'): ?>
                                                    <div
                                                        class="d-flex flex-wrap gap-2 <?php echo e($checkProductStatus == 0?'custom-cart-opacity-50':''); ?>">
                                                        <span class="fw-semibold">
                                                            <?php echo e(translate('shipping_cost')); ?>

                                                        </span>:
                                                        <span>
                                                            <?php echo e(webCurrencyConverter(amount: $cartItem['shipping_cost'])); ?>

                                                        </span>
                                                    </div>
                                                <?php endif; ?>

                                                <?php if($product->product_type == 'physical' && $getProductCurrentStock < $cartItem['quantity']): ?>
                                                    <div class="d-flex text-danger font-bold">
                                                        <span><?php echo e(translate('Out_Of_Stock')); ?></span>
                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="<?php echo e($checkProductStatus == 0?'custom-cart-opacity-50':''); ?> __w-15p">
                                    <div class="text-center">
                                        <div class="fw-semibold">
                                            <?php echo e(webCurrencyConverter(amount: $cartItem['price']-$cartItem['discount'])); ?>

                                        </div>
                                        <span class="text-nowrap fs-10">
                                                <?php if($cartItem->tax_model === "exclude"): ?>
                                                (<?php echo e(translate('tax')); ?>

                                                : <?php echo e(webCurrencyConverter(amount: $cartItem['tax']*$cartItem['quantity'])); ?>

                                                )
                                            <?php else: ?>
                                                (<?php echo e(translate('tax_included')); ?>)
                                            <?php endif; ?>
                                             </span>
                                    </div>
                                </td>
                                <td class="__w-15p text-center">

                                    <?php ($minimum_order=\App\Utils\ProductManager::get_product($cartItem['product_id'])); ?>
                                    <?php if($checkProductStatus == 1): ?>
                                        <div class="qty d-flex justify-content-center align-items-center gap-3">
                                                <span class="qty_minus action-update-cart-quantity-list"
                                                      data-minimum-order="<?php echo e($product->minimum_order_qty); ?>"
                                                      data-cart-id="<?php echo e($cartItem['id']); ?>"
                                                      data-increment="<?php echo e('-1'); ?>"
                                                      data-event="<?php echo e($cartItem['quantity'] == $product->minimum_order_qty ? 'delete':'minus'); ?>">

                                                    <?php if($getProductCurrentStock < $cartItem['quantity'] || $cartItem['quantity'] == (isset($cartItem->product->minimum_order_qty) ? $cartItem->product->minimum_order_qty : 1)): ?>
                                                        <i class="tio-delete text-danger"></i>
                                                    <?php else: ?>
                                                        <i class="tio-remove"></i>
                                                    <?php endif; ?>

                                                </span>
                                            <input type="text" class="qty_input cartQuantity<?php echo e($cartItem['id']); ?> action-change-update-cart-quantity-list"
                                                   value="<?php echo e($cartItem['quantity']); ?>"
                                                   name="quantity[<?php echo e($cartItem['id']); ?>]"
                                                   id="cart_quantity_web<?php echo e($cartItem['id']); ?>"
                                                   data-current-stock="<?php echo e($getProductCurrentStock); ?>"
                                                   data-minimum-order="<?php echo e($product->minimum_order_qty); ?>"
                                                   data-cart-id="<?php echo e($cartItem['id']); ?>"
                                                   data-increment="<?php echo e('0'); ?>"
                                                   data-min="<?php echo e(isset($cartItem->product->minimum_order_qty) ? $cartItem->product->minimum_order_qty : 1); ?>"
                                                   oninput="this.value = this.value.replace(/[^0-9]/g, '')">
                                            <span class="qty_plus action-update-cart-quantity-list"
                                                  data-minimum-order="<?php echo e($product->minimum_order_qty); ?>"
                                                  data-cart-id="<?php echo e($cartItem['id']); ?>"
                                                  data-increment="<?php echo e('1'); ?>">
                                                    <i class="tio-add"></i>
                                            </span>
                                        </div>
                                    <?php else: ?>
                                        <div class="qty d-flex justify-content-center align-items-center gap-3">
                                            <span class="action-update-cart-quantity-list cursor-pointer"
                                                  data-minimum-order="<?php echo e($product?->minimum_order_qty ?? 1); ?>"
                                                  data-cart-id="<?php echo e($cartItem['id']); ?>"
                                                  data-increment="-<?php echo e($cartItem['quantity']); ?>"
                                                  data-event="delete">
                                                <i class="tio-delete text-danger" data-toggle="tooltip"
                                                   data-title="<?php echo e(translate('product_not_available_right_now')); ?>"></i>
                                            </span>
                                        </div>
                                    <?php endif; ?>
                                </td>
                                <td class="__w-15p text-end <?php echo e($checkProductStatus == 0?'custom-cart-opacity-50':''); ?>">
                                    <div>
                                        <?php echo e(webCurrencyConverter(amount: ($cartItem['price']-$cartItem['discount'])*$cartItem['quantity'])); ?>

                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>

                    <?php ($free_delivery_status = \App\Utils\OrderManager::getFreeDeliveryOrderAmountArray($group[0]->cart_group_id)); ?>
                    <?php if($free_delivery_status['status'] && (session()->missing('coupon_type') || session('coupon_type') !='free_delivery')): ?>
                        <div class="free-delivery-area px-3 mb-3 mb-lg-2">
                            <div class="d-flex align-items-center gap-8">
                                <img class="__w-30px"
                                     src="<?php echo e(theme_asset(path: 'public/assets/front-end/img/icons/free-shipping.png')); ?>" alt="">
                                <?php if($free_delivery_status['amount_need'] <= 0): ?>
                                    <span
                                        class="text-muted fs-12 mt-1"><?php echo e(translate('you_Get_Free_Delivery_Bonus')); ?></span>
                                <?php else: ?>
                                    <span
                                        class="need-for-free-delivery font-bold fs-12 mt-1 text-primary"><?php echo e(webCurrencyConverter(amount: $free_delivery_status['amount_need'])); ?></span>
                                    <span
                                        class="text-muted fs-12 mt-1"><?php echo e(translate('add_more_for_free_delivery')); ?></span>
                                <?php endif; ?>
                            </div>
                            <div class="progress free-delivery-progress">
                                <div class="progress-bar" role="progressbar"
                                     style="width: <?php echo e($free_delivery_status['percentage']); ?>%"
                                     aria-valuenow="<?php echo e($free_delivery_status['percentage']); ?>" aria-valuemin="0"
                                     aria-valuemax="100"></div>
                            </div>
                        </div>
                    <?php endif; ?>

                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>

        <?php $__currentLoopData = $cart; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $group_key => $group): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="cart_information mb-3 pb-3 w-100 d-lg-none">
                    <?php
                    $isPhysicalProductExist = false;
                    $total_shipping_cost = 0;
                    foreach ($group as $row) {
                        if ($row->product_type == 'physical' && $row->is_checked) {
                            $isPhysicalProductExist = true;
                        }
                        if ($row->product_type == 'physical' && $row->is_checked && $row->shipping_type != "order_wise") {
                            $total_shipping_cost += $row->shipping_cost;
                        }
                    }

                    ?>

                <?php $__currentLoopData = $group; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cart_key=>$cartItem): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if($shippingMethod=='inhouse_shipping'): ?>
                            <?php
                            $admin_shipping = \App\Models\ShippingType::where('seller_id', 0)->first();
                            $shipping_type = isset($admin_shipping) == true ? $admin_shipping->shipping_type : 'order_wise';
                            ?>
                    <?php else: ?>
                            <?php
                            if ($cartItem->seller_is == 'admin') {
                                $admin_shipping = \App\Models\ShippingType::where('seller_id', 0)->first();
                                $shipping_type = isset($admin_shipping) == true ? $admin_shipping->shipping_type : 'order_wise';
                            } else {
                                $seller_shipping = \App\Models\ShippingType::where('seller_id', $cartItem->seller_id)->first();
                                $shipping_type = isset($seller_shipping) == true ? $seller_shipping->shipping_type : 'order_wise';
                            }
                            ?>
                    <?php endif; ?>

                    <?php if($cart_key==0): ?>
                        <div
                            class="card-header d-flex flex-column gap-2 border-0 justify-content-between px-12">
                            <?php ($verify_status = \App\Utils\OrderManager::verifyCartListMinimumOrderAmount($request, $group_key)); ?>
                            <?php if($cartItem->seller_is=='admin'): ?>
                                <div class="d-flex gap-2">
                                    <div class="d-flex gap-3 align-items-center">
                                        <input type="checkbox" class="shop-head-check shop-head-check-mobile">
                                        <a href="<?php echo e(route('shopView',['id'=>0])); ?>"
                                           class="text-primary d-flex align-items-center gap-2 fs-16">
                                            <img src="<?php echo e(theme_asset(path: 'public/assets/front-end/img/cart-store.png')); ?>" alt="">
                                            <?php echo e(getWebConfig(name: 'company_name')); ?>

                                        </a>
                                    </div>
                                    <?php if($verify_status['minimum_order_amount'] > $verify_status['amount']): ?>
                                        <span class="pl-1 text-danger pulse-button minimum-order-amount-message" data-toggle="tooltip"
                                              data-placement="bottom"
                                              data-title="<?php echo e(translate('minimum_Order_Amount')); ?> <?php echo e(webCurrencyConverter(amount: $verify_status['minimum_order_amount'])); ?> <?php echo e(translate('for')); ?> <?php if($cartItem->seller_is=='admin'): ?> <?php echo e(getWebConfig(name: 'company_name')); ?> <?php else: ?> <?php echo e(\App\Utils\get_shop_name($cartItem['seller_id'])); ?> <?php endif; ?>"
                                              title="<?php echo e(translate('minimum_Order_Amount')); ?> <?php echo e(webCurrencyConverter(amount: $verify_status['minimum_order_amount'])); ?> <?php echo e(translate('for')); ?> <?php if($cartItem->seller_is=='admin'): ?> <?php echo e(getWebConfig(name: 'company_name')); ?> <?php else: ?> <?php echo e(\App\Utils\get_shop_name($cartItem['seller_id'])); ?> <?php endif; ?>">
                                                <i class="czi-security-announcement"></i>
                                            </span>
                                    <?php endif; ?>
                                </div>
                            <?php else: ?>
                                <?php
                                    $shopIdentity = \App\Models\Shop::where(['seller_id'=>$cartItem['seller_id']])->first();
                                ?>
                                <div class="d-flex gap-2">
                                    <?php if($shopIdentity): ?>
                                        <div class="d-flex gap-3 align-items-center">
                                            <input type="checkbox" class="shop-head-check shop-head-check-mobile">
                                            <a href="<?php echo e(route('shopView',['id' => $shopIdentity->id])); ?>"
                                               class="text-primary d-flex align-items-center gap-2 fs-16">
                                                <img src="<?php echo e(theme_asset(path: 'public/assets/front-end/img/cart-store.png')); ?>" alt="">
                                                <?php echo e($shopIdentity->name); ?>

                                            </a>
                                        </div>
                                        <?php if($verify_status['minimum_order_amount'] > $verify_status['amount']): ?>
                                            <span class="pl-1 text-danger pulse-button minimum-order-amount-message" data-toggle="tooltip"
                                                  data-placement="right"
                                                  data-title="<?php echo e(translate('minimum_Order_Amount')); ?> <?php echo e(webCurrencyConverter(amount: $verify_status['minimum_order_amount'])); ?> <?php echo e(translate('for')); ?> <?php if($cartItem->seller_is=='admin'): ?> <?php echo e(getWebConfig(name: 'company_name')); ?> <?php else: ?> <?php echo e(\App\Utils\get_shop_name($cartItem['seller_id'])); ?> <?php endif; ?>"
                                                  title="<?php echo e(translate('minimum_Order_Amount')); ?> <?php echo e(webCurrencyConverter(amount: $verify_status['minimum_order_amount'])); ?> <?php echo e(translate('for')); ?> <?php if($cartItem->seller_is=='admin'): ?> <?php echo e(getWebConfig(name: 'company_name')); ?> <?php else: ?> <?php echo e(\App\Utils\get_shop_name($cartItem['seller_id'])); ?> <?php endif; ?>">
                                                <i class="czi-security-announcement"></i>
                                            </span>
                                        <?php endif; ?>
                                    <?php else: ?>
                                        <a href="javascript:"
                                           class="text-primary d-flex align-items-center gap-2 fs-16">
                                            <img src="<?php echo e(theme_asset(path: 'public/assets/front-end/img/cart-store.png')); ?>" alt="">
                                            <span class="text-danger"><?php echo e(translate('vendor_not_available')); ?></span>
                                        </a>
                                    <?php endif; ?>

                                </div>
                            <?php endif; ?>

                            <div class=" bg-white select-method-border rounded">
                                <?php if($isPhysicalProductExist && $shippingMethod=='sellerwise_shipping' && $shipping_type == 'order_wise'): ?>
                                    <?php ($chosenShipping=\App\Models\CartShipping::where(['cart_group_id'=>$cartItem['cart_group_id']])->first()); ?>
                                    <?php if(isset($chosenShipping)==false): ?>
                                        <?php ($chosenShipping['shipping_method_id']=0); ?>
                                    <?php endif; ?>
                                    <?php ( $shippings=\App\Utils\Helpers::getShippingMethods($cartItem['seller_id'],$cartItem['seller_is'])); ?>
                                    <?php if($isPhysicalProductExist && $shippingMethod=='sellerwise_shipping' && $shipping_type == 'order_wise'): ?>

                                        <?php if(count($shippings) > 0): ?>
                                            <div class="d-sm-flex">
                                                <select class="form-control fs-13 font-weight-bold text-capitalize border-aliceblue max-240px action-set-shipping-id"
                                                        data-product-id="<?php echo e($cartItem['cart_group_id']); ?>">
                                                    <option><?php echo e(translate('choose_shipping_method')); ?></option>
                                                    <?php $__currentLoopData = $shippings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $shipping): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <option
                                                            value="<?php echo e($shipping['id']); ?>" <?php echo e($chosenShipping['shipping_method_id']==$shipping['id']?'selected':''); ?>>
                                                            <?php echo e(translate('shipping_method')); ?>

                                                            : <?php echo e($shipping['title'].' ( '.$shipping['duration'].' ) '.webCurrencyConverter(amount: $shipping['cost'])); ?>

                                                        </option>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </select>
                                            </div>
                                        <?php else: ?>
                                            <span class="text-danger d-flex align-items-center gap-1 fs-14 font-semi-bold user-select-none" data-toggle="tooltip"
                                                  data-placement="top"
                                                  title="<?php echo e(translate('No_shipping_options_available_at_this_shop')); ?>, <?php echo e(translate('please_remove_all_items_from_this_shop')); ?>">
                                                        <i class="czi-security-announcement"></i> <?php echo e(translate('shipping_Not_Available')); ?>

                                                    </span>
                                        <?php endif; ?>

                                        <?php if(isset($chosenShipping['shipping_cost'])): ?>
                                            <div class="text-sm-nowrap mt-2 text-center fs-12">
                                                <span class="font-weight-bold"><?php echo e(translate('shipping_cost')); ?></span>
                                                :<span><?php echo e(webCurrencyConverter($chosenShipping['shipping_cost'])); ?></span>
                                            </div>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                <?php else: ?>
                                    <?php if($isPhysicalProductExist && $shipping_type != 'order_wise'): ?>
                                        <div class="text-sm-nowrap text-center fs-12">
                                            <span class="font-weight-bold"><?php echo e(translate('total_shipping_cost')); ?></span> :
                                            <span><?php echo e(webCurrencyConverter(amount: $total_shipping_cost)); ?></span>
                                        </div>
                                    <?php elseif($isPhysicalProductExist && $shipping_type == 'order_wise' && $chosenShipping): ?>
                                        <div class="text-sm-nowrap text-center fs-12">
                                            <span class="font-weight-bold"><?php echo e(translate('total_shipping_cost')); ?></span> :
                                            <span><?php echo e(webCurrencyConverter(amount: isset($chosenShipping['shipping_cost']) ? $chosenShipping['shipping_cost'] : 0)); ?></span>
                                        </div>
                                    <?php endif; ?>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                <?php
                    $isPhysicalProductExist = false;
                    foreach ($group as $row) {
                        if ($row->product_type == 'physical' && $row->is_checked) {
                            $isPhysicalProductExist = true;
                        }
                    }
                ?>
                <?php $__currentLoopData = $group; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cart_key=>$cartItem): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php ($product = $cartItem->allProducts); ?>

                    <?php
                        $checkProductStatus = $cartItem->allProducts?->status ?? 0;
                        if($cartItem->seller_is == 'admin') {
                            $inhouseTemporaryClose = getWebConfig(name: 'temporary_close') ? getWebConfig(name: 'temporary_close')['status'] : 0;
                            $inhouseVacation = getWebConfig(name: 'vacation_add');
                            $vacationStartDate = $inhouseVacation['vacation_start_date'] ? date('Y-m-d', strtotime($inhouseVacation['vacation_start_date'])) : null;
                            $vacationEndDate = $inhouseVacation['vacation_end_date'] ? date('Y-m-d', strtotime($inhouseVacation['vacation_end_date'])) : null;
                            $vacationStatus = $inhouseVacation['status'] ?? 0;
                            if ($inhouseTemporaryClose || ($vacationStatus && (date('Y-m-d') >= $vacationStartDate) && (date('Y-m-d') <= $vacationEndDate))) {
                                $checkProductStatus = 0;
                            }
                        }else{
                            if (!isset($cartItem->allProducts->seller) || (isset($cartItem->allProducts->seller) && $cartItem->allProducts->seller->status != 'approved')) {
                                $checkProductStatus = 0;
                            }
                            if (!isset($cartItem->allProducts->seller->shop) || $cartItem->allProducts->seller->shop->temporary_close) {
                                $checkProductStatus = 0;
                            }
                            if(isset($cartItem->allProducts->seller->shop) && ($cartItem->allProducts->seller->shop->vacation_status && (date('Y-m-d') >= $cartItem->allProducts->seller->shop->vacation_start_date) && (date('Y-m-d') <= $cartItem->allProducts->seller->shop->vacation_end_date))) {
                                $checkProductStatus = 0;
                            }
                        }
                    ?>
                    <div
                        class="d-flex justify-content-between gap-3 p-3 fs-12  <?php echo e(count($group)-1 == $cart_key ? '' :'border-bottom border-aliceblue'); ?>">
                        <div class="d-flex gap-3 align-items-center">
                            <input type="checkbox" class="shop-item-check shop-item-check-mobile" value="<?php echo e($cartItem['id']); ?>" <?php echo e($cartItem['is_checked'] ? 'checked' : ''); ?>>
                            <div class="d-flex align-items-center gap-3">
                                <div class="">
                                    <a href="<?php echo e($checkProductStatus == 1 ? route('product',$cartItem['slug']) : 'javascript:'); ?>"
                                    class="position-relative overflow-hidden">
                                        <img class="rounded __img-48 <?php echo e($checkProductStatus == 0?'custom-cart-opacity-50':''); ?>"
                                            src="<?php echo e(getStorageImages(path: $cartItem?->product?->thumbnail_full_url, type: 'product')); ?>"
                                            alt="<?php echo e(translate('product')); ?>">
                                        <?php if($checkProductStatus == 0): ?>
                                            <span class="temporary-closed position-absolute text-center p-2">
                                                <span class="fs-12 font-weight-bolder"><?php echo e(translate('N/A')); ?></span>
                                            </span>
                                        <?php endif; ?>
                                    </a>
                                </div>
                                <div class="d-flex flex-column gap-1 <?php echo e($checkProductStatus == 0?'custom-cart-opacity-50':''); ?>">
                                    <div class="text-break __line-2">
                                        <a href="<?php echo e($checkProductStatus == 1 ? route('product',$cartItem['slug']) : 'javascript:'); ?>"><?php echo e($cartItem['name']); ?></a>
                                    </div>

                                    <?php if(!empty($cartItem['variant'])): ?>
                                        <div>
                                            <span class="__text-12px"><?php echo e(translate('variant')); ?> : <?php echo e($cartItem['variant']); ?></span>
                                        </div>
                                    <?php endif; ?>
                                    <div class="d-flex flex-wrap column-gap-2">
                                        <div class="text-nowrap text-muted"><?php echo e(translate('unit_price')); ?> :</div>
                                        <div class="text-start d-flex gap-1 flex-wrap">
                                            <div
                                                class="fw-semibold"><?php echo e(webCurrencyConverter(amount: $cartItem['price']-$cartItem['discount'])); ?></div>
                                        </div>
                                    </div>

                                    <div class="d-flex gap-2">
                                        <div class="text-nowrap text-muted"><?php echo e(translate('total')); ?> :</div>
                                        <div class="font-semi-bold">
                                            <?php echo e(webCurrencyConverter(amount: ($cartItem['price']-$cartItem['discount'])*$cartItem['quantity'])); ?>


                                        </div>
                                        <span class="text-nowrap fs-10 mt-1px">
                                            <?php if($cartItem->tax_model === "exclude"): ?>
                                                (<?php echo e(translate('tax')); ?>

                                                : <?php echo e(webCurrencyConverter(amount: $cartItem['tax']*$cartItem['quantity'])); ?>

                                                )
                                            <?php else: ?>
                                                (<?php echo e(translate('tax_included')); ?>)
                                            <?php endif; ?>
                                        </span>
                                    </div>

                                    <?php if($shipping_type != 'order_wise'): ?>
                                        <div class="d-flex flex-wrap gap-2 <?php echo e($checkProductStatus == 0?'custom-cart-opacity-50':''); ?>">
                                            <span class="text-muted"> <?php echo e(translate('shipping_cost')); ?></span>:<span
                                                class="font-semi-bold"><?php echo e(webCurrencyConverter(amount: $cartItem['shipping_cost'])); ?></span>
                                        </div>
                                    <?php endif; ?>

                                    <?php if($product->product_type == 'physical' && $getProductCurrentStock < $cartItem['quantity']): ?>
                                        <div class="d-flex text-danger font-bold">
                                            <span><?php echo e(translate('Out_Of_Stock')); ?></span>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>

                        <div>
                            <?php ($minimum_order=\App\Utils\ProductManager::get_product($cartItem['product_id'])); ?>
                            <?php if($minimum_order && $checkProductStatus): ?>
                                <div class="qty d-flex flex-column align-items-center gap-1">
                                    <span class="qty_plus action-update-cart-quantity-list-mobile p-2"
                                          data-minimum-order="<?php echo e($product->minimum_order_qty); ?>"
                                          data-cart-id="<?php echo e($cartItem['id']); ?>"
                                          data-increment="1">
                                        <i class="tio-add"></i>
                                    </span>
                                    <input type="number" class="qty_input cartQuantity<?php echo e($cartItem['id']); ?> action-change-update-cart-quantity-list-mobile"
                                           value="<?php echo e($cartItem['quantity']); ?>" name="quantity[<?php echo e($cartItem['id']); ?>]"
                                           id="cart_quantity_mobile<?php echo e($cartItem['id']); ?>"
                                           data-minimum-order="<?php echo e($product->minimum_order_qty); ?>"
                                           data-cart-id="<?php echo e($cartItem['id']); ?>"
                                           data-increment="0"
                                           data-current-stock="<?php echo e($getProductCurrentStock); ?>"
                                           data-min="<?php echo e(isset($cartItem->product->minimum_order_qty) ? $cartItem->product->minimum_order_qty : 1); ?>"
                                           oninput="this.value = this.value.replace(/[^0-9]/g, '')">
                                    <span class="qty_minus action-update-cart-quantity-list-mobile p-2"
                                          data-minimum-order="<?php echo e($product->minimum_order_qty); ?>"
                                          data-cart-id="<?php echo e($cartItem['id']); ?>"
                                          data-increment="-1"
                                          data-event="<?php echo e($cartItem['quantity'] == $product->minimum_order_qty ? 'delete':'minus'); ?>">

                                        <?php if($getProductCurrentStock < $cartItem['quantity'] || $cartItem['quantity'] == (isset($cartItem->product->minimum_order_qty) ? $cartItem->product->minimum_order_qty : 1)): ?>
                                        <i class="tio-delete text-danger"></i>
                                        <?php else: ?>
                                            <i class="tio-remove"></i>
                                        <?php endif; ?>
                                    </span>
                                </div>
                            <?php else: ?>
                                <div class="qty d-flex flex-column align-items-center gap-3">
                                <span class="action-update-cart-quantity-list-mobile cursor-pointer"
                                      data-minimum-order="<?php echo e($product?->minimum_order_qty ?? 1); ?>"
                                      data-cart-id="<?php echo e($cartItem['id']); ?>"
                                      data-increment="-<?php echo e($cartItem['quantity']); ?>"
                                      data-event="delete">
                                    <i class="tio-delete text-danger" data-toggle="tooltip"
                                       data-title="<?php echo e(translate('product_not_available_right_now')); ?>"></i>
                                </span>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                <?php ($free_delivery_status = \App\Utils\OrderManager::getFreeDeliveryOrderAmountArray($group[0]->cart_group_id)); ?>
                <?php if($free_delivery_status['status'] && (session()->missing('coupon_type') || session('coupon_type') !='free_delivery')): ?>
                    <div class="free-delivery-area px-3 mb-3 mb-lg-2">
                        <div class="d-flex align-items-center gap-8">
                            <img class="__w-30px"
                                 src="<?php echo e(theme_asset(path: 'public/assets/front-end/img/icons/free-shipping.png')); ?>" alt="">
                            <?php if($free_delivery_status['amount_need'] <= 0): ?>
                                <span
                                    class="text-muted fs-12 mt-1"><?php echo e(translate('you_Get_Free_Delivery_Bonus')); ?></span>
                            <?php else: ?>
                                <span
                                    class="need-for-free-delivery font-bold fs-12 mt-1 text-primary"><?php echo e(webCurrencyConverter(amount: $free_delivery_status['amount_need'])); ?></span>
                                <span class="text-muted fs-12 mt-1"><?php echo e(translate('add_more_for_free_delivery')); ?></span>
                            <?php endif; ?>
                        </div>
                        <div class="progress free-delivery-progress">
                            <div class="progress-bar" role="progressbar"
                                 style="width: <?php echo e($free_delivery_status['percentage']); ?>%"
                                 aria-valuenow="<?php echo e($free_delivery_status['percentage']); ?>" aria-valuemin="0"
                                 aria-valuemax="100"></div>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>


        <?php if($shippingMethod=='inhouse_shipping'): ?>
                <?php
                $isPhysicalProductExist = false;
                foreach ($cart as $group_key => $group) {
                    foreach ($group as $row) {
                        if ($row->product_type == 'physical' && $row->is_checked) {
                            $isPhysicalProductExist = true;
                        }
                    }
                }
                ?>

                <?php
                $admin_shipping = \App\Models\ShippingType::where('seller_id', 0)->first();
                $shipping_type = isset($admin_shipping) == true ? $admin_shipping->shipping_type : 'order_wise';
                ?>
            <?php if($shipping_type == 'order_wise' && $isPhysicalProductExist): ?>
                <?php ($shippings=\App\Utils\Helpers::getShippingMethods(1,'admin')); ?>
                <?php ($chosenShipping=\App\Models\CartShipping::where(['cart_group_id'=>$cartItem['cart_group_id']])->first()); ?>

                <?php if(isset($chosenShipping)==false): ?>
                    <?php ($chosenShipping['shipping_method_id']=0); ?>
                <?php endif; ?>
                <div class="px-3 px-md-0 mb-3">
                    <div class="row">
                        <div class="col-12">
                            <select class="form-control border-aliceblue action-set-shipping-id"
                                    data-product-id="all_cart_group">
                                <option><?php echo e(translate('choose_shipping_method')); ?></option>
                                <?php $__currentLoopData = $shippings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $shipping): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option
                                        value="<?php echo e($shipping['id']); ?>" <?php echo e($chosenShipping['shipping_method_id']==$shipping['id']?'selected':''); ?>>
                                        <?php echo e(translate('shipping_method')); ?>

                                        : <?php echo e($shipping['title'].' ( '.$shipping['duration'].' ) '.webCurrencyConverter(amount: $shipping['cost'])); ?>

                                    </option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        <?php endif; ?>

        <?php if( $cart->count() == 0): ?>
            <div class="card mb-4">
                <div class="card-body py-5">
                    <div class="py-md-4">
                        <div class="text-center text-capitalize">
                            <img class="mb-3 mw-100"
                                 src="<?php echo e(theme_asset(path: 'public/assets/front-end/img/icons/empty-cart.svg')); ?>" alt="">
                            <p class="text-capitalize"><?php echo e(translate('Your_Cart_is_Empty')); ?>!</p>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>


        <div class="px-3 px-md-0 mt-3 mt-md-0">
            <form method="get">
                <div class="mb-lg-3">
                    <div class="row">
                        <div class="col-12">
                            <label for="phoneLabel" class="form-label input-label fs-14 font-semibold">
                                <?php echo e(translate('order_note')); ?>

                                <span class="input-label-secondary">(<?php echo e(translate('optional')); ?>)</span>
                            </label>
                            <textarea class="form-control w-100 border-aliceblue h-100-200" id="order_note"
                                      name="order_note"><?php echo e(session('order_note')); ?></textarea>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>

    <?php echo $__env->make('web-views.partials._order-summary', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <span id="route-customer-set-shipping-method" data-url="<?php echo e(url('/customer/set-shipping-method')); ?>"></span>
    <span id="route-action-checkout-function" data-route="shop-cart"></span>
</div>

<?php $__env->startPush('script'); ?>
    <script src="<?php echo e(theme_asset(path: 'public/assets/front-end/js/cart-details.js')); ?>"></script>
<?php $__env->stopPush(); ?>
<?php /**PATH /opt/projects/Genius/MarketMboa/code/resources/themes/default/web-views/cart/_cart-details.blade.php ENDPATH**/ ?>