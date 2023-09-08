<!-- Start footer section -->
<footer class="footer__section footer__bg">
    <div class="container">
        <div class="main__footer section--padding">
            <div class="row ">
                <div class="col-lg-4 col-md-8">
                    <div class="footer__widget">
                        <h2 class="footer__widget--title d-none d-sm-u-block">About Us <button
                                class="footer__widget--button" aria-label="footer widget button"></button>
                            <svg class="footer__widget--title__arrowdown--icon" xmlns="http://www.w3.org/2000/svg"
                                width="12.355" height="8.394" viewBox="0 0 10.355 6.394">
                                <path d="M15.138,8.59l-3.961,3.952L7.217,8.59,6,9.807l5.178,5.178,5.178-5.178Z"
                                    transform="translate(-6 -8.59)" fill="currentColor"></path>
                            </svg>
                        </h2>
                        <div class="footer__widget--inner">
                            <div class="footer__logo">
                                <a class="footer__logo--link" href="{{ route('/') }}">
                                    <img class="footer__logo--img"
                                        src="{{ asset('site/assets/img/logo/nav-log.webp') }}" alt="logo-img">
                                </a>
                            </div>
                            <p class="footer__widget--desc">{{ $businessSettings['footer_desc'] ?? '' }}</p>
                            <ul class="footer__widget--info">
                                <li class="footer__widget--info_list">
                                    <svg class="footer__widget--info__icon" width="20" height="23"
                                        viewBox="0 0 20 23" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M18.3334 10.1666C18.3334 14.769 10.0001 20.9999 10.0001 20.9999C10.0001 20.9999 1.66675 14.769 1.66675 10.1666C1.66675 5.56421 5.39771 1.83325 10.0001 1.83325C14.6025 1.83325 18.3334 5.56421 18.3334 10.1666Z"
                                            stroke="currentColor" stroke-width="2"></path>
                                        <ellipse cx="10.0001" cy="10.1667" rx="2.5" ry="2.5"
                                            stroke="currentColor" stroke-width="2"></ellipse>
                                    </svg>
                                    <span class="footer__widget--info__text">{{ $businessSettings['address'] ?? '' }}</span>
                                </li>
                                <li class="footer__widget--info_list">
                                    <svg class="footer__widget--info__icon" width="20" height="20"
                                        viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M13.31 1.52371L18.6133 2.11296C18.6133 2.11296 19.2026 7.41627 13.31 13.3088C7.41748 19.2014 2.11303 18.6133 2.11303 18.6133L1.52377 13.31L5.64971 10.9529L7.71153 13.0148C7.71153 13.0148 9.18467 12.7201 10.9524 10.9524C12.7202 9.18461 13.0148 7.71147 13.0148 7.71147L10.953 5.64965L13.31 1.52371Z"
                                            stroke="currentColor" stroke-width="2"></path>
                                    </svg>
                                    <a class="footer__widget--info__text"
                                        href="tel:+91{{ $businessSettings['phone'] ?? '' }}">: (+91)
                                        {{ $businessSettings['phone'] ?? '' }}</a>
                                </li>
                                <li class="footer__widget--info_list">
                                    <svg class="footer__widget--info__icon" width="24" height="20"
                                        viewBox="0 0 24 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M2.00006 3.33325H22.0001V17.4999H2.00006V3.33325Z"
                                            stroke="currentColor" stroke-width="2"></path>
                                        <path d="M3.2655 3.33325H20.7871L12 12.4999L3.2655 3.33325Z"
                                            stroke="currentColor" stroke-width="2"></path>
                                    </svg>
                                    <a class="footer__widget--info__text"
                                        href="mailto:{{ $businessSettings['email'] ?? '' }}">{{ $businessSettings['email'] ?? '' }}</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-md-4">
                    <div class="footer__widget">
                        <h2 class="footer__widget--title ">Our Offer <button class="footer__widget--button"
                                aria-label="footer widget button"></button>
                            <svg class="footer__widget--title__arrowdown--icon" xmlns="http://www.w3.org/2000/svg"
                                width="12.355" height="8.394" viewBox="0 0 10.355 6.394">
                                <path d="M15.138,8.59l-3.961,3.952L7.217,8.59,6,9.807l5.178,5.178,5.178-5.178Z"
                                    transform="translate(-6 -8.59)" fill="currentColor"></path>
                            </svg>
                        </h2>
                        <ul class="footer__widget--menu footer__widget--inner">
                            <li class="footer__widget--menu__list"><a class="footer__widget--menu__text"
                                    href="{{ route('contact') }}">Contact Us</a></li>
                            <li class="footer__widget--menu__list"><a class="footer__widget--menu__text"
                                    href="{{ route('about') }}">About Us</a></li>
                            <li class="footer__widget--menu__list"><a class="footer__widget--menu__text"
                                    href="{{ route('wishlist') }}">Wishlist</a></li>
                            <li class="footer__widget--menu__list"><a class="footer__widget--menu__text"
                                    href="#">Privacy Policy</a></li>
                            <li class="footer__widget--menu__list"><a class="footer__widget--menu__text"
                                    href="{{ route('faq') }}">Frequently</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-2 col-md-5">
                    <div class="footer__widget">
                        <h2 class="footer__widget--title ">Quick Links <button class="footer__widget--button"
                                aria-label="footer widget button"></button>
                            <svg class="footer__widget--title__arrowdown--icon" xmlns="http://www.w3.org/2000/svg"
                                width="12.355" height="8.394" viewBox="0 0 10.355 6.394">
                                <path d="M15.138,8.59l-3.961,3.952L7.217,8.59,6,9.807l5.178,5.178,5.178-5.178Z"
                                    transform="translate(-6 -8.59)" fill="currentColor"></path>
                            </svg>
                        </h2>
                        <ul class="footer__widget--menu footer__widget--inner">

                            <li class="footer__widget--menu__list"><a class="footer__widget--menu__text"
                                    href="#">My Account</a></li>
                            <li class="footer__widget--menu__list"><a class="footer__widget--menu__text"
                                    href="{{ route('cart') }}">Shopping Cart</a></li>
                            <li class="footer__widget--menu__list"><a class="footer__widget--menu__text"
                                    href="{{ route('google.login') }}">Login</a></li>
                            <li class="footer__widget--menu__list"><a class="footer__widget--menu__text"
                                    href="{{ route('google.login') }}">Register</a></li>
                            <li class="footer__widget--menu__list"><a class="footer__widget--menu__text"
                                    href="{{ route('checkout') }}">Checkout</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-4 col-md-7">
                    <div class="footer__widget">
                        <h2 class="footer__widget--title ">Newsletter <button class="footer__widget--button"
                                aria-label="footer widget button"></button>
                            <svg class="footer__widget--title__arrowdown--icon" xmlns="http://www.w3.org/2000/svg"
                                width="12.355" height="8.394" viewBox="0 0 10.355 6.394">
                                <path d="M15.138,8.59l-3.961,3.952L7.217,8.59,6,9.807l5.178,5.178,5.178-5.178Z"
                                    transform="translate(-6 -8.59)" fill="currentColor"></path>
                            </svg>
                        </h2>
                        <div class="footer__widget--inner">
                            <p class="footer__widget--desc">Subscribe to our weekly Newsletter and receive updates
                                via email.</p>
                            <div class="newsletter__subscribe footer__newsletter">
                                <form class="newsletter__subscribe--form" action="#">
                                    <label>
                                        <input class="newsletter__subscribe--input" placeholder=" Enter Your Email"
                                            type="text">
                                    </label>
                                    <button class="newsletter__subscribe--button" type="submit">Subscribe</button>
                                </form>
                            </div>
                            <ul class="social__share footer__social d-flex">
                                <li class="social__share--list">
                                    <a class="social__share--icon" target="_blank"
                                        href="{{ $businessSettings['facebook'] ?? '' }}">
                                        <svg width="11" height="17" viewBox="0 0 9 15" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M7.62891 8.625L8.01172 6.10938H5.57812V4.46875C5.57812 3.75781 5.90625 3.10156 7 3.10156H8.12109V0.941406C8.12109 0.941406 7.10938 0.75 6.15234 0.75C4.15625 0.75 2.84375 1.98047 2.84375 4.16797V6.10938H0.601562V8.625H2.84375V14.75H5.57812V8.625H7.62891Z"
                                                fill="currentColor" />
                                        </svg>
                                        <span class="visually-hidden">Facebook</span>
                                    </a>
                                </li>
                                <li class="social__share--list">
                                    <a class="social__share--icon" target="_blank"
                                        href="{{ $businessSettings['youtube'] ?? '' }}">
                                        <i class="fa-brands fa-youtube"></i>
                                        <span class="visually-hidden">Youtube</span>
                                    </a>
                                </li>
                                <li class="social__share--list">
                                    <a class="social__share--icon" target="_blank"
                                        href="{{ $businessSettings['instagram'] ?? '' }}">
                                        <svg width="16" height="15" viewBox="0 0 14 13" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M7.125 3.60547C5.375 3.60547 3.98047 5.02734 3.98047 6.75C3.98047 8.5 5.375 9.89453 7.125 9.89453C8.84766 9.89453 10.2695 8.5 10.2695 6.75C10.2695 5.02734 8.84766 3.60547 7.125 3.60547ZM7.125 8.80078C6.00391 8.80078 5.07422 7.89844 5.07422 6.75C5.07422 5.62891 5.97656 4.72656 7.125 4.72656C8.24609 4.72656 9.14844 5.62891 9.14844 6.75C9.14844 7.89844 8.24609 8.80078 7.125 8.80078ZM11.1172 3.49609C11.1172 3.08594 10.7891 2.75781 10.3789 2.75781C9.96875 2.75781 9.64062 3.08594 9.64062 3.49609C9.64062 3.90625 9.96875 4.23438 10.3789 4.23438C10.7891 4.23438 11.1172 3.90625 11.1172 3.49609ZM13.1953 4.23438C13.1406 3.25 12.9219 2.375 12.2109 1.66406C11.5 0.953125 10.625 0.734375 9.64062 0.679688C8.62891 0.625 5.59375 0.625 4.58203 0.679688C3.59766 0.734375 2.75 0.953125 2.01172 1.66406C1.30078 2.375 1.08203 3.25 1.02734 4.23438C0.972656 5.24609 0.972656 8.28125 1.02734 9.29297C1.08203 10.2773 1.30078 11.125 2.01172 11.8633C2.75 12.5742 3.59766 12.793 4.58203 12.8477C5.59375 12.9023 8.62891 12.9023 9.64062 12.8477C10.625 12.793 11.5 12.5742 12.2109 11.8633C12.9219 11.125 13.1406 10.2773 13.1953 9.29297C13.25 8.28125 13.25 5.24609 13.1953 4.23438ZM11.8828 10.3594C11.6914 10.9062 11.2539 11.3164 10.7344 11.5352C9.91406 11.8633 8 11.7812 7.125 11.7812C6.22266 11.7812 4.30859 11.8633 3.51562 11.5352C2.96875 11.3164 2.55859 10.9062 2.33984 10.3594C2.01172 9.56641 2.09375 7.65234 2.09375 6.75C2.09375 5.875 2.01172 3.96094 2.33984 3.14062C2.55859 2.62109 2.96875 2.21094 3.51562 1.99219C4.30859 1.66406 6.22266 1.74609 7.125 1.74609C8 1.74609 9.91406 1.66406 10.7344 1.99219C11.2539 2.18359 11.6641 2.62109 11.8828 3.14062C12.2109 3.96094 12.1289 5.875 12.1289 6.75C12.1289 7.65234 12.2109 9.56641 11.8828 10.3594Z"
                                                fill="currentColor" />
                                        </svg>
                                        <span class="visually-hidden">Instagram</span>
                                    </a>
                                </li>
                                <li class="social__share--list">
                                    <a class="social__share--icon" target="_blank"
                                        href="https://api.whatsapp.com/send?phone=91{{ $businessSettings['whatsapp'] ??"" }}">
                                        <i class="fa-brands fa-whatsapp"></i>
                                        <span class="visually-hidden">Whatsapp</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <div class="footer__bottom">
        <div class="container">
            <div class="footer__bottom--inenr d-flex justify-content-between align-items-center">
                <p class="copyright__content mb-0"><span class="text__secondary">© {{ date('Y') }}</span> Powered
                    by <a class="copyright__content--link" target="_blank" href="#">{{ env('APP_NAME') }}</a>
                    . All Rights
                    Reserved.</p>
                <div class="footer__payment">
                    <img src="{{ asset('site/assets/img/icon/payment-img.webp') }}" alt="payment-img">
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- End footer section -->
