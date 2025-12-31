<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Share;
use Illuminate\Support\Facades\Storage;

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

    /**
     * Cập nhật tên người dùng
     */
    public function updateName(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ], [
            'name.required' => 'Vui lòng nhập tên.',
            'name.max' => 'Tên không được quá 255 ký tự.',
        ]);

        $user = auth()->user();
        $user->name = $request->input('name');
        $user->save();

        return redirect()->route('profile')->with('success', 'Đổi tên thành công!');
    }

    /**
     * Cập nhật avatar người dùng
     */
    public function updateAvatar(Request $request)
    {
        $request->validate([
            'avatar' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:5120', // 5MB
        ], [
            'avatar.required' => 'Vui lòng chọn ảnh đại diện.',
            'avatar.image' => 'File phải là hình ảnh.',
            'avatar.mimes' => 'Chỉ hỗ trợ định dạng: jpeg, png, jpg, gif, webp.',
            'avatar.max' => 'Ảnh không được quá 5MB.',
        ]);

        $user = auth()->user();

        // Xóa avatar cũ nếu có
        if ($user->avatar && Storage::disk('public')->exists($user->avatar)) {
            Storage::disk('public')->delete($user->avatar);
        }

        // Upload avatar mới
        $path = $request->file('avatar')->store('avatars', 'public');
        $user->avatar = $path;
        $user->save();

        return redirect()->route('profile')->with('success', 'Đổi ảnh đại diện thành công!');
    }
}
