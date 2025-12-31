{{-- Navbar với Gradient --}}
<nav class="navbar navbar-expand-lg fixed-top" style="background: linear-gradient(135deg, rgba(255,255,255,0.95) 0%, rgba(240,244,255,0.95) 100%); backdrop-filter: blur(20px); border-bottom: 1px solid rgba(99, 102, 241, 0.1); box-shadow: 0 4px 20px rgba(99, 102, 241, 0.08);">
    <div class="container">
        {{-- Logo với Gradient --}}
        <a class="navbar-brand d-flex align-items-center" href="{{ route('home') }}" style="font-weight: 800; font-size: 1.5rem;">
            <div style="width: 40px; height: 40px; background: var(--gradient-primary); border-radius: 12px; display: flex; align-items: center; justify-content: center; margin-right: 10px; box-shadow: 0 4px 15px rgba(99, 102, 241, 0.3);">
                <i class="ri-bubble-chart-fill" style="color: white; font-size: 1.3rem;"></i>
            </div>
            <span class="text-gradient">Social</span>
        </a>

        {{-- Toggle Button Mobile --}}
        <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMain">
            <i class="ri-menu-3-line" style="font-size: 1.5rem; color: var(--primary);"></i>
        </button>

        {{-- Navbar Content --}}
        <div class="collapse navbar-collapse" id="navbarMain">
            <ul class="navbar-nav ms-auto align-items-center gap-2">
                @if (Auth::check())
                    {{-- Home Link --}}
                    <li class="nav-item">
                        <a href="{{ route('home') }}" class="nav-link px-3 py-2 rounded-pill {{ request()->routeIs('home') ? 'active-nav' : '' }}" style="font-weight: 600; transition: all 0.3s;">
                            <i class="ri-home-4-line me-1"></i> Trang chủ
                        </a>
                    </li>
                    
                    {{-- Profile Link --}}
                    <li class="nav-item">
                        <a href="{{ route('profile') }}" class="nav-link px-3 py-2 rounded-pill {{ request()->routeIs('profile') ? 'active-nav' : '' }}" style="font-weight: 600; transition: all 0.3s;">
                            <i class="ri-user-line me-1"></i> Hồ sơ
                        </a>
                    </li>

                    {{-- User Dropdown --}}
                    <li class="nav-item dropdown ms-2">
                        <a href="#" class="nav-link dropdown-toggle d-flex align-items-center p-0" data-bs-toggle="dropdown" style="gap: 8px;">
                            <div style="position: relative;">
                                @if(Auth::user()->avatar)
                                    <img src="{{ asset('storage/' . Auth::user()->avatar) }}" 
                                        class="rounded-circle" 
                                        style="width: 42px; height: 42px; object-fit: cover; border: 3px solid transparent; background: linear-gradient(white, white) padding-box, var(--gradient-primary) border-box;" 
                                        alt="Avatar">
                                @else
                                    <img src="{{ asset('template_assets/images/user/01.jpg') }}" 
                                        class="rounded-circle" 
                                        style="width: 42px; height: 42px; object-fit: cover; border: 3px solid transparent; background: linear-gradient(white, white) padding-box, var(--gradient-primary) border-box;" 
                                        alt="Avatar">
                                @endif
                                <span style="position: absolute; bottom: 2px; right: 2px; width: 10px; height: 10px; background: var(--success); border-radius: 50%; border: 2px solid white;"></span>
                            </div>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end shadow-lg border-0 mt-2" style="min-width: 240px; border-radius: 18px; overflow: hidden; padding: 0;">
                            <li style="background: linear-gradient(135deg, #6366F1 0%, #EC4899 100%); padding: 1rem; margin: 0;">
                                <div style="color: white; font-weight: 700;">{{ Auth::user()->name }}</div>
                                <small style="color: rgba(255,255,255,0.8);">{{ Auth::user()->email }}</small>
                            </li>
                            <li>
                                <a class="dropdown-item py-2 px-3" href="{{ route('profile') }}" style="font-weight: 500;">
                                    <i class="ri-user-settings-line me-2" style="color: #6366F1;"></i> Trang cá nhân
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item py-2 px-3" href="#" style="font-weight: 500;">
                                    <i class="ri-settings-3-line me-2" style="color: #14B8A6;"></i> Cài đặt
                                </a>
                            </li>
                            <li><hr class="dropdown-divider my-1"></li>
                            <li>
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="dropdown-item py-2 px-3" style="font-weight: 500; color: #EF4444;">
                                        <i class="ri-logout-box-line me-2"></i> Đăng xuất
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </li>
                @else
                    {{-- Login Button --}}
                    <li class="nav-item">
                        <a href="{{ route('login') }}" class="btn btn-primary px-4 py-2" style="font-weight: 600;">
                            <i class="ri-login-box-line me-1"></i> Đăng nhập
                        </a>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</nav>

{{-- Spacer --}}
<div style="height: 75px;"></div>

<style>
    .nav-link { color: var(--text-secondary); }
    .nav-link:hover { color: var(--primary); }
    .active-nav { 
        background: linear-gradient(135deg, rgba(99, 102, 241, 0.15) 0%, rgba(236, 72, 153, 0.1) 100%); 
        color: var(--primary) !important; 
    }
    .dropdown-item:hover { background: rgba(99, 102, 241, 0.08); }
</style>
