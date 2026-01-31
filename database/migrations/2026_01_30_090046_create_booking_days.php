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
        Schema::create('booking_days', function (Blueprint $table) {
            $table->id();
        
            $table->foreignId('booking_id')
                ->constrained()
                ->cascadeOnDelete();
        
            $table->unsignedBigInteger('original_day_id')->nullable();
            $table->unsignedSmallInteger('day_number');
        
            $table->date('date')->nullable();
        
            $table->unsignedBigInteger('city_id')->nullable();
            $table->string('city_name');
        
            $table->json('meta_json')->nullable();
        
            $table->timestamps();
        
            $table->index(['booking_id', 'day_number']);
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('booking_days');
    }
};
