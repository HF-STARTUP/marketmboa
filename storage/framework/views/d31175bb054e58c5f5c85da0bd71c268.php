<div class="modal fade" id="out-of-stock-modal">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header border-0">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body pb-5">
                <div class="text-center">
                    <img src="<?php echo e(theme_asset(path: 'public/assets/front-end/img/icons/out-of-stock.png')); ?>" alt="" class="mw-100px">
                    <h6 class="font-semi-bold mt-3 mb-4 mx-auto __max-w-220" id="out-of-stock-modal-message"><?php echo e(translate('Out_of_stock')); ?></h6>
                </div>
                <div class="d-flex gap-3 justify-content-center">
                    <a href="javascript:" class="btn btn--primary __rounded-10" data-dismiss="modal">
                        <?php echo e(translate('Okay')); ?>

                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="add-wishlist-modal">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header border-0">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body pb-5">
                <div class="text-center">
                    <img src="<?php echo e(theme_asset(path: 'public/assets/front-end/img/icons/added-wishlist.png')); ?>" alt="">
                    <h6 class="font-semi-bold mt-3 mb-4 mx-auto __max-w-220"><?php echo e(translate('Product_added_to_wishlist')); ?></h6>
                </div>
                <div class="d-flex gap-3 justify-content-center">
                    <a href="javascript:" class="btn btn--primary __rounded-10" data-dismiss="modal">
                        <?php echo e(translate('Okay')); ?>

                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="login-alert-modal">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header border-0">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body pb-5">
                <div class="text-center">
                    <img src="<?php echo e(theme_asset(path: 'public/assets/front-end/img/icons/locked-icon.svg')); ?>" alt="">
                    <h6 class="font-semi-bold mt-3 mb-1"><?php echo e(translate('Please_Sign_in')); ?></h6>
                    <p class="mb-4">
                        <small><?php echo e(translate('You_need_to_Sign_in_to_view_this_feature')); ?></small>
                    </p>
                </div>
                <div class="d-flex gap-3 justify-content-center">
                    <button class="btn btn-soft-secondary bg--secondary __rounded-10" data-dismiss="modal">
                        <?php echo e(translate('Cancel')); ?>

                    </button>

                    <a href="<?php echo e(route('customer.auth.login')); ?>" class="btn btn-primary __rounded-10">
                        <?php echo e(translate('sign_in')); ?>

                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="remove-address">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header border-0">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body pb-5">
                <div class="text-center">
                    <img src="<?php echo e(theme_asset(path: 'public/assets/front-end/img/icons/remove-address.png')); ?>" alt="">
                    <h6 class="font-semi-bold mt-3 mb-1"><?php echo e(translate('Delete_this_address')); ?>?</h6>
                    <p class="mb-4">
                        <small><?php echo e(translate('This_address_will_be_removed_from_this_list')); ?></small>
                    </p>
                </div>
                <div class="d-flex gap-3 justify-content-center">
                    <a href="javascript:" class="btn btn-primary __rounded-10" id="remove-address-link">
                        <?php echo e(translate('Remove')); ?>

                    </a>
                    <button class="btn btn-soft-secondary bg--secondary __rounded-10" data-dismiss="modal">
                        <?php echo e(translate('Cancel')); ?>

                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
<?php /**PATH /opt/projects/Genius/MarketMboa/code/resources/themes/default/layouts/front-end/partials/modal/_dynamic-modals.blade.php ENDPATH**/ ?>