@extends('layouts.app')

@section('content')
<style>
    .profile-container {
        max-width: 700px;
        margin: 0 auto;
        padding: 1.5rem 1rem;
    }
    
    /* Profile Header */
    .profile-header {
        background: var(--bg-card);
        border-radius: var(--radius-lg);
        overflow: hidden;
        margin-bottom: 1.5rem;
        box-shadow: var(--shadow-sm);
        border: 1px solid var(--border-color);
    }
    
    .profile-cover {
        height: 150px;
        background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
    }
    
    .profile-info {
        padding: 0 1.5rem 1.5rem;
        text-align: center;
    }
    
    .profile-avatar-wrapper {
        margin-top: -50px;
        position: relative;
        display: inline-block;
    }
    
    .profile-avatar {
        width: 100px;
        height: 100px;
        border-radius: 50%;
        object-fit: cover;
        border: 4px solid var(--bg-card);
        background: var(--primary);
    }
    
    .profile-avatar-placeholder {
        width: 100px;
        height: 100px;
        border-radius: 50%;
        border: 4px solid var(--bg-card);
        background: var(--primary);
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 2.5rem;
        font-weight: 700;
    }
    
    .avatar-edit-btn {
        position: absolute;
        bottom: 5px;
        right: 5px;
        width: 32px;
        height: 32px;
        border-radius: 50%;
        background: var(--primary);
        color: white;
        border: 2px solid var(--bg-card);
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: all 0.2s;
    }
    .avatar-edit-btn:hover {
        background: var(--primary-dark);
        transform: scale(1.1);
    }
    
    .profile-name {
        margin-top: 1rem;
        font-size: 1.5rem;
        font-weight: 700;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
        flex-wrap: wrap;
    }
    
    .profile-email {
        color: var(--text-muted);
        font-size: 0.9rem;
    }
    
    .profile-stats {
        display: flex;
        justify-content: center;
        gap: 2rem;
        margin-top: 1rem;
        padding-top: 1rem;
        border-top: 1px solid var(--border-color);
    }
    
    .stat-item {
        text-align: center;
    }
    .stat-item .stat-value {
        font-size: 1.25rem;
        font-weight: 700;
        color: var(--text-primary);
    }
    .stat-item .stat-label {
        font-size: 0.8rem;
        color: var(--text-muted);
    }
    
    /* Section Title */
    .section-title {
        font-size: 1.1rem;
        font-weight: 600;
        margin-bottom: 1rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }
    .section-title i {
        color: var(--primary);
    }
    
    /* Shared Post Card */
    .shared-post-card {
        background: var(--bg-card);
        border-radius: var(--radius-lg);
        margin-bottom: 1rem;
        box-shadow: var(--shadow-sm);
        border: 1px solid var(--border-color);
        overflow: hidden;
    }
    
    .share-caption {
        padding: 1rem 1.25rem;
        background: var(--bg-main);
        border-bottom: 1px solid var(--border-color);
    }
    
    .share-caption .share-header {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        margin-bottom: 0.5rem;
    }
    
    .share-caption .avatar {
        width: 36px;
        height: 36px;
        border-radius: 50%;
        object-fit: cover;
    }
    
    .share-caption .user-name {
        font-weight: 600;
        font-size: 0.9rem;
    }
    
    .share-caption .share-date {
        font-size: 0.8rem;
        color: var(--text-muted);
    }
    
    .share-caption .caption-text {
        font-size: 0.95rem;
        line-height: 1.5;
    }
    
    .original-post {
        padding: 1rem 1.25rem;
    }
    
    .original-post .post-header {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        margin-bottom: 0.75rem;
    }
    
    .original-post .avatar {
        width: 38px;
        height: 38px;
        border-radius: 50%;
        object-fit: cover;
    }
    
    .original-post .user-info h6 {
        margin: 0;
        font-weight: 600;
        font-size: 0.9rem;
    }
    
    .original-post .user-info small {
        color: var(--text-muted);
        font-size: 0.75rem;
    }
    
    .original-post .post-title {
        margin-bottom: 0.75rem;
        line-height: 1.5;
    }
    
    .original-post .post-media img {
        width: 100%;
        max-height: 400px;
        object-fit: cover;
        border-radius: var(--radius-sm);
    }
    
    .original-post .post-media video {
        width: 100%;
        max-height: 400px;
        background: #000;
        border-radius: var(--radius-sm);
    }
    
    .shared-post-actions {
        padding: 0.75rem 1.25rem;
        border-top: 1px solid var(--border-color);
        display: flex;
        justify-content: flex-end;
    }
    
    /* Empty State */
    .empty-state {
        text-align: center;
        padding: 3rem 1rem;
        color: var(--text-muted);
    }
    .empty-state i {
        font-size: 4rem;
        margin-bottom: 1rem;
        opacity: 0.5;
    }
    
    /* Responsive */
    @media (max-width: 576px) {
        .profile-container {
            padding: 1rem 0.5rem;
        }
        .profile-name {
            font-size: 1.25rem;
        }
        .profile-stats {
            gap: 1.5rem;
        }
    }
