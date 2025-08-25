<!-- HTML Header: Bao gồm các import cần thiết -->

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>SocialV | Responsive Bootstrap 4 Admin Dashboard Template</title>

    <link rel="shortcut icon" href="{{ asset('template_assets/images/favicon.ico') }}" />
    <link rel="stylesheet" href="{{ asset('template_assets/css/libs.min.css') }}">
    <link rel="stylesheet" href="{{ asset('template_assets/css/socialv.css?v=4.0.0') }}">
    <link rel="stylesheet" href="{{ asset('template_assets/vendor/@fortawesome/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('template_assets/vendor/remixicon/fonts/remixicon.css') }}">
    <link rel="stylesheet"
        href="{{ asset('template_assets/vendor/vanillajs-datepicker/dist/css/datepicker.min.css') }}">
    <link rel="stylesheet" href="{{ asset('template_assets/vendor/font-awesome-line-awesome/css/all.min.css') }}">
    <link rel="stylesheet"
        href="{{ asset('template_assets/vendor/line-awesome/dist/line-awesome/css/line-awesome.min.css') }}">
</head>

<!-- Nội dung trang đăng nhập -->
<div class="wrapper">
    <section class="sign-in-page">
       
        <div class="container p-0">
            <div class="row no-gutters d-flex justify-content-center align-items-center min-vh-100">
                <div class="col-md-6 col-sm-12 bg-white pt-5 pb-5">
                    <div class="sign-in-from">
                        <h1 class="mb-0 text-center">Đăng nhập</h1>
                        <form class="mt-4" action="{{ route('login') }}" method="POST">
                            @csrf
                        
                            <!-- Email -->
                            <div class="form-group">
                                <label class="form-label" for="email">Email address</label>
                                <input type="email" class="form-control mb-0 @error('email') is-invalid @enderror" id="email" name="email"
                                    placeholder="Enter email" value="{{ old('email') }}" required>
                                @error('email')
                                    <div class="invalid-feedback d-block">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        
                            <!-- Password -->
                            <div class="form-group">
                                <label class="form-label" for="password">Password</label>
                                <input type="password" class="form-control mb-0 @error('password') is-invalid @enderror" id="password"
                                    name="password" placeholder="Password" required>
                                @error('password')
                                    <div class="invalid-feedback d-block">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        
                            <!-- Remember Me + Submit -->
                            <div class="d-inline-block w-100">
                                <div class="form-check d-inline-block mt-2 pt-1">
                                    <input type="checkbox" class="form-check-input" id="remember" name="remember">
                                    <label class="form-check-label" for="remember">Remember Me</label>
                                </div>
                                <button type="submit" class="btn btn-primary float-end">Đăng nhập</button>
                            </div>
                        
                            <!-- Thông báo lỗi đăng nhập chung -->
                            @if(session('error'))
                                <div class="alert alert-danger mt-3" role="alert">
                                    {{ session('error') }}
                                </div>
                            @endif
                        
                            <!-- Footer info -->
                            <div class="sign-info mt-3">
                                <span class="dark-color d-inline-block line-height-2">Bạn không có tài khoản? 
                                    <a href="{{ route('register') }}">Đăng ký</a>
                                </span>
                                <ul class="iq-social-media">
                                    <li><a href="#"><i class="ri-facebook-box-line"></i></a></li>
                                    <li><a href="#"><i class="ri-twitter-line"></i></a></li>
                                    <li><a href="#"><i class="ri-instagram-line"></i></a></li>
                                </ul>
                            </div>
                        </form>
                        
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>


<!-- Backend Bundle JavaScript -->
<script src="{{ asset('template_assets/js/libs.min.js') }}"></script>
<!-- Slider JavaScript -->
<script src="{{ asset('template_assets/js/slider.js') }}"></script>
<!-- Masonry JavaScript -->
<script src="{{ asset('template_assets/js/masonry.pkgd.min.js') }}"></script>
<!-- SweetAlert JavaScript -->
<script src="{{ asset('template_assets/js/enchanter.js') }}"></script>
<!-- SweetAlert JavaScript -->
<script src="{{ asset('template_assets/js/sweetalert.js') }}"></script>
<!-- App JavaScript -->
<script src="{{ asset('template_assets/js/charts/weather-chart.js') }}"></script>
<script src="{{ asset('template_assets/js/app.js') }}"></script>
<script src="{{ asset('template_assets/vendor/vanillajs-datepicker/dist/js/datepicker.min.js') }}"></script>
<script src="{{ asset('template_assets/js/lottie.js') }}"></script>
