<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('coupons', function (Blueprint $table) {
            $table->id();

            // Creator
            $table->foreignId('created_by')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            $table->enum('creator_type', ['admin'])->default('admin');

            // Coupon Info
            $table->string('code')->unique();
            $table->enum('discount_type', ['fixed', 'percentage']);
            $table->decimal('discount_value', 10, 2);

            // Scope
            $table->boolean('is_global')->default(true);

            // Usage limits
            $table->integer('total_usage_limit')->nullable();
            $table->integer('per_user_limit')->nullable();
            $table->integer('used_count')->default(0);

            // Validity
            $table->dateTime('start_date')->nullable();
            $table->dateTime('end_date')->nullable();

            // Status
            $table->boolean('is_active')->default(true);

            $table->timestamps();

            // Indexes
            $table->index(['is_active', 'start_date', 'end_date']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('coupons');
    }
};
