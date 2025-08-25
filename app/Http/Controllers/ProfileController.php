<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post; 
class ProfileController extends Controller
{
    public function index(Request $request)
    {
        $user = auth()->user();

        $posts = $user->sharedPosts;

        return view('profile', compact('posts'));
    }
   
}
