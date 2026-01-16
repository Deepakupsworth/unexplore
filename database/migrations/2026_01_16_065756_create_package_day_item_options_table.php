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
        Schema::create('package_day_item_options', function (Blueprint $table) {
            $table->id();

            $table->foreignId('package_day_id')
                  ->constrained()
                  ->cascadeOnDelete();

            $table->enum('item_type', ['hotel', 'event', 'todo']);
            $table->unsignedBigInteger('item_id');

            $table->decimal('extra_price', 10, 2)->default(0);
            $table->boolean('is_default')->default(false);
            $table->unsignedSmallInteger('sort_order')->default(0);

            $table->timestamps();

            $table->index(['item_type', 'item_id']);
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('package_day_item_options');
    }
};
