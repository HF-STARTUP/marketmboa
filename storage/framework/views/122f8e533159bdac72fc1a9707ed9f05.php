<?php if(count($companyReliability) > 0): ?>
<div class="container rtl pb-4 px-0 px-md-3">
    <div class="shipping-policy-web">
        <div class="footer-top-slider owl-theme owl-carousel">
            <?php $__currentLoopData = $companyReliability; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php if($value['status'] == 1 && !empty($value['title'])): ?>
                    <div class="footer-top-slide-item">
                        <div class="d-flex justify-content-center">
                            <div class="shipping-method-system">
                                <div class="w-100 d-flex justify-content-center mb-1">
                                    <img alt="" class="object-contain" width="88" height="88" src="<?php echo e(getStorageImages(path: imagePathProcessing(imageData: $value['image'],path: 'company-reliability'), type: 'source', source: 'public/assets/front-end/img'.'/'.$value['item'].'.png')); ?>">
                                </div>
                                <div class="w-100 text-center">
                                    <p class="m-0"><?php echo e($value['title']); ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
</div>
<?php endif; ?>
<?php /**PATH /opt/projects/Genius/MarketMboa/code/resources/themes/default/web-views/partials/_company-reliability.blade.php ENDPATH**/ ?>