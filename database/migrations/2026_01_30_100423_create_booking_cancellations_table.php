<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('booking_cancellations', function (Blueprint $table) {
            $table->id();

            $table->foreignId('booking_id')
                ->constrained('bookings')
                ->cascadeOnDelete();

            // 🔄 cancellation type
            $table->enum('type', [
                'full',
                'partial'
            ])->default('full');

            // 💰 refund snapshot
            $table->string('currency', 3);
            $table->decimal('refund_amount', 12, 2)->default(0);

            // 📌 refund status
            $table->enum('refund_status', [
                'not_applicable',
                'pending',
                'processed',
                'failed'
            ])->default('not_applicable');

            // 🧾 reason & notes
            $table->string('reason')->nullable();
            $table->text('note')->nullable();

            // 🔐 policy snapshot at cancellation time
            $table->json('policy_snapshot_json')->nullable();

            // 👤 who cancelled
            $table->enum('cancelled_by', [
                'customer',
                'admin',
                'system'
            ])->default('customer');

            $table->timestamps();

            // Indexes
            $table->index('booking_id');
            $table->index('refund_status');
            $table->index('type');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('booking_cancellations');
    }
};
