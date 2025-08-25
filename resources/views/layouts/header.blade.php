{{-- 
    <div class="iq-sidebar sidebar-default">
        <div id="sidebar-scrollbar">
            <nav class="iq-sidebar-menu">
                <ul id="iq-sidebar-toggle" class="iq-menu">
                    <li class="{{ request()->routeIs('home') ? 'active' : '' }}">
                        <a href="{{ route('home') }}" class=" ">
                            <i class="las la-newspaper"></i><span>Newsfeed</span>
                        </a>
                    </li>
                    @if (Auth::check())
                        <li class="{{ request()->routeIs('profile') ? 'active' : '' }}">
                            <a href="{{ route('profile') }}" class=" ">
                                <i class="las la-user"></i><span>Profile</span>
                            </a>
                        </li>
                    
                    @endif
                </ul>
                

            </nav>
            <div class="p-5"></div>
        </div>
    </div> --}}

<div class="iq-top-navbar">
    <div class="iq-navbar-custom">
        <nav class="navbar navbar-expand-lg navbar-light p-0">
            <div class="iq-navbar-logo d-flex justify-content-between">
                <a href="{{ route('home') }}">
                    <span>Social</span>
                </a>
            </div>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-label="Toggle navigation">
                <i class="ri-menu-3-line"></i>
            </button>
            <div class="collapse navbar-collapse " id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto navbar-list">
                    @if (Auth::check())
                        <li>
                            <a href="{{ route('home') }}" class="d-flex align-items-center" style="font-weight: 500">
                                <i class="ri-home-line"></i><span>Home</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('profile') }}" class="d-flex align-items-center" style="font-weight: 500">
                                <i class="las la-user"></i><span>Profile</span>
                            </a>
                        </li>
                    @endif

                    @if (Auth::check())
                        <li class="nav-item dropdown">
                            <a href="#" class="d-flex align-items-center dropdown-toggle" id="drop-down-arrow"
                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <img src="https://avatars.fastly.steamstatic.com/79d0a512c5512bf571c21ed9af845382cc595543_full.jpg"
                                    class="img-fluid rounded-circle me-3" alt="user" />
                                <div class="caption">
                                    <h6 class="mb-0 line-height"></h6>
                                </div>
                            </a>
                            <div class="sub-drop dropdown-menu caption-menu" aria-labelledby="drop-down-arrow">
                                <div class="card shadow-none m-0">
                                    <div class="card-header bg-primary">
                                        <div class="header-title">
                                            <h5 class="mb-0 text-white">Chào {{ Auth::user()->name }}</h5>
                                        </div>
                                    </div>
                                    <div class="card-body p-0">
                                        <a href="{{ route('profile') }}" class="iq-sub-card iq-bg-primary-hover">
                                            <div class="d-flex align-items-center">
                                                <div class="rounded card-icon bg-soft-primary">
                                                    <i class="ri-file-user-line"></i>
                                                </div>
                                                <div class="ms-3">
                                                    <h6 class="mb-0">Trang cá nhân</h6>
                                                    <p class="mb-0 font-size-12">
                                                        Vào trang cá nhân của bạn.
                                                    </p>
                                                </div>
                                            </div>
                                        </a>


                                        <div class="d-inline-block w-100 text-center p-3">
                                            <form action="{{ route(name: 'logout') }}" method="POST">
                                                @csrf
                                                <button type="submit" class="btn btn-primary iq-sign-btn"
                                                    role="button">Đăng xuất<i
                                                        class="ri-login-box-line ms-2"></i></button>
                                            </form>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                    @else
                        <a class="nav-item dropdown" href="{{ route('login') }}">
                            <button type="button" class="btn btn-primary mb-1">Đăng nhập</button>
                        </a>
                    @endif
                </ul>
            </div>
        </nav>
    </div>
</div>
