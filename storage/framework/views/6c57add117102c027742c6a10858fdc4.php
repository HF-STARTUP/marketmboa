<?php ($overallRating = getOverallRating($product->reviews)); ?>

<div class="product-single-hover style--card">
    <div class="overflow-hidden position-relative">
        <div class=" inline_product clickable d-flex justify-content-center">
            <?php if(getProductPriceByType(product: $product, type: 'discount', result: 'value') > 0): ?>
                <div class="d-flex">
                    <span class="for-discount-value p-1 pl-2 pr-2 font-bold fs-13">
                        <span class="direction-ltr d-block">
                            -<?php echo e(getProductPriceByType(product: $product, type: 'discount', result: 'string')); ?>

                        </span>
                    </span>
                </div>
            <?php else: ?>
                <div class="d-flex justify-content-end">
                    <span class="for-discount-value-null"></span>
                </div>
            <?php endif; ?>
            <div class="p-10px pb-0">
                <a href="<?php echo e(route('product',$product->slug)); ?>" class="w-100">
                    <img alt=""
                         src="<?php echo e(getStorageImages(path: $product->thumbnail_full_url, type: 'product')); ?>">
                </a>
            </div>

            <div class="quick-view">
                <a class="btn-circle stopPropagation action-product-quick-view" href="javascript:" data-product-id="<?php echo e($product->id); ?>">
                    <i class="czi-eye align-middle"></i>
                </a>
            </div>
            <?php if($product->product_type == 'physical' && $product->current_stock <= 0): ?>
                <span class="out_fo_stock"><?php echo e(translate('out_of_stock')); ?></span>
            <?php endif; ?>
        </div>
        <div class="single-product-details">
            <?php if($overallRating[0] != 0 ): ?>
                <div class="rating-show justify-content-between text-center">
                    <span class="d-inline-block font-size-sm text-body">
                        <?php for($inc=1;$inc<=5;$inc++): ?>
                            <?php if($inc <= (int)$overallRating[0]): ?>
                                <i class="tio-star text-warning"></i>
                            <?php elseif($overallRating[0] != 0 && $inc <= (int)$overallRating[0] + 1.1 && $overallRating[0] > ((int)$overallRating[0])): ?>
                                <i class="tio-star-half text-warning"></i>
                            <?php else: ?>
                                <i class="tio-star-outlined text-warning"></i>
                            <?php endif; ?>
                        <?php endfor; ?>
                        <label class="badge-style">( <?php echo e(count($product->reviews)); ?> )</label>
                    </span>
                </div>
            <?php endif; ?>
            <h3 class="text-center mb-1 letter-spacing-0">
                <a href="<?php echo e(route('product',$product->slug)); ?>">
                    <?php echo e($product['name']); ?>

                </a>
            </h3>
            <div class="justify-content-between text-center">
                <h4 class="product-price text-center d-flex flex-wrap justify-content-center align-items-center gap-8 mb-0 letter-spacing-0">
                    <?php if(getProductPriceByType(product: $product, type: 'discount', result: 'value') > 0): ?>
                        <del class="category-single-product-price">
                            <?php echo e(webCurrencyConverter(amount: $product->unit_price)); ?>

                        </del>
                    <?php endif; ?>
                    <span class="text-accent text-dark">
                        <?php echo e(getProductPriceByType(product: $product, type: 'discounted_unit_price', result: 'string')); ?>

                    </span>
                </h4>
            </div>
        </div>
    </div>
</div>


<?php /**PATH /opt/projects/Genius/MarketMboa/code/resources/themes/default/web-views/partials/_inline-single-product.blade.php ENDPATH**/ ?>