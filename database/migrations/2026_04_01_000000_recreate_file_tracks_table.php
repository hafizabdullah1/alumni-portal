<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Drop the old table first
        Schema::dropIfExists('file_tracks');

        Schema::create('file_tracks', function (Blueprint $table) {
            $table->id();
            // user_id is nullable. If null, it means it's a global file.
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('cascade');
            $table->string('title');
            $table->text('description')->nullable();
            $table->string('file_path');
            $table->boolean('is_global')->default(false);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('file_tracks');
        
        // Re-create the old table if rolling back
        Schema::create('file_tracks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('file_no')->unique()->index();
            $table->string('title');
            $table->string('current_deparment')->default('Registrar Office');
            $table->enum('status', ['pending', 'processing', 'dispatched', 'delivered'])->default('pending');
            $table->text('remarks')->nullable();
            $table->timestamps();
        });
    }
};
