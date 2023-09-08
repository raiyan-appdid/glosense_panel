@php
    $total = 0;
@endphp
<div class="minicart__product">
    @auth
        @forelse ($carts as $cart)
            <div class="minicart__product--items d-flex">
                <div class="minicart__thumb">
                    <a href="#"><img src="{{ asset($cart->product->images[0]->image) }}" alt="prduct-img"></a>
                </div>
                <div class="minicart__text">
                    <h4 class="minicart__subtitle"><a
                            href="{{ route('product-detail', $cart->product->slug) }}">{{ $cart->product->title }}</a>
                    </h4>
                    <div class="minicart__price">
                        <span class="minicart__current--price">₹ {{ $cart->product->discounted_price }}</span>
                        <span class="minicart__old--price">₹{{ $cart->product->price }}</span>
                    </div>
                    <div class="minicart__text--footer d-flex align-items-center">
                        {{-- <div class="quantity__box minicart__quantity">
                    <button type="button" class="quantity__value decrease" aria-label="quantity value"
                        value="Decrease Value">-</button>
                    <label>
                        <input type="number" class="quantity__number" value="1" data-counter />
                    </label>
                    <button type="button" class="quantity__value increase" aria-label="quantity value"
                        value="Increase Value">+</button>
                </div> --}}
                        <span>x {{ $cart->quantity }} &nbsp;</span>
                        <button class="minicart__product--remove" type="button">Remove</button>
                    </div>
                </div>
            </div>
            @php
                $total += $cart->quantity * $cart->product->discounted_price;
            @endphp
        @empty
            <div class="text-center">
                <p class="p-5">No Product Found</p>
            </div>
        @endforelse
    @endauth
    @guest
        @forelse ($carts as $product)
            <div class="minicart__product--items d-flex">
                <div class="minicart__thumb">
                    <a href="#"><img src="{{ asset($product->images[0]->image) }}" alt="prduct-img"></a>
                </div>
                <div class="minicart__text">
                    <h4 class="minicart__subtitle"><a
                            href="{{ route('product-detail', $product->slug) }}">{{ $product->title }}</a>
                    </h4>
                    <div class="minicart__price">
                        <span class="minicart__current--price">₹ {{ $product->price }}</span>
                        <span class="minicart__old--price">₹{{ $product->discounted_price }}</span>
                    </div>
                    <div class="minicart__text--footer d-flex align-items-center">
                        <span>x {{ $product->quantity }} &nbsp;</span>
                        <button class="minicart__product--remove" type="button">Remove</button>
                    </div>
                </div>
            </div>
            @php
                $total += $product->quantity * $product->discounted_price;
            @endphp
        @empty
            <div class="text-center">
                <p class="p-5">No Product Found</p>
            </div>
        @endforelse
    @endguest
</div>
<div class="minicart__amount">
    <div class="minicart__amount_list d-flex justify-content-between">
        <span>Sub Total:</span>
        <span><b>₹{{ $total }}</b></span>
    </div>
    <div class="minicart__amount_list d-flex justify-content-between">
        <span>Total:</span>
        <span><b>₹{{ $total }}</b></span>
    </div>
    <span>Shipping charges may apply</span>
</div>
