<?php
    // Numéro WhatsApp propre au produit (vendeur ou boutique in-house), avec fallback global
    $stickyWhatsappPhone = $productDetails->added_by == 'seller'
        ? ($productDetails->seller->shop->contact ?? $productDetails->seller->phone ?? null)
        : (getWebConfig(name: 'whatsapp')['phone'] ?? '');

    if (empty($stickyWhatsappPhone)) {
        $stickyWhatsappPhone = getWebConfig(name: 'whatsapp')['phone'] ?? '';
    }
?>

<div class="bg-white product-details-sticky product-details-sticky-section pt-4 pt-md-3 pb-3 {{ $productDetails->variation && count(json_decode($productDetails->variation)) > 0 ? 'multi-variation-product' : '' }}">
    <div class="btn-circle product-details-sticky-collapse-btn d-md-none transition cursor-pointer shadow-sm position-absolute translate-middle top-0 left-50 justify-content-center align-items-center {{ $productDetails->variation && count(json_decode($productDetails->variation)) > 0 ? 'd-flex' : 'd-none' }}" style="--size: 34px">
        <i class="czi-arrow-up"></i>
    </div>

    <div class="container product-cart-option-container">
        <form class="add-to-cart-sticky-form addToCartDynamicForm">
            <?php echo csrf_field(); ?>
            <input type="hidden" name="id" value="{{ $productDetails->id }}">
            <input type="hidden" name="position" value="bottom">
            <div class="product-details-sticky-top">
                <div class="border-bottom d-flex flex-column gap-3 mb-3 pb-3">
                    <?php if (count(json_decode($productDetails->colors)) > 0): ?>
                    <div class="position-relative">
                        <h6 class="fs-14 mb-2 pb-2">
                            {{ translate('color')}}
                            <span class="text-muted font-weight-light product-details-sticky-color-name"></span>
                        </h6>
                        <div>
                            <ul class="list-inline checkbox-color m-0 px-0 flex-start gap-2">
                                <?php foreach (json_decode($productDetails->colors) as $key => $color): ?>
                                    <li class="user-select-none">
                                        <input type="radio"
                                               id="sticky-{{ str_replace(' ', '', ($productDetails->id. '-color-'. str_replace('#','',$color))) }}"
                                               name="color" value="{{ $color }}"
                                               <?php if ($key == 0): ?>checked<?php endif; ?>>
                                        <label style="background: {{ $color }};"
                                               class="focus-preview-image-by-color shadow-border m-0"
                                               for="sticky-{{ str_replace(' ', '', ($productDetails->id. '-color-'. str_replace('#','',$color))) }}"
                                               data-toggle="tooltip"
                                               data-key="{{ str_replace('#','',$color) }}"
                                               data-colorid="preview-box-{{ str_replace('#','',$color) }}" data-title="{{ getColorNameByCode(code: $color) }}">
                                            <span class="outline"></span></label>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    </div>
                    <?php endif; ?>

                    <?php $extensionIndex = 0; ?>
                    <?php if ($productDetails['product_type'] == 'digital' && $productDetails['digital_product_file_types'] && count($productDetails['digital_product_file_types']) > 0 && $productDetails['digital_product_extensions']): ?>
                        <?php foreach ($productDetails['digital_product_extensions'] as $extensionKey => $extensionGroup): ?>
                        <div>
                            <h6 class="fs-14 mb-2 text-capitalize">
                                {{ translate($extensionKey) }}
                            </h6>

                            <?php if (count($extensionGroup) > 0): ?>
                            <div class="list-inline checkbox-alphanumeric checkbox-alphanumeric--style-1 mb-0 flex-start row ps-0 overflow-x-auto flex-nowrap overflow-y-hidden scrollbar-none">
                                <?php foreach ($extensionGroup as $index => $extension): ?>
                                    <div class="user-select-none">
                                        <div class="for-mobile-capacity">
                                            <input type="radio" hidden
                                                   id="sticky-extension_{{ str_replace(' ', '-', $extension) }}"
                                                   name="variant_key"
                                                   value="{{ $extensionKey.'-'.preg_replace('/\s+/', '-', $extension) }}"
                                                <?php echo $extensionIndex == 0 ? 'checked' : ''; ?>>
                                            <label for="sticky-extension_{{ str_replace(' ', '-', $extension) }}"
                                                   class="__text-12px">
                                                   <span class="text-nowrap max-w-180 line--limit-1">{{ $extension }}</span>
                                            </label>
                                        </div>
                                    </div>
                                    <?php $extensionIndex++; ?>
                                <?php endforeach; ?>
                            </div>
                            <?php endif; ?>
                        </div>
                        <?php endforeach; ?>
                    <?php endif; ?>

                    <?php foreach (json_decode($productDetails->choice_options) as $key => $choice): ?>
                    <div>
                        <h6 class="fs-14 mb-2 text-capitalize">
                            {{ $choice->title }}
                        </h6>
                        <div class="list-inline checkbox-alphanumeric checkbox-alphanumeric--style-1 mb-0 flex-start ps-0 overflow-x-auto flex-nowrap overflow-y-hidden scrollbar-none">
                            <?php foreach ($choice->options as $index => $option): ?>
                                <div class="user-select-none">
                                    <div class="for-mobile-capacity">
                                        <input type="radio"
                                               id="sticky-{{ str_replace(' ', '', ($choice->name. '-'. $option)) }}"
                                               name="{{ $choice->name }}" value="{{ $option }}"
                                               <?php if ($index == 0): ?>checked<?php endif; ?> >
                                        <label class="__text-12px"
                                               for="sticky-{{ str_replace(' ', '', ($choice->name. '-'. $option)) }}">
                                               <span class="text-nowrap max-w-180 line--limit-1">{{ $option }}</span>
                                            </label>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <div class="d-flex flex-column flex-lg-row justify-content-between gap-3 product-details-sticky-bottom">
                <div class="media gap-sm-3 d-flex flex-column flex-sm-row">
                    <img width="48" class="rounded d-none d-sm-block aspect-1 object-cover"
                         src="{{ getStorageImages(path: $productDetails->thumbnail_full_url, type: 'product') }}"
                         alt=""
                    >
                    <div class="media-body">
                        <h6 class="mb-1 fs-14 line--limit-1">
                            {{ $productDetails->name }}
                        </h6>
                        <div>
                            <input type="hidden" class="product-generated-variation-code" name="product_variation_code" data-product-id="{{ $productDetails['id'] }}">
                            <input type="hidden" value="" class="product-exist-in-cart-list form-control w-50" name="key">
                        </div>
                        <div class="d-flex flex-wrap align-items-center mb-2 pro">
                            <span class="fs-12 text-muted line--limit-1 text-capitalize product-generated-variation-text"></span>
                            <div class="d-none d-sm-flex flex-wrap align-items-center">
                                <span class="{{ count(json_decode($productDetails->variation, true)) > 0 ? '__inline-25' : '' }} {{ count(json_decode($productDetails->variation, true)) > 0 ? 'mx-2' : '' }} mt-0"></span>

                                <span class="fs-12">
                                    <span class="d-flex flex-wrap gap-8 align-items-center row-gap-0">
                                        {!! getPriceRangeWithDiscount(product: $productDetails) !!}
                                    </span>
                                </span>
                                <span class="for-discount-value position-static p-1 px-2 font-bold fs-13 mx-2 discounted-badge-element">
                                    <span class="direction-ltr d-block discounted_badge">
                                        {{ $initialProductConfig['discount']  }}
                                    </span>
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="d-sm-none d-flex gap-1 fs-12">
                        {!! getPriceRangeWithDiscount(product: $productDetails) !!}
                    </div>
                </div>

                <div class="d-flex align-items-center gap-2 gap-sm-3 gap-xl-4 flex-wrap product-details-sticky-actions">
                    <div class="d-flex justify-content-between align-items-center quantity-box border rounded border-base web-text-primary w-130px h-40px overflow-hidden">
                        <span class="input-group-btn h-100">
                            <button class="btn btn-number __p-10 web-text-primary bg-ECF1F6 rounded-0 h-100 w-32px d-flex align-items-center" type="button" data-type="minus" data-field="quantity" disabled="disabled">-</button>
                        </span>
                        <input type="number" name="quantity"
                        class="form-control input-number text-center product-details-cart-qty __inline-29 border-0 w-100 fs-12"
                        placeholder="{{ translate('1') }}"
                        value="{{ $initialProductConfig['quantity'] ?? 1 }}"
                        data-producttype="{{ $productDetails->product_type }}"
                        min="{{ $productDetails->minimum_order_qty ?? 1 }}"
                        max="{{$productDetails['product_type'] == 'physical' ? $productDetails->current_stock : 100}}">

                        <span class="input-group-btn h-100">
                            <button class="btn btn-number __p-10 web-text-primary bg-ECF1F6 rounded-0 h-100 w-32px d-flex align-items-center" type="button" data-producttype="physical" data-type="plus" data-field="quantity">+</button>
                        </span>
                    </div>

                    <div class="font-weight-normal text-accent align-items-end gap-2 d-none d-lg-flex">
                        <span class="product-bottom-section-price fs-24 font-bold user-select-none text-nowrap">{{$initialProductConfig['price']}}</span>
                    </div>


                    <?php if (($product->added_by == 'admin' && (checkVendorAbility(type: 'inhouse', status: 'temporary_close') || checkVendorAbility(type: 'inhouse', status: 'vacation_status'))) || ($product->added_by == 'seller' && (checkVendorAbility(type: 'vendor', status: 'temporary_close', vendor: $product->seller->shop) || checkVendorAbility(type: 'vendor', status: 'vacation_status', vendor: $product->seller->shop)))): ?>
                        <div class="alert alert-danger m-0 font-semi-bold fs-12 ms-2" role="alert">
                            {{translate('you_cannot_add_product_to_cart_from_this_shop_for_now')}}
                        </div>
                    <?php else: ?>
                        <div class="product-add-and-buy-section d-flex flex-wrap gap-2">
                            <button type="button" class="btn btn-secondary element-center btn-gap-right product-buy-now-button"
                                    data-form=".add-to-cart-sticky-form"
                                    data-auth="{{( getWebConfig(name: 'guest_checkout') == 1 || Auth::guard('customer')->check() ? 'true':'false')}}"
                                    data-route="{{ route('shop-cart') }}"
                            >
                                <span class="string-limit">{{ translate('buy_now') }}</span>
                            </button>

                            <button class="btn btn--primary element-center product-add-to-cart-button"
                                    type="button"
                                    data-form=".add-to-cart-sticky-form"
                                    data-update="{{ translate('update_cart') }}"
                                    data-add="{{ translate('add_to_cart') }}"
                            >
                                {{ translate('add_to_cart') }}
                            </button>

                            <a href="javascript:void(0)" id="sticky-whatsapp-order-btn"
                               class="btn btn--primary element-center d-flex align-items-center justify-content-center gap-2"
                               data-whatsapp="{{ $stickyWhatsappPhone }}"
                               data-form=".add-to-cart-sticky-form"
                            >
                                <img src="{{ theme_asset(path: 'public/assets/front-end/img/whatsapp.svg') }}"
                                     alt="{{ translate('whatsapp') }}" loading="eager" style="width:1.1rem;height:auto;">
                                <span class="string-limit">{{ translate('order_on_whatsapp') }}</span>
                            </a>
                        </div>

                        <?php if ($productDetails['product_type'] == 'physical'): ?>
                            <div class="product-restock-request-section collapse" <?php echo $firstVariationQuantity <= 0 ? 'style="display: block;"' : ''; ?>>
                                <button type="button"
                                        class="btn request-restock-btn btn-outline-primary fw-semibold product-restock-request-button"
                                        data-auth="{{ auth('customer')->check() }}"
                                        data-form=".add-to-cart-sticky-form"
                                        data-default="{{ translate('Request_Restock') }}"
                                        data-requested="{{ translate('Request_Sent') }}"
                                >
                                    {{ translate('Request_Restock')}}
                                </button>
                            </div>
                        <?php endif; ?>
                    <?php endif; ?>
                </div>
            </div>
        </form>
    </div>
