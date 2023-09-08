<x-site.layouts.main>
    @section('title', 'Home')

    @section('meta-title', 'Glossense')
    @section('meta-description', 'Glossense skin product')

    @section('page-style')
    @endsection
    @section('content')
        <!-- Start breadcrumb section -->
        <div class="breadcrumb__section breadcrumb__bg">
            <div class="container">
                <div class="row row-cols-1">
                    <div class="col">
                        <div class="breadcrumb__content text-center">
                            <h1 class="breadcrumb__content--title">Product</h1>
                            <ul class="breadcrumb__content--menu d-flex justify-content-center">
                                <li class="breadcrumb__content--menu__items"><a href="{{ route('/') }}">Home</a></li>
                                <li class="breadcrumb__content--menu__items"><span>Product</span></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End breadcrumb section -->

        <!-- Start shop section -->
        <div class="shop__section section--padding">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="shop__product--wrapper position__sticky">
                            <div class="shop__header d-flex align-items-center justify-content-between mb-30">
                                <div class="product__view--mode d-flex align-items-center">
                                    {{-- <button class="widget__filter--btn align-items-center" data-offcanvas>
                                        <svg class="widget__filter--btn__icon" xmlns="http://www.w3.org/2000/svg"
                                            viewBox="0 0 512 512">
                                            <path fill="none" stroke="currentColor" stroke-linecap="round"
                                                stroke-linejoin="round" stroke-width="28"
                                                d="M368 128h80M64 128h240M368 384h80M64 384h240M208 256h240M64 256h80" />
                                            <circle cx="336" cy="128" r="28" fill="none"
                                                stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                stroke-width="28" />
                                            <circle cx="176" cy="256" r="28" fill="none"
                                                stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                stroke-width="28" />
                                            <circle cx="336" cy="384" r="28" fill="none"
                                                stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                stroke-width="28" />
                                        </svg>
                                        <span class="widget__filter--btn__text">Filter</span>
                                    </button> --}}
                                    {{-- <div class="product__view--mode__list product__short--by align-items-center d-flex ">
                                        <label class="product__view--label">Prev Page :</label>
                                        <div class="select shop__header--select">
                                            <select class="product__view--select">
                                                <option selected value="1">65</option>
                                                <option value="2">40</option>
                                                <option value="3">42</option>
                                                <option value="4">57 </option>
                                                <option value="5">60 </option>
                                            </select>
                                        </div>
                                    </div> --}}
                                    {{-- <div class="product__view--mode__list product__short--by align-items-center d-flex">
                                        <label class="product__view--label">Sort By :</label>
                                        <div class="select shop__header--select">
                                            <select class="product__view--select">
                                                <option selected value="1">Sort by latest</option>
                                                <option value="2">Sort by popularity</option>
                                                <option value="3">Sort by newness</option>
                                                <option value="4">Sort by rating </option>
                                            </select>
                                        </div>

                                    </div> --}}
                                    <div class="product__view--mode__list">
                                        <div
                                            class="product__tab--one product__grid--column__buttons d-flex justify-content-center">
                                            <button class="product__grid--column__buttons--icons active"
                                                aria-label="grid btn" data-toggle="tab" data-target="#product_grid">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13"
                                                    viewBox="0 0 9 9">
                                                    <g transform="translate(-1360 -479)">
                                                        <rect id="Rectangle_5725" data-name="Rectangle 5725" width="4"
                                                            height="4" transform="translate(1360 479)"
                                                            fill="currentColor" />
                                                        <rect id="Rectangle_5727" data-name="Rectangle 5727" width="4"
                                                            height="4" transform="translate(1360 484)"
                                                            fill="currentColor" />
                                                        <rect id="Rectangle_5726" data-name="Rectangle 5726" width="4"
                                                            height="4" transform="translate(1365 479)"
                                                            fill="currentColor" />
                                                        <rect id="Rectangle_5728" data-name="Rectangle 5728" width="4"
                                                            height="4" transform="translate(1365 484)"
                                                            fill="currentColor" />
                                                    </g>
                                                </svg>
                                            </button>
                                            <button class="product__grid--column__buttons--icons" aria-label="list btn"
                                                data-toggle="tab" data-target="#product_list">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="17" height="16"
                                                    viewBox="0 0 13 8">
                                                    <g id="Group_14700" data-name="Group 14700"
                                                        transform="translate(-1376 -478)">
                                                        <g transform="translate(12 -2)">
                                                            <g id="Group_1326" data-name="Group 1326">
                                                                <rect id="Rectangle_5729" data-name="Rectangle 5729"
                                                                    width="3" height="2"
                                                                    transform="translate(1364 483)" fill="currentColor" />
                                                                <rect id="Rectangle_5730" data-name="Rectangle 5730"
                                                                    width="9" height="2"
                                                                    transform="translate(1368 483)" fill="currentColor" />
                                                            </g>
                                                            <g id="Group_1328" data-name="Group 1328"
                                                                transform="translate(0 -3)">
                                                                <rect id="Rectangle_5729-2" data-name="Rectangle 5729"
                                                                    width="3" height="2"
                                                                    transform="translate(1364 483)" fill="currentColor" />
                                                                <rect id="Rectangle_5730-2" data-name="Rectangle 5730"
                                                                    width="9" height="2"
                                                                    transform="translate(1368 483)" fill="currentColor" />
                                                            </g>
                                                            <g id="Group_1327" data-name="Group 1327"
                                                                transform="translate(0 -1)">
                                                                <rect id="Rectangle_5731" data-name="Rectangle 5731"
                                                                    width="3" height="2"
                                                                    transform="translate(1364 487)" fill="currentColor" />
                                                                <rect id="Rectangle_5732" data-name="Rectangle 5732"
                                                                    width="9" height="2"
                                                                    transform="translate(1368 487)" fill="currentColor" />
                                                            </g>
                                                        </g>
                                                    </g>
                                                </svg>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <p class="product__showing--count">Showing {{ count($products) ?? 0 }} results</p>
                            </div>
                            <div class="tab_content">
                                <div id="product_grid" class="tab_pane active show">
                                    <div class="product__section--inner">
                                        <div class="row mb--n30">
                                            @forelse ($products as $product)
                                                <div class="col-lg-3 col-md-4 col-sm-6 col-6 custom-col mb-30">
                                                    <article class="product__card">
                                                        <div class="product__card--thumbnail">
                                                            <a class="product__card--thumbnail__link display-block"
                                                                href="{{ route('product-detail', $product->slug) }}">
                                                                <img class="product__card--thumbnail__img product__primary--img"
                                                                    src="{{ asset($product->images[0]->image) }}"
                                                                    alt="product-img">
                                                                <img class="product__card--thumbnail__img product__secondary--img"
                                                                    src="{{ asset($product->images[1]->image) }}"
                                                                    alt="product-img">
                                                            </a>
                                                            @php
                                                                $percentage = (($product->price - $product->discounted_price) / $product->price) * 100;
                                                            @endphp
                                                            <span class="product__badge">-{{ (int) $percentage }}%</span>
                                                            <ul class="product__card--action">
                                                                <li class="product__card--action__list">
                                                                    <a class="product__card--action__btn"
                                                                        title="Quick View"
                                                                        href="{{ route('product-detail', $product->slug) }}">
                                                                        <svg class="product__card--action__btn--svg"
                                                                            width="16" height="16"
                                                                            viewBox="0 0 16 16" fill="none"
                                                                            xmlns="http://www.w3.org/2000/svg">
                                                                            <path
                                                                                d="M15.6952 14.4991L11.7663 10.5588C12.7765 9.4008 13.33 7.94381 13.33 6.42703C13.33 2.88322 10.34 0 6.66499 0C2.98997 0 0 2.88322 0 6.42703C0 9.97085 2.98997 12.8541 6.66499 12.8541C8.04464 12.8541 9.35938 12.4528 10.4834 11.6911L14.4422 15.6613C14.6076 15.827 14.8302 15.9184 15.0687 15.9184C15.2944 15.9184 15.5086 15.8354 15.6711 15.6845C16.0166 15.364 16.0276 14.8325 15.6952 14.4991ZM6.66499 1.67662C9.38141 1.67662 11.5913 3.8076 11.5913 6.42703C11.5913 9.04647 9.38141 11.1775 6.66499 11.1775C3.94857 11.1775 1.73869 9.04647 1.73869 6.42703C1.73869 3.8076 3.94857 1.67662 6.66499 1.67662Z"
                                                                                fill="currentColor"></path>
                                                                        </svg>
                                                                        <span class="visually-hidden">Quick View</span>
                                                                    </a>
                                                                </li>
                                                                <li class="product__card--action__list">
                                                                    <a class="product__card--action__btn" title="Wishlist"
                                                                        href="javascript:void(0)"
                                                                        onclick="addToWishlist(this,{{ $product->id }})"
                                                                        style="{{ $product->liked_by_count > 0 ? 'background: var(--secondary-color);color: var(--text-white-color);' : '' }}">
                                                                        <svg class="product__card--action__btn--svg"
                                                                            width="18" height="18"
                                                                            viewBox="0 0 16 13" fill="none"
                                                                            xmlns="http://www.w3.org/2000/svg">
                                                                            <path
                                                                                d="M13.5379 1.52734C11.9519 0.1875 9.51832 0.378906 8.01442 1.9375C6.48317 0.378906 4.04957 0.1875 2.46364 1.52734C0.412855 3.25 0.713636 6.06641 2.1902 7.57031L6.97536 12.4648C7.24879 12.7383 7.60426 12.9023 8.01442 12.9023C8.39723 12.9023 8.7527 12.7383 9.02614 12.4648L13.8386 7.57031C15.2879 6.06641 15.5886 3.25 13.5379 1.52734ZM12.8816 6.64062L8.09645 11.5352C8.04176 11.5898 7.98707 11.5898 7.90504 11.5352L3.11989 6.64062C2.10817 5.62891 1.91676 3.71484 3.31129 2.53906C4.3777 1.63672 6.01832 1.77344 7.05739 2.8125L8.01442 3.79688L8.97145 2.8125C9.98317 1.77344 11.6238 1.63672 12.6902 2.51172C14.0847 3.71484 13.8933 5.62891 12.8816 6.64062Z"
                                                                                fill="currentColor" />
                                                                        </svg>
                                                                        <span class="visually-hidden">Wishlist</span>
                                                                    </a>
                                                                </li>
                                                            </ul>
                                                            <div class="product__add--to__card">
                                                                <a class="product__card--btn" title="Add To Card"
                                                                    onclick="addToCart(this, {{ $product->id }})"> Add to
                                                                    Cart
                                                                    <svg width="17" height="15"
                                                                        viewBox="0 0 14 11" fill="none"
                                                                        xmlns="http://www.w3.org/2000/svg">
                                                                        <path
                                                                            d="M13.2371 4H11.5261L8.5027 0.460938C8.29176 0.226562 7.9402 0.203125 7.70582 0.390625C7.47145 0.601562 7.44801 0.953125 7.63551 1.1875L10.0496 4H3.46364L5.8777 1.1875C6.0652 0.953125 6.04176 0.601562 5.80739 0.390625C5.57301 0.203125 5.22145 0.226562 5.01051 0.460938L1.98707 4H0.299574C0.135511 4 0.0183239 4.14062 0.0183239 4.28125V4.84375C0.0183239 5.00781 0.135511 5.125 0.299574 5.125H0.721449L1.3777 9.78906C1.44801 10.3516 1.91676 10.75 2.47926 10.75H11.0339C11.5964 10.75 12.0652 10.3516 12.1355 9.78906L12.7918 5.125H13.2371C13.3777 5.125 13.5183 5.00781 13.5183 4.84375V4.28125C13.5183 4.14062 13.3777 4 13.2371 4ZM11.0339 9.625H2.47926L1.86989 5.125H11.6433L11.0339 9.625ZM7.33082 6.4375C7.33082 6.13281 7.07301 5.875 6.76832 5.875C6.4402 5.875 6.20582 6.13281 6.20582 6.4375V8.3125C6.20582 8.64062 6.4402 8.875 6.76832 8.875C7.07301 8.875 7.33082 8.64062 7.33082 8.3125V6.4375ZM9.95582 6.4375C9.95582 6.13281 9.69801 5.875 9.39332 5.875C9.0652 5.875 8.83082 6.13281 8.83082 6.4375V8.3125C8.83082 8.64062 9.0652 8.875 9.39332 8.875C9.69801 8.875 9.95582 8.64062 9.95582 8.3125V6.4375ZM4.70582 6.4375C4.70582 6.13281 4.44801 5.875 4.14332 5.875C3.8152 5.875 3.58082 6.13281 3.58082 6.4375V8.3125C3.58082 8.64062 3.8152 8.875 4.14332 8.875C4.44801 8.875 4.70582 8.64062 4.70582 8.3125V6.4375Z"
                                                                            fill="currentColor" />
                                                                    </svg>
                                                                </a>
                                                            </div>
                                                        </div>
                                                        <div class="product__card--content text-center">
                                                            <h3 class="product__card--title"><a
                                                                    href="{{ route('product-detail', $product->slug, $product->id) }}">{{ $product->title }}
                                                                </a></h3>
                                                            <div class="product__card--price">
                                                                <span
                                                                    class="current__price">₹{{ $product->discounted_price }}</span>
                                                                <span class="old__price">
                                                                    ₹{{ $product->price }}</span>
                                                            </div>
                                                        </div>
                                                    </article>
                                                </div>
                                            @empty
                                                <div class="text-center">
                                                    <p>No Product Available</p>
                                                </div>
                                            @endforelse
                                        </div>
                                    </div>
                                </div>
                                <div id="product_list" class="tab_pane">
                                    <div class="product__section--inner product__section--style3__inner">
                                        <div class="row row-cols-1 mb--n30">
                                            @forelse ($products as $product)
                                                <div class="col mb-30">
                                                    <div class="product__card product__list d-flex align-items-center">
                                                        <div class="product__card--thumbnail product__list--thumbnail">
                                                            <a class="product__card--thumbnail__link display-block"
                                                                href="{{ route('product-detail', $product->slug) }}">
                                                                <img class="product__card--thumbnail__img product__primary--img"
                                                                    src="{{ asset($product->images[0]->image) }}"
                                                                    alt="product-img">
                                                                <img class="product__card--thumbnail__img product__secondary--img"
                                                                    src="{{ asset($product->images[1]->image) }}"
                                                                    alt="product-img">
                                                            </a>
                                                            @php
                                                                $percentage = (($product->price - $product->discounted_price) / $product->price) * 100;
                                                            @endphp
                                                            <span class="product__badge">-{{ (int) $percentage }}%</span>
                                                            <ul class="product__card--action">
                                                                <li class="product__card--action__list">
                                                                    <a class="product__card--action__btn"
                                                                        title="Quick View"
                                                                        href="{{ route('product-detail', $product->slug) }}">
                                                                        <svg class="product__card--action__btn--svg"
                                                                            width="16" height="16"
                                                                            viewBox="0 0 16 16" fill="none"
                                                                            xmlns="http://www.w3.org/2000/svg">
                                                                            <path
                                                                                d="M15.6952 14.4991L11.7663 10.5588C12.7765 9.4008 13.33 7.94381 13.33 6.42703C13.33 2.88322 10.34 0 6.66499 0C2.98997 0 0 2.88322 0 6.42703C0 9.97085 2.98997 12.8541 6.66499 12.8541C8.04464 12.8541 9.35938 12.4528 10.4834 11.6911L14.4422 15.6613C14.6076 15.827 14.8302 15.9184 15.0687 15.9184C15.2944 15.9184 15.5086 15.8354 15.6711 15.6845C16.0166 15.364 16.0276 14.8325 15.6952 14.4991ZM6.66499 1.67662C9.38141 1.67662 11.5913 3.8076 11.5913 6.42703C11.5913 9.04647 9.38141 11.1775 6.66499 11.1775C3.94857 11.1775 1.73869 9.04647 1.73869 6.42703C1.73869 3.8076 3.94857 1.67662 6.66499 1.67662Z"
                                                                                fill="currentColor"></path>
                                                                        </svg>
                                                                        <span class="visually-hidden">Quick View</span>
                                                                    </a>
                                                                </li>
                                                                <li class="product__card--action__list">
                                                                    <a class="product__card--action__btn" title="Wishlist"
                                                                        href="javascript:void(0)"
                                                                        onclick="addToWishlist(this,{{ $product->id }})"
                                                                        style="{{ $product->liked_by_count > 0 ? 'background: var(--secondary-color);color: var(--text-white-color);' : '' }}">
                                                                        <svg class="product__card--action__btn--svg"
                                                                            width="18" height="18"
                                                                            viewBox="0 0 16 13" fill="none"
                                                                            xmlns="http://www.w3.org/2000/svg">
                                                                            <path
                                                                                d="M13.5379 1.52734C11.9519 0.1875 9.51832 0.378906 8.01442 1.9375C6.48317 0.378906 4.04957 0.1875 2.46364 1.52734C0.412855 3.25 0.713636 6.06641 2.1902 7.57031L6.97536 12.4648C7.24879 12.7383 7.60426 12.9023 8.01442 12.9023C8.39723 12.9023 8.7527 12.7383 9.02614 12.4648L13.8386 7.57031C15.2879 6.06641 15.5886 3.25 13.5379 1.52734ZM12.8816 6.64062L8.09645 11.5352C8.04176 11.5898 7.98707 11.5898 7.90504 11.5352L3.11989 6.64062C2.10817 5.62891 1.91676 3.71484 3.31129 2.53906C4.3777 1.63672 6.01832 1.77344 7.05739 2.8125L8.01442 3.79688L8.97145 2.8125C9.98317 1.77344 11.6238 1.63672 12.6902 2.51172C14.0847 3.71484 13.8933 5.62891 12.8816 6.64062Z"
                                                                                fill="currentColor" />
                                                                        </svg>
                                                                        <span class="visually-hidden">Wishlist</span>
                                                                    </a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                        <div class="product__card--content product__list--content">
                                                            <h3 class="product__card--title"><a
                                                                    href="{{ route('product-detail', $product->slug) }}">{{ $product->title }}
                                                                </a></h3>
                                                            <div class="product__card--price">
                                                                <span
                                                                    class="current__price">₹{{ $product->discounted_price }}</span>
                                                                <span class="old__price">
                                                                    ₹{{ $product->price }}</span>
                                                            </div>
                                                            <p class="product__card--content__desc mb-15">
                                                                {{ $product->short_description }}</p>
                                                            <a
                                                                class="product__card--btn primary__btn"onclick="addToCart(this, {{ $product->id }})">+
                                                                Add to cart</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            @empty
                                                <div class="text-center">
                                                    <p>No Product Available</p>
                                                </div>
                                            @endforelse
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{-- <div class="pagination__area">
                                <nav class="pagination justify-content-center">
                                    <ul class="pagination__wrapper d-flex align-items-center justify-content-center">
                                        <li class="pagination__list">
                                            <a href="#" class="pagination__item--arrow  link ">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="22.51" height="20.443"
                                                    viewBox="0 0 512 512">
                                                    <path fill="none" stroke="currentColor" stroke-linecap="round"
                                                        stroke-linejoin="round" stroke-width="48"
                                                        d="M244 400L100 256l144-144M120 256h292" />
                                                </svg>
                                                <span class="visually-hidden">page left arrow</span>
                                            </a>
                                        <li>
                                        <li class="pagination__list"><span
                                                class="pagination__item pagination__item--current">1</span></li>
                                        <li class="pagination__list"><a href="#"
                                                class="pagination__item link">2</a></li>
                                        <li class="pagination__list"><a href="#"
                                                class="pagination__item link">3</a></li>
                                        <li class="pagination__list"><a href="#"
                                                class="pagination__item link">4</a></li>
                                        <li class="pagination__list">
                                            <a href="#" class="pagination__item--arrow  link ">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="22.51" height="20.443"
                                                    viewBox="0 0 512 512">
                                                    <path fill="none" stroke="currentColor" stroke-linecap="round"
                                                        stroke-linejoin="round" stroke-width="48"
                                                        d="M268 112l144 144-144 144M392 256H100" />
                                                </svg>
                                                <span class="visually-hidden">page right arrow</span>
                                            </a>
                                        <li>
                                    </ul>
                                </nav>
                            </div> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End shop section -->

        <!-- Start feature section -->
        <section class="feature__section section--padding pt-0">
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
        </section>
        <!-- End feature section -->
    @endsection

    @section('page-script')
        <script>
            function addToCart(element, id) {
                Notiflix.Loading.standard('Adding to cart...');
                $.ajax({
                    method: "post",
                    url: "{{ route('add-to-cart') }}",
                    data: {
                        _token: "{{ csrf_token() }}",
                        product_id: id,
                    },
                    success: function(response, status) {
                        Notiflix.Loading.remove();
                        console.log(response);
                        if (status == 'success') {
                            Notiflix.Notify.success(response.success);
                            location.reload();
                        } else {
                            Notiflix.Notify.failure('response.error');
                        }
                    },
                    error: function(response) {
                        console.log(response);
                    }
                });
            }


            function addToWishlist(element, id) {
                Notiflix.Loading.standard('Adding to wishlist...');
                $.ajax({
                    type: "post",
                    url: "{{ route('add-wishlist') }}",
                    data: {
                        _token: "{{ csrf_token() }}",
                        id: id
                    },
                    success: function(response, status) {
                        Notiflix.Loading.remove();
                        console.log(response);
                        if (response.success) {
                            Notiflix.Notify.success(response.success);
                        } else {
                            Notiflix.Notify.failure(response.error);
                        }
                    },
                    error: function(response) {
                        console.log(response);
                    }
                });
            }
        </script>
    @endsection
</x-site.layouts.main>
