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
                            <div class="user-detail text-center mb-3">
                                <div class="profile-img">
                                    <img src="https://avatars.fastly.steamstatic.com/79d0a512c5512bf571c21ed9af845382cc595543_full.jpg"
                                        alt="profile-img" class="avatar-130 img-fluid" />
                                </div>
                                <div class="profile-detail">
                                    <h3 class="">{{ Auth::user()->name }}</h3>
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

                                    @if ($posts->isEmpty())
                                        <div class="col-sm-12">
                                            <div class="alert alert-info" role="alert">
                                                Hiện tại không có bài viết nào trên trang cá nhân của bạn.
                                            </div>
                                        </div>
                                    @endif
                                    @foreach ($posts as $post)
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
                                                                            {{ $post->user->name }}</h5>

                                                                        <p class="mb-0 text-primary">
                                                                            {{ $post->created_at->format('d/m/Y H:i') }}

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
                                                    <div class="mt-3">
                                                        <p>
                                                            {{ $post->title }}
                                                        </p>
                                                    </div>
                                                    <div class="user-post">
                                                        <div class="row-span-2 row-span-md-1">
                                                            <img style="max-height: 30rem;object-fit: cover;"
                                                                src="{{ asset('storage/' . $post->list_img) }}"
                                                                alt="post-image" class="img-fluid rounded w-100" />
                                                        </div>



                                                    </div>
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
                                                    @else
                                                        <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
                                                            <symbol id="check-circle-fill" fill="currentColor"
                                                                viewBox="0 0 16 16">
                                                                <path
                                                                    d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z">
                                                                </path>
                                                            </symbol>
                                                            <symbol id="info-fill" fill="currentColor"
                                                                viewBox="0 0 16 16">
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
                                                            <svg class="bi flex-shrink-0 me-2" width="24"
                                                                height="24">
                                                                <use xlink:href="#info-fill"></use>
                                                            </svg>
                                                            <div>
                                                                vui lòng bình luận để tương tác với bài viết!

                                                            </div>
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
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
    </div>
@endsection
