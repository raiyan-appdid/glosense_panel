<x-site.layouts.main>
    @section('title', 'Home')

    @section('meta-title', 'Glossense')
    @section('meta-description', 'Glossense skin product')

    @section('page-style')
        <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/animatecss/3.5.2/animate.min.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/wow/1.1.2/wow.min.js"></script>

        <style>
            .hero-section {
                background: pink;
            }

            .outer-box {
                padding-top: 20rem
            }

            .gl-product {
                width: 38rem;
            }

            section {
                height: 60rem;
            }

            .image-scetion h1 {
                margin: auto;
                height: 300px;
                width: 300px;
            }

            .wrapper {
                top: 50%;
                left: 50%;
                transform: translate(-50%, -50%);
                position: fixed;
            }

            .circle {
                width: 100px;
                height: 100px;
                border-radius: 50%;
                background-color: greenyellow;
                text-align: center;
                vertical-align: middle;
                display: table-cell;
            }

            #reload {
                width: 50px;
                height: 50px;
            }
        </style>
    @endsection
    @section('content')
        <section class="hero-section">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-12 col-12 text-center">
                        <div class="outer-box">
                            <img class="gl-product wow fadeInDown item--large" data-wow-delay="0.3s"
                                src="{{ asset('site/assets/img/product/Skin Glow.png') }}" alt="Glosense">
                        </div>
                    </div>
                </div>
            </div>
        </section>
        {{-- <div class="image-scetion">
            <div class="container">
                <div class="w-100">
                    <div class="img-container">
                        <div class="item wow bounceInRight item--medium"></div>
                        <div class="item wow bounceInRight item--large" data-wow-delay="0.3s"></div>
                        <div class="item wow bounceInRight" data-wow-delay="0.4s"></div>
                        <div class="item wow bounceInRight item--medium" data-wow-delay="0.5s"></div>
                        <div class="item wow bounceInRight"></div>
                    </div>
                    <div class="img-container">
                        <div class="item wow flipInX item--hori-large item--medium"></div>
                        <div class="item wow rollIn" data-wow-delay="0.3s"></div>
                        <div class="item wow rollIn" data-wow-delay="0.3s"></div>
                        <div class="item wow rollIn" data-wow-delay="0.3s"></div>
                    </div>
                    <div class="img-container">
                        <div class="item wow fadeInRight item--hori-medium item--medium"></div>
                        <div class="item wow fadeInRight item--medium"></div>
                        <div class="item wow jackInTheBox" data-wow-delay="0.3s"></div>
                        <div class="item wow jackInTheBox" data-wow-delay="0.3s"></div>
                        <div class="item wow jackInTheBox" data-wow-delay="0.3s"></div>
                    </div>
                </div>
            </div>
        </div> --}}


        {{-- <section class="img-rotate">
            <div class="container">
                <div class="wrapper">
                    <div class="circle">
                        <img id="reload" src="{{ asset('site/assets/img/product/Skin Glow.png') }}" alt="scroll">
                    </div>
                </div>
            </div>
        </section> --}}



        <div class="imagesDuo mb-5 mt-5">
            <div class="imgDuo">
                <div class="parallex flex" style="transform: translate3d(0px, -48.8402px, 0px);">
                    <img class="wow fadeInLeft" src="{{ asset('site/assets/img/product/left-img.webp') }}" alt="Glosense">
                    <img class="wow fadeInRight" src="{{ asset('site/assets/img/product/right-img.webp') }}" alt="Glosense">
                </div>
            </div>
        </div>

        <x-site.testimonials :testimonials="$testimonials" />

    @endsection

    @section('page-script')
        <script>
            $(document).ready(function() {


                window.onscroll = function() {
                    scrollRotate();
                };

                function scrollRotate() {
                    let image = document.getElementById("reload");
                    image.style.transform = "rotate(" + window.pageYOffset / 2 + "deg)";
                }

                WOW.prototype.addBox = function(element) {
                    this.boxes.push(element);
                };

                var wow = new WOW();
                wow.init();

                $('.wow').on('scrollSpy:exit', function() {
                    $(this).css({
                        'visibility': 'hidden',
                        'animation-name': 'none'
                    }).removeClass('animated');
                    wow.addBox(this);
                }).scrollSpy();
            });
        </script>
    @endsection

</x-site.layouts.main>
