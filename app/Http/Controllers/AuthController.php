<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Feed;
use App\Models\Post;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Nette\Utils\Random;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($request->only('email', 'password'))) {
            $request->session()->regenerate();
            return redirect('/home');
        }

        return back()->withErrors(['email' => 'Thông tin đăng nhập không chính xác.']);
    }

    public function showRegisterForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
{
    $validatedData = $request->validate([
        'name' => 'required|max:255',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|min:8|confirmed',
        'gender' => 'required|in:male,female', 
    ], [
        'email.unique' => 'Email đã được sử dụng.',
        'password.confirmed' => 'Xác nhận mật khẩu không khớp.',
        'gender.required' => 'Giới tính là bắt buộc.',
        'gender.in' => 'Giới tính không hợp lệ.',
    ]);

    $user = User::create([
        'name' => $validatedData['name'],
        'email' => $validatedData['email'],
        'password' => Hash::make($validatedData['password']),
        'gender' => $validatedData['gender'], 
    ]);
    Auth::login($user);

    // tao feed 
    $categorys = Post::select('category')->distinct()->pluck('category'); 
    foreach ($categorys as $category ) {
        $posts = Post::where('category', $category)->get();
        $post_random = $posts->shuffle()->take(ceil($posts->count() / 3));
        
        foreach ($post_random as $post) {
            Feed::create([
                'user_id' => Auth::id(),
                'post_id' => $post->id,
                'view' => false,
            ]);
        }

    }

    return redirect('/home');
}

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
