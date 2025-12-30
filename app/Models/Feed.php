<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feed extends Model
{
    use HasFactory;

    // Tên bảng (nếu không theo chuẩn số nhiều của Laravel)
    protected $table = 'feed';

    // Các cột có thể gán giá trị hàng loạt
    protected $fillable = [
        'post_id',
        'user_id',
        'view',
        'view_duration',
        'weight',
    ];

    /**
     * Quan hệ với User
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Quan hệ với Post
     */
    public function post()
    {
        return $this->belongsTo(Post::class);
    }
}
