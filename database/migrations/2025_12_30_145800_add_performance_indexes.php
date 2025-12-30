<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * Thêm indexes để tối ưu performance cho queries thường dùng
     */
    public function up(): void
    {
        // Index cho bảng feed - tối ưu query feed theo user
        Schema::table('feed', function (Blueprint $table) {
            $table->index(['user_id', 'created_at'], 'feed_user_created_idx');
        });

        // Index cho bảng posts - tối ưu query posts theo category và thời gian
        Schema::table('posts', function (Blueprint $table) {
            $table->index(['category'], 'posts_category_idx');
            $table->index(['created_at'], 'posts_created_idx');
        });

        // Index cho bảng likes - tối ưu check like
        Schema::table('likes', function (Blueprint $table) {
            $table->index(['post_id', 'user_id'], 'likes_post_user_idx');
        });

        // Index cho bảng shares - tối ưu check share
        Schema::table('shares', function (Blueprint $table) {
            $table->index(['post_id', 'user_id'], 'shares_post_user_idx');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('feed', function (Blueprint $table) {
            $table->dropIndex('feed_user_created_idx');
        });

        Schema::table('posts', function (Blueprint $table) {
            $table->dropIndex('posts_category_idx');
            $table->dropIndex('posts_created_idx');
        });

        Schema::table('likes', function (Blueprint $table) {
            $table->dropIndex('likes_post_user_idx');
        });

        Schema::table('shares', function (Blueprint $table) {
            $table->dropIndex('shares_post_user_idx');
        });
    }
};
