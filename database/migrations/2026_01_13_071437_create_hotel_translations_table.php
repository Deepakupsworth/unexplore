<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up(): void
    {
        Schema::create('hotel_translations', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('hotel_id');
            $table->string('language_code', 10);

            $table->string('name');
            $table->text('description')->nullable();

            $table->timestamps();

            // Prevent duplicate language rows
            $table->unique(['hotel_id', 'language_code']);

            $table->foreign('hotel_id')
                  ->references('id')
                  ->on('hotels')
                  ->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('hotel_translations');
    }
};
