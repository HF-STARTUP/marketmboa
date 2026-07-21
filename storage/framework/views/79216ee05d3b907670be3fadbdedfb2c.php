<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title><?php echo $__env->yieldContent('title'); ?></title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="shortcut icon" href="<?php echo e(getStorageImages(path: getWebConfig(name: 'company_fav_icon'), type:'backend-logo')); ?>">
        <link rel="stylesheet" href="<?php echo e(dynamicAsset(path: 'public/assets/back-end/css/font-awesome.css')); ?>">
        <link rel="stylesheet" href="<?php echo e(dynamicAsset(path: 'public/assets/back-end/css/toastr.css')); ?>">
        <link rel="stylesheet" href="<?php echo e(dynamicAsset(path: 'public/assets/back-end/css/bootstrap.min.css')); ?>">

        <style>
            :root {
                --blue: <?php echo e($web_config['primary_color']); ?>;
                --primary: <?php echo e($web_config['primary_color']); ?>;
                --bs-direction: <?php echo e(Session::get('direction')); ?>;
                --theme--text-light: #FFFFFF;
            }
            .btn--primary,
            .btn--primary:hover,
            .btn--primary:focus {
                background-color: var(--primary) !important;
                color: var(--theme--text-light) !important;
            }

            .btn-outline-primary {
                color: var(--primary) !important;
                border-color: var(--primary) !important;
            }
            .text-primary {
                color: var(--primary) !important;
            }
        </style>

    </head>
    <body>
        <div class="flex-center position-ref full-height">
            <div class="code">
                <?php echo $__env->yieldContent('code'); ?>
            </div>

            <div class="message">
                <?php echo $__env->yieldContent('message'); ?>
            </div>
        </div>
    </body>
</html>
<?php /**PATH /opt/projects/Genius/MarketMboa/code/resources/views/errors/minimal.blade.php ENDPATH**/ ?>