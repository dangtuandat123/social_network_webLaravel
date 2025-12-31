@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body profile-page p-0">
                        <div class="profile-header">
                            <div class="position-relative">
                                <img src="{{ asset('template_assets/images/page-img/pr') }}ofile-bg1.jpg" alt="profile-bg"
                                    class="rounded img-fluid">
                                <ul class="header-nav list-inline d-flex flex-wrap justify-end p-0 m-0">
                                    <li><a href="#"><i class="ri-pencil-line"></i></a></li>
                                    <li><a href="#"><i class="ri-settings-4-line"></i></a></li>
                                </ul>
                            </div>
                            <div class="user-detail text-center mb-3" style="position: relative; z-index: 10;">
                                <div class="profile-img position-relative d-inline-block">
                                    @if(Auth::user()->avatar)
                                        <img src="{{ asset('storage/' . Auth::user()->avatar) }}"
                                            alt="profile-img" class="avatar-130 img-fluid rounded-circle" style="width: 130px; height: 130px; object-fit: cover;" />
                                    @else
                                        <img src="{{ asset('template_assets/images/user/01.jpg') }}"
                                            alt="profile-img" class="avatar-130 img-fluid rounded-circle" style="width: 130px; height: 130px; object-fit: cover;" />
                                    @endif
                                    <button type="button" class="btn btn-sm btn-primary position-absolute" 
                                        style="bottom: 5px; right: 5px; border-radius: 50%; width: 36px; height: 36px; z-index: 20;"
                                        data-bs-toggle="modal" data-bs-target="#changeAvatarModal">
                                        <i class="ri-camera-line"></i>
                                    </button>
                                </div>
                                <div class="profile-detail mt-3">
                                    <h3 class="d-inline-block mb-0">{{ Auth::user()->name }}</h3>
                                    <button type="button" class="btn btn-sm btn-outline-primary ms-2" 
                                        style="z-index: 20; position: relative;"
                                        data-bs-toggle="modal" data-bs-target="#changeNameModal">
                                        <i class="ri-edit-line"></i> Đổi tên
                                    </button>
                                </div>
                            </div>
                            <div
                                class="profile-info p-3 d-flex align-items-center justify-content-between position-relative">
                                <div class="social-links">
                                    <ul
                                        class="social-data-block d-flex align-items-center justify-content-between list-inline p-0 m-0">
                                        <li class="text-center pe-3">
                                            <a href="#"><img src="{{ asset('template_assets/images/icon/08.png') }}"
                                                    class="img-fluid rounded" alt="facebook"></a>
                                        </li>
                                        <li class="text-center pe-3">
                                            <a href="#"><img src="{{ asset('template_assets/images/icon/09.png') }}"
                                                    class="img-fluid rounded" alt="Twitter"></a>
                                        </li>
                                        <li class="text-center pe-3">
                                            <a href="#"><img src="{{ asset('template_assets/images/icon/10.png') }}"
                                                    class="img-fluid rounded" alt="Instagram"></a>
                                        </li>
                                        <li class="text-center pe-3">
                                            <a href="#"><img src="{{ asset('template_assets/images/icon/11.png') }}"
                                                    class="img-fluid rounded" alt="Google plus"></a>
                                        </li>
                                        <li class="text-center pe-3">
                                            <a href="#"><img src="{{ asset('template_assets/images/icon/12.png') }}"
                                                    class="img-fluid rounded" alt="You tube"></a>
                                        </li>
                                        <li class="text-center md-pe-3 pe-0">
                                            <a href="#"><img src="{{ asset('template_assets/images/icon/13.png') }}"
                                                    class="img-fluid rounded" alt="linkedin"></a>
                                        </li>
                                    </ul>
                                </div>
                                {{-- <div class="social-info">
                        <ul class="social-data-block d-flex align-items-center justify-content-between list-inline p-0 m-0">
                           <li class="text-center ps-3">
                              <h6>Posts</h6>
                              <p class="mb-0">690</p>
                           </li>
                           <li class="text-center ps-3">
                              <h6>Followers</h6>
                              <p class="mb-0">206</p>
                           </li>
                           <li class="text-center ps-3">
                              <h6>Following</h6>
                              <p class="mb-0">100</p>
                           </li>
                        </ul>
                     </div> --}}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body p-0">
                        <ul
                            class="nav nav-pills d-flex align-items-center justify-content-center profile-feed-items p-0 m-0">
                            <li class="nav-item col-12 col-sm-6 p-0">
                                <a class="nav-link active" href="#pills-timeline-tab" data-bs-toggle="pill"
                                    data-bs-target="#timeline" role="button">Timeline</a>
                            </li>
                            <li class="nav-item col-12 col-sm-6 p-0">
                                <a class="nav-link" href="#pills-about-tab" data-bs-toggle="pill" data-bs-target="#about"
                                    role="button">About</a>
                            </li>

                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-sm-12">
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="timeline" role="tabpanel">
                        <div class="card-body p-0">
                            <div class="row d-flex align-items-center justify-content-center">

                                <div class="col-sm-9 ">

                                    @if ($shares->isEmpty())
                                        <div class="col-sm-12">
                                            <div class="alert alert-info" role="alert">
                                                Hiện tại không có bài viết nào trên trang cá nhân của bạn.
                                            </div>
                                        </div>
                                    @endif
                                    @foreach ($shares as $share)
                                        @php $post = $share->post; @endphp
                                        @if($post)
                                        <div class="col-sm-12">
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
                                                                        <h5 class="mb-0 d-inline-block">
                                                                            {{ Auth::user()->name }}</h5>
                                                                        <span class="text-muted">đã chia sẻ bài viết của</span>
                                                                        <span class="text-primary fw-semibold">{{ $post->user->name ?? 'Unknown' }}</span>
                                                                        <p class="mb-0 text-muted">
                                                                            {{ $share->created_at->format('d/m/Y H:i') }}
                                                                        </p>
                                                                    </div>
                                                                    <div class="card-post-toolbar">
                                                                        <div class="dropdown">
                                                                            <span class="dropdown-toggle"
                                                                                data-bs-toggle="dropdown"
                                                                                aria-haspopup="true" aria-expanded="false"
                                                                                role="button">
                                                                                <i class="ri-more-fill"></i>
                                                                            </span>
                                                                            <div class="dropdown-menu m-0 p-0">
                                                                                <form
                                                                                    action="{{ route('post.deleteShare', $post->id) }}"
                                                                                    method="POST">
                                                                                    @csrf

                                                                                    <button type="submit"
                                                                                        style="background-color: beige"
                                                                                        class="dropdown-item p-3"
                                                                                        href="#">
                                                                                        <div
                                                                                            class="d-flex align-items-top">
                                                                                            <i
                                                                                                class="ri-close-circle-line h4"></i>
                                                                                            <div class="data ms-2">
                                                                                                <h6>Xóa</h6>
                                                                                                <p class="mb-0">
                                                                                                    Xóa bài viết
                                                                                                    khỏi trang cá
                                                                                                    nhân.
                                                                                                </p>
                                                                                            </div>
                                                                                        </div>
                                                                                    </button>

                                                                                </form>

                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    
                                                    {{-- Caption của người share --}}
                                                    @if($share->caption)
                                                        <div class="mt-3 p-3 bg-light rounded">
                                                            <p class="mb-0 fst-italic">"{{ $share->caption }}"</p>
                                                        </div>
                                                    @endif
                                                    
                                                    {{-- Nội dung bài viết gốc --}}
                                                    <div class="mt-3 border-start border-3 border-primary ps-3">
                                                        <p class="fw-semibold mb-2">{{ $post->title }}</p>
                                                    </div>
                                                    
                                                    {{-- Hiển thị ảnh --}}
                                                    @if(!empty($post->list_img))
                                                        @php
                                                            $images = array_filter(explode(',', $post->list_img));
                                                        @endphp
                                                        <div class="user-post mt-3">
                                                            @if(count($images) === 1)
                                                                <img style="max-height: 30rem; object-fit: cover;"
                                                                    src="{{ asset('storage/' . trim($images[0])) }}"
                                                                    alt="post-image" class="img-fluid rounded w-100" loading="lazy" />
                                                            @else
                                                                <div id="profile-carousel-{{ $share->id }}" class="carousel slide" data-bs-ride="carousel">
                                                                    <div class="carousel-inner">
                                                                        @foreach($images as $index => $image)
                                                                            <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                                                                                <img src="{{ asset('storage/' . trim($image)) }}" 
                                                                                    alt="post-image" 
                                                                                    class="d-block w-100" 
                                                                                    loading="lazy"
                                                                                    style="max-height: 30rem; object-fit: cover; border-radius: 12px;">
                                                                            </div>
                                                                        @endforeach
                                                                    </div>
                                                                    <button class="carousel-control-prev" type="button" data-bs-target="#profile-carousel-{{ $share->id }}" data-bs-slide="prev">
                                                                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                                                    </button>
                                                                    <button class="carousel-control-next" type="button" data-bs-target="#profile-carousel-{{ $share->id }}" data-bs-slide="next">
                                                                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                                                    </button>
                                                                </div>
                                                            @endif
                                                        </div>
                                                    @endif
                                                    
                                                    {{-- Hiển thị video --}}
                                                    @if(!empty($post->list_video))
                                                        @php
                                                            $videos = array_filter(explode(',', $post->list_video));
                                                        @endphp
                                                        <div class="user-post mt-3">
                                                            @foreach($videos as $video)
                                                                <div class="video-container mb-2" style="border-radius: 12px; overflow: hidden;">
                                                                    <video 
                                                                        class="auto-play-video"
                                                                        controls 
                                                                        playsinline
                                                                        preload="metadata"
                                                                        style="width: 100%; max-height: 30rem; background: #000;">
                                                                        <source src="{{ asset('storage/' . trim($video)) }}" type="video/mp4">
                                                                        <source src="{{ asset('storage/' . trim($video)) }}" type="video/webm">
                                                                        Trình duyệt không hỗ trợ video.
                                                                    </video>
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                    @endif
                                                    
                                                    @if (Auth::check())
                                                        <div class="comment-area mt-3">
                                                            <div
                                                                class="d-flex justify-content-between align-items-center flex-wrap">
                                                                <div
                                                                    class="like-block position-relative d-flex align-items-center">
                                                                    <div class="d-flex align-items-center">
                                                                        <div class="like-data">
                                                                            <!-- Nút Like -->
                                                                            <button type="button"
                                                                                style="background-color: white; border: none;"
                                                                                class="btn btn-info"
                                                                                id="like-btn-{{ $post->id }}"
                                                                                data-post-id="{{ $post->id }}">
                                                                                <!-- Hình ảnh Like -->
                                                                                <img src="{{ auth()->user()->hasLiked($post) ? asset('template_assets/images/heart.png') : asset('template_assets/images/heart (1).png') }}"
                                                                                    alt="like-icon"
                                                                                    style="width: 26px;height: 26px;" />
                                                                            </button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        @endif
                                    @endforeach
                                    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
                                        });
                                    </script>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="about" role="tabpanel">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-3">
                                        <ul class="nav nav-pills basic-info-items list-inline d-block p-0 m-0">
                                            <li>
                                                <a class="nav-link active" href="#v-pills-basicinfo-tab"
                                                    data-bs-toggle="pill" data-bs-target="#v-pills-basicinfo-tab"
                                                    role="button">Contact and Basic Info</a>
                                            </li>
                                            <li>
                                                <a class="nav-link" href="#v-pills-family-tab" data-bs-toggle="pill"
                                                    data-bs-target="#v-pills-family" role="button">Family and
                                                    Relationship</a>
                                            </li>
                                            <li>
                                                <a class="nav-link" href="#v-pills-work-tab" data-bs-toggle="pill"
                                                    data-bs-target="#v-pills-work-tab" role="button">Work and
                                                    Education</a>
                                            </li>
                                            <li>
                                                <a class="nav-link" href="#v-pills-lived-tab" data-bs-toggle="pill"
                                                    data-bs-target="#v-pills-lived-tab" role="button">Places You've
                                                    Lived</a>
                                            </li>
                                            <li>
                                                <a class="nav-link" href="#v-pills-details-tab" data-bs-toggle="pill"
                                                    data-bs-target="#v-pills-details-tab" role="button">Details About
                                                    You</a>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="col-md-9 ps-4">
                                        <div class="tab-content">
                                            <div class="tab-pane fade active show" id="v-pills-basicinfo-tab"
                                                role="tabpanel" aria-labelledby="v-pills-basicinfo-tab">
                                                <h4>Contact Information</h4>
                                                <hr>
                                                <div class="row">
                                                    <div class="col-3">
                                                        <h6>Email</h6>
                                                    </div>
                                                    <div class="col-9">
                                                        <p class="mb-0">Bnijohn@gmail.com</p>
                                                    </div>
                                                    <div class="col-3">
                                                        <h6>Mobile</h6>
                                                    </div>
                                                    <div class="col-9">
                                                        <p class="mb-0">(001) 4544 565 456</p>
                                                    </div>
                                                    <div class="col-3">
                                                        <h6>Address</h6>
                                                    </div>
                                                    <div class="col-9">
                                                        <p class="mb-0">United States of America</p>
                                                    </div>
                                                </div>
                                                <h4 class="mt-3">Websites and Social Links</h4>
                                                <hr>
                                                <div class="row">
                                                    <div class="col-3">
                                                        <h6>Website</h6>
                                                    </div>
                                                    <div class="col-9">
                                                        <p class="mb-0">www.bootstrap.com</p>
                                                    </div>
                                                    <div class="col-3">
                                                        <h6>Social Link</h6>
                                                    </div>
                                                    <div class="col-9">
                                                        <p class="mb-0">www.bootstrap.com</p>
                                                    </div>
                                                </div>
                                                <h4 class="mt-3">Basic Information</h4>
                                                <hr>
                                                <div class="row">
                                                    <div class="col-3">
                                                        <h6>Birth Date</h6>
                                                    </div>
                                                    <div class="col-9">
                                                        <p class="mb-0">24 January</p>
                                                    </div>
                                                    <div class="col-3">
                                                        <h6>Birth Year</h6>
                                                    </div>
                                                    <div class="col-9">
                                                        <p class="mb-0">1994</p>
                                                    </div>
                                                    <div class="col-3">
                                                        <h6>Gender</h6>
                                                    </div>
                                                    <div class="col-9">
                                                        <p class="mb-0">Female</p>
                                                    </div>
                                                    <div class="col-3">
                                                        <h6>interested in</h6>
                                                    </div>
                                                    <div class="col-9">
                                                        <p class="mb-0">Designing</p>
                                                    </div>
                                                    <div class="col-3">
                                                        <h6>language</h6>
                                                    </div>
                                                    <div class="col-9">
                                                        <p class="mb-0">English, French</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="tab-pane fade" id="v-pills-family" role="tabpanel">
                                                <h4 class="mb-3">Relationship</h4>
                                                <ul class="suggestions-lists m-0 p-0">
                                                    <li class="d-flex mb-4 align-items-center">
                                                        <div class="user-img img-fluid"><i class="ri-add-fill"></i></div>
                                                        <div class="media-support-info ms-3">
                                                            <h6>Add Your Relationship Status</h6>
                                                        </div>
                                                    </li>
                                                </ul>
                                                <h4 class="mt-3 mb-3">Family Members</h4>
                                                <ul class="suggestions-lists m-0 p-0">
                                                    <li class="d-flex mb-4 align-items-center">
                                                        <div class="user-img img-fluid"><i class="ri-add-fill"></i></div>
                                                        <div class="media-support-info ms-3">
                                                            <h6>Add Family Members</h6>
                                                        </div>
                                                    </li>
                                                    <li class="d-flex mb-4 align-items-center justify-content-between">
                                                        <div class="user-img img-fluid"><img
                                                                src="{{ asset('template_assets/images/user/01.jpg') }}"
                                                                alt="story-img" class="rounded-circle avatar-40"></div>
                                                        <div class="w-100">
                                                            <div class="d-flex justify-content-between">
                                                                <div class="ms-3">
                                                                    <h6>Paul Molive</h6>
                                                                    <p class="mb-0">Brothe</p>
                                                                </div>
                                                                <div class="edit-relation"><a href="#"><i
                                                                            class="ri-edit-line me-2"></i>Edit</a></div>
                                                            </div>
                                                        </div>
                                                    </li>
                                                    <li class="d-flex justify-content-between mb-4  align-items-center">
                                                        <div class="user-img img-fluid"><img
                                                                src="{{ asset('template_assets/images/user/02.jpg') }}"
                                                                alt="story-img" class="rounded-circle avatar-40"></div>
                                                        <div class="w-100">
                                                            <div class="d-flex flex-wrap justify-content-between">
                                                                <div class=" ms-3">
                                                                    <h6>Anna Mull</h6>
                                                                    <p class="mb-0">Sister</p>
                                                                </div>
                                                                <div class="edit-relation"><a href="#"><i
                                                                            class="ri-edit-line me-2"></i>Edit</a></div>
                                                            </div>
                                                        </div>
                                                    </li>
                                                    <li class="d-flex mb-4 align-items-center justify-content-between">
                                                        <div class="user-img img-fluid"><img
                                                                src="{{ asset('template_assets/images/user/03.jpg') }}"
                                                                alt="story-img" class="rounded-circle avatar-40"></div>
                                                        <div class="w-100">
                                                            <div class="d-flex justify-content-between">
                                                                <div class="ms-3">
                                                                    <h6>Paige Turner</h6>
                                                                    <p class="mb-0">Cousin</p>
                                                                </div>
                                                                <div class="edit-relation"><a href="#"><i
                                                                            class="ri-edit-line me-2"></i>Edit</a></div>
                                                            </div>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="tab-pane fade" id="v-pills-work-tab" role="tabpanel"
                                                aria-labelledby="v-pills-work-tab">
                                                <h4 class="mb-3">Work</h4>
                                                <ul class="suggestions-lists m-0 p-0">
                                                    <li class="d-flex justify-content-between mb-4  align-items-center">
                                                        <div class="user-img img-fluid"><i class="ri-add-fill"></i></div>
                                                        <div class="ms-3">
                                                            <h6>Add Work Place</h6>
                                                        </div>
                                                    </li>
                                                    <li class="d-flex mb-4 align-items-center justify-content-between">
                                                        <div class="user-img img-fluid"><img
                                                                src="{{ asset('template_assets/images/user/01.jpg') }}"
                                                                alt="story-img" class="rounded-circle avatar-40"></div>
                                                        <div class="w-100">
                                                            <div class="d-flex justify-content-between">
                                                                <div class="ms-3">
                                                                    <h6>Themeforest</h6>
                                                                    <p class="mb-0">Web Designer</p>
                                                                </div>
                                                                <div class="edit-relation"><a href="#"><i
                                                                            class="ri-edit-line me-2"></i>Edit</a></div>
                                                            </div>
                                                        </div>
                                                    </li>
                                                    <li class="d-flex mb-4 align-items-center justify-content-between">
                                                        <div class="user-img img-fluid"><img
                                                                src="{{ asset('template_assets/images/user/02.jpg') }}"
                                                                alt="story-img" class="rounded-circle avatar-40"></div>
                                                        <div class="w-100">
                                                            <div class="d-flex flex-wrap justify-content-between">
                                                                <div class="ms-3">
                                                                    <h6>iqonicdesign</h6>
                                                                    <p class="mb-0">Web Developer</p>
                                                                </div>
                                                                <div class="edit-relation"><a href="#"><i
                                                                            class="ri-edit-line me-2"></i>Edit</a></div>
                                                            </div>
                                                        </div>
                                                    </li>
                                                    <li class="d-flex mb-4 align-items-center justify-content-between">
                                                        <div class="user-img img-fluid"><img
                                                                src="{{ asset('template_assets/images/user/03.jpg') }}"
                                                                alt="story-img" class="rounded-circle avatar-40"></div>
                                                        <div class="w-100">
                                                            <div class="d-flex flex-wrap justify-content-between">
                                                                <div class="ms-3">
                                                                    <h6>W3school</h6>
                                                                    <p class="mb-0">Designer</p>
                                                                </div>
                                                                <div class="edit-relation"><a href="#"><i
                                                                            class="ri-edit-line me-2"></i>Edit</a></div>
                                                            </div>
                                                        </div>
                                                    </li>
                                                </ul>
                                                <h4 class="mb-3">Professional Skills</h4>
                                                <ul class="suggestions-lists m-0 p-0">
                                                    <li class="d-flex mb-4 align-items-center">
                                                        <div class="user-img img-fluid"><i class="ri-add-fill"></i></div>
                                                        <div class="ms-3">
                                                            <h6>Add Professional Skills</h6>
                                                        </div>
                                                    </li>
                                                </ul>
                                                <h4 class="mt-3 mb-3">College</h4>
                                                <ul class="suggestions-lists m-0 p-0">
                                                    <li class="d-flex mb-4 align-items-center">
                                                        <div class="user-img img-fluid"><i class="ri-add-fill"></i></div>
                                                        <div class="ms-3">
                                                            <h6>Add College</h6>
                                                        </div>
                                                    </li>
                                                    <li class="d-flex mb-4 align-items-center">
                                                        <div class="user-img img-fluid"><img
                                                                src="{{ asset('template_assets/images/user/01.jpg') }}"
                                                                alt="story-img" class="rounded-circle avatar-40"></div>
                                                        <div class="w-100">
                                                            <div class="d-flex flex-wrap justify-content-between">
                                                                <div class="ms-3">
                                                                    <h6>Lorem ipsum</h6>
                                                                    <p class="mb-0">USA</p>
                                                                </div>
                                                                <div class="edit-relation"><a href="#"><i
                                                                            class="ri-edit-line me-2"></i>Edit</a></div>
                                                            </div>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="tab-pane fade" id="v-pills-lived-tab" role="tabpanel"
                                                aria-labelledby="v-pills-lived-tab">
                                                <h4 class="mb-3">Current City and Hometown</h4>
                                                <ul class="suggestions-lists m-0 p-0">
                                                    <li class="d-flex mb-4 align-items-center justify-content-between">
                                                        <div class="user-img img-fluid"><img
                                                                src="{{ asset('template_assets/images/user/01.jpg') }}"
                                                                alt="story-img" class="rounded-circle avatar-40"></div>
                                                        <div class="w-100">
                                                            <div class="d-flex flex-wrap justify-content-between">
                                                                <div class="ms-3">
                                                                    <h6>Georgia</h6>
                                                                    <p class="mb-0">Georgia State</p>
                                                                </div>
                                                                <div class="edit-relation"><a href="#"><i
                                                                            class="ri-edit-line me-2"></i>Edit</a></div>
                                                            </div>
                                                        </div>
                                                    </li>
                                                    <li class="d-flex mb-4 align-items-center justify-content-between">
                                                        <div class="user-img img-fluid"><img
                                                                src="{{ asset('template_assets/images/user/02.jpg') }}"
                                                                alt="story-img" class="rounded-circle avatar-40"></div>
                                                        <div class="w-100">
                                                            <div class="d-flex flex-wrap justify-content-between">
                                                                <div class="ms-3">
                                                                    <h6>Atlanta</h6>
                                                                    <p class="mb-0">Atlanta City</p>
                                                                </div>
                                                                <div class="edit-relation"><a href="#"><i
                                                                            class="ri-edit-line me-2"></i>Edit</a></div>
                                                            </div>
                                                        </div>
                                                    </li>
                                                </ul>
                                                <h4 class="mt-3 mb-3">Other Places Lived</h4>
                                                <ul class="suggestions-lists m-0 p-0">
                                                    <li class="d-flex mb-4 align-items-center">
                                                        <div class="user-img img-fluid"><i class="ri-add-fill"></i></div>
                                                        <div class="ms-3">
                                                            <h6>Add Place</h6>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="tab-pane fade" id="v-pills-details-tab" role="tabpanel"
                                                aria-labelledby="v-pills-details-tab">
                                                <h4 class="mb-3">About You</h4>
                                                <p>Hi, I’m Bni, I’m 26 and I work as a Web Designer for the iqonicdesign.
                                                </p>
                                                <h4 class="mt-3 mb-3">Other Name</h4>
                                                <p>Bini Rock</p>
                                                <h4 class="mt-3 mb-3">Favorite Quotes</h4>
                                                <p>Lorem Ipsum is simply dummy text of the printing and typesetting
                                                    industry. Lorem Ipsum has been the industry's standard dummy text ever
                                                    since the 1500s</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                </div>
            </div>
            {{-- <div class="col-sm-12 text-center">
         <img src="{{ asset('template_assets/images/page-img/page-load-loader.gif')}}" alt="loader" style="height: 100px;">
      </div> --}}
    </div>

    {{-- Modal Đổi Tên --}}
    <div class="modal fade" id="changeNameModal" tabindex="-1" aria-labelledby="changeNameModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content rounded-4 border-0 shadow-lg">
                <div class="modal-header border-0">
                    <h5 class="modal-title fw-semibold" id="changeNameModalLabel">
                        <i class="ri-edit-line me-2"></i>Đổi tên hiển thị
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('profile.updateName') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="name" class="form-label fw-semibold">Tên mới</label>
                            <input type="text" class="form-control form-control-lg" name="name" id="name" 
                                value="{{ Auth::user()->name }}" required maxlength="255" 
                                placeholder="Nhập tên hiển thị mới">
                        </div>
                    </div>
                    <div class="modal-footer border-0">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                        <button type="submit" class="btn btn-primary">
                            <i class="ri-check-line me-1"></i>Lưu thay đổi
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Modal Đổi Avatar --}}
    <div class="modal fade" id="changeAvatarModal" tabindex="-1" aria-labelledby="changeAvatarModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content rounded-4 border-0 shadow-lg">
                <div class="modal-header border-0">
                    <h5 class="modal-title fw-semibold" id="changeAvatarModalLabel">
                        <i class="ri-camera-line me-2"></i>Đổi ảnh đại diện
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('profile.updateAvatar') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="text-center mb-3">
                            <div class="avatar-preview mb-3">
                                @if(Auth::user()->avatar)
                                    <img src="{{ asset('storage/' . Auth::user()->avatar) }}" id="avatarPreview"
                                        class="rounded-circle" style="width: 150px; height: 150px; object-fit: cover;">
                                @else
                                    <img src="{{ asset('template_assets/images/user/01.jpg') }}" id="avatarPreview"
                                        class="rounded-circle" style="width: 150px; height: 150px; object-fit: cover;">
                                @endif
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="avatar" class="form-label fw-semibold">Chọn ảnh mới</label>
                            <input type="file" class="form-control" name="avatar" id="avatar" 
                                accept="image/jpeg,image/png,image/jpg,image/gif,image/webp" required>
                            <small class="text-muted">Hỗ trợ: JPEG, PNG, GIF, WebP. Tối đa 5MB.</small>
                        </div>
                    </div>
                    <div class="modal-footer border-0">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                        <button type="submit" class="btn btn-primary">
                            <i class="ri-upload-2-line me-1"></i>Tải lên
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Thông báo --}}
    @if(session('success'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                alert('{{ session('success') }}');
            });
        </script>
    @endif
    @if(session('error'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                alert('{{ session('error') }}');
            });
        </script>
    @endif

    {{-- Script preview avatar --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const avatarInput = document.getElementById('avatar');
            const avatarPreview = document.getElementById('avatarPreview');
            
            if (avatarInput && avatarPreview) {
                avatarInput.addEventListener('change', function(e) {
                    const file = e.target.files[0];
                    if (file) {
                        const reader = new FileReader();
                        reader.onload = function(e) {
                            avatarPreview.src = e.target.result;
                        };
                        reader.readAsDataURL(file);
                    }
                });
            }
        });
    </script>
@endsection
