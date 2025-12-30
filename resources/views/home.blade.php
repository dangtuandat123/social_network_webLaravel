@extends('layouts.app')

@section('content')
    <style>
        .home-page {
            background: linear-gradient(180deg, #f5f7fb 0%, #ffffff 45%);
            min-height: 100vh;
        }

        .text-white-75 {
            color: rgba(255, 255, 255, 0.75) !important;
        }

        .home-hero {
            position: relative;
            overflow: hidden;
            border-radius: 24px;
            padding: 2.75rem 3rem;
            background: linear-gradient(135deg, #516bff 0%, #8360ff 45%, #fb9ad1 100%);
            color: #fff;
            display: flex;
            align-items: center;
            gap: 2.5rem;
            flex-wrap: wrap;
        }

        .home-hero::after,
        .home-hero::before {
            content: '';
            position: absolute;
            border-radius: 999px;
            background: rgba(255, 255, 255, 0.18);
            filter: blur(0px);
            z-index: 0;
        }

        .home-hero::before {
            width: 260px;
            height: 260px;
            top: -80px;
            right: -60px;
        }

        .home-hero::after {
            width: 180px;
            height: 180px;
            bottom: -50px;
            left: 30px;
        }

        .home-hero-text,
        .home-hero-illustration {
            position: relative;
            z-index: 1;
        }

        .home-hero-text {
            max-width: 520px;
        }

        .home-hero-illustration {
            min-width: 240px;
            flex: 1 1 220px;
            display: flex;
            justify-content: flex-end;
        }

        .glass-card {
            backdrop-filter: blur(18px);
            background: rgba(255, 255, 255, 0.18);
            border-radius: 22px;
            padding: 1.75rem;
            border: 1px solid rgba(255, 255, 255, 0.35);
            box-shadow: 0 25px 45px rgba(15, 23, 42, 0.12);
            width: 100%;
            max-width: 260px;
        }

        .quick-stats {
            display: flex;
            flex-wrap: wrap;
            gap: 1.5rem;
        }

        .quick-stat-item h4 {
            font-weight: 700;
            margin-bottom: 0.25rem;
        }

        .quick-stat-item small {
            color: rgba(255, 255, 255, 0.85);
        }

        .create-post-card {
            border-radius: 20px;
            box-shadow: 0 24px 45px rgba(15, 23, 42, 0.08);
        }

        .create-post-card .card-body {
            padding: 1.75rem;
        }

        .open-post-modal {
            width: 100%;
            border: 1px solid rgba(81, 107, 255, 0.2);
            background-color: #f3f5ff;
            color: #3b54d6;
            border-radius: 16px;
            padding: 0.9rem 1.25rem;
            text-align: left;
            font-weight: 600;
            transition: all 0.2s ease;
        }

        .open-post-modal:hover {
            background-color: #516bff;
            color: #fff;
            box-shadow: 0 12px 20px rgba(81, 107, 255, 0.25);
        }

        .post-option,
        .post-option:focus {
            display: inline-flex;
            align-items: center;
            gap: 0.6rem;
            padding: 0.7rem 1.15rem;
            border-radius: 999px;
            background: #f8f9ff;
            border: 1px solid transparent;
            color: #516bff;
            font-weight: 600;
            transition: all 0.2s ease;
        }

        .post-option:hover {
            background-color: #516bff;
            color: #fff;
            transform: translateY(-1px);
        }

        .post-option-icon {
            width: 22px;
            height: 22px;
            object-fit: cover;
        }

        .feed-card {
            border-radius: 22px;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .feed-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 22px 38px rgba(15, 23, 42, 0.12);
        }

        .feed-card .card-body {
            padding: 1.85rem;
        }

        .feed-avatar,
        .avatar-lg {
            width: 3.25rem;
            height: 3.25rem;
            object-fit: cover;
        }

        .avatar-lg {
            width: 3.5rem;
            height: 3.5rem;
        }

        .feed-meta {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            flex-wrap: wrap;
            font-size: 0.9rem;
            color: #66789e;
        }

        .meta-divider {
            width: 6px;
            height: 6px;
            border-radius: 50%;
            background-color: rgba(102, 120, 158, 0.6);
        }

        .feed-text {
            font-size: 1.05rem;
            line-height: 1.6;
            color: #394b6a;
        }

        .feed-media img {
            width: 100%;
            max-height: 32rem;
            object-fit: cover;
            border-radius: 18px;
        }

        .feed-actions {
            border-top: 1px solid #edf1ff;
            padding-top: 1rem;
        }

        .btn-like {
            display: inline-flex;
            align-items: center;
            gap: 0.55rem;
            padding: 0.55rem 1.1rem;
            border-radius: 999px;
            background-color: #eef1ff;
            border: none;
            font-weight: 600;
            color: #516bff;
            transition: all 0.2s ease;
        }

        .btn-like:hover {
            background-color: #516bff;
            color: #fff;
            transform: translateY(-1px);
        }

        .btn-like img {
            width: 22px;
            height: 22px;
        }

        .aside-card {
            border-radius: 20px;
            box-shadow: 0 20px 38px rgba(15, 23, 42, 0.08);
        }

        .aside-card .card-body {
            padding: 1.75rem;
        }

        .tag-pill {
            display: inline-block;
            padding: 0.45rem 0.95rem;
            border-radius: 999px;
            background-color: #f1f4ff;
            color: #516bff;
            font-weight: 600;
            transition: all 0.2s ease;
        }

        .tag-pill:hover {
            background-color: #516bff;
            color: #fff;
        }

        .avatar-suggestion {
            width: 48px;
            height: 48px;
            border-radius: 50%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background-color: #f3f5ff;
            color: #516bff;
            font-size: 1.3rem;
        }

        .event-card {
            background-color: #f9faff;
            border: 1px solid rgba(81, 107, 255, 0.1);
        }

        .event-card h6 {
            font-weight: 600;
        }

        .bg-soft-primary {
            background-color: rgba(81, 107, 255, 0.18) !important;
            color: #516bff !important;
        }

        .bg-primary-subtle {
            background-color: rgba(81, 107, 255, 0.12) !important;
            color: #516bff !important;
        }

        .home-hero .btn-outline-light:hover {
            background-color: rgba(255, 255, 255, 0.18);
            color: #fff;
        }

        .category-highlight {
            background: #fff;
            border-radius: 22px;
            box-shadow: 0 20px 44px rgba(15, 23, 42, 0.08);
            padding: 2.2rem 2.4rem;
            margin-bottom: 2.5rem;
        }

        .category-highlight-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 1.25rem;
            flex-wrap: wrap;
            margin-bottom: 1.6rem;
        }

        .category-highlight-items {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
            gap: 1.25rem;
        }

        .category-highlight-card {
            background: linear-gradient(135deg, rgba(81, 107, 255, 0.08), rgba(131, 96, 255, 0.15));
            border-radius: 18px;
            padding: 1.35rem;
            display: flex;
            flex-direction: column;
            gap: 0.65rem;
            position: relative;
            overflow: hidden;
        }

        .category-highlight-card::after {
            content: '';
            position: absolute;
            top: -35px;
            right: -35px;
            width: 110px;
            height: 110px;
            border-radius: 50%;
            background: rgba(81, 107, 255, 0.08);
        }

        .category-highlight-icon {
            width: 48px;
            height: 48px;
            border-radius: 14px;
            background: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #516bff;
            font-size: 1.4rem;
            box-shadow: 0 12px 24px rgba(81, 107, 255, 0.15);
            z-index: 1;
        }

        .category-highlight-card h6 {
            margin: 0;
            font-weight: 700;
            color: #334366;
        }

        .category-highlight-card p {
            margin: 0;
            color: #516bff;
            font-weight: 600;
            font-size: 1.1rem;
        }

        .category-highlight-meta {
            margin: 0;
            color: #7b8ab3;
            font-size: 0.9rem;
        }

        .category-highlight-card[data-variant="giao-duc"] {
            background: linear-gradient(135deg, #f0f5ff 0%, #d6e4ff 100%);
        }

        .category-highlight-card[data-variant="giao-duc"] .category-highlight-icon {
            background: rgba(59, 84, 214, 0.16);
            color: #3b54d6;
        }

        .category-highlight-card[data-variant="chinh-tri"] {
            background: linear-gradient(135deg, #ffe9e4 0%, #ffd1ca 100%);
        }

        .category-highlight-card[data-variant="chinh-tri"] .category-highlight-icon {
            background: rgba(240, 84, 84, 0.18);
            color: #e24343;
        }

        .category-highlight-card[data-variant="y-te"] {
            background: linear-gradient(135deg, #e4fff7 0%, #c7f5ea 100%);
        }

        .category-highlight-card[data-variant="y-te"] .category-highlight-icon {
            background: rgba(22, 160, 133, 0.18);
            color: #169c84;
        }

        .category-highlight-card[data-variant="khac"] {
            background: linear-gradient(135deg, #f5f6fb 0%, #e1e4ff 100%);
        }

        .category-highlight-card[data-variant="khac"] .category-highlight-icon {
            background: rgba(81, 107, 255, 0.15);
            color: #516bff;
        }

        .category-highlight-card[data-variant="mac-dinh"] {
            background: linear-gradient(135deg, rgba(81, 107, 255, 0.08), rgba(131, 96, 255, 0.12));
        }

        .category-highlight-card[data-variant="mac-dinh"] .category-highlight-icon {
            background: rgba(81, 107, 255, 0.16);
            color: #4455aa;
        }

        @media (max-width: 991.98px) {
            .category-highlight {
                padding: 1.8rem;
            }
        }

        @media (max-width: 767.98px) {
            .category-highlight {
                padding: 1.25rem 1.4rem;
                margin-bottom: 1.75rem;
            }

            .category-highlight-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 0.75rem;
            }

            .category-highlight-items {
                gap: 0.85rem;
            }

            .category-highlight-card {
                padding: 1.1rem;
            }
        }

        @media (max-width: 575.98px) {
            .category-highlight {
                padding: 1rem 1.1rem;
                border-radius: 18px;
            }

            .category-highlight-items {
                grid-template-columns: repeat(2, minmax(0, 1fr));
                gap: 0.75rem;
            }

            .category-highlight-card {
                padding: 1rem;
            }

            .category-highlight-icon {
                width: 40px;
                height: 40px;
                font-size: 1.2rem;
            }

            .category-highlight-card h6 {
                font-size: 1rem;
            }

            .category-highlight-card p {
                font-size: 1rem;
            }
        }

        @media (max-width: 1199.98px) {
            .home-hero {
                padding: 2.3rem 2.4rem;
                gap: 2rem;
            }
        }

        @media (max-width: 991.98px) {
            .home-hero {
                padding: 1.8rem 1.6rem;
                gap: 1.35rem;
            }

            .create-post-card .card-body,
            .feed-card .card-body {
                padding: 1.4rem;
            }

            .home-hero-illustration {
                justify-content: flex-start;
            }
        }

        @media (max-width: 767.98px) {
            .home-page .container {
                padding-left: 0.5rem;
                padding-right: 0.5rem;
            }

            .home-hero {
                text-align: center;
                padding: 1.35rem 1.2rem;
                margin-bottom: 1.5rem !important;
                gap: 1.1rem;
            }

            .home-hero::after,
            .home-hero::before {
                display: none;
            }

            .home-hero-text {
                margin: 0 auto;
            }

            .glass-card {
                margin: 0 auto;
                padding: 1.2rem;
                max-width: 220px;
            }

            .quick-stats {
                gap: 1rem;
            }

            .open-post-modal {
                padding: 0.75rem 1rem;
                font-size: 0.95rem;
            }

            .post-option {
                flex: 1 1 calc(50% - 0.5rem);
                justify-content: center;
                padding: 0.6rem 0.9rem;
            }

            .create-post-card .card-body {
                padding: 1.2rem;
            }

            .feed-card .card-body {
                padding: 1.05rem;
            }

            #feed {
                --bs-gutter-x: 0.65rem;
                --bs-gutter-y: 1rem;
            }
        }

        @media (max-width: 575.98px) {
            .home-page .container {
                padding-left: 0.35rem;
                padding-right: 0.35rem;
            }

            .home-hero {
                padding: 0.95rem 0.85rem;
            }

            .home-hero-text h1 {
                font-size: 1.9rem;
            }

            .home-hero-text .lead {
                font-size: 1rem;
            }

            .post-option {
                flex: 1 1 100%;
                padding: 0.5rem 0.8rem;
            }

            .feed-meta {
                gap: 0.3rem;
            }

            .feed-card .card-body {
                padding: 0.95rem;
            }

            .feed-text {
                font-size: 1.12rem;
            }

            .feed-media {
                margin: 0 -0.25rem;
            }

            .feed-media img {
                border-radius: 16px;
                width: calc(100% + 0.5rem);
                max-width: none;
                margin-left: -0.25rem;
            }

            #feed {
                --bs-gutter-x: 0.5rem;
                --bs-gutter-y: 0.85rem;
            }
        }
    </style>

    <div id="content-page" style="padding: 0" class="content-page home-page">
        <div class="container py-4 py-lg-5">

            @php
                $categoryHighlight = $posts->groupBy(fn($post) => $post->category ?? 'Khác')->map(function ($items) {
                    return [
                        'count' => $items->count(),
                        'latest' => optional($items->sortByDesc('created_at')->first())->created_at,
                    ];
                })->sortByDesc('count')->take(4);

                $categoryMeta = [
                    'Giáo dục' => ['icon' => 'ri-graduation-cap-line', 'variant' => 'giao-duc'],
                    'Chính trị' => ['icon' => 'ri-flag-line', 'variant' => 'chinh-tri'],
                    'Y tế' => ['icon' => 'ri-heart-pulse-line', 'variant' => 'y-te'],
                    'Khác' => ['icon' => 'ri-compass-3-line', 'variant' => 'khac'],
                ];

                $defaultMeta = ['icon' => 'ri-hashtag', 'variant' => 'mac-dinh'];
            @endphp

            @if ($categoryHighlight->isNotEmpty())
                <section class="category-highlight">
                    <div class="category-highlight-header">
                        <div>
                            <span class="badge bg-soft-primary text-uppercase fw-semibold">Danh mục nổi bật</span>
                            {{-- <h2 class="h4 fw-bold mt-2 mb-1">Khám phá nội dung theo sở thích của bạn</h2>
                            <p class="text-muted mb-0">Những chủ đề được cộng đồng quan tâm nhiều nhất trong tuần qua.</p> --}}
                        </div>
                    </div>
                    <div class="category-highlight-items">
                        @foreach ($categoryHighlight as $categoryName => $stat)
                            @php
                                $meta = $categoryMeta[$categoryName] ?? $defaultMeta;
                                $icon = $meta['icon'];
                                $variant = $meta['variant'] ?? 'mac-dinh';
                                $latest = $stat['latest'];
                            @endphp
                            <div class="category-highlight-card" data-variant="{{ $variant }}">
                                <div class="category-highlight-icon">
                                    <i class="{{ $icon }}"></i>
                                </div>
                                <h6>{{ $categoryName }}</h6>
                                <p>{{ $stat['count'] }} bài viết</p>
                                @if ($latest)
                                    <p class="category-highlight-meta">Cập nhật gần nhất {{ $latest->diffForHumans() }}</p>
                                @else
                                    <p class="category-highlight-meta">Chưa có bài viết</p>
                                @endif
                            </div>
                        @endforeach
                    </div>
                </section>
            @endif

            <div class="row gx-4 gy-4 mt-1 justify-content-center" id="feed">
                <div class="col-12 col-xl-10 order-2 order-xl-1">
                    @if (Auth::check() && Auth::user()->level == 1)
                        <div class="card create-post-card border-0 shadow-sm mb-4">
                            <div class="card-body">
                                <div class="d-flex align-items-center gap-3">
                                    <img src="https://avatars.fastly.steamstatic.com/79d0a512c5512bf571c21ed9af845382cc595543_full.jpg"
                                        alt="user" class="avatar-lg rounded-circle flex-shrink-0">
                                    <button type="button" class="open-post-modal" data-bs-toggle="modal"
                                        data-bs-target="#post-modal">
                                        Bạn đang nghĩ gì hôm nay, {{ Auth::user()->name }}?
                                    </button>
                                </div>
                                <div class="d-flex flex-wrap gap-2 mt-3">
                                    <button type="button" class="post-option" data-bs-toggle="modal"
                                        data-bs-target="#post-modal">
                                        <img src="{{ asset('template_assets/images/small/07.png') }}" alt="icon"
                                            class="post-option-icon">
                                        <span>Ảnh/Video</span>
                                    </button>
                                    <button type="button" class="post-option" data-bs-toggle="modal"
                                        data-bs-target="#post-modal">
                                        <img src="{{ asset('template_assets/images/small/08.png') }}" alt="icon"
                                            class="post-option-icon">
                                        <span>Tag bạn bè</span>
                                    </button>
                                    <button type="button" class="post-option" data-bs-toggle="modal"
                                        data-bs-target="#post-modal">
                                        <img src="{{ asset('template_assets/images/small/09.png') }}" alt="icon"
                                            class="post-option-icon">
                                        <span>Cảm xúc</span>
                                    </button>
                                    <div class="dropdown">
                                        <button class="post-option dropdown-toggle" type="button" data-bs-toggle="dropdown"
                                            aria-expanded="false">
                                            <i class="ri-more-fill"></i> Khác
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-end">
                                            <li><a class="dropdown-item" href="#" data-bs-toggle="modal"
                                                    data-bs-target="#post-modal">Check in</a></li>
                                            <li><a class="dropdown-item" href="#" data-bs-toggle="modal"
                                                    data-bs-target="#post-modal">Live Video</a></li>
                                            <li><a class="dropdown-item" href="#" data-bs-toggle="modal"
                                                    data-bs-target="#post-modal">Gif</a></li>
                                            <li><a class="dropdown-item" href="#" data-bs-toggle="modal"
                                                    data-bs-target="#post-modal">Watch Party</a></li>
                                            <li><a class="dropdown-item" href="#" data-bs-toggle="modal"
                                                    data-bs-target="#post-modal">Play with Friend</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="modal fade" id="post-modal" tabindex="-1" aria-labelledby="post-modalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
                                <div class="modal-content rounded-4 border-0 shadow-lg">
                                    <div class="modal-header border-0 pb-0">
                                        <div>
                                            <h5 class="modal-title fw-semibold" id="post-modalLabel">Tạo bài viết</h5>
                                            <small class="text-muted">Chia sẻ nội dung hữu ích cho cộng đồng của bạn.</small>
                                        </div>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="d-flex align-items-center gap-3 mb-4">
                                            <img src="{{ asset('template_assets/images/user/1.jpg') }}" alt="user"
                                                class="avatar-lg rounded-circle">
                                            <div>
                                                <h6 class="mb-0 fw-semibold">{{ Auth::user()->name }}</h6>
                                                <small class="text-muted">Bài viết sẽ được hiển thị tới cộng đồng</small>
                                            </div>
                                        </div>
                                        <form class="needs-validation" action="{{ route('post.store') }}" method="POST"
                                            enctype="multipart/form-data" novalidate>
                                            @csrf
                                            <div class="row g-3">
                                                <div class="col-12">
                                                    <label for="title" class="form-label fw-semibold">Tiêu đề</label>
                                                    <input type="text" class="form-control form-control-lg" name="title" id="title"
                                                        required placeholder="Nhập tiêu đề bài viết">
                                                </div>
                                                <div class="col-12">
                                                    <label for="list_img" class="form-label fw-semibold">Hình ảnh</label>
                                                    <input type="file" class="form-control" name="list_img[]" id="list_img" multiple
                                                        accept="image/*">
                                                    <small class="text-muted">Bạn có thể tải lên nhiều hình ảnh (tối đa 10, mỗi ảnh tối đa 2MB).</small>
                                                </div>
                                                <div class="col-12">
                                                    <label for="list_video" class="form-label fw-semibold">Video</label>
                                                    <input type="file" class="form-control" name="list_video[]" id="list_video" multiple
                                                        accept="video/mp4,video/webm,video/quicktime">
                                                    <small class="text-muted">Bạn có thể tải lên video (MP4, WebM, tối đa 500MB mỗi video).</small>
                                                </div>
                                                <div class="col-12">
                                                    <div class="alert alert-info py-2 mb-0">
                                                        <i class="ri-information-line me-1"></i>
                                                        <small>Vui lòng tải lên ít nhất một hình ảnh hoặc video.</small>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="category" class="form-label fw-semibold">Danh mục</label>
                                                    <select class="form-select" name="category" id="category" required>
                                                        <option value="Giáo dục">Giáo dục</option>
                                                        <option value="Chính trị">Chính trị</option>
                                                        <option value="Y tế">Y tế</option>
                                                        <option value="Khác">Khác</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="fakeorreal" class="form-label fw-semibold">Loại bài viết</label>
                                                    <select class="form-select" name="fakeorreal" id="fakeorreal" required>
                                                        <option value="real">Real</option>
                                                        <option value="fake">Fake</option>
                                                    </select>
                                                </div>
                                                <div class="col-12">
                                                    <label for="useridpost" class="form-label fw-semibold">Người đăng</label>
                                                    <select class="form-select" name="useridpost" id="useridpost" required>
                                                        <option value="{{ Auth::user()->id }}">{{ Auth::user()->name }}</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="d-grid mt-4">
                                                <button type="submit" class="btn btn-primary btn-lg rounded-3">
                                                    Tạo Bài Viết
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif

                    @if ($posts->isEmpty())
                        <div class="alert alert-info border-0 shadow-sm rounded-4">
                            <div class="d-flex flex-column flex-md-row align-items-start align-items-md-center gap-3">
                                <i class="ri-information-line display-6 text-primary"></i>
                                <div>
                                    <h5 class="mb-1 fw-semibold">Hiện tại chưa có bài viết nào.</h5>
                                    <p class="mb-0">@unless(Auth::check())<a href="{{ route('login') }}" class="link-primary">Đăng nhập</a> để là người đầu tiên chia sẻ câu chuyện của bạn.@else Chia sẻ nội dung đầu tiên của bạn ngay hôm nay!@endunless</p>
                                </div>
                            </div>
                        </div>
                    @endif

                    @foreach ($posts as $post)
                        <article class="card feed-card border-0 shadow-sm mb-4 post_container_duration"
                            data-feed-id="{{ $post->feed_id ?? '' }}">
                            <div class="card-body">
                                <div class="d-flex align-items-start justify-content-between flex-wrap gap-3">
                                    <div class="d-flex align-items-center gap-3">
                                        <img class="feed-avatar rounded-circle"
                                            src="{{ asset('template_assets/images/user/01.jpg') }}" alt="avatar">
                                        <div>
                                            <h6 class="mb-0 fw-semibold">{{ $post->user->name }}</h6>
                                            <div class="feed-meta mt-1">
                                                <span>{{ $post->created_at->format('d/m/Y H:i') }}</span>
                                                @if (!empty($post->category))
                                                    <span class="meta-divider"></span>
                                                    <span class="badge rounded-pill bg-soft-primary">{{ $post->category }}</span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    @if (Auth::check() && Auth::id() === $post->user_id)
                                        <span class="badge bg-primary-subtle fw-semibold align-self-start">Bài viết của bạn</span>
                                    @endif
                                </div>

                                @if (!empty($post->title))
                                    <p class="feed-text mt-3 mb-3">{{ $post->title }}</p>
                                @endif

                                @if (!empty($post->list_img))
                                    @php
                                        $images = explode(',', $post->list_img);
                                        $images = array_filter($images); // Loại bỏ phần tử rỗng
                                    @endphp
                                    <div class="feed-media mb-3">
                                        @if (count($images) === 1)
                                            <img src="{{ asset('storage/' . trim($images[0])) }}" alt="post-image" class="img-fluid w-100" loading="lazy">
                                        @else
                                            <div id="carousel-{{ $post->id }}" class="carousel slide" data-bs-ride="carousel">
                                                <div class="carousel-inner">
                                                    @foreach ($images as $index => $image)
                                                        <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                                                            <img src="{{ asset('storage/' . trim($image)) }}" alt="post-image-{{ $index + 1 }}" class="d-block w-100" loading="lazy" style="max-height: 32rem; object-fit: cover; border-radius: 18px;">
                                                        </div>
                                                    @endforeach
                                                </div>
                                                <button class="carousel-control-prev" type="button" data-bs-target="#carousel-{{ $post->id }}" data-bs-slide="prev">
                                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                                    <span class="visually-hidden">Previous</span>
                                                </button>
                                                <button class="carousel-control-next" type="button" data-bs-target="#carousel-{{ $post->id }}" data-bs-slide="next">
                                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                                    <span class="visually-hidden">Next</span>
                                                </button>
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                @endif

                                {{-- Hiển thị Video --}}
                                @if (!empty($post->list_video))
                                    @php
                                        $videos = explode(',', $post->list_video);
                                        $videos = array_filter($videos);
                                    @endphp
                                    <div class="feed-media mb-3">
                                        @foreach ($videos as $index => $video)
                                            <div class="video-container mb-2" style="position: relative; border-radius: 18px; overflow: hidden;">
                                                <video 
                                                    class="auto-play-video"
                                                    controls 
                                                    playsinline
                                                    preload="metadata"
                                                    style="width: 100%; max-height: 32rem; border-radius: 18px; background: #000;">
                                                    <source src="{{ asset('storage/' . trim($video)) }}" type="video/mp4">
                                                    <source src="{{ asset('storage/' . trim($video)) }}" type="video/webm">
                                                    Trình duyệt của bạn không hỗ trợ video.
                                                </video>
                                            </div>
                                        @endforeach
                                    </div>
                                @endif

                                @if (Auth::check())
                                    <div class="feed-actions d-flex align-items-center justify-content-between flex-wrap gap-3 mt-3">
                                        <div class="d-flex align-items-center gap-3">
                                            <button type="button" class="btn-like" data-post-id="{{ $post->id }}">
                                                <img src="{{ auth()->user()->hasLiked($post) ? asset('template_assets/images/heart.png') : asset('template_assets/images/heart (1).png') }}"
                                                    alt="like-icon">
                                                <span>Yêu thích</span>
                                            </button>
                                        </div>
                                        <div class="d-flex align-items-center gap-2">
                                            <button type="button" class="btn btn-outline-primary btn-sm rounded-pill px-3"
                                                data-bs-toggle="modal" data-bs-target="#Modal_share_{{ $post->id }}">
                                                <i class="ri-share-forward-line me-1"></i>Chia sẻ
                                            </button>
                                        </div>
                                    </div>
                                @else
                                    <div class="mt-3">
                                        <a class="btn btn-outline-primary rounded-pill" href="{{ route('login') }}">
                                            <i class="ri-login-circle-line me-1"></i>Đăng nhập để tương tác
                                        </a>
                                    </div>
                                @endif
                            </div>
                        </article>

                        <div class="modal fade" id="Modal_share_{{ $post->id }}" tabindex="-1"
                            aria-labelledby="shareModalLabel_{{ $post->id }}" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content rounded-4 border-0 shadow-lg">
                                    <div class="modal-header border-0">
                                        <h5 class="modal-title fw-semibold" id="shareModalLabel_{{ $post->id }}">Chia sẻ bài viết</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <form action="{{ route('share.store', $post->id) }}" method="POST">
                                        @csrf
                                        <div class="modal-body">
                                            <div class="mb-3">
                                                <label for="caption_{{ $post->id }}" class="form-label fw-semibold">Viết gì đó về bài viết này...</label>
                                                <textarea 
                                                    class="form-control" 
                                                    name="caption" 
                                                    id="caption_{{ $post->id }}" 
                                                    rows="3" 
                                                    placeholder="Viết gì đó về bài viết này..."
                                                    maxlength="1000"
                                                    required></textarea>
                                                <small class="text-muted">Bắt buộc - Tối đa 1000 ký tự</small>
                                            </div>
                                        </div>
                                        <div class="modal-footer border-0">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                                            <button type="submit" class="btn btn-primary">
                                                <i class="ri-share-forward-line me-1"></i>Chia sẻ ngay
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach

                    {{-- Pagination Links --}}
                    @if(method_exists($posts, 'links'))
                        <div class="d-flex justify-content-center mt-4 mb-4">
                            {{ $posts->links('pagination::bootstrap-5') }}
                        </div>
                    @endif

                    <script>
                        $(document).ready(function() {
                            $('.btn-like').on('click', function(event) {
                                event.preventDefault();
                                const postId = $(this).data('post-id');

                                if (!postId) {
                                    console.warn('Thiếu post_id khi gửi yêu cầu like.');
                                    return;
                                }

                                $.ajax({
                                    url: '/like/' + postId,
                                    method: 'POST',
                                    data: {
                                        _token: '{{ csrf_token() }}',
                                    },
                                    success: function(response) {
                                        const $likeButtons = $('.btn-like[data-post-id="' + postId + '"]');

                                        if (response.status === 'liked') {
                                            $likeButtons.find('img').attr('src',
                                                '{{ asset('template_assets/images/heart.png') }}');
                                        } else {
                                            $likeButtons.find('img').attr('src',
                                                '{{ asset('template_assets/images/heart (1).png') }}');
                                        }
                                    },
                                    error: function(error) {
                                        console.error('Không thể like bài viết', error);
                                    }
                                });
                            });

                            $('.btn-share').on('click', function(event) {
                                event.preventDefault();
                                const postId = $(this).data('post-id');

                                if (!postId) {
                                    console.warn('Thiếu post_id khi chia sẻ bài viết.');
                                    return;
                                }

                                $.ajax({
                                    url: '/share-to-profile/' + postId,
                                    type: 'POST',
                                    data: {
                                        _token: '{{ csrf_token() }}'
                                    },
                                    success: function() {
                                        alert('Chia sẻ thành công!');
                                    },
                                    error: function() {
                                        alert('Có lỗi xảy ra!');
                                    }
                                });
                            });

                            const feedViewStartTimes = {};

                            function sendDuration(feedId, duration) {
                                if (duration <= 0) {
                                    return;
                                }

                                $.ajax({
                                    url: '{{ route('feed.updateDuration') }}',
                                    type: 'POST',
                                    data: {
                                        _token: '{{ csrf_token() }}',
                                        feed_id: feedId,
                                        duration: duration
                                    },
                                    success: function() {
                                        console.log('Feed', feedId, 'được xem', duration, 'giây');
                                    },
                                    error: function() {
                                        console.error('Lỗi gửi thời gian xem feed', feedId);
                                    }
                                });
                            }

                            const observer = new IntersectionObserver(function(entries) {
                                entries.forEach(entry => {
                                    const $el = $(entry.target);
                                    const feedId = $el.data('feed-id');

                                    if (!feedId) {
                                        return;
                                    }

                                    if (entry.isIntersecting) {
                                        if (!feedViewStartTimes[feedId]) {
                                            feedViewStartTimes[feedId] = Date.now();
                                        }
                                    } else if (feedViewStartTimes[feedId]) {
                                        const duration = Math.floor((Date.now() - feedViewStartTimes[feedId]) / 1000);
                                        sendDuration(feedId, duration);
                                        feedViewStartTimes[feedId] = null;
                                    }
                                });
                            }, {
                                threshold: 0.4
                            });

                            $('.post_container_duration').each(function() {
                                observer.observe(this);
                            });

                            // Video Autoplay Observer - Tự động phát video khi scroll đến
                            const videoObserver = new IntersectionObserver(function(entries) {
                                entries.forEach(entry => {
                                    const video = entry.target;
                                    
                                    if (entry.isIntersecting) {
                                        // Video xuất hiện trong viewport - tự động phát
                                        video.play().catch(function(error) {
                                            console.log('Autoplay blocked:', error);
                                        });
                                    } else {
                                        // Video ra khỏi viewport - tạm dừng
                                        video.pause();
                                    }
                                });
                            }, {
                                threshold: 0.5 // 50% video hiển thị thì mới phát
                            });

                            // Observe tất cả video có class auto-play-video
                            $('.auto-play-video').each(function() {
                                videoObserver.observe(this);
                            });

                            $(window).on('beforeunload', function() {
                                Object.keys(feedViewStartTimes).forEach(function(feedId) {
                                    if (!feedViewStartTimes[feedId]) {
                                        return;
                                    }

                                    const duration = Math.floor((Date.now() - feedViewStartTimes[feedId]) / 1000);

                                    if (duration <= 0) {
                                        return;
                                    }

                                    navigator.sendBeacon('{{ route('feed.updateDuration') }}', new URLSearchParams({
                                        _token: '{{ csrf_token() }}',
                                        feed_id: feedId,
                                        duration: duration
                                    }));
                                });
                            });
                        });
                    </script>
                </div>

            </div>
        </div>
    </div>
    @unless (Auth::check())
        <button type="button" id="model_up" class="btn btn-primary" data-bs-toggle="modal"
            data-bs-target="#exampleModal" style="display: none">
        </button>
        <script>
            window.onload = function() {
                document.querySelector('#model_up').click();
            };
        </script>
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"
            style="display: none;">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Thông báo</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">

                        </button>
                    </div>
                    <div class="modal-body">
                        Để có thể tương tác với bài viết vui lòng đăng nhập!
                        <a class="nav-item dropdown" href="{{ route('login') }}">
                            <button type="button" class="btn btn-primary mb-1">Đăng nhập ngay</button>
                        </a>
                    </div>


                </div>
            </div>
        </div>
    @endunless
@endsection
