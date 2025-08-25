<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'list_img',
        'useridpost',
        'fakeorreal',
    ];

    // Nếu 'list_img' là JSON, bạn có thể muốn sử dụng cast
    // protected $casts = [
    //     'list_img' => 'array',
    // ];
    public function user()
    {
        return $this->belongsTo(User::class, 'useridpost');
    }
}
