<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', subject: app()->getLocale()) }}">
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1, shrink-to-fit=no"
    />
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>SocialV | Responsive Bootstrap 5 Admin Dashboard Template</title>

    <link rel="shortcut icon" href="{{ asset('template_assets/images/favicon.ico') }}" />
    <link rel="stylesheet" href="{{ asset('template_assets/css/libs.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('template_assets/css/socialv.css?v=4.0.0') }}" />
    <link
      rel="stylesheet"
      href="{{ asset('template_assets/vendor/@fortawesome/fontawesome-free/css/all.min.css') }}"
    />
    <link
      rel="stylesheet"
      href="{{ asset('template_assets/vendor/remixicon/fonts/remixicon.css') }}"
    />
    <link
      rel="stylesheet"
      href="{{ asset('template_assets/vendor/vanillajs-datepicker/dist/css/datepicker.min.css') }}"
    />
    <link
      rel="stylesheet"
      href="{{ asset('template_assets/vendor/font-awesome-line-awesome/css/all.min.css') }}"
    />
    <link
      rel="stylesheet"
      href="{{ asset('template_assets/vendor/line-awesome/dist/line-awesome/css/line-awesome.min.css') }}"
    />
  </head>
  <body class="  ">
    <!-- loader Start -->
    <div id="loading">
      <div id="loading-center"></div>
    </div>
    <!-- loader END -->
    <!-- Wrapper Start -->
    <div class="wrapper">
 
      @include('layouts.header')
      <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
      @yield('content')
      

     
    </div>
    <!-- Wrapper End-->
    @include('layouts.footer')

    <!-- Backend Bundle JavaScript -->
    <script src="{{ asset('template_assets/js/libs.min.js') }}"></script>
    <!-- slider JavaScript -->
    <script src="{{ asset('template_assets/js/slider.js') }}"></script>
    <!-- masonry JavaScript -->
    <script src="{{ asset('template_assets/js/masonry.pkgd.min.js') }}"></script>
    <!-- SweetAlert JavaScript -->
    <script src="{{ asset('template_assets/js/enchanter.js') }}"></script>
    <!-- SweetAlert JavaScript -->
    <script src="{{ asset('template_assets/js/sweetalert.js') }}"></script>
    <!-- app JavaScript -->
    <script src="{{ asset('template_assets/js/charts/weather-chart.js') }}"></script>
    <script src="{{ asset('template_assets/js/app.js') }}"></script>
    <script src="{{ asset('template_assets/vendor/vanillajs-datepicker/dist/js/datepicker.min.js') }}"></script>
    <script src="{{ asset('template_assets/js/lottie.js') }}"></script>

    <!-- offcanvas start -->

    <div
      class="offcanvas offcanvas-bottom share-offcanvas"
      tabindex="-1"
      id="share-btn"
      aria-labelledby="shareBottomLabel"
    >
      <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="shareBottomLabel">Share</h5>
        <button
          type="button"
          class="btn-close text-reset"
          data-bs-dismiss="offcanvas"
          aria-label="Close"
        ></button>
      </div>
      <div class="offcanvas-body small">
        <div class="d-flex flex-wrap align-items-center">
          <div class="text-center me-3 mb-3">
            <img
              src="{{asset('/template_assets/images/icon/08.png')}}"
              class="img-fluid rounded mb-2"
              alt=""
            />
            <h6>Facebook</h6>
          </div>
          <div class="text-center me-3 mb-3">
            <img
              src="{{asset('/template_assets/images/icon/09.png')}}"
              class="img-fluid rounded mb-2"
              alt=""
            />
            <h6>Twitter</h6>
          </div>
          <div class="text-center me-3 mb-3">
            <img
              src="{{asset('/template_assets/images/icon/10.png')}}"
              class="img-fluid rounded mb-2"
              alt=""
            />
            <h6>Instagram</h6>
          </div>
          <div class="text-center me-3 mb-3">
            <img
              src="{{asset('/template_assets/images/icon/11.png')}}"
              class="img-fluid rounded mb-2"
              alt=""
            />
            <h6>Google Plus</h6>
          </div>
          <div class="text-center me-3 mb-3">
            <img
              src="{{asset('/template_assets/images/icon/13.png')}}"
              class="img-fluid rounded mb-2"
              alt=""
            />
            <h6>In</h6>
          </div>
          <div class="text-center me-3 mb-3">
            <img
              src="{{asset('/template_assets/images/icon/12.png')}}"
              class="img-fluid rounded mb-2"
              alt=""
            />
            <h6>YouTube</h6>
          </div>
        </div>
      </div>
    </div>
  </body>
  
</html>
