{{-- Navbar --}}
<nav class="navbar navbar-expand-lg fixed-top" style="background: rgba(255,255,255,0.95); backdrop-filter: blur(10px); border-bottom: 1px solid var(--border-color);">
    <div class="container">
        {{-- Logo --}}
        <a class="navbar-brand d-flex align-items-center" href="{{ route('home') }}" style="font-weight: 700; font-size: 1.5rem; color: var(--primary);">
            <i class="ri-bubble-chart-fill me-2"></i>
            Social
        </a>

        {{-- Toggle Button Mobile --}}
        <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMain">
            <i class="ri-menu-3-line" style="font-size: 1.5rem;"></i>
        </button>

        {{-- Navbar Content --}}
        <div class="collapse navbar-collapse" id="navbarMain">
            <ul class="navbar-nav ms-auto align-items-center gap-1">
                @if (Auth::check())
                    {{-- Home Link --}}
                    <li class="nav-item">
                        <a href="{{ route('home') }}" class="nav-link px-3 py-2 rounded-pill {{ request()->routeIs('home') ? 'bg-primary bg-opacity-10 text-primary' : '' }}" style="font-weight: 500;">
                            <i class="ri-home-line me-1"></i> Trang chủ
                        </a>
                    </li>
                    
                    {{-- Profile Link --}}
                    <li class="nav-item">
                        <a href="{{ route('profile') }}" class="nav-link px-3 py-2 rounded-pill {{ request()->routeIs('profile') ? 'bg-primary bg-opacity-10 text-primary' : '' }}" style="font-weight: 500;">
                            <i class="ri-user-line me-1"></i> Trang cá nhân
                        </a>
                    </li>

                    {{-- User Dropdown --}}
                    <li class="nav-item dropdown ms-2">
                        <a href="#" class="nav-link dropdown-toggle d-flex align-items-center p-0" data-bs-toggle="dropdown">
                            @if(Auth::user()->avatar)
                                <img src="{{ asset('storage/' . Auth::user()->avatar) }}" 
                                    class="rounded-circle" 
                                    style="width: 40px; height: 40px; object-fit: cover; border: 2px solid var(--border-color);" 
                                    alt="Avatar">
                            @else
                                <img src="{{ asset('template_assets/images/user/01.jpg') }}" 
                                    class="rounded-circle" 
                                    style="width: 40px; height: 40px; object-fit: cover; border: 2px solid var(--border-color);" 
                                    alt="Avatar">
                            @endif
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end shadow-lg border-0 mt-2" style="min-width: 220px; border-radius: var(--radius-md);">
                            <li class="px-3 py-2 border-bottom">
                                <div style="font-weight: 600; color: var(--text-primary);">{{ Auth::user()->name }}</div>
                                <small class="text-muted">{{ Auth::user()->email }}</small>
                            </li>
                            <li>
                                <a class="dropdown-item py-2" href="{{ route('profile') }}">
                                    <i class="ri-user-settings-line me-2"></i> Trang cá nhân
                                </a>
                            </li>
                            <li><hr class="dropdown-divider my-1"></li>
                            <li>
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="dropdown-item py-2 text-danger">
                                        <i class="ri-logout-box-line me-2"></i> Đăng xuất
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </li>
                @else
                    {{-- Login Button --}}
                    <li class="nav-item">
                        <a href="{{ route('login') }}" class="btn btn-primary px-4">
                            <i class="ri-login-box-line me-1"></i> Đăng nhập
                        </a>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</nav>

{{-- Spacer for fixed navbar --}}
<div style="height: 70px;"></div>
