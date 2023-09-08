    <!-- Scroll top bar -->
    <button id="scroll__top"><svg xmlns="http://www.w3.org/2000/svg" class="ionicon" viewBox="0 0 512 512">
            <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="48"
                d="M112 244l144-144 144 144M256 120v292" />
        </svg></button>
    <script src="{{ asset('vendors/js/forms/select/select2.full.min.js') }}" defer="defer"></script>
    <!-- All Script JS Plugins here  -->
    <script src="https://code.jquery.com/jquery-3.6.3.min.js"
        integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/notiflix@3.2.5/dist/notiflix-aio-3.2.5.min.js"></script>
    <script src="{{ asset('site/assets/js/vendor/popper.js') }}" defer="defer"></script>
    <script src="{{ asset('site/assets/js/vendor/bootstrap.min.js') }}" defer="defer"></script>
    <script src="{{ asset('site/assets/js/plugins/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('site/assets/js/plugins/glightbox.min.js') }}"></script>

    <!-- Customscript js -->
    <script src="{{ asset('site/assets/js/script.js') }}"></script>

    <script>
        $(".alert").fadeTo(5000, 3500).slideUp(3500, function() {
            $(".alert").slideUp(3500);
            setTimeout(() => {
                location.href = "{{ route('/') }}"
            }, 500);
        });

        $(window).on('load', function() {
            getCartData();
        })

        function getCartData() {
            $.ajax({
                type: "get",
                url: "{{ route('get-cart-data') }}",
                success: function(response) {
                    console.log(response);
                    $('.items__count').text(response.count.length ?? 0);
                    $('#nav-cart').html(response.html);
                }
            });
        }

        $('#search').keyup(function(e) {
            const search = $(this).val();
            console.log(search);
            $.ajax({
                type: "get",
                url: "{{ route('search') }}",
                data: {
                    search: search,
                    _token: "{{ csrf_token() }}"
                },
                success: function(response) {
                    console.log(response);
                    $('[data-search-result]').html(response.html);
                }
            });
        });
    </script>
    @yield('page-script')
