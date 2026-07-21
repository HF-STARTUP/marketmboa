<?php $__env->startSection('title', translate('page_Not_found')); ?>

<?php $__env->startSection('message'); ?>
    <div class="container">
        <div class="row justify-content-center align-items-center vh-100">
            <div class="col-12">
                <div class="text-primary">
                    <?php echo $__env->make('errors.404-icon', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                </div>

                <h2 class="text-center pt-3"><?php echo e(translate('page_Not_found')); ?></h2>

                <p class="text-center h4 lead py-2">
                    <?php echo e(translate('we_are_sorry')); ?>, <?php echo e(translate('the_page_you_requested_could_not_be_found')); ?>

                    <br>
                    <?php echo e(translate('please_go_back_to_the_homepage')); ?>

                </p>
                <div class="text-center">
                    <a class="btn btn--primary font-weight-bold" href="<?php echo e(route('home')); ?>">
                        <span class="mr-2"><i class="fa fa-home" aria-hidden="true"></i></span>
                        <?php echo e(translate('home')); ?>

                    </a>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('errors::minimal', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /opt/projects/Genius/MarketMboa/code/resources/views/errors/404.blade.php ENDPATH**/ ?>