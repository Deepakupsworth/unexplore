<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('package_price_increase_persons', function (Blueprint $table) {
            $table->id();

            $table->foreignId('package_id')
                  ->constrained()
                  ->cascadeOnDelete();

            $table->unsignedSmallInteger('person_number');
            $table->decimal('additional_price', 10, 2);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('package_price_increase_persons');
    }
};
