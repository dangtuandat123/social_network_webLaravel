<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Share;

class ProfileController extends Controller
{
    public function index(Request $request)
    {
        $user = auth()->user();

        // Lấy shares với caption và post thông tin
        $shares = Share::with(['post.user'])
            ->where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('profile', compact('shares'));
    }
}
