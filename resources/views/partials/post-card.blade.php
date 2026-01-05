@if($post)
@php
    // Tạo unique ID - dùng feed_id nếu có, nếu không dùng post_id với random
    $uniqueId = $post->feed_id ?? ($post->id . '-' . uniqid());
@endphp
<article class="post-card" data-feed-id="{{ $post->feed_id ?? '' }}" data-post-id="{{ $post->id }}" data-unique-id="{{ $uniqueId }}">
    
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
        <p class="post-title"><strong>{{ $post->title }}</strong></p>
        @if($post->content)
            @php $contentLength = mb_strlen($post->content); @endphp
            @if($contentLength > 200)
                <p class="post-text" id="content-short-{{ $uniqueId }}">
                    {{ Str::limit($post->content, 200) }}
                    <a href="javascript:void(0)" class="see-more-btn" onclick="toggleContent('{{ $uniqueId }}')">Xem thêm</a>
                </p>
                <p class="post-text" id="content-full-{{ $uniqueId }}" style="display: none;">
                    {{ $post->content }}
                    <a href="javascript:void(0)" class="see-more-btn" onclick="toggleContent('{{ $uniqueId }}')">Thu gọn</a>
                </p>
            @else
                <p class="post-text">{{ $post->content }}</p>
            @endif
        @endif
    </div>
    
    @if(!empty($post->list_img))
        @php $images = array_filter(explode(',', $post->list_img)); @endphp
        @if(count($images) > 0)
            <div class="post-media">
                @if(count($images) === 1)
                    <img src="{{ asset('storage/' . trim($images[0])) }}" alt="" loading="lazy">
                @else
                    <div id="carousel-{{ $uniqueId }}" class="carousel slide" data-bs-ride="false">
                        <div class="carousel-inner">
                            @foreach($images as $i => $img)
                                <div class="carousel-item {{ $i === 0 ? 'active' : '' }}">
                                    <img src="{{ asset('storage/' . trim($img)) }}" alt="" loading="lazy">
                                </div>
                            @endforeach
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#carousel-{{ $uniqueId }}" data-bs-slide="prev"><i class="ri-arrow-left-s-line"></i></button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carousel-{{ $uniqueId }}" data-bs-slide="next"><i class="ri-arrow-right-s-line"></i></button>
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
            <button class="action-btn" data-bs-toggle="modal" data-bs-target="#shareModal-{{ $uniqueId }}">
                <i class="ri-share-forward-line"></i> Chia sẻ
            </button>
        </div>
    @endif
</article>

@if(Auth::check())
<div class="modal fade" id="shareModal-{{ $uniqueId }}" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header border-0 pb-0">
                <h6 class="modal-title fw-semibold">Chia sẻ bài viết</h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form class="share-form" data-post-id="{{ $post->id }}" data-action="{{ route('share.store', $post->id) }}">
                @csrf
                <div class="modal-body py-2">
                    <textarea name="caption" class="form-control" rows="3" placeholder="Viết gì đó..." required></textarea>
                </div>
                <div class="modal-footer border-0 pt-0">
                    <button type="button" class="btn btn-light btn-sm" data-bs-dismiss="modal">Hủy</button>
                    <button type="submit" class="btn btn-primary btn-sm share-submit-btn"><i class="ri-share-forward-line me-1"></i>Chia sẻ</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endif
@endif

