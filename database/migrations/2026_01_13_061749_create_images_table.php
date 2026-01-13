<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('images', function (Blueprint $table) {
            $table->bigIncrements('id');

            // Polymorphic relation
            $table->unsignedBigInteger('imageable_id');
            $table->string('imageable_type');

            // Language support (nullable = common image)
            $table->string('language_code', 10)->nullable();

            // Image data
            $table->string('image_path');

            // Image role
            $table->enum('role', ['thumb', 'gallery', 'banner', 'icon'])
                  ->default('gallery');

            $table->boolean('is_primary')->default(false);
            $table->integer('sort_order')->default(0);

            $table->timestamps();

            // 🔥 PERFORMANCE INDEXES (VERY IMPORTANT)
            $table->index(['imageable_type', 'imageable_id'], 'idx_imageable');
            $table->index('role', 'idx_role');
            $table->index('language_code', 'idx_language');

            // Composite index (FASTEST for real usage)
            $table->index(
                ['imageable_type', 'imageable_id', 'role', 'language_code'],
                'idx_main_lookup'
            );
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('images');
    }
};
