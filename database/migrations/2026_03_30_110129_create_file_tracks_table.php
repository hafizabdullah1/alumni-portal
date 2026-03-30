<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('file_tracks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // The applicant
            $table->string('file_no')->unique()->index();
            $table->string('title');
            $table->string('current_deparment')->default('Registrar Office');
            $table->enum('status', ['pending', 'processing', 'dispatched', 'delivered'])->default('pending');
            $table->text('remarks')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('file_tracks');
    }
};
