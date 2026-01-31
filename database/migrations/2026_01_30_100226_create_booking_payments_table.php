<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('booking_payments', function (Blueprint $table) {
            $table->id();

            $table->foreignId('booking_id')
                ->constrained('bookings')
                ->cascadeOnDelete();

            // 💳 Payment info
            $table->string('payment_method'); 
            // e.g. stripe, paypal, razorpay, cash

            $table->string('transaction_id')->nullable();
            $table->string('gateway_reference')->nullable();

            // 💰 Amount snapshot
            $table->string('currency', 3);
            $table->decimal('amount', 12, 2);

            // 📌 Payment status
            $table->enum('status', [
                'pending',
                'paid',
                'failed',
                'refunded',
                'partial_refund'
            ])->default('pending');

            // 🔐 Gateway full response
            $table->json('payload_json')->nullable();

            $table->timestamps();

            // Indexes
            $table->index('booking_id');
            $table->index('transaction_id');
            $table->index('status');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('booking_payments');
    }
};
