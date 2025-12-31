@extends('layouts.app')

@section('content')
<style>
    /* Main Layout */
    .home-layout {
        display: grid;
        grid-template-columns: 260px 1fr 260px;
        gap: 1.5rem;
        max-width: 1200px;
        margin: 0 auto;
        padding: 1.5rem 1rem;
    }
    
    .left-sidebar, .right-sidebar {
        position: sticky;
        top: 90px;
        height: fit-content;
    }
    
    /* Sidebar Card - Optimized */
    .sidebar-card {
        background: #fff;
        border-radius: 16px;
        padding: 1.25rem;
        margin-bottom: 1rem;
        box-shadow: 0 2px 8px rgba(0,0,0,0.06);
        border: 1px solid #E2E8F0;
    }
    
    .sidebar-card h6 {
        font-weight: 700;
        margin-bottom: 1rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
        color: #1E293B;
    }
    
    .sidebar-card h6 i { 
        color: #6366F1;
        font-size: 1.1rem;
    }
    
    /* User Card */
    .user-card { 
        text-align: center;
        background: linear-gradient(180deg, #EEF2FF 0%, #fff 50%);
    }
    
    .user-card .user-avatar {
        width: 70px;
        height: 70px;
        border-radius: 50%;
        object-fit: cover;
        margin-bottom: 0.75rem;
        border: 3px solid #6366F1;
    }
    
    .user-card .user-name {
        font-weight: 700;
        font-size: 1rem;
        margin-bottom: 0.25rem;
        color: #6366F1;
    }
    
    .user-card .user-email {
        color: var(--text-muted);
        font-size: 0.8rem;
    }
    
    /* Menu Links */
    .menu-links {
        list-style: none;
        padding: 0;
        margin: 0;
    }
    
    .menu-links li a {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        padding: 0.65rem 0.75rem;
        border-radius: var(--radius-sm);
        color: var(--text-secondary);
        text-decoration: none;
        font-weight: 500;
        font-size: 0.9rem;
        transition: all 0.2s;
    }
    
    .menu-links li a:hover, .menu-links li a.active {
        background: var(--bg-main);
        color: var(--primary);
    }
    
    .menu-links li a i { font-size: 1.2rem; }
    
    /* Trending */
    .trending-item {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        padding: 0.5rem 0;
    }
    
    .trending-item .trend-rank {
        width: 24px;
        height: 24px;
        border-radius: 50%;
        background: var(--gradient-primary);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 0.7rem;
        font-weight: 700;
        color: white;
    }
    
    .trending-item .trend-topic {
        font-weight: 700;
        font-size: 0.85rem;
        color: #1E293B;
    }
    
    .trending-item .trend-posts {
        font-size: 0.7rem;
        color: #94A3B8;
    }
    
    /* Stories - Optimized */
    .stories-section {
        background: #fff;
        border-radius: 16px;
        padding: 1rem;
        margin-bottom: 1rem;
        box-shadow: 0 2px 8px rgba(0,0,0,0.06);
        border: 1px solid #E2E8F0;
    }
    
    .stories-container {
        display: flex;
        gap: 0.75rem;
        overflow-x: auto;
        padding-bottom: 0.25rem;
    }
    
    .story-item {
        flex-shrink: 0;
        text-align: center;
        cursor: pointer;
    }
    
    .story-item .story-avatar {
        width: 58px;
        height: 58px;
        border-radius: 50%;
        object-fit: cover;
        border: 3px solid #6366F1;
        padding: 2px;
        background: white;
    }
    
    .story-item .story-name {
        font-size: 0.7rem;
        font-weight: 600;
        color: #64748B;
        margin-top: 0.35rem;
        max-width: 58px;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }
    
    /* Create Post - Optimized */
    .create-post-card {
        background: #fff;
        border-radius: 16px;
        padding: 1.25rem;
        margin-bottom: 1rem;
        box-shadow: 0 2px 8px rgba(0,0,0,0.06);
        border: 1px solid #E2E8F0;
    }
    
    .create-post-card:focus-within {
        border-color: #6366F1;
    }
    
    .create-post-card .avatar {
        width: 44px;
        height: 44px;
        border-radius: 50%;
        object-fit: cover;
        border: 2px solid transparent;
        background: linear-gradient(white, white) padding-box, var(--gradient-primary) border-box;
    }
    
    .create-post-card textarea {
        border: none;
        resize: none;
        font-size: 0.95rem;
        background: transparent;
    }
    .create-post-card textarea:focus { box-shadow: none; outline: none; }
    
    .upload-actions {
        display: flex;
        gap: 0.5rem;
        flex-wrap: wrap;
    }
    
    .upload-btn {
        flex: 1;
        min-width: 90px;
        background: #F8FAFC;
        border: 1px dashed #CBD5E1;
        border-radius: 10px;
        padding: 0.6rem;
        cursor: pointer;
        text-align: center;
        font-size: 0.85rem;
        font-weight: 500;
    }
    .upload-btn:hover {
        border-color: #6366F1;
        background: #EEF2FF;
    }
    
    /* Post Card - Optimized */
    .post-card {
        background: #fff;
        border-radius: 16px;
        margin-bottom: 1rem;
        box-shadow: 0 2px 8px rgba(0,0,0,0.06);
        border: 1px solid #E2E8F0;
        overflow: hidden;
    }
    
    .post-header {
        padding: 0.875rem 1rem;
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }
    
    .post-header .avatar {
        width: 42px;
        height: 42px;
        border-radius: 50%;
        object-fit: cover;
        border: 2px solid #6366F1;
    }
    
    .post-header .user-info h6 {
        margin: 0;
        font-weight: 700;
        font-size: 0.95rem;
    }
    
    .post-header .user-info small {
        color: var(--text-muted);
        font-size: 0.75rem;
    }
    
    .post-content {
        padding: 0 1rem 0.875rem;
    }
    
    .post-content p {
        margin: 0;
        line-height: 1.5;
        font-size: 0.95rem;
    }
    
    .post-media img, .post-media video {
        width: 100%;
        max-height: 450px;
        object-fit: cover;
    }
    
    .post-media video { background: #000; }
    
    .carousel-control-prev, .carousel-control-next {
        width: 36px;
        height: 36px;
        background: rgba(0,0,0,0.5);
        border-radius: 50%;
        top: 50%;
        transform: translateY(-50%);
        opacity: 0;
        transition: opacity 0.2s;
    }
    .post-media:hover .carousel-control-prev,
    .post-media:hover .carousel-control-next { opacity: 1; }
    .carousel-control-prev { left: 10px; }
    .carousel-control-next { right: 10px; }
    
    .post-actions {
        padding: 0.5rem 1rem;
        border-top: 1px solid var(--border-color);
        display: flex;
        gap: 0.5rem;
    }
    
    .post-actions .action-btn {
        flex: 1;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.4rem;
        padding: 0.5rem;
        border: none;
        background: transparent;
        border-radius: var(--radius-sm);
        color: var(--text-secondary);
        font-weight: 500;
        font-size: 0.85rem;
        cursor: pointer;
        transition: all 0.2s;
    }
    
    .post-actions .action-btn:hover { background: var(--bg-main); }
    .post-actions .action-btn.liked { color: #EF4444; }
    .post-actions .action-btn i { font-size: 1.1rem; }
    
    /* Suggestions */
    .suggestion-item {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        padding: 0.5rem 0;
    }
    
    .suggestion-item .avatar {
        width: 36px;
        height: 36px;
        border-radius: 50%;
        object-fit: cover;
    }
    
    .suggestion-item .name {
        font-weight: 600;
        font-size: 0.85rem;
    }
    
    .suggestion-item .mutual {
        font-size: 0.7rem;
        color: var(--text-muted);
    }
    
    /* Empty & Pagination */
    .empty-state {
        text-align: center;
        padding: 2.5rem 1rem;
        color: var(--text-muted);
    }
    .empty-state i { font-size: 3rem; margin-bottom: 0.75rem; opacity: 0.5; }
    
    .pagination { justify-content: center; gap: 0.25rem; }
    .pagination .page-link {
        border: none;
        border-radius: var(--radius-sm);
        padding: 0.5rem 0.85rem;
        color: var(--text-secondary);
        font-weight: 500;
        font-size: 0.9rem;
    }
    .pagination .page-item.active .page-link { background: var(--primary); }
    
    /* Responsive */
    @media (max-width: 1100px) {
        .home-layout { grid-template-columns: 220px 1fr; }
        .right-sidebar { display: none; }
    }
    
    @media (max-width: 768px) {
        .home-layout { 
            grid-template-columns: 1fr; 
            max-width: 100%; 
            padding: 0.75rem;
            gap: 0.75rem;
        }
        .left-sidebar { display: none; }
        
        .stories-section {
            border-radius: 0;
            margin: 0 -0.75rem 0.75rem;
            padding: 0.75rem;
        }
        
        .create-post-card {
            border-radius: 12px;
            padding: 1rem;
        }
        
        .create-post-card .avatar {
            width: 38px;
            height: 38px;
        }
        
        .upload-actions {
            flex-wrap: nowrap;
            overflow-x: auto;
        }
        
        .upload-btn {
            min-width: 70px;
            padding: 0.5rem;
            font-size: 0.75rem;
        }
        
        .post-card {
            border-radius: 12px;
        }
        
        .post-header {
            padding: 0.75rem;
        }
        
        .post-header .avatar {
            width: 38px;
            height: 38px;
        }
        
        .post-header .user-info h6 {
            font-size: 0.9rem;
        }
        
        .post-content {
            padding: 0 0.75rem 0.75rem;
        }
        
        .post-content p {
            font-size: 0.9rem;
        }
        
        .post-actions {
            padding: 0.5rem 0.75rem;
        }
        
        .post-actions .action-btn {
            font-size: 0.8rem;
            padding: 0.4rem;
        }
        
        .post-actions .action-btn i {
            font-size: 1rem;
        }
    }
    
    @media (max-width: 480px) {
        .home-layout {
            padding: 0.5rem;
        }
        
        .stories-section {
            margin: 0 -0.5rem 0.5rem;
        }
        
        .story-item .story-avatar {
            width: 50px;
            height: 50px;
        }
        
        .story-item .story-name {
            max-width: 50px;
            font-size: 0.65rem;
        }
        
        .create-post-card textarea {
            font-size: 0.9rem;
        }
        
        .upload-btn {
            min-width: 60px;
            font-size: 0.7rem;
        }
        
        .form-select {
            font-size: 0.8rem;
            padding: 0.4rem 0.6rem;
        }
        
        .btn-primary.btn-sm {
            font-size: 0.85rem;
            padding: 0.5rem 1rem;
        }
    }
</style>

<div class="home-layout">
    {{-- Left Sidebar --}}
    <aside class="left-sidebar">
        @if(Auth::check())
            {{-- User Profile Card --}}
            <div class="sidebar-card user-card">
                @if(Auth::user()->avatar)
                    <img src="{{ asset('storage/' . Auth::user()->avatar) }}" class="user-avatar" alt="">
                @else
                    <img src="{{ asset('template_assets/images/user/01.jpg') }}" class="user-avatar" alt="">
                @endif
                <div class="user-name">{{ Auth::user()->name }}</div>
                <div class="user-email">{{ Auth::user()->email }}</div>
            </div>
            
            {{-- Navigation Menu --}}
            <div class="sidebar-card">
                <ul class="menu-links">
                    <li><a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'active' : '' }}"><i class="ri-home-4-line"></i> Bảng tin</a></li>
                    <li><a href="{{ route('profile') }}" class="{{ request()->routeIs('profile') ? 'active' : '' }}"><i class="ri-user-line"></i> Trang cá nhân</a></li>
                    <li><a href="#"><i class="ri-bookmark-line"></i> Đã lưu</a></li>
                    <li><a href="#"><i class="ri-settings-3-line"></i> Cài đặt</a></li>
                </ul>
            </div>
        @else
            <div class="sidebar-card">
                <h6><i class="ri-information-line"></i> Chào mừng!</h6>
                <p style="font-size: 0.85rem; color: var(--text-secondary); margin-bottom: 1rem;">Đăng nhập để trải nghiệm đầy đủ tính năng.</p>
                <a href="{{ route('login') }}" class="btn btn-primary w-100">Đăng nhập</a>
            </div>
        @endif
    </aside>
    
    {{-- Main Feed --}}
    <main class="feed-main">
        {{-- Alerts --}}
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show py-2" role="alert">
                <i class="ri-check-line me-1"></i>{{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show py-2" role="alert">
                <i class="ri-error-warning-line me-1"></i>{{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif
        
        {{-- Stories Section --}}
        <div class="stories-section">
            <div class="stories-container">
                <div class="story-item">
                    <img src="{{ asset('template_assets/images/user/01.jpg') }}" class="story-avatar" alt="">
                    <div class="story-name">Bạn</div>
                </div>
                <div class="story-item">
                    <img src="{{ asset('template_assets/images/user/02.jpg') }}" class="story-avatar" alt="">
                    <div class="story-name">Minh Anh</div>
                </div>
                <div class="story-item">
                    <img src="{{ asset('template_assets/images/user/03.jpg') }}" class="story-avatar" alt="">
                    <div class="story-name">Hoàng Nam</div>
                </div>
                <div class="story-item">
                    <img src="{{ asset('template_assets/images/user/04.jpg') }}" class="story-avatar" alt="">
                    <div class="story-name">Thu Hà</div>
                </div>
                <div class="story-item">
                    <img src="{{ asset('template_assets/images/user/05.jpg') }}" class="story-avatar" alt="">
                    <div class="story-name">Văn Đức</div>
                </div>
                <div class="story-item">
                    <img src="{{ asset('template_assets/images/user/01.jpg') }}" class="story-avatar" alt="">
                    <div class="story-name">Lan Phương</div>
                </div>
            </div>
        </div>
        
        {{-- Create Post --}}
        @if(Auth::check() && Auth::user()->level == 1)
            <div class="create-post-card">
                <form action="{{ route('post.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="useridpost" value="{{ Auth::id() }}">
                    
                    <div class="d-flex gap-3 mb-3">
                        @if(Auth::user()->avatar)
                            <img src="{{ asset('storage/' . Auth::user()->avatar) }}" class="avatar" alt="">
                        @else
                            <img src="{{ asset('template_assets/images/user/01.jpg') }}" class="avatar" alt="">
                        @endif
                        <textarea name="title" class="form-control" rows="2" placeholder="Bạn đang nghĩ gì?" required></textarea>
                    </div>
                    
                    <div class="upload-actions mb-3">
                        <label class="upload-btn">
                            <i class="ri-image-line" style="color: var(--success);"></i> Ảnh
                            <input type="file" name="list_img[]" multiple accept="image/*" class="d-none">
                        </label>
                        <label class="upload-btn">
                            <i class="ri-video-line" style="color: var(--danger);"></i> Video
                            <input type="file" name="list_video[]" multiple accept="video/*" class="d-none">
                        </label>
                        <select name="category" class="form-select form-select-sm" style="flex: 1.5;" required>
                            <option value="">Danh mục</option>
                            <option value="Giáo dục">Giáo dục</option>
                            <option value="Chính trị">Chính trị</option>
                            <option value="Y tế">Y tế</option>
                            <option value="Khác">Khác</option>
                        </select>
                        <select name="fakeorreal" class="form-select form-select-sm" style="flex: 1;" required>
                            <option value="">Loại</option>
                            <option value="real">Thật</option>
                            <option value="fake">Giả</option>
                        </select>
                    </div>
                    
                    <button type="submit" class="btn btn-primary w-100 btn-sm">
                        <i class="ri-send-plane-line me-1"></i> Đăng bài
                    </button>
                </form>
            </div>
        @endif
        
        {{-- Posts --}}
        @forelse($posts as $post)
            @if($post)
            <article class="post-card" data-feed-id="{{ $post->feed_id ?? '' }}" data-post-id="{{ $post->id }}">
                {{-- Category Badge on Top --}}
                @if($post->category)
                    @php
                        $categoryColors = [
                            'Giáo dục' => 'background: linear-gradient(135deg, #10B981, #14B8A6);',
                            'Chính trị' => 'background: linear-gradient(135deg, #6366F1, #8B5CF6);',
                            'Y tế' => 'background: linear-gradient(135deg, #EF4444, #EC4899);',
                            'Khác' => 'background: linear-gradient(135deg, #F59E0B, #F97316);',
                        ];
                        $bgStyle = $categoryColors[$post->category] ?? 'background: #64748B;';
                    @endphp
                    <div style="padding: 0.5rem 1rem; {{ $bgStyle }} color: white; font-size: 0.75rem; font-weight: 600; display: flex; align-items: center; gap: 0.35rem;">
                        <i class="ri-folder-line"></i> {{ $post->category }}
                    </div>
                @endif
                
                <div class="post-header">
                    @if($post->user && $post->user->avatar)
                        <img src="{{ asset('storage/' . $post->user->avatar) }}" class="avatar" alt="">
                    @else
                        <img src="{{ asset('template_assets/images/user/01.jpg') }}" class="avatar" alt="">
                    @endif
                    <div class="user-info flex-grow-1">
                        <h6>{{ $post->user->name ?? 'Unknown' }}</h6>
                        <small>{{ $post->created_at->diffForHumans() }}</small>
                    </div>
                    @if(Auth::check() && Auth::user()->level == 1)
                        <div class="dropdown">
                            <button class="btn btn-sm p-1" data-bs-toggle="dropdown"><i class="ri-more-2-fill"></i></button>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li>
                                    <form action="{{ route('post.deletePost', $post->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="dropdown-item text-danger" onclick="return confirm('Xóa bài viết?')">
                                            <i class="ri-delete-bin-line me-1"></i>Xóa
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    @endif
                </div>
                
                <div class="post-content">
                    <p>{{ $post->title }}</p>
                </div>
                
                @if(!empty($post->list_img))
                    @php $images = array_filter(explode(',', $post->list_img)); @endphp
                    @if(count($images) > 0)
                        <div class="post-media">
                            @if(count($images) === 1)
                                <img src="{{ asset('storage/' . trim($images[0])) }}" alt="" loading="lazy">
                            @else
                                <div id="carousel-{{ $post->id }}" class="carousel slide" data-bs-ride="false">
                                    <div class="carousel-inner">
                                        @foreach($images as $i => $img)
                                            <div class="carousel-item {{ $i === 0 ? 'active' : '' }}">
                                                <img src="{{ asset('storage/' . trim($img)) }}" alt="" loading="lazy">
                                            </div>
                                        @endforeach
                                    </div>
                                    <button class="carousel-control-prev" type="button" data-bs-target="#carousel-{{ $post->id }}" data-bs-slide="prev"><i class="ri-arrow-left-s-line"></i></button>
                                    <button class="carousel-control-next" type="button" data-bs-target="#carousel-{{ $post->id }}" data-bs-slide="next"><i class="ri-arrow-right-s-line"></i></button>
                                </div>
                            @endif
                        </div>
                    @endif
                @endif
                
                @if(!empty($post->list_video))
                    @php $videos = array_filter(explode(',', $post->list_video)); @endphp
                    @foreach($videos as $video)
                        <div class="post-media">
                            <video controls playsinline preload="metadata">
                                <source src="{{ asset('storage/' . trim($video)) }}" type="video/mp4">
                            </video>
                        </div>
                    @endforeach
                @endif
                
                @if(Auth::check())
                    <div class="post-actions">
                        <button class="action-btn like-btn {{ auth()->user()->hasLiked($post) ? 'liked' : '' }}" data-post-id="{{ $post->id }}">
                            <i class="{{ auth()->user()->hasLiked($post) ? 'ri-heart-fill' : 'ri-heart-line' }}"></i> Thích
                        </button>
                        <button class="action-btn" data-bs-toggle="modal" data-bs-target="#shareModal-{{ $post->id }}">
                            <i class="ri-share-forward-line"></i> Chia sẻ
                        </button>
                    </div>
                @endif
            </article>
            
            @if(Auth::check())
            <div class="modal fade" id="shareModal-{{ $post->id }}" tabindex="-1">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header border-0 pb-0">
                            <h6 class="modal-title fw-semibold">Chia sẻ bài viết</h6>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <form action="{{ route('share.store', $post->id) }}" method="POST">
                            @csrf
                            <div class="modal-body py-2">
                                <textarea name="caption" class="form-control" rows="3" placeholder="Viết gì đó..." required></textarea>
                            </div>
                            <div class="modal-footer border-0 pt-0">
                                <button type="button" class="btn btn-light btn-sm" data-bs-dismiss="modal">Hủy</button>
                                <button type="submit" class="btn btn-primary btn-sm"><i class="ri-share-forward-line me-1"></i>Chia sẻ</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            @endif
            @endif
        @empty
            <div class="empty-state">
                <i class="ri-newspaper-line"></i>
                <h6>Chưa có bài viết</h6>
                <p class="mb-0">Hãy quay lại sau nhé!</p>
            </div>
        @endforelse
        
        @if(method_exists($posts, 'links'))
            <div class="mt-3">{{ $posts->links('pagination::bootstrap-5') }}</div>
        @endif
    </main>
    
    {{-- Right Sidebar --}}
    <aside class="right-sidebar">
        {{-- Trending --}}
        <div class="sidebar-card">
            <h6><i class="ri-fire-line"></i> Xu hướng</h6>
            <div class="trending-item">
                <span class="trend-rank">1</span>
                <div>
                    <div class="trend-topic">#COVID19</div>
                    <div class="trend-posts">1.2K bài viết</div>
                </div>
            </div>
            <div class="trending-item">
                <span class="trend-rank">2</span>
                <div>
                    <div class="trend-topic">#GiáoDục</div>
                    <div class="trend-posts">856 bài viết</div>
                </div>
            </div>
            <div class="trending-item">
                <span class="trend-rank">3</span>
                <div>
                    <div class="trend-topic">#TinGiả</div>
                    <div class="trend-posts">543 bài viết</div>
                </div>
            </div>
            <div class="trending-item">
                <span class="trend-rank">4</span>
                <div>
                    <div class="trend-topic">#ChínhTrị</div>
                    <div class="trend-posts">421 bài viết</div>
                </div>
            </div>
        </div>
        
        {{-- Suggestions --}}
        <div class="sidebar-card">
            <h6><i class="ri-user-add-line"></i> Gợi ý kết bạn</h6>
            <div class="suggestion-item">
                <img src="{{ asset('template_assets/images/user/02.jpg') }}" class="avatar" alt="">
                <div class="flex-grow-1">
                    <div class="name">Nguyễn Minh</div>
                    <div class="mutual">5 bạn chung</div>
                </div>
            </div>
            <div class="suggestion-item">
                <img src="{{ asset('template_assets/images/user/03.jpg') }}" class="avatar" alt="">
                <div class="flex-grow-1">
                    <div class="name">Trần Hương</div>
                    <div class="mutual">3 bạn chung</div>
                </div>
            </div>
            <div class="suggestion-item">
                <img src="{{ asset('template_assets/images/user/04.jpg') }}" class="avatar" alt="">
                <div class="flex-grow-1">
                    <div class="name">Lê Hoàng</div>
                    <div class="mutual">2 bạn chung</div>
                </div>
            </div>
        </div>
        
        {{-- Footer --}}
        <div class="text-center" style="font-size: 0.7rem; color: var(--text-muted);">
            <p class="mb-1">© 2024 Social Media</p>
            <a href="#" style="color: var(--text-muted);">Điều khoản</a> · 
            <a href="#" style="color: var(--text-muted);">Bảo mật</a>
        </div>
    </aside>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Like
    document.querySelectorAll('.like-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            const postId = this.dataset.postId;
            const icon = this.querySelector('i');
            const self = this;
            
            fetch('/like/' + postId, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Content-Type': 'application/json'
                }
            })
            .then(r => r.json())
            .then(d => {
                if (d.status === 'liked') {
                    self.classList.add('liked');
                    icon.className = 'ri-heart-fill';
                } else {
                    self.classList.remove('liked');
                    icon.className = 'ri-heart-line';
                }
            });
        });
    });
    
    // File upload feedback
    document.querySelectorAll('.upload-btn input[type="file"]').forEach(input => {
        input.addEventListener('change', function() {
            const label = this.closest('label');
            if (this.files.length > 0) {
                label.style.borderColor = '#6366F1';
                label.style.background = '#EEF2FF';
            }
        });
    });
    
    // Video autoplay on scroll (muted để trình duyệt cho phép autoplay)
    const videoObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            const video = entry.target;
            if (entry.isIntersecting) {
                video.play().catch(() => {});
            } else {
                video.pause();
            }
        });
    }, { threshold: 0.5 });
    
    document.querySelectorAll('.post-media video').forEach(video => {
        // Muted để autoplay hoạt động
        video.muted = true;
        videoObserver.observe(video);
        
        // Click vào video để bật/tắt âm thanh
        video.addEventListener('click', function() {
            this.muted = !this.muted;
        });
    });
    
    // Feed tracking
    @if(Auth::check())
    const durations = {};
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(e => {
            const fid = e.target.dataset.feedId;
            if (!fid) return;
            if (e.isIntersecting) {
                durations[fid] = Date.now();
            } else if (durations[fid]) {
                const dur = Math.round((Date.now() - durations[fid]) / 1000);
                if (dur > 0) {
                    fetch('/feed/update-duration', {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify({ feed_id: fid, duration: dur })
                    });
                }
                delete durations[fid];
            }
        });
    }, { threshold: 0.5 });
    
    document.querySelectorAll('.post-card[data-feed-id]').forEach(c => {
        if (c.dataset.feedId) observer.observe(c);
    });
    @endif
});
</script>
@endsection