</div>

<style>
    /* Responsive spécifique à la barre sticky : la barre sticky a peu de hauteur,
       donc on gère différemment du quick view (qui a plus d'espace vertical). */

    .product-details-sticky-actions .btn {
        white-space: nowrap;
    }

    #sticky-whatsapp-order-btn span.string-limit {
        max-width: 140px;
    }

    @media (max-width: 767.98px) {
        .product-details-sticky-actions {
            width: 100%;
            justify-content: space-between;
        }
        .product-details-sticky-actions .product-add-and-buy-section {
            width: 100%;
            flex-wrap: nowrap;
            overflow-x: auto;
            scrollbar-width: none;
        }
        .product-details-sticky-actions .product-add-and-buy-section::-webkit-scrollbar {
            display: none;
        }
        .product-details-sticky-actions .product-add-and-buy-section .btn {
            flex: 0 0 auto;
            font-size: 12px;
            padding-left: .75rem;
            padding-right: .75rem;
        }
        #sticky-whatsapp-order-btn span.string-limit {
            display: none;
        }
        #sticky-whatsapp-order-btn img {
            width: 1.25rem !important;
        }
    }

    @media (min-width: 768px) and (max-width: 1199.98px) {
        #sticky-whatsapp-order-btn span.string-limit {
            display: none;
        }
    }

    @media (min-width: 1200px) {
        #sticky-whatsapp-order-btn span.string-limit {
            display: inline;
        }
    }
