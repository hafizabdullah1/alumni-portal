<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('file_movements', function (Blueprint $table) {
            $table->id();
            $table->foreignId('file_track_id')->constrained()->cascadeOnDelete();
            $table->foreignId('from_department_id')->nullable()->constrained('departments')->nullOnDelete();
            $table->foreignId('to_department_id')->nullable()->constrained('departments')->nullOnDelete();
            $table->foreignId('action_by')->nullable()->constrained('users')->nullOnDelete();
            $table->string('status', 30)->default('pending');
            $table->text('remarks')->nullable();
            $table->timestamp('moved_at')->useCurrent();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('file_movements');
    }
};
