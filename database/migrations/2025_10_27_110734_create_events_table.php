<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up(): void
    {
        Schema::create('events', function (Blueprint $table) {
            $table->id();

            // SEO
            $table->string('slug', 255)->unique();

            // Event schedule
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();

            // Opening info
            $table->string('opening_days')->nullable(); // Mon–Fri
            $table->time('opening_time')->nullable();
            $table->time('closing_time')->nullable();


            // City (SAFE)
            $table->foreignId('city_id')
                  ->nullable()
                  ->constrained()
                  ->nullOnDelete();

            // Capacity (NEW)
            $table->integer('capacity')->nullable(); // max people

            // Status (NEW)
            $table->boolean('status')->default(1);

             // 📍 Location
            $table->string('location')->nullable();
            $table->decimal('latitude', 10, 7)->nullable();
            $table->decimal('longitude', 10, 7)->nullable();

            // 🎥 ONE video URL
            $table->string('video_url')->nullable();
            $table->string('url')->nullable();
            $table->foreignId('category_id')->nullable()->constrained('categories')->nullOnDelete();
            // 🔥 CRITICAL
            $table->softDeletes();

            $table->timestamps();

            $table->index('slug');
            $table->index('city_id');
            $table->index('status');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
