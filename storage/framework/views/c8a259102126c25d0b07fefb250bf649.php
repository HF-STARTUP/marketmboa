<?php $__env->startSection('title', translate('My_Shopping_Cart')); ?>

<?php $__env->startPush('css_or_js'); ?>
    <meta property="og:image" content="<?php echo e($web_config['web_logo']['path']); ?>"/>
    <meta property="og:title" content="<?php echo e($web_config['company_name']); ?> "/>
    <meta property="og:url" content="<?php echo e(env('APP_URL')); ?>">
    <meta property="og:description" content="<?php echo e($web_config['meta_description']); ?>">
    <meta property="twitter:card" content="<?php echo e($web_config['web_logo']['path']); ?>"/>
    <meta property="twitter:title" content="<?php echo e($web_config['company_name']); ?>"/>
    <meta property="twitter:url" content="<?php echo e(env('APP_URL')); ?>">
    <meta property="twitter:description" content="<?php echo e($web_config['meta_description']); ?>">
    <link rel="stylesheet" href="<?php echo e(dynamicStorage(path: 'public/assets/front-end/css/shop-cart.css')); ?>">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
    <div class="container mt-3 rtl px-0 px-md-3 text-align-direction" id="cart-summary">
        <?php echo $__env->make(VIEW_FILE_NAMES['products_cart_details_partials'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </div>

    <span id="get-cart-select-cart-items" data-route="<?php echo e(route('cart.select-cart-items')); ?>"></span>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('script'); ?>
    <script>
        cartQuantityInitialize();
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.front-end.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /opt/projects/Genius/MarketMboa/code/resources/themes/default/web-views/cart/cart-list.blade.php ENDPATH**/ ?>