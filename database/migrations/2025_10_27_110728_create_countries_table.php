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
        Schema::create('countries', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('name');               // India, Saudi Arabia, United Arab Emirates

            // ISO country code
            $table->string('code', 10)->unique();   // IN, SA, AE

            // Default currency for country
            $table->string('currency_code', 10);    // INR, SAR, AED

            // Status
            $table->boolean('status')->default(1);

            $table->timestamps();

            // Indexes
            $table->index('currency_code');
            $table->index('status');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('countries');
    }
};
