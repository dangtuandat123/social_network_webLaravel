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

        // ============================================================
        // LOGIC TẠO FEED MỚI
        // ============================================================
        // 1. Với mỗi danh mục (Y tế, Chính trị, Giáo dục):
        //    - Lấy ngẫu nhiên 1 bài từ mỗi lesson (1, 2, 3) → tổng 3 bài/danh mục
        // 2. Lặp các bài theo tỉ lệ random cho từng user:
        //    - Giáo dục: x1, Chính trị: x3, Y tế: x7 (random thứ tự)
        // 3. Danh mục "Khác": lấy tất cả
        // 4. Trộn sao cho bài giống nhau không ở gần nhau

        $categories = ['Giáo dục', 'Chính trị', 'Y tế'];
        $lessons = [1, 2, 3];
        
        // Tỉ lệ lặp - shuffle để mỗi user có thứ tự khác nhau
        $weights = [1, 3, 7];
        shuffle($weights);
        $categoryWeights = array_combine($categories, $weights);

        $feedEntries = [];
        $postGroups = []; // Nhóm các bài theo post_id để trộn sau

        // Bước 1: Lấy bài cho mỗi danh mục (trừ "Khác")
        foreach ($categories as $category) {
            $weight = $categoryWeights[$category];
            
            foreach ($lessons as $lessonNum) {
                // Lấy ngẫu nhiên 1 bài trong lesson này
                $post = Post::where('category', $category)
                    ->where('lesson_number', $lessonNum)
                    ->inRandomOrder()
                    ->first();
                
                if ($post) {
                    // Lặp bài theo weight (1, 3, hoặc 7 lần)
                    for ($i = 0; $i < $weight; $i++) {
                        $postGroups[$post->id][] = [
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
            }
        }

        // Bước 2: Lấy tất cả bài "Khác"
        $otherPosts = Post::where('category', 'Khác')->get();
        foreach ($otherPosts as $post) {
            $postGroups[$post->id][] = [
                'user_id' => Auth::id(),
                'post_id' => $post->id,
                'view' => false,
                'view_duration' => 0,
                'weight' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        // Bước 3: Trộn sao cho bài giống nhau không ở gần nhau
        // Thuật toán: Round-robin lấy từ mỗi nhóm
        $result = [];
        $groupKeys = array_keys($postGroups);
        shuffle($groupKeys); // Random thứ tự các nhóm
        
        $maxIterations = 0;
        foreach ($postGroups as $group) {
            $maxIterations = max($maxIterations, count($group));
        }
        
        for ($i = 0; $i < $maxIterations; $i++) {
            // Mỗi vòng lặp, lấy 1 bài từ mỗi nhóm (nếu còn)
            shuffle($groupKeys); // Shuffle lại để random hơn
            foreach ($groupKeys as $key) {
                if (isset($postGroups[$key][$i])) {
                    $result[] = $postGroups[$key][$i];
                }
            }
        }

        // Shuffle thêm 1 lần cuối để random hơn
        // Nhưng giữ nguyên cấu trúc cơ bản để bài giống nhau không gần nhau
        
        // Insert tất cả feed entries
        if (!empty($result)) {
            Feed::insert($result);
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
