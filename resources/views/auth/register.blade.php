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

<!-- Nội dung trang đăng ký -->
<div class="wrapper">
    <section class="sign-in-page">
    
        <div class="container p-0">
            <div class="row no-gutters d-flex justify-content-center align-items-center min-vh-100">
                <div class="col-md-6 col-sm-12 bg-white pt-5 pb-5">
                    <div class="sign-in-from">
                        <h1 class="mb-0 text-center">Đăng ký</h1>
                        <p class="text-center">Nhập thông tin của bạn để tạo tài khoản.</p>
                    
                        <!-- Container lỗi với max-height + scroll -->
                        @if ($errors->any())
                            <div class="alert alert-danger" style="max-height:150px; overflow-y:auto;">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                    
                        <form action="{{ route('register') }}" method="POST" style="display:flex; flex-direction:column; height:100%;">
                            @csrf
                    
                            <div class="form-group">
                                <label>Họ và tên *</label>
                                <input name="name" type="text" class="form-control" value="{{ old('name') }}" required />
                            </div>
                    
                            <div class="form-group">
                                <label>Địa chỉ Email *</label>
                                <input name="email" type="email" class="form-control" value="{{ old('email') }}" required />
                            </div>
                    
                            <div class="form-group">
                                <label for="gender">Giới tính</label>
                                <select name="gender" id="gender" class="form-control">
                                    <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>Nam</option>
                                    <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>Nữ</option>
                                    <option value="other" {{ old('gender') == 'other' ? 'selected' : '' }}>Khác</option>
                                </select>
                            </div>
                    
                            <div class="form-group">
                                <label>Mật khẩu *</label>
                                <input name="password" type="password" class="form-control" required />
                            </div>
                    
                            <div class="form-group">
                                <label>Nhập lại mật khẩu *</label>
                                <input name="password_confirmation" type="password" class="form-control" required />
                            </div>
                    
                            <!-- Spacer để đẩy nút xuống cuối -->
                            <div style="flex-grow:1;"></div>
                    
                            <div class="form-submit-group">
                                <button type="submit" class="btn btn-primary btn-gradient hover-icon-reverse w-100">Đăng ký</button>
                            </div>
                    
                            <div class="text-center mt-3">
                                <a class="rbt-btn-link" href="{{ route('login') }}">Bạn đã có tài khoản? Đăng nhập</a>
                            </div>
                        </form>
                    </div>
                    
                </div>
            </div>
        </div>
    </section>
</div>

<script src="{{ asset('template_assets/js/libs.min.js') }}"></script>
<script src="{{ asset('template_assets/js/slider.js') }}"></script>
<script src="{{ asset('template_assets/js/masonry.pkgd.min.js') }}"></script>
<script src="{{ asset('template_assets/js/enchanter.js') }}"></script>
<script src="{{ asset('template_assets/js/sweetalert.js') }}"></script>
<script src="{{ asset('template_assets/js/charts/weather-chart.js') }}"></script>
<script src="{{ asset('template_assets/js/app.js') }}"></script>
<script src="{{ asset('template_assets/vendor/vanillajs-datepicker/dist/js/datepicker.min.js') }}"></script>
<script src="{{ asset('template_assets/js/lottie.js') }}"></script>
