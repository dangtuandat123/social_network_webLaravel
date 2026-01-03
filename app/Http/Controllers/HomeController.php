<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;
use App\Models\Share;
use App\Models\Feed;

use App\Models\Like;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Cache;

class HomeController extends Controller
{
    // Số posts per page - có thể điều chỉnh
    private const POSTS_PER_PAGE = 10;

    public function index(Request $request)
    {
        $page = $request->get('page', 1);
        
        if (Auth::check()) {
            $userId = Auth::id();
            $userLevel = Auth::user()->level;
            
            if ($userLevel == 1) {
                // Admin: cache danh sách posts trong 5 phút
                $cacheKey = "admin_posts_page_{$page}";
                $posts = Cache::remember($cacheKey, 300, function () {
                    return Post::with('user')
                        ->orderBy('id', 'desc')
                        ->paginate(self::POSTS_PER_PAGE);
                });
            } else {
                // User thường: lấy feed cá nhân với pagination
                $feeds = Feed::with(['post.user'])
                    ->where('user_id', $userId)
                    ->orderBy('created_at', 'desc')
                    ->paginate(self::POSTS_PER_PAGE);

                // Transform feeds thành posts với feed_id
                $posts = $feeds->through(function ($feed) {
                    $post = $feed->post;
                    
                    if (!$post) {
                        return null;
                    }

                    $postClone = clone $post;
                    $postClone->setAttribute('feed_id', $feed->id);
                    $postClone->setRelation('user', $post->user);

                    return $postClone;
                })->filter();
            }
        } else {
            // Guest: cache danh sách posts trong 5 phút
            $cacheKey = "guest_posts_page_{$page}";
            $posts = Cache::remember($cacheKey, 300, function () {
                return Post::with('user')
                    ->orderBy('id', 'desc')
                    ->paginate(self::POSTS_PER_PAGE);
            });
        }

        return view('home', compact('posts'));
    }
    public function store(Request $request)
    {
        // Validate dữ liệu nhập vào
        // Ảnh hoặc video phải có ít nhất 1 trong 2
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'nullable|string|max:5000',
            'list_img' => 'nullable|array',
            'list_img.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'list_video' => 'nullable|array',
            'list_video.*' => 'mimetypes:video/mp4,video/webm,video/quicktime|max:512000', // 500MB
            'useridpost' => 'required|exists:users,id',
            'category' => 'required|string|in:Giáo dục,Chính trị,Y tế,Khác',
            'lesson_number' => 'nullable|integer|in:1,2,3',
        ]);

        // Upload ảnh (không bắt buộc)
        $imagePaths = [];
        if ($request->hasFile('list_img')) {
            foreach ($request->file('list_img') as $image) {
                $path = $image->store('uploads/images', 'public');
                $imagePaths[] = $path;
            }
        }

        // Upload video
        $videoPaths = [];
        if ($request->hasFile('list_video')) {
            foreach ($request->file('list_video') as $video) {
                $path = $video->store('uploads/videos', 'public');
                $videoPaths[] = $path;
            }
        }

        $post = new Post();
        $post->title = $request->input('title');
        $post->content = $request->input('content');
        $post->list_img = !empty($imagePaths) ? implode(',', $imagePaths) : null;
        $post->list_video = !empty($videoPaths) ? implode(',', $videoPaths) : null;
        $post->useridpost = $request->input('useridpost');
        $post->category = $request->input('category');
        $post->lesson_number = $request->input('lesson_number');

        $post->save();

        // Clear cache để cập nhật danh sách posts
        Cache::flush();

        return redirect('home')->with('success', 'Bài viết đã được tạo thành công!');
    }
    public function deletePost($postId)
    {
        try {
            $post = Post::findOrFail($postId);
            
            // Xóa ảnh
            if ($post->list_img) {
                $images = explode(',', $post->list_img);
                foreach ($images as $image) {
                    $imagePath = public_path('storage/' . trim($image));
                    if (file_exists($imagePath)) {
                        unlink($imagePath);
                    }
                }
            }
            
            // Xóa video
            if ($post->list_video) {
                $videos = explode(',', $post->list_video);
                foreach ($videos as $video) {
                    $videoPath = public_path('storage/' . trim($video));
                    if (file_exists($videoPath)) {
                        unlink($videoPath);
                    }
                }
            }
            
            $post->delete();
            
            // Clear cache để cập nhật danh sách posts
            Cache::flush();
        } catch (\Throwable $th) {
            \Log::error('Delete post failed: ' . $th->getMessage());
            return redirect()->back()->with('error', 'Không thể xóa bài viết này.');
        }

        return redirect()->route('home')->with('success', 'Bài viết đã được xóa thành công!');
    }
    public function shareToProfile(Request $request, $id)
    {
        try {
            $user = auth()->user();
            
            // Validate caption (bắt buộc)
            $request->validate([
                'caption' => 'required|string|max:1000',
            ], [
                'caption.required' => 'Vui lòng nhập caption cho bài chia sẻ.',
            ]);
            
            // Kiểm tra xem đã share chưa
            $existingShare = Share::where('post_id', $id)
                ->where('user_id', $user->id)
                ->first();
            
            if ($existingShare) {
                return redirect()->route('home')->with('info', 'Bạn đã chia sẻ bài viết này rồi.');
            }

            Share::create([
                'post_id' => $id,
                'user_id' => $user->id,
                'caption' => $request->input('caption'),
            ]);
            
            return redirect()->route('home')->with('success', 'Bài viết đã được chia sẻ lên trang cá nhân!');
        } catch (\Throwable $th) {
            \Log::error('Share failed: ' . $th->getMessage());
            return redirect()->route('home')->with('error', 'Không thể chia sẻ bài viết. Vui lòng thử lại.');
        }
    }
    public function deleteShare($postId)
    {
        try {
            $user = auth()->user();
            $share = Share::where('post_id', $postId)->where('user_id', $user->id)->first();

            if ($share) {
                $share->delete();
                return redirect()->route('profile')->with('success', 'Đã xóa chia sẻ thành công.');
            }
            
            return redirect()->route('profile')->with('info', 'Không tìm thấy bài chia sẻ.');
        } catch (\Throwable $th) {
            \Log::error('Delete share failed: ' . $th->getMessage());
            return redirect()->route('profile')->with('error', 'Không thể xóa chia sẻ. Vui lòng thử lại.');
        }
    }
    public function toggleLike($postId)
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Vui lòng đăng nhập để thích bài viết.');
        }

        $user = Auth::user();
        $post = Post::findOrFail($postId);

        $like = Like::where('post_id', $postId)->where('user_id', $user->id)->first();

        if ($like) {
            $like->delete();
            $status = 'unliked';
        } else {
            Like::create([
                'post_id' => $postId,
                'user_id' => $user->id,
            ]);
            $status = 'liked';
        }

        return response()->json(['status' => $status]);
    }

    // Feed
    public function updateDuration(Request $request)
    {
        if (!Auth::check()) {
            return response()->json(['success' => false, 'message' => 'Unauthenticated.'], 401);
        }

        $validated = $request->validate([
            'feed_id' => 'required|integer',
            'duration' => 'required|integer|min:1',
        ]);

        $feed = Feed::where('id', $validated['feed_id'])
            ->where('user_id', Auth::id())
            ->first();

        if (!$feed) {
            return response()->json(['success' => false, 'message' => 'Feed not found.'], 404);
        }

        $feed->view_duration += $validated['duration'];
        $feed->view = true;
        $feed->save();

        return response()->json(['success' => true]);
    }
}
