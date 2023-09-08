<x-site.layouts.main>
    @section('title', 'Login')

    @section('meta-title', 'Maryam one stop solution for infertility')
    @section('meta-description', 'Maryam one stop solution for infertility')

    @section('page-style')
    @endsection

    @section('content')
        <!-- --------------------Breadcrumb------------ -->
        <div class="breadcrumb-container">
            <nav data-depth="2" class="breadcrumb container">
                <h1 class="h1 category-title breadcrumb-title">Login</h1>
                <ul>
                    <li>
                        <a href="{{ route('/') }}">
                            <span>Home</span>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <span>Login</span>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
        <!-- -----------Login page----------- -->
        <section id="wrapper">
            <div class="container">
                <div class="row">
                    <div id="content-wrapper" class="col-12">
                        <section id="main">
                            <div class="login-page">
                                <div class="block-title">
                                    <h2 class="title"><span>Login</span></h2>
                                </div>
                                <form action="#" id="login" method="post" enctype="multipart/form-data"
                                    class="card">
                                    @csrf
                                    <div class="login-form">
                                        {{-- <div class="form-group row ">
                                            <label class="col-md-3 col-sm-12 form-control-label required">Email</label>
                                            <div class="col-md-9 col-sm-12">
                                                <input class="form-control" id="email" name="email" type="email"
                                                    value="">
                                            </div>
                                            <label class="col-md-3 col-sm-12 form-control-label required">Password</label>
                                            <div class="col-md-9 col-sm-12">
                                                <input class="form-control" id="password" name="password" type="password"
                                                    value="">
                                            </div>
                                        </div> --}}
                                        <div class="form-group text-center">
                                            <a href="{{ route('google.login') }}" class="btn btn-primary">
                                                Login with google account
                                            </a>
                                        </div>
                                        <div class="form-group text-center">
                                            <a href="{{ route('user-register') }}">New to Maryam? create an account </a>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </section>
                    </div>
                </div>
            </div>
        </section>
    @endsection

    @section('page-script')

        <script type="module">
        // Import the functions you need from the SDKs you need
        import { initializeApp } from "https://www.gstatic.com/firebasejs/9.15.0/firebase-app.js";
        // TODO: Add SDKs for Firebase products that you want to use
        // https://firebase.google.com/docs/web/setup#available-libraries
      
        // Your web app's Firebase configuration
        const firebaseConfig = {
          apiKey: "AIzaSyDocbSPPd9I-KLC9esBF3euk-a1tyKYuiQ",
          authDomain: "maryam-18b9b.firebaseapp.com",
          projectId: "maryam-18b9b",
          storageBucket: "maryam-18b9b.appspot.com",
          messagingSenderId: "551155894766",
          appId: "1:551155894766:web:919b9185bebeda9c5526ff"
        };
      
        // Initialize Firebase
        const app = initializeApp(firebaseConfig);     
                
      </script>

        <script>
            $('#login').submit(function(e) {
                e.preventDefault();
                const data = $(this).serialize();
                // console.log(data);
                $.ajax({
                    type: "post",
                    url: "{{ route('post-login') }}",
                    data: data,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        console.log(response);
                    },
                    error: function(xhr, status, error) {
                        if (xhr.status == 422) {
                            $.each(xhr.responseJSON.errors, function(key, item) {
                                console.log(item);
                                $('#error-modal').modal('show');
                                $('#error').text(item[0]);
                            });
                        }
                    }
                });
            });
        </script>
    @endsection
</x-site.layouts.main>
