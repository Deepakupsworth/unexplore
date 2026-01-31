<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('booking_travellers', function (Blueprint $table) {
            $table->id();

            $table->foreignId('booking_id')
                ->constrained('bookings')
                ->cascadeOnDelete();

            $table->enum('type', ['adult', 'child']);

            $table->string('first_name');
            $table->string('last_name')->nullable();

            $table->enum('gender', ['male', 'female', 'other'])->nullable();
            $table->date('dob')->nullable();

            $table->timestamps();

            // 🔥 Helpful indexes
            $table->index('booking_id');
            $table->index('type');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('booking_travellers');
    }
};
