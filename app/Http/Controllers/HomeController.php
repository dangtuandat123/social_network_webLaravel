<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;
use App\Models\Share;
use App\Models\Feed;

use App\Models\Like;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        if (Auth::check()) {
            if (Auth::user()->level == 1) {
                $posts = Post::with('user')->orderBy('id', 'desc')->get();
            } else {
                $posts = Feed::with(['post.user'])
                    ->where('user_id', Auth::id())
                    ->orderBy('created_at', 'desc')
                    ->get()
                    ->map(function ($feed) {
                        $post = $feed->post;

                        if (!$post) {
                            return null;
                        }

                        $postClone = clone $post;
                        $postClone->setAttribute('feed_id', $feed->id);
                        $postClone->setRelation('user', $post->user);

                        return $postClone;
                    })
                    ->filter()
                    ->values();
                // die($posts);
             
            }
        } else {
            $posts = Post::with('user')->orderBy('id', 'desc')->get();
        }

        return view('home', compact('posts'));
    }
    public function store(Request $request)
    {
        // Validate dữ liệu nhập vào
        $request->validate([
            'title' => 'required|string|max:255',
            'list_img' => 'required|array',
            'list_img.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'useridpost' => 'required|exists:users,id',
            'fakeorreal' => 'required|string|in:real,fake',
        ]);

        $imagePaths = [];
        if ($request->hasFile('list_img')) {
            foreach ($request->file('list_img') as $image) {
                $path = $image->store('uploads', 'public');
                $imagePaths[] = $path;
            }
        }

        $post = new Post();
        $post->title = $request->input('title');
        $post->list_img = implode(',', $imagePaths);
        $post->useridpost = $request->input('useridpost');
        $post->fakeorreal = $request->input('fakeorreal');
        $post->category = $request->input('category');

        $post->save();


        return redirect('home');
    }
    public function deletePost($postId)
    {
        try {
            $post = Post::findOrFail($postId);
            $img = $post->list_img;
            if ($img) {
                $images = explode(',', $img);
                foreach ($images as $image) {
                    $imagePath = public_path('storage/' . $image);
                    if (file_exists($imagePath)) {
                        //xoa file 
                        unlink($imagePath);
                    }
                }
            }
            $post->delete();
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Không thể xóa bài viết này.');
        }

        return redirect()->route('home')->with('success', 'Bài viết đã được xóa thành công!');
    }
    public function shareToProfile($id)
    {
        try {
            $user = auth()->user();

            Share::create([
                'post_id' => $id,
                'user_id' => $user->id,
            ]);
        } catch (\Throwable $th) {
        }

        return redirect()->route('home')->with('success', 'Bài viết đã được chia sẻ lên trang cá nhân!');
    }
    public function deleteShare($postId)
    {
        try {
            $user = auth()->user();
            $Share = Share::where('post_id', $postId)->where('user_id', $user->id)->first();

            if ($Share) {
                $Share->delete();
            }
        } catch (\Throwable $th) {
        }

        return redirect()->route('profile');
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
