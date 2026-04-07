<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('file_tracks', function (Blueprint $table) {
            $table->foreignId('current_department_id')->nullable()->after('user_id')->constrained('departments')->nullOnDelete();
            $table->string('tracking_no')->nullable()->unique()->after('id');
            $table->string('status', 30)->default('pending')->after('is_global');
            $table->timestamp('last_action_at')->nullable()->after('status');
            $table->dropColumn(['file_path']);
        });
    }

    public function down(): void
    {
        Schema::table('file_tracks', function (Blueprint $table) {
            $table->string('file_path')->nullable();
            $table->dropForeign(['current_department_id']);
            $table->dropColumn(['current_department_id', 'tracking_no', 'status', 'last_action_at']);
        });
    }
};
