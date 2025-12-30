<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('posts', function (Blueprint $table) {
            // Thêm cột list_video để lưu đường dẫn video (nullable vì post có thể chỉ có ảnh)
            $table->string('list_video')->nullable()->after('list_img');
        });

        // Sửa list_img thành nullable (post có thể chỉ có video)
        Schema::table('posts', function (Blueprint $table) {
            $table->string('list_img')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->dropColumn('list_video');
        });
    }
};
