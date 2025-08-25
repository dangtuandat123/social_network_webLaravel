@extends('layouts.app')
@section('content')
    <div id="content-page" class="content-page">
        <div class="container">
            <div class="row">
                <div class="col-12 row m-0 p-0 justify-content-center">
                    @if (Auth::check() && Auth::user()->level == 1)
                        <div class="col-sm-9">
                            <div id="post-modal-data" class="card card-block card-stretch card-height">
                                <div class="card-header d-flex justify-content-between">
                                    <div class="header-title">
                                        <h4 class="card-title">Đăng bài viết</h4>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="d-flex align-items-center">
                                        <div class="user-img">
                                            <img src="https://avatars.fastly.steamstatic.com/79d0a512c5512bf571c21ed9af845382cc595543_full.jpg"
                                                alt="userimg" class="avatar-60 rounded-circle" />
                                        </div>
                                        <form class="post-text ms-3 w-100" data-bs-toggle="modal"
                                            data-bs-target="#post-modal" action="javascript:void();">
                                            <input type="text" class="form-control rounded"
                                                placeholder="Write something here..." style="border: none" />
                                        </form>
                                    </div>
                                    <hr />
                                    <ul class="post-opt-block d-flex list-inline m-0 p-0 flex-wrap">
                                        <li class="me-3 mb-md-0 mb-2">
                                            <a href="#" class="btn btn-soft-primary">
                                                <img src="{{ asset('template_assets/images/small/07.png') }}" alt="icon"
                                                    class="img-fluid me-2" />
                                                Photo/Video
                                            </a>
                                        </li>
                                        <li class="me-3 mb-md-0 mb-2">
                                            <a href="#" class="btn btn-soft-primary">
                                                <img src="{{ asset('template_assets/images/small/08.png') }}" alt="icon"
                                                    class="img-fluid me-2" />
                                                Tag Friend
                                            </a>
                                        </li>
                                        <li class="me-3">
                                            <a href="#" class="btn btn-soft-primary">
                                                <img src="{{ asset('template_assets/images/small/09.png') }}" alt="icon"
                                                    class="img-fluid me-2" />
                                                Feeling/Activity
                                            </a>
                                        </li>
                                        <li>
                                            <button class="btn btn-soft-primary">
                                                <div class="card-header-toolbar d-flex align-items-center">
                                                    <div class="dropdown">
                                                        <div class="dropdown-toggle" id="post-option"
                                                            data-bs-toggle="dropdown">
                                                            <i class="ri-more-fill"></i>
                                                        </div>
                                                        <div class="dropdown-menu dropdown-menu-right"
                                                            aria-labelledby="post-option" style="">
                                                            <a class="dropdown-item" href="#" data-bs-toggle="modal"
                                                                data-bs-target="#post-modal">Check in</a>
                                                            <a class="dropdown-item" href="#" data-bs-toggle="modal"
                                                                data-bs-target="#post-modal">Live Video</a>
                                                            <a class="dropdown-item" href="#" data-bs-toggle="modal"
                                                                data-bs-target="#post-modal">Gif</a>
                                                            <a class="dropdown-item" href="#" data-bs-toggle="modal"
                                                                data-bs-target="#post-modal">Watch Party</a>
                                                            <a class="dropdown-item" href="#" data-bs-toggle="modal"
                                                                data-bs-target="#post-modal">Play with Friend</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </button>
                                        </li>
                                    </ul>
                                </div>
                                <!-- Modal Create Post -->
                                <div class="modal fade" id="post-modal" tabindex="-1" aria-labelledby="post-modalLabel"
                                    aria-hidden="true">
                                    <div class="modal-dialog modal-fullscreen-sm-down">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="post-modalLabel">
                                                    Create Post
                                                </h5>
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                                    <i class="ri-close-fill"></i>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="d-flex align-items-center">
                                                    <div class="user-img">
                                                        <img src="{{ asset('template_assets/images/user/1.jpg') }}"
                                                            alt="userimg" class="avatar-60 rounded-circle img-fluid" />
                                                    </div>
                                                    <form class="post-text ms-3 w-100" action="{{ route('post.store') }}"
                                                        method="POST" enctype="multipart/form-data">
                                                        @csrf
                                                        <div class="form-group">
                                                            <label for="title">Tiêu đề</label>
                                                            <input type="text" class="form-control" name="title"
                                                                id="title" required
                                                                placeholder="Nhập tiêu đề bài viết" />
                                                        </div>

                                                        <div class="form-group mt-3">
                                                            <label for="list_img">Chọn hình
                                                                ảnh</label>
                                                            <input type="file" class="form-control" name="list_img[]"
                                                                id="list_img" multiple required>
                                                        </div>
                                                        <div class="form-group mt-3">
                                                            <label for="fakeorreal">Danh mục</label>
                                                            <select class="form-control" name="category" id="category"
                                                                required>
                                                                <option value="Giáo dục">Giáo dục</option>
                                                                <option value="Chính trị">Chính trị</option>
                                                                <option value="Y tế">Y tế</option>

                                                            </select>
                                                        </div>
                                                        <div class="form-group mt-3">
                                                            <label for="fakeorreal">Loại bài viết</label>
                                                            <select class="form-control" name="fakeorreal"
                                                                id="fakeorreal" required>
                                                                <option value="real">Real</option>
                                                                <option value="fake">Fake</option>
                                                            </select>
                                                        </div>

                                                        <div class="form-group mt-3">
                                                            <label for="useridpost">Người Đăng</label>
                                                            <select class="form-control" name="useridpost"
                                                                id="useridpost" required>
                                                                <option value="{{ Auth::user()->id }}">
                                                                    {{ Auth::user()->name }}
                                                                </option>
                                                            </select>
                                                        </div>

                                                        <button type="submit" class="btn btn-primary d-block w-100 mt-3">
                                                            Tạo Bài Viết
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Kết thúc Modal -->

                                <!-- Nút mở Modal (nếu bạn cần nút này để kích hoạt modal) -->
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#post-modal">
                                    Tạo Bài Viết
                                </button>
                            </div>
                        </div>
                    @endif
                    @if ($posts->isEmpty())
                        <div class="col-sm-12">
                            <div class="alert alert-info" role="alert">
                                <h4>Hiện tại không có bài viết nào để hiển thị, vui lòng <a
                                        href="{{ route('login') }}">đăng nhập.</a></h4>
                            </div>
                        </div>
                    @endif
                    @foreach ($posts as $post)
                        <div class="col-sm-9 post_container_duration" data-post-id="{{ $post->id}}">
                            <div class="card card-block card-stretch card-height">
                                <div class="card-body">
                                    <div class="user-post-data">
                                        <div class="d-flex justify-content-between">
                                            <div class="me-3">
                                                <img class="rounded-circle img-fluid"
                                                    src="{{ asset('template_assets/images/user/01.jpg') }}"
                                                    alt="" />
                                            </div>
                                            <div class="w-100">
                                                <div class="d-flex justify-content-between">
                                                    <div class="">
                                                        <h5 class="mb-0 d-inline-block">{{ $post->user->name }}</h5>
                                                        <p class="mb-0 text-primary">
                                                            {{ $post->created_at->format('d/m/Y H:i') }}

                                                        </p>
                                                    </div>
                                                    <div class="card-post-toolbar">
                                                        <b>
                                                            <h5 class="mb-0 text-primary">Danh mục: <span
                                                                    style="color: red">{{ $post->category }}</span></h5>
                                                        </b>


                                                    </div>


                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mt-3">
                                        <p>
                                            {{ $post->title }}
                                        </p>
                                    </div>
                                    <div class="user-post">
                                        <div class="row-span-2 row-span-md-1">
                                            <img style="max-height: 30rem;object-fit: cover;"
                                                src="{{ asset('storage/' . $post->list_img) }}" alt="post-image"
                                                class="img-fluid rounded w-100" />
                                        </div>



                                    </div>
                                    @if (Auth::check())
                                        <div class="comment-area mt-3">
                                            <div class="d-flex justify-content-between align-items-center flex-wrap">
                                                <div class="like-block position-relative d-flex align-items-center">
                                                    <div class="d-flex align-items-center">
                                                        <div class="like-data">
                                                            <!-- Nút Like -->
                                                            <button type="button" class="btn btn-info"
                                                                style="background-color: white; border: none;"
                                                                id="like-btn-{{ $post->id }}"
                                                                data-post-id="{{ $post->id }}">
                                                                <!-- Hình ảnh Like -->
                                                                <img src="{{ auth()->user()->hasLiked($post) ? asset('template_assets/images/heart.png') : asset('template_assets/images/heart (1).png') }}"
                                                                    alt="like-icon" style="width: 26px;height: 26px;" />
                                                            </button>



                                                        </div>

                                                    </div>

                                                </div>




                                                <div class="d-flex">
                                                    <!-- Nút chia sẻ lên trang cá nhân -->

                                                    <a class="btn btn-info" data-bs-toggle="modal"
                                                        data-bs-target="#Modal_share_{{ $post->id }}">Chia sẽ</a>
                                                    <div class="modal fade" id="Modal_share_{{ $post->id }}"
                                                        tabindex="-1" aria-labelledby="exampleModalLabel"
                                                        aria-hidden="true" style="display: none;">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="exampleModalLabel">
                                                                        Thông báo
                                                                    </h5>
                                                                    <button type="button" class="btn-close"
                                                                        data-bs-dismiss="modal" aria-label="Close">

                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    Bạn có muốn chia sẽ bài viết này lên trang cá nhân
                                                                    không?
                                                                    <button type="submit" data-bs-dismiss="modal"
                                                                        class="btn btn-primary mb-1 mt-1 btn-share"
                                                                        data-post-id="{{ $post->id }}">Chia sẽ
                                                                        ngay</button>

                                                                </div>


                                                            </div>
                                                        </div>
                                                    </div>
                                                    @if (Auth::check() && Auth::user()->level == 1)
                                                        <form action="{{ route('post.deletePost', $post->id) }}"
                                                            method="POST">
                                                            @csrf
                                                            <button type="submit" class="btn btn-danger"
                                                                style="margin-left: 7px">
                                                                Xóa
                                                            </button>
                                                        </form>
                                                    @endif
                                                </div>
                                            </div>

                                        </div>
                                    @else
                                        <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
                                            <symbol id="check-circle-fill" fill="currentColor" viewBox="0 0 16 16">
                                                <path
                                                    d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z">
                                                </path>
                                            </symbol>
                                            <symbol id="info-fill" fill="currentColor" viewBox="0 0 16 16">
                                                <path
                                                    d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z">
                                                </path>
                                            </symbol>
                                            <symbol id="exclamation-triangle-fill" fill="currentColor"
                                                viewBox="0 0 16 16">
                                                <path
                                                    d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z">
                                                </path>
                                            </symbol>
                                        </svg>

                                        <div class="alert alert-solid alert-primary d-flex align-items-center mt-3"
                                            role="alert">
                                            <svg class="bi flex-shrink-0 me-2" width="24" height="24">
                                                <use xlink:href="#info-fill"></use>
                                            </svg>
                                            <div>
                                                Vui lòng đăng nhập để tương tác với bài viết!

                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                    <script>
                        $(document).ready(function() {

                            $('.btn-info').click(function() {
                                var postId = $(this).data('post-id');

                                $.ajax({
                                    url: '/like/' + postId,
                                    method: 'POST',
                                    data: {
                                        _token: '{{ csrf_token() }}',
                                    },
                                    success: function(response) {
                                        if (response.status === 'liked') {
                                            $('#like-btn-' + postId).find('img').attr('src',
                                                '{{ asset('template_assets/images/heart.png') }}');
                                        } else {
                                            $('#like-btn-' + postId).find('img').attr('src',
                                                '{{ asset('template_assets/images/heart (1).png') }}');
                                        }
                                        console.log(response);
                                    },
                                    error: function(error) {
                                        console.log(error);
                                    }
                                });
                            });
                            $('.btn-share').click(function() {
                                let postId = $(this).data('post-id');
                                $.ajax({
                                    url: '/share-to-profile/' + postId,
                                    type: 'POST',
                                    data: {
                                        _token: '{{ csrf_token() }}'
                                    },
                                    success: function(res) {
                                        alert('Chia sẽ thành công!');

                                    },
                                    error: function(err) {
                                        alert('Có lỗi xảy ra!');
                                    }
                                });
                            });



                            // lưu thời gian bắt đầu xem cho mỗi bài
                            let postViewStartTimes = {};

                            // gửi duration lên server
                            function sendDuration(postId, duration) {
                                if (duration <= 0) return; // bỏ qua nếu duration = 0
                                $.ajax({
                                    url: '{{ route('feed.updateDuration') }}',
                                    type: 'POST',
                                    data: {
                                        _token: '{{ csrf_token() }}',
                                        post_id: postId,
                                        duration: duration
                                    },
                                    success: function(res) {
                                        console.log('Bài', postId, 'đã xem', duration, 'giây');
                                    },
                                    error: function(err) {
                                        console.error('Lỗi gửi thời gian xem bài', postId);
                                    }
                                });
                            }

                            // tạo observer
                            let observer = new IntersectionObserver(function(entries, observer) {
                                entries.forEach(entry => {
                                    let $el = $(entry.target);
                                    let postId = $el.data('post-id');

                                    if (entry.isIntersecting) {
                                        // bắt đầu xem
                                        if (!postViewStartTimes[postId]) {
                                            postViewStartTimes[postId] = Date.now();
                                        }
                                    } else {
                                        // ra khỏi view
                                        if (postViewStartTimes[postId]) {
                                            let duration = Math.floor((Date.now() - postViewStartTimes[postId]) /
                                                1000);
                                            sendDuration(postId, duration);
                                            postViewStartTimes[postId] = null;
                                        }
                                    }
                                });
                            }, {
                                threshold: 0.4 // 10% bài viết hiển thị -> tính là xem
                            });

                            $('.post_container_duration').each(function() {
                                observer.observe(this);
                            });

                            $(window).on('beforeunload', function() {
                                for (let postId in postViewStartTimes) {
                                    if (postViewStartTimes[postId]) {
                                        let duration = Math.floor((Date.now() - postViewStartTimes[postId]) / 1000);
                                        navigator.sendBeacon('{{ route('feed.updateDuration') }}', new URLSearchParams({
                                            _token: '{{ csrf_token() }}',
                                            post_id: postId,
                                            duration: duration
                                        }));
                                    }
                                }
                            });
                        });
                    </script>
                </div>


            </div>
        </div>
    </div>
    @if (Auth::check())
    @else
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
    @endif
@endsection
