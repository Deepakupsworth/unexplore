<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('thing_gallery_images', function (Blueprint $table) {
            $table->id();
            $table->foreignId('thing_id')->constrained('things_to_do')->cascadeOnDelete();
            $table->string('image_path');
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('thing_gallery_images');
    }
};
