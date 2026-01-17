<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up(): void
    {
        Schema::create('transport_translations', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('transport_id');
            $table->string('language_code', 10);

            $table->string('name');        // Taxi, Sedan Taxi, SUV Taxi
            $table->text('description')->nullable(); // Optional description

            $table->timestamps();

            $table->unique(['transport_id', 'language_code']);

            $table->foreign('transport_id')
                  ->references('id')
                  ->on('transports')
                  ->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('transport_translations');
    }
};
