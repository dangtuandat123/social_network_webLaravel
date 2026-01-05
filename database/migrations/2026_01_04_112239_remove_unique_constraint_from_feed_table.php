<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     * Xóa unique constraint để cho phép 1 post xuất hiện nhiều lần trong feed
     */
    public function up(): void
    {
        // Sử dụng try-catch để bypass nếu index không tồn tại
        try {
            DB::statement('ALTER TABLE feed DROP INDEX feed_post_id_user_id_unique');
        } catch (\Exception $e) {
            // Index không tồn tại, bỏ qua
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('feed', function (Blueprint $table) {
            // Thêm lại unique constraint
            $table->unique(['post_id', 'user_id']);
        });
    }
};
