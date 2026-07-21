<?php if($web_config['popup_banner']): ?>
    <div class="modal fade" id="popup-modal">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header border-0 p-0">
                    <button type="button" class="close __close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body cursor-pointer __p-3px get-view-by-onclick" data-link="<?php echo e($web_config['popup_banner']['url']); ?>">
                    <img class="d-block w-100" alt=""
                         src="<?php echo e(getStorageImages(path: $web_config['popup_banner']['photo_full_url'], type: 'banner')); ?>">
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>
<?php /**PATH /opt/projects/Genius/MarketMboa/code/resources/themes/default/layouts/front-end/partials/_modals.blade.php ENDPATH**/ ?>