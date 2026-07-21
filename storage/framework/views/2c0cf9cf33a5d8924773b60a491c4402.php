<?php if(count($category['products']) > 0): ?>
<section class="container rtl pb-4 px-max-sm-0">
    <div class="__shadow-2">
        <div class="__p-20px rounded bg-white overflow-hidden">
            <div class="d-flex __gap-6px flex-between align-items-baseline px-sm-3">
                <h2 class="category-product-view-title mb-0">
                    <span class="for-feature-title font-bold __text-20px text-uppercase">
                            <?php echo e($category['name']); ?>

                    </span>
                </h2>
                <div class="category-product-view-all">
                    <a class="text-capitalize view-all-text text-nowrap web-text-primary"
                       href="<?php echo e(route('products',['category_id'=> $category['id'],'data_from'=>'category','page'=>1])); ?>">
                        <?php echo e(translate('view_all')); ?>

                        <i class="czi-arrow-<?php echo e(Session::get('direction') === "rtl" ? 'left mr-1 ml-n1 mt-1 float-left' : 'right ml-1 mr-n1'); ?>"></i>
                    </a>
                </div>
            </div>

            <div class="mt-2">
                <div class="carousel-wrap-2 d-none d-sm-block">
                    <div class="owl-carousel owl-theme category-wise-product-slider">
                        <?php $__currentLoopData = $category['products']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php echo $__env->make('web-views.partials._category-single-product',['product' => $product], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
                <div class="d-sm-none">
                    <div class="row g-2">
                        <?php $__currentLoopData = $category['products']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php if($key < 4): ?>
                                <div class="col-6">
                                    <?php echo $__env->make('web-views.partials._category-single-product', ['product'=>$product], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                </div>
                            <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php endif; ?>
<?php /**PATH /opt/projects/Genius/MarketMboa/code/resources/themes/default/web-views/partials/_category-wise-product.blade.php ENDPATH**/ ?>