<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('city_translations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('city_id')->constrained('cities')->cascadeOnDelete();
            $table->foreignId('language_id')->constrained('languages')->cascadeOnDelete();
            $table->string('name');
            $table->string('tagline')->nullable();
            $table->text('about')->nullable();
            $table->timestamps();

            $table->unique(['city_id', 'language_id']);
        });
    }

    public function down(): void {
        Schema::dropIfExists('city_translations');
    }
};