</style>

<div class="profile-container">
    {{-- Success/Error Messages --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="ri-check-line me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="ri-error-warning-line me-2"></i>{{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    {{-- Profile Header --}}
    <div class="profile-header">
        <div class="profile-cover"></div>
        <div class="profile-info">
            <div class="profile-avatar-wrapper">
                @if(Auth::user()->avatar)
                    <img src="{{ asset('storage/' . Auth::user()->avatar) }}" class="profile-avatar" alt="Avatar">
                @else
                    <div class="profile-avatar-placeholder">
                        {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                    </div>
                @endif
                <button type="button" class="avatar-edit-btn" data-bs-toggle="modal" data-bs-target="#changeAvatarModal">
                    <i class="ri-camera-line"></i>
                </button>
            </div>
            
            <div class="profile-name">
                {{ Auth::user()->name }}
                <button type="button" class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#changeNameModal">
                    <i class="ri-pencil-line"></i>
                </button>
            </div>
            <div class="profile-email">{{ Auth::user()->email }}</div>
            
            <div class="profile-stats">
                <div class="stat-item">
                    <div class="stat-value">{{ $shares->count() }}</div>
                    <div class="stat-label">Bài chia sẻ</div>
                </div>
            </div>
        </div>
    </div>
    
    {{-- Shared Posts Section --}}
    <h3 class="section-title">
        <i class="ri-share-forward-line"></i> Bài viết đã chia sẻ
    </h3>
    
    @forelse($shares as $share)
        @if($share->post)
        <article class="shared-post-card">
            {{-- Share Caption --}}
            <div class="share-caption">
                <div class="share-header">
                    @if(Auth::user()->avatar)
                        <img src="{{ asset('storage/' . Auth::user()->avatar) }}" class="avatar" alt="Avatar">
                    @else
                        <div class="avatar d-flex align-items-center justify-content-center" style="background: var(--primary); color: white; font-weight: 600; font-size: 0.9rem;">
                            {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                        </div>
                    @endif
                    <div>
                        <div class="user-name">{{ Auth::user()->name }}</div>
                        <div class="share-date">{{ $share->created_at->diffForHumans() }}</div>
                    </div>
                </div>
                @if($share->caption)
                    <p class="caption-text mb-0">{{ $share->caption }}</p>
                @endif
            </div>
            
            {{-- Original Post --}}
            <div class="original-post">
                <div class="post-header">
                    @if($share->post->user && $share->post->user->avatar)
                        <img src="{{ asset('storage/' . $share->post->user->avatar) }}" class="avatar" alt="Avatar">
                    @else
                        <div class="avatar d-flex align-items-center justify-content-center" style="background: var(--secondary); color: white; font-weight: 600; font-size: 0.85rem;">
                            {{ strtoupper(substr($share->post->user->name ?? 'U', 0, 1)) }}
                        </div>
                    @endif
                    <div class="user-info">
                        <h6>{{ $share->post->user->name ?? 'Unknown' }}</h6>
                        <small>{{ $share->post->created_at->diffForHumans() }}</small>
                    </div>
                </div>
                
                <p class="post-title">{{ $share->post->title }}</p>
                
                {{-- Images --}}
                @if(!empty($share->post->list_img))
                    @php $images = array_filter(explode(',', $share->post->list_img)); @endphp
                    @if(count($images) > 0)
                        <div class="post-media mb-2">
                            <img src="{{ asset('storage/' . trim($images[0])) }}" alt="Post image" loading="lazy">
                        </div>
                    @endif
                @endif
                
                {{-- Videos --}}
                @if(!empty($share->post->list_video))
                    @php $videos = array_filter(explode(',', $share->post->list_video)); @endphp
                    @if(count($videos) > 0)
                        <div class="post-media">
                            <video controls playsinline preload="metadata">
                                <source src="{{ asset('storage/' . trim($videos[0])) }}" type="video/mp4">
                            </video>
                        </div>
                    @endif
                @endif
            </div>
            
            {{-- Actions --}}
            <div class="shared-post-actions">
                <form action="{{ route('post.deleteShare', $share->post->id) }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Xóa bài chia sẻ này?')">
                        <i class="ri-delete-bin-line me-1"></i>Xóa
                    </button>
                </form>
            </div>
        </article>
        @endif
    @empty
        <div class="empty-state">
            <i class="ri-share-forward-line"></i>
            <h5>Chưa có bài chia sẻ</h5>
            <p>Bạn chưa chia sẻ bài viết nào.</p>
            <a href="{{ route('home') }}" class="btn btn-primary mt-2">
                <i class="ri-home-line me-1"></i>Về trang chủ
            </a>
        </div>
    @endforelse
</div>

{{-- Change Name Modal --}}
<div class="modal fade" id="changeNameModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header border-0 pb-0">
                <h5 class="modal-title fw-semibold">
                    <i class="ri-pencil-line me-2 text-primary"></i>Đổi tên hiển thị
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ route('profile.updateName') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <label class="form-label fw-medium">Tên mới</label>
                    <input type="text" class="form-control" name="name" value="{{ Auth::user()->name }}" required maxlength="255">
                </div>
                <div class="modal-footer border-0 pt-0">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Hủy</button>
                    <button type="submit" class="btn btn-primary">
                        <i class="ri-check-line me-1"></i>Lưu
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- Change Avatar Modal --}}
<div class="modal fade" id="changeAvatarModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header border-0 pb-0">
                <h5 class="modal-title fw-semibold">
                    <i class="ri-camera-line me-2 text-primary"></i>Đổi ảnh đại diện
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ route('profile.updateAvatar') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body text-center">
                    <div class="mb-3">
                        @if(Auth::user()->avatar)
                            <img src="{{ asset('storage/' . Auth::user()->avatar) }}" id="avatarPreview" class="rounded-circle" style="width: 120px; height: 120px; object-fit: cover;">
                        @else
                            <div id="avatarPreview" class="rounded-circle d-inline-flex align-items-center justify-content-center" style="width: 120px; height: 120px; background: var(--primary); color: white; font-size: 3rem; font-weight: 700;">
                                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                            </div>
                        @endif
                    </div>
                    <input type="file" class="form-control" name="avatar" id="avatarInput" accept="image/*" required>
                    <small class="text-muted">JPEG, PNG, GIF, WebP. Tối đa 5MB.</small>
                </div>
                <div class="modal-footer border-0 pt-0">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Hủy</button>
                    <button type="submit" class="btn btn-primary">
                        <i class="ri-upload-2-line me-1"></i>Tải lên
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
document.getElementById('avatarInput')?.addEventListener('change', function(e) {
    const file = e.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            const preview = document.getElementById('avatarPreview');
            if (preview.tagName === 'IMG') {
                preview.src = e.target.result;
            } else {
                const img = document.createElement('img');
                img.src = e.target.result;
                img.className = 'rounded-circle';
                img.style = 'width: 120px; height: 120px; object-fit: cover;';
                img.id = 'avatarPreview';
                preview.replaceWith(img);
            }
        };
        reader.readAsDataURL(file);
    }
});
</script>
@endsection
