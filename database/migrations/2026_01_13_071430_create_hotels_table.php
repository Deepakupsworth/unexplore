<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up(): void
    {
        Schema::create('hotels', function (Blueprint $table) {

            $table->bigIncrements('id');

            // Relations
            $table->unsignedBigInteger('city_id');

            // Hotel Info
            $table->string('location')->nullable();      // Area / Address
            $table->decimal('latitude', 10, 7)->nullable();
            $table->decimal('longitude', 10, 7)->nullable();
            $table->string('email')->nullable();         // Contact Email
            $table->string('phone', 20)->nullable();     // Contact Phone

            // Hotel Features
            $table->tinyInteger('star_rating')->nullable(); // 1–5
            $table->boolean('has_meal')->default(0);        // Yes / No
            $table->boolean('status')->default(1);         // Active / Inactive

            // Timestamps
            $table->timestamps();
            $table->softDeletes();

            // Indexes
            $table->index('city_id');
            $table->index('status');

            // Foreign Key
            $table->foreign('city_id')
                  ->references('id')
                  ->on('cities')
                  ->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('hotels');
    }
};
