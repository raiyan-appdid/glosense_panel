<x-site.layouts.main>
    @section('title', 'Home')

    @section('meta-title', 'Glossense')
    @section('meta-description', 'Glossense skin product')

    @section('page-style')
        <style>
            .selection {
                display: initial
            }
        </style>
    @endsection
    @section('content')
        <!-- Start breadcrumb section -->
        <div class="breadcrumb__section breadcrumb__bg">
            <div class="container">
                <div class="row row-cols-1">
                    <div class="col">
                        <div class="breadcrumb__content text-center">
                            <ul class="breadcrumb__content--menu d-flex justify-content-center">
                                <li class="breadcrumb__content--menu__items"><a href="{{ route('/') }}">Home</a></li>
                                <li class="breadcrumb__content--menu__items"><span>Checkout</span></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End breadcrumb section -->

        <!-- Start checkout page area -->
        <div class="checkout__page--area section--padding">
            <div class="container">
                <div class="row">
                    <div class="col-lg-7 col-md-6">
                        <div class="main checkout__mian">
                            <form action="#">
                                <div class="checkout__content--step section__contact--information">
                                    <div
                                        class="checkout__section--header d-flex align-items-center justify-content-between mb-25">
                                        <h2 class="checkout__header--title h3">Contact information</h2>
                                    </div>
                                    <div class="customer__information">
                                        <div class="row">
                                            <div class="col-lg-6 col-12">
                                                <div class="checkout__email--phone mb-12">
                                                    <label>
                                                        <input class="checkout__input--field border-radius-5"
                                                            placeholder="Email or mobile phone mumber" type="text">
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-12">
                                                <div class="checkout__email--phone mb-12">
                                                    <label>
                                                        <input class="checkout__input--field border-radius-5"
                                                            placeholder="Mobile number" type="text">
                                                    </label>
                                                </div>
                                            </div>
                                        </div>

                                        {{-- <div class="checkout__checkbox">
                                            <input class="checkout__checkbox--input" id="check1" type="checkbox">
                                            <span class="checkout__checkbox--checkmark"></span>
                                            <label class="checkout__checkbox--label" for="check1">
                                                Email me with news and offers</label>
                                        </div> --}}
                                    </div>
                                </div>
                                <div class="checkout__content--step section__shipping--address">
                                    <div class="checkout__section--header mb-25">
                                        <h2 class="checkout__header--title h3">Billing Details</h2>
                                    </div>
                                    <div class="section__shipping--address__content">
                                        <div class="row">
                                            <div class="col-lg-6 col-md-6 col-sm-6 mb-20">
                                                <div class="checkout__input--list ">
                                                    <label class="checkout__input--label mb-10" for="input1">Fist Name
                                                        <span class="checkout__input--label__star">*</span></label>
                                                    <input class="checkout__input--field border-radius-5"
                                                        placeholder="First name (optional)" id="input1" type="text">
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-6 mb-20">
                                                <div class="checkout__input--list">
                                                    <label class="checkout__input--label mb-10" for="input2">Last Name
                                                        <span class="checkout__input--label__star">*</span></label>
                                                    <input class="checkout__input--field border-radius-5"
                                                        placeholder="Last name" id="input2" type="text">
                                                </div>
                                            </div>
                                            <div class="col-12 mb-20">
                                                <div class="checkout__input--list">
                                                    <label class="checkout__input--label mb-10" for="input4">Address <span
                                                            class="checkout__input--label__star">*</span></label>
                                                    <input class="checkout__input--field border-radius-5"
                                                        placeholder="Address1" id="input4" type="text">
                                                </div>
                                            </div>
                                            <div class="col-12 mb-20">
                                                <div class="checkout__input--list">
                                                    <input class="checkout__input--field border-radius-5"
                                                        placeholder="Apartment, suite, etc. (optional)" type="text">
                                                </div>
                                            </div>

                                            <div class="col-lg-6 mb-20 form-group">
                                                {{-- <div class="checkout__input--list"> --}}
                                                <label class="checkout__input--label mb-10" for="country">State <span
                                                        class="checkout__input--label__star">*</span></label>
                                                {{-- <div class="checkout__input--select select"> --}}
                                                <select
                                                    class="checkout__input--select__field form-select border-radius-5 select2"
                                                    id="state" name="state">
                                                    <option value="" selected disabled>Select State</option>
                                                    @forelse ($states as $state)
                                                        <option value="{{ $state->id }}">{{ $state->name }}
                                                        </option>
                                                    @empty
                                                    @endforelse

                                                </select>
                                                {{-- </div> --}}
                                                {{-- </div> --}}
                                            </div>
                                            <div class="col-6 mb-20">
                                                <label class="checkout__input--label mb-10" for="country">City <span
                                                        class="checkout__input--label__star">*</span></label>
                                                <select class="checkout__input--select__field border-radius-5 select2"
                                                    id="city" name="city">
                                                    <option value="" selected disabled>Select City</option>
                                                    @forelse ($cities as $city)
                                                        <option value="{{ $city->id }}">{{ $city->name }}
                                                        </option>
                                                    @empty
                                                    @endforelse
                                                </select>
                                            </div>
                                            <div class="col-lg-6 mb-20">
                                                <div class="checkout__input--list">
                                                    <label class="checkout__input--label mb-10" for="input6">Postal Code
                                                        <span class="checkout__input--label__star">*</span></label>
                                                    <input class="checkout__input--field border-radius-5"
                                                        placeholder="Postal code" id="postal" type="text">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="checkout__checkbox">
                                        <input class="checkout__checkbox--input" id="checkbox2" type="checkbox">
                                        <span class="checkout__checkbox--checkmark"></span>
                                        <label class="checkout__checkbox--label" for="checkbox2">
                                            Save this information for next time</label>
                                    </div>
                                </div>
                                <div class="order-notes mb-20">
                                    <label class="checkout__input--label mb-10" for="order">Order Notes <span
                                            class="checkout__input--label__star">*</span></label>
                                    <textarea class="checkout__notes--textarea__field border-radius-5" id="order"
                                        placeholder="Notes about your order, e.g. special notes for delivery." spellcheck="false"></textarea>
                                </div>
                                <div class="checkout__content--step__footer d-flex align-items-center">
                                    <a class="continue__shipping--btn primary__btn border-radius-5"
                                        href="index.html">Continue To Shipping</a>
                                    <a class="previous__link--content" href="{{ route('cart') }}">Return to cart</a>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="col-lg-5 col-md-6">
                        <aside class="checkout__sidebar sidebar border-radius-10">
                            <h2 class="checkout__order--summary__title text-center mb-15">Your Order Summary</h2>
                            <div class="cart__table checkout__product--table">
                                <table class="cart__table--inner">
                                    <tbody class="cart__table--body">
                                        @php
                                            $total = 0;
                                        @endphp
                                        @forelse ($carts as $cart)
                                            <tr class="cart__table--body__items">
                                                <td class="cart__table--body__list">
                                                    <div class="product__image two  d-flex align-items-center">
                                                        <div class="product__thumbnail border-radius-5">
                                                            <a class="display-block"
                                                                href="{{ route('product-detail', $cart->product->id) }}"><img
                                                                    class="display-block border-radius-5"
                                                                    src="{{ asset($cart->product->images[0]->image) }}"
                                                                    alt="cart-product"></a>
                                                            <span
                                                                class="product__thumbnail--quantity">{{ $cart->quantity }}</span>
                                                        </div>
                                                        <div class="product__description">
                                                            <h4 class="product__description--name"><a
                                                                    href="{{ route('product-detail', $cart->product->id) }}">{{ $cart->product->title }}</a>
                                                            </h4>
                                                            <span class="product__description--variant">manufacturer:
                                                                {{ $cart->product->manufacturer }}</span>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="cart__table--body__list">
                                                    <span
                                                        class="cart__price">₹{{ $cart->quantity * $cart->product->discounted_price }}</span>
                                                </td>
                                            </tr>
                                            @php
                                                $total += $cart->quantity * $cart->product->discounted_price;
                                            @endphp
                                        @empty
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                            <div class="checkout__discount--code">
                                <div class="d-flex" id="applyPromocode">
                                    <label>
                                        <input class="checkout__discount--code__input--field border-radius-5"
                                            placeholder="Discount code" name="code" data-discount-code type="text">
                                    </label>
                                    <button data-apply disabled
                                        class="checkout__discount--code__btn primary__btn border-radius-5 apply"
                                        type="submit">Apply</button>
                                </div>
                                <p id="invalid-promo" class="text-danger" hidden></p>
                                <p id="valid-promo" class="text-primary" hidden></p>
                            </div>
                            <div class="checkout__total">
                                <table class="checkout__total--table">
                                    <tbody class="checkout__total--body">
                                        <tr class="checkout__total--items">
                                            <td class="checkout__total--title text-left">Subtotal </td>
                                            <td class="checkout__total--amount text-right">₹{{ $total }}</td>
                                        </tr>
                                        <tr class="checkout__total--items">
                                            <td class="checkout__total--title text-left">Shipping</td>
                                            <td class="checkout__total--calculated__text text-right">
                                                ₹ <span id="shipping-charge"></span></td>
                                            <input type="hidden" name="delivery_charges" id="delivery_charges" hidden />
                                        </tr>
                                        <tr class="checkout__total--items" id="promo-discount" hidden>
                                            <td class="checkout__total--title text-left">Promocode Discount</td>
                                            <td class="checkout__total--calculated__text text-right">
                                                ₹ <span id="" data-discount></span></td>
                                            <input type="text" name="promocode_discount" hidden
                                                id="promocode_discount" />
                                            <input type="hidden" name="promocode" id="promocode" hidden />
                                        </tr>
                                    </tbody>
                                    <tfoot class="checkout__total--footer">
                                        <tr class="checkout__total--footer__items">
                                            <td
                                                class="checkout__total--footer__title checkout__total--footer__list text-left">
                                                Total </td>
                                            <td
                                                class="checkout__total--footer__amount checkout__total--footer__list text-right">
                                                ₹ <span id="total">{{ $total }}</span></td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                            @auth
                                <button class="checkout__now--btn primary__btn" type="submit">Pay Now</button>
                            @else
                                <a href="{{ route('google.login') }}" class="checkout__now--btn primary__btn">Pay Now</a>
                            @endauth
                        </aside>
                    </div>

                </div>
            </div>
        </div>
        <!-- End checkout page area -->

        <!-- Start feature section -->
        {{-- <section class="feature__section section--padding pt-0">
            <div class="container">
                <div class="feature__inner d-flex justify-content-between">
                    <div class="feature__items d-flex align-items-center">
                        <div class="feature__icon">
                            <img src="{{ asset('site/assets/img/other/feature1.webp') }}" alt="img">
                        </div>
                        <div class="feature__content">
                            <h2 class="feature__content--title h3">Free Shipping</h2>
                            <p class="feature__content--desc">Free shipping over ₹100</p>
                        </div>
                    </div>
                    <div class="feature__items d-flex align-items-center">
                        <div class="feature__icon ">
                            <img src="{{ asset('site/assets/img/other/feature2.webp') }}" alt="img">
                        </div>
                        <div class="feature__content">
                            <h2 class="feature__content--title h3">Support 24/7</h2>
                            <p class="feature__content--desc">Contact us 24 hours a day</p>
                        </div>
                    </div>
                    <div class="feature__items d-flex align-items-center">
                        <div class="feature__icon">
                            <img src="{{ asset('site/assets/img/other/feature3.webp') }}" alt="img">
                        </div>
                        <div class="feature__content">
                            <h2 class="feature__content--title h3">100% Money Back</h2>
                            <p class="feature__content--desc">You have 30 days to Return</p>
                        </div>
                    </div>
                    <div class="feature__items d-flex align-items-center">
                        <div class="feature__icon">
                            <img src="{{ asset('site/assets/img/other/feature4.webp') }}" alt="img">
                        </div>
                        <div class="feature__content">
                            <h2 class="feature__content--title h3">Payment Secure</h2>
                            <p class="feature__content--desc">We ensure secure payment</p>
                        </div>
                    </div>
                </div>
            </div>
        </section> --}}
        <!-- End feature section -->
    @endsection
    @section('page-script')
        <script>
            $(document).ready(function() {
                $('.select2').select2();
                $('[data-discount-code]').keyup(function(e) {
                    empty = $(this).val().length == 0;
                    if (empty) {
                        $('.apply').attr('disabled', true);
                    } else {
                        $('.apply').attr('disabled', false);
                    }
                });
            });
        </script>
        <script>
            // $('#postal').keyup(function(e) {
            //     var delivery_charges = 0;
            //     const deliveryCharge = @json($deliveryCharges);
            //     const postal = $(this).val();

            //     if (postal.length == 6) {
            //         $.ajax({
            //             type: "get",
            //             url: "https://api.postalpincode.in/pincode/" + postal,
            //             success: function(result) {
            //                 console.log(result);
            //                 if (result[0].PostOffice[0].State == "Mumbai") {
            //                     // $("#city").val(result[0].PostOffice[0].State);
            //                     $('#shipping-charge').text(deliveryCharge['within']);
            //                     $('#delivery-charge').val(deliveryCharge['within']);
            //                     $('#total').text(parseFloat({{ $total }}) + parseFloat(
            //                         deliveryCharge['within']));
            //                 } else {
            //                     $('#shipping-charge').text(deliveryCharge['out_of']);
            //                     $('#delivery-charge').val(deliveryCharge['out_of']);
            //                     $('#total').text(parseFloat({{ $total }}) + parseFloat(
            //                         deliveryCharge['out_of']));
            //                 }
            //             }
            //         });
            //     }
            // });



            $(document).on('click', '[data-apply]', function() {
                var delivery_charges = $('#delivery_charges').val();
                const code = $(this).closest('#applyPromocode').find('[data-discount-code]').val();
                $.ajax({
                    type: "post",
                    url: "{{ route('apply-promocode') }}",
                    data: {
                        code: code,
                    },
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                    },
                    success: function(response) {
                        console.log(response);
                        if (response.success) {
                            $('#invalid-promocode').attr('hidden', true);
                            $('#valid-promo').attr('hidden', false);
                            $('#valid-promo').text(response.success);
                            $('#promo-discount').attr('hidden', false);
                            $('#promo-discount').attr('hidden', false);
                            $('#promocode_discount').val(response.discount);
                            $('#promocode').val(response.promocode);
                            $('[data-discount]').text(response.discount);
                            $('#total').text(parseFloat(response.final_total) + parseFloat(
                                delivery_charges));
                        } else {
                            $('#valid-promo').attr('hidden', true);
                            $('#invalid-promo').attr('hidden', false);
                            $('#invalid-promo').text(response.error);
                            $('#promo-discount').attr('hidden', true);
                            $('#promocode_discount').val('');
                            $('#promocode').val('');
                            // $('#total').text(parseFloat(response.final_total) + parseFloat(
                            //     delivery_charges));
                        }
                    },
                    error: function(response) {
                        console.log(response);
                    }
                });

            });
        </script>
    @endsection

</x-site.layouts.main>
