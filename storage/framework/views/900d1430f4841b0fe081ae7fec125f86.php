<?php if(!isset($productDetailsMeta) || !$productDetailsMeta): ?>
    <?php if(isset($robotsMetaContentData) && $robotsMetaContentData?->meta_title): ?>
        <title><?php echo e($robotsMetaContentData?->meta_title); ?></title>
        <meta name="title" content="<?php echo e($robotsMetaContentData?->meta_title); ?>">
        <meta property="og:title" content="<?php echo e($robotsMetaContentData?->meta_title); ?>">
        <meta name="twitter:title" content="<?php echo e($robotsMetaContentData?->meta_title); ?>">
    <?php elseif($web_config['default_meta_content']): ?>
        <meta name="title" content="<?php echo e($web_config['default_meta_content']['meta_title']); ?> "/>
        <meta property="og:title" content="<?php echo e($web_config['default_meta_content']['meta_title']); ?> "/>
        <meta name="twitter:title" content="<?php echo e($web_config['default_meta_content']['meta_title']); ?>"/>
    <?php else: ?>
        <meta name="title" content="<?php echo e($web_config['company_name']); ?> "/>
        <meta property="og:title" content="<?php echo e($web_config['company_name']); ?> "/>
        <meta name="twitter:title" content="<?php echo e($web_config['company_name']); ?>"/>
    <?php endif; ?>

    <?php if(isset($robotsMetaContentData) && $robotsMetaContentData?->meta_description): ?>
        <meta name="description" content="<?php echo e($robotsMetaContentData?->meta_description); ?>">
        <meta property="og:description" content="<?php echo e($robotsMetaContentData?->meta_description); ?>">
        <meta name="twitter:description" content="<?php echo e($robotsMetaContentData?->meta_description); ?>">
    <?php elseif($web_config['default_meta_content']): ?>
        <meta name="description" content="<?php echo e(substr(strip_tags(str_replace('&nbsp;', ' ', $web_config['default_meta_content']['meta_description'])),0,160)); ?>">
        <meta property="og:description" content="<?php echo e(substr(strip_tags(str_replace('&nbsp;', ' ', $web_config['default_meta_content']['meta_description'])),0,160)); ?>">
        <meta name="twitter:description" content="<?php echo e(substr(strip_tags(str_replace('&nbsp;', ' ', $web_config['default_meta_content']['meta_description'])),0,160)); ?>">
    <?php else: ?>
        <meta name="description" content="<?php echo e($web_config['meta_description']); ?>">
        <meta property="og:description" content="<?php echo e($web_config['meta_description']); ?>">
        <meta name="twitter:description" content="<?php echo e($web_config['meta_description']); ?>">
    <?php endif; ?>

    <meta property="og:url" content="<?php echo e(env('APP_URL')); ?>">
    <meta name="twitter:url" content="<?php echo e(env('APP_URL')); ?>">

    <?php if(isset($robotsMetaContentData) && $robotsMetaContentData?->meta_image_full_url['path']): ?>
        <meta property="og:image" content="<?php echo e($robotsMetaContentData?->meta_image_full_url['path']); ?>">
        <meta name="twitter:image" content="<?php echo e($robotsMetaContentData?->meta_image_full_url['path']); ?>">
        <meta name="twitter:card" content="<?php echo e($robotsMetaContentData?->meta_image_full_url['path']); ?>">
    <?php elseif($web_config['default_meta_content']): ?>
        <meta property="og:image" content="<?php echo e($web_config['default_meta_content']?->meta_image_full_url['path']); ?>"/>
        <meta name="twitter:image" content="<?php echo e($web_config['default_meta_content']?->meta_image_full_url['path']); ?>"/>
        <meta name="twitter:card" content="<?php echo e($web_config['default_meta_content']?->meta_image_full_url['path']); ?>"/>
    <?php else: ?>
        <meta property="og:image" content="<?php echo e($web_config['web_logo']['path']); ?>"/>
        <meta name="twitter:image" content="<?php echo e($web_config['web_logo']['path']); ?>"/>
        <meta name="twitter:card" content="<?php echo e($web_config['web_logo']['path']); ?>"/>
    <?php endif; ?>

    <?php if(isset($robotsMetaContentData) && $robotsMetaContentData?->canonicals_url): ?>
        <link rel="canonical" href="<?php echo e($robotsMetaContentData?->canonicals_url); ?>">
    <?php endif; ?>

    <?php if(isset($robotsMetaContentData) && $robotsMetaContentData?->index != 'noindex'): ?>
        <meta name="robots" content="index">
    <?php endif; ?>

    <?php if(isset($robotsMetaContentData) && ($robotsMetaContentData?->no_follow || $robotsMetaContentData?->no_image_index || $robotsMetaContentData?->no_archive || $robotsMetaContentData?->no_snippet)): ?>
        <meta name="robots" content="<?php echo e(($robotsMetaContentData?->no_follow ? 'nofollow' : '') . ($robotsMetaContentData?->no_image_index ? ' noimageindex' : '') . ($robotsMetaContentData?->no_archive ? ' noarchive' : '') . ($robotsMetaContentData?->no_snippet ? ' nosnippet' : '')); ?>">
    <?php endif; ?>

    <?php if(isset($robotsMetaContentData) && $robotsMetaContentData?->meta_max_snippet): ?>
        <meta name="robots" content="max-snippet<?php echo e($robotsMetaContentData?->max_snippet_value ? ': ' . $robotsMetaContentData?->max_snippet_value : ''); ?>">
    <?php endif; ?>

    <?php if(isset($robotsMetaContentData) && $robotsMetaContentData?->max_video_preview): ?>
        <meta name="robots" content="max-video-preview<?php echo e($robotsMetaContentData?->max_video_preview_value ? ': ' . $robotsMetaContentData?->max_video_preview_value : ''); ?>">
    <?php endif; ?>

    <?php if(isset($robotsMetaContentData) && $robotsMetaContentData?->max_image_preview): ?>
        <meta name="robots" content="max-image-preview<?php echo e($robotsMetaContentData?->max_image_preview_value ? ': ' . $robotsMetaContentData?->max_image_preview_value : ''); ?>">
    <?php endif; ?>
<?php endif; ?>
<?php /**PATH /opt/projects/Genius/MarketMboa/code/resources/themes/default/web-views/partials/_robotsMetaContentData.blade.php ENDPATH**/ ?>