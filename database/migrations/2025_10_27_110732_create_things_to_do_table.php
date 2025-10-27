<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('things_to_do', function (Blueprint $table) {
            $table->id();
            $table->string('slug', 255)->unique();
            $table->string('image')->nullable();
            $table->string('location')->nullable();
            $table->foreignId('city_id')->constrained('cities')->cascadeOnDelete();
            $table->foreignId('category_id')->nullable()->constrained('categories')->nullOnDelete();
            $table->timestamps();

            $table->index('slug');
        });
    }

    public function down(): void {
        Schema::dropIfExists('things_to_do');
    }
};

