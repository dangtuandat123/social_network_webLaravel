<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Feed;
use App\Models\Post;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

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

        // Tạo feed với weight thay vì duplicate entries
        // Weight đại diện cho tần suất hiển thị: Giáo dục x1, Chính trị x3, Y tế x7
        $categoryWeights = [
            'Giáo dục' => 1,
            'Chính trị' => 3,
            'Y tế' => 7,
            'Khác' => 1,
        ];

        $feedEntries = [];

        foreach ($categoryWeights as $category => $weight) {
            $posts = Post::where('category', $category)->get();
            
            // Lấy 1/3 số posts của mỗi category (trừ "Khác" lấy tất cả)
            if ($category === 'Khác') {
                $selectedPosts = $posts;
            } else {
                $selectedPosts = $posts->shuffle()->take(max(1, round($posts->count() / 3)));
            }

            foreach ($selectedPosts as $post) {
                $feedEntries[] = [
                    'user_id' => Auth::id(),
                    'post_id' => $post->id,
                    'view' => false,
                    'view_duration' => 0,
                    'weight' => $weight,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }
        }

        // Shuffle để trộn các category với nhau
        shuffle($feedEntries);

        // Insert tất cả feed entries (không có duplicate vì mỗi post_id chỉ xuất hiện 1 lần)
        Feed::insert($feedEntries);

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
