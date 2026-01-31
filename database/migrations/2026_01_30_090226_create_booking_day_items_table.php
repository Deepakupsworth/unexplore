<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('booking_day_items', function (Blueprint $table) {
            $table->id();

            $table->foreignId('booking_day_id')
                ->constrained('booking_days')
                ->cascadeOnDelete();

            $table->enum('item_type', ['transport', 'hotel', 'event', 'todo']);

            $table->unsignedBigInteger('original_item_id')
                ->nullable()
                ->comment('Original item id at booking time');

            $table->string('title');
            $table->text('description')->nullable();

            // ⏰ itinerary timing
            $table->time('start_time')->nullable();
            $table->time('end_time')->nullable();
            $table->unsignedSmallInteger('sort_order')->default(0);

            // 💰 only extra price
            $table->decimal('extra_price', 12, 2)->default(0);

            // ⚙️ optional logic
            $table->boolean('is_optional')->default(false);
            $table->boolean('is_selected')->default(true);

            // 🔐 immutable snapshot
            $table->json('meta_json')->nullable();

            $table->timestamps();

            // indexes
            $table->index('booking_day_id');
            $table->index(['item_type', 'original_item_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('booking_day_items');
    }
};
