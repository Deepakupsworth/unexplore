<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up(): void
    {
        Schema::create('hotels', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('city_id');

            $table->tinyInteger('star_rating')->nullable(); // 1–5
            $table->boolean('has_meal')->default(0);        // YES / NO
            $table->boolean('status')->default(1);

            $table->timestamps();

            // Indexes
            $table->index('city_id');
            $table->index('status');

            $table->foreign('city_id')
                  ->references('id')
                  ->on('cities')
                  ->cascadeOnDelete();
                  $table->softDeletes(); // deleted_at

        });
    }

    public function down(): void
    {
        Schema::dropIfExists('hotels');
    }
};