</style>

<script>
    document.addEventListener("click", function (e) {
        const button = e.target.closest("#sticky-whatsapp-order-btn");
        if (!button) return;

        e.preventDefault();

        let whatsapp = button.dataset.whatsapp || "";
        if (!whatsapp) {
            alert("Numéro WhatsApp indisponible");
            return;
        }
        whatsapp = whatsapp.replace(/\D/g, "");

        const form = document.querySelector(button.dataset.form);
        if (!form) return;

        const productName = document.querySelector('.product-details-sticky-bottom h6.line--limit-1')?.textContent.trim() || '';
        const quantity = form.querySelector('input[name="quantity"]')?.value || 1;
        const totalPrice = document.querySelector('.product-bottom-section-price')?.textContent.trim() || '';

        const selectedColorInput = form.querySelector('input[name="color"]:checked');
        const selectedColorLabel = selectedColorInput
            ? document.querySelector(`label[for="${selectedColorInput.id}"]`)
            : null;
        const selectedColorName = selectedColorLabel?.getAttribute('data-title') || '';

        const choiceParts = [];
        form.querySelectorAll('.checkbox-alphanumeric input[type="radio"]:checked').forEach(input => {
            if (input.name === 'variant_key') return;
            const label = form.querySelector(`label[for="${input.id}"]`);
            const value = label ? label.textContent.trim() : input.value;
            choiceParts.push(`${input.name} : ${value}`);
        });

        const selectedExtension = form.querySelector('input[name="variant_key"]:checked');
        const extensionLabel = selectedExtension
            ? form.querySelector(`label[for="${selectedExtension.id}"]`)?.textContent.trim()
            : '';

        let message = "👋 *Bonjour, je souhaite commander ce produit :*\n\n";
        message += `• *${productName}*\n`;
        if (selectedColorName) message += `  Couleur : ${selectedColorName}\n`;
        if (choiceParts.length) message += `  ${choiceParts.join(', ')}\n`;
        if (extensionLabel) message += `  Format : ${extensionLabel}\n`;
        message += `  Qté : ${quantity}\n`;
        message += `  Total : ${totalPrice}\n`;

        window.open(
            `https://wa.me/${whatsapp}?text=${encodeURIComponent(message)}`,
            "_blank"
        );
    });
</script>