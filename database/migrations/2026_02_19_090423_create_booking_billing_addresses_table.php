<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('booking_billing_addresses', function (Blueprint $table) {
            $table->id();

            // relations
            $table->foreignId('booking_id')->constrained()->cascadeOnDelete();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();

            // billing snapshot
            $table->string('full_name');
            $table->string('phone', 20);
            $table->string('email')->nullable();

            $table->string('address_line1');
            $table->string('city');
            $table->string('postal_code', 20);
            $table->string('country_code', 10);

            // optional fields (future safe)
            $table->string('company_name')->nullable();
            $table->string('gst_number')->nullable();

            $table->timestamps();

            // indexes
            $table->index('booking_id');
            $table->index('user_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('booking_billing_addresses');
    }
};
