<?php if(isset($product)): ?>
    <?php ($overallRating = getOverallRating($product->reviews)); ?>
    <div class="flash_deal_product get-view-by-onclick" data-link="<?php echo e(route('product',$product->slug)); ?>">
        <?php if(getProductPriceByType(product: $product, type: 'discount', result: 'value') > 0): ?>
            <span class="for-discount-value p-1 pl-2 pr-2 font-bold fs-13">
                <span class="direction-ltr d-block">
                    -<?php echo e(getProductPriceByType(product: $product, type: 'discount', result: 'string')); ?>

                </span>
            </span>
        <?php endif; ?>
        <div class=" d-flex">
            <div class="d-flex align-items-center justify-content-center p-12px">
                <div class="flash-deals-background-image">
                    <img class="__img-125px" alt="" src="<?php echo e(getStorageImages(path: $product->thumbnail_full_url, type: 'product')); ?>">
                </div>
            </div>
            <div class="flash_deal_product_details pl-3 pr-3 pr-1 d-flex mt-3">
                <div>
                    <h3 class="mb-0 letter-spacing-0">
                        <a href="<?php echo e(route('product',$product->slug)); ?>"
                           class="flash-product-title text-capitalize fw-semibold">
                            <?php echo e(Str::limit($product['name'], 80)); ?>

                        </a>
                    </h3>
                    <?php if($overallRating[0] != 0 ): ?>
                        <div class="flash-product-review">
                            <?php for($inc=1;$inc<=5;$inc++): ?>
                                <?php if($inc <= (int)$overallRating[0]): ?>
                                    <i class="tio-star text-warning"></i>
                                <?php elseif($overallRating[0] != 0 && $inc <= (int)$overallRating[0] + 1.1 && $overallRating[0] > ((int)$overallRating[0])): ?>
                                    <i class="tio-star-half text-warning"></i>
                                <?php else: ?>
                                    <i class="tio-star-outlined text-warning"></i>
                                <?php endif; ?>
                            <?php endfor; ?>
                            <label class="badge-style2">
                                ( <?php echo e(count($product->reviews)); ?> )
                            </label>
                        </div>
                    <?php endif; ?>
                    <h4 class="d-flex flex-wrap gap-8 align-items-center row-gap-0 mb-0 letter-spacing-0">
                        <?php if(getProductPriceByType(product: $product, type: 'discount', result: 'value') > 0): ?>
                            <del class="category-single-product-price">
                                <?php echo e(webCurrencyConverter(amount: $product->unit_price)); ?>

                            </del>
                        <?php endif; ?>
                        <span class="flash-product-price text-dark fw-semibold">
                            <?php echo e(getProductPriceByType(product: $product, type: 'discounted_unit_price', result: 'string')); ?>

                        </span>
                    </h4>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>
<?php /**PATH /opt/projects/Genius/MarketMboa/code/resources/themes/default/web-views/partials/_product-card-2.blade.php ENDPATH**/ ?>