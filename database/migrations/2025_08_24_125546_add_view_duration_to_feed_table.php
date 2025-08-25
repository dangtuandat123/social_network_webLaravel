<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('feed', function (Blueprint $table) {
            $table->integer('view_duration')->default(0)->after('view'); // tính bằng giây
        });
    }

    public function down(): void
    {
        Schema::table('feed', function (Blueprint $table) {
            $table->dropColumn('view_duration');
        });
    }
};
