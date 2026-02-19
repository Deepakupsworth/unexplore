<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('customer_billings', function (Blueprint $table) {
            $table->id();

            // User relation
            $table->foreignId('user_id')
                ->nullable()
                ->constrained()
                ->cascadeOnDelete();

            /* ================= BASIC INFO ================= */
            $table->string('full_name');
            $table->string('email')->nullable();
            $table->string('phone', 20);

            /* ================= ADDRESS ================= */
            $table->string('address_line1');
            $table->string('address_line2')->nullable();
            $table->string('city');
            $table->string('state')->nullable();
            $table->string('postal_code', 20);
            $table->string('country_code', 5)->index();

            /* ================= BUSINESS (OPTIONAL) ================= */
            $table->string('company_name')->nullable();
            $table->string('gst_number', 20)->nullable();

            /* ================= FLAGS ================= */
            $table->boolean('is_default')->default(false);

            $table->timestamps();

            /* ================= INDEXES ================= */
            $table->index(['user_id', 'is_default']);
            $table->index('phone');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('customer_billings');
    }
};
