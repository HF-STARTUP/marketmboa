<?php
    $formattedCart = collect($productData)->map(function ($itemKey, $itemValue) {
        return [
            'name' => $productData['name'] ?? $productData['title'] ?? translate('product'),
            'variant' => $productData['variant'] ?? null,
            'quantity' => $productData['quantity'] ?? 1,
            'formatted_price' => webCurrencyConverter($productData['price'] ?? 0),
            'formatted_total' => webCurrencyConverter(($productData['price'] ?? 0) * ($productData['quantity'] ?? 1)),
        ];
    });

    $productId = $productData['id'] ?? $productData['product_id'] ?? null;
    $product = $productId ? \App\Models\Product::with(['seller.shop', 'seller'])->find($productId) : null;

    $whatsappPhone = $product->seller->shop->contact ?? ($product->seller->phone ?? (getWebConfig(name: 'whatsapp')['phone'] ?? ''));
    $totalAmountFormatted = webCurrencyConverter(($productData['price'] ?? 0) * ($productData['quantity'] ?? 1));
?>

<form action="{{ route('cart.add') }}" method="POST">
    @csrf
    <div class="d-flex align-items-center justify-content-between mb-4">
        <h5 class="modal-title flex-grow-1 text-center" id="buyNowModalLabel">
            {{ translate('Shipping_Method') }}
        </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="d-flex gap-2 mb-3">
        <img src="{{theme_asset(path: 'public/assets/front-end/img/icons/car.svg')}}" alt="">
        <div>{{ translate('Choose_Shipping_Method') }}</div>
    </div>

    <div class="form-group">
        <div class="border rounded p-3 d-flex flex-column gap-2">
            @foreach($shipping_method_list as $shippingMethodKey => $shippingMethod)
            <div class="d-flex gap-2 align-items-center">
                <input type="radio" class="show" name="shipping_method_id" id="shipping_method_id-{{ $shippingMethod['id'] }}" value="{{ $shippingMethod['id'] }}" {{ $shippingMethodKey == 0 ? 'checked':'' }}>
                <label class="mb-0" for="shipping_method_id-{{ $shippingMethod['id'] }}">
                    {{ ucfirst($shippingMethod['title']) }} ({{ $shippingMethod['duration'] }}) {{ webCurrencyConverter($shippingMethod['cost']) }}
                </label>
            </div>
            @endforeach

            <input type="hidden" class="form-control" value="1" name="shipping_method_exist">

        </div>
    </div>

    <div class="row d-none">
        @foreach($productData as $inputKey => $productInputData)
            <div class="col-6">
                <label>
                    {{ $inputKey }}
                </label>
                <input type="text" class="form-control" value="{{ $productInputData }}" name="{{ $inputKey }}">
            </div>
        @endforeach
    </div>

    <div class="d-flex flex-column flex-sm-row justify-content-center gap-2 mt-4">
        <button type="submit" class="btn text-white web--bg-primary flex-grow-1">
            {{ translate('Proceed_to_Checkout') }}
        </button>

        <a href="javascript:void(0)" class="whatsapp-order-btn btn btn--primary font-weight-semibold rounded-10 py-2 text-capitalize d-flex align-items-center justify-content-center gap-2 flex-grow-1"
            data-whatsapp="{{ $whatsappPhone }}"
            data-cart='@json($formattedCart)'
            data-subtotal="{{ $totalAmountFormatted }}">
            <img src="{{ theme_asset(path: 'public/assets/front-end/img/whatsapp.svg') }}"
                alt="{{ translate('cart') }}" loading="eager" style="width:1.25rem;height:auto;">
            <span>{{ translate('order_on_whatsapp') }}</span>
        </a>
    </div>
</form>

@push('script')
    <script>
        document.addEventListener("click", function (e) {
            const button = e.target.closest(".whatsapp-order-btn");

            if (!button) return;

            e.preventDefault();

            let whatsapp = button.dataset.whatsapp || "";

            if (!whatsapp) {
                alert("Numéro WhatsApp indisponible");
                return;
            }

            whatsapp = whatsapp.replace(/\D/g, "");

            const cart = JSON.parse(button.dataset.cart || "[]");
            const subtotal = button.dataset.subtotal || "";

            let message = "👋 *Bonjour, je souhaite commander cet article :*\n\n";

            cart.forEach(item => {
                message += `• *${item.name}*`;

                if (item.variant) {
                    message += ` (${item.variant})`;
                }

                message += `\n  Qté : ${item.quantity}`;
                message += `\n  Prix : ${item.formatted_price}\n\n`;
            });

            if (subtotal) {
                message += `💰 *Total : ${subtotal}*`;
            }

            window.open(
                `https://wa.me/${whatsapp}?text=${encodeURIComponent(message)}`,
                "_blank"
            );
        });
    </script>
@endpush