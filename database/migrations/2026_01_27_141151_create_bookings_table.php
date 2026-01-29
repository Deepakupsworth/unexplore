<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();

            $table->string('booking_code')->unique();

            $table->foreignId('user_id')
                ->nullable()
                ->constrained()
                ->nullOnDelete();

            $table->enum('status', [
                'pending',
                'confirmed',
                'cancelled',
                'completed'
            ])->default('pending');

            $table->enum('payment_status', [
                'unpaid',
                'paid',
                'refunded',
                'partial_refund'
            ])->default('unpaid');

            // 💱 Currency snapshot
            $table->string('base_currency', 3);        // e.g. SAR
            $table->string('booking_currency', 3);     // e.g. USD

            $table->decimal('base_total_amount', 12, 2);
            $table->decimal('exchange_rate', 12, 6);
            $table->decimal('booking_total_amount', 12, 2);

            // ✈️ Travel period
            $table->date('travel_start_date');
            $table->date('travel_end_date');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
