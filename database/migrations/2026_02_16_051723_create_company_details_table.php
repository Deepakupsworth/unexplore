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
        Schema::create('company_details', function (Blueprint $table) {
            $table->id();

            // Basic info
            $table->string('company_name');
            $table->string('email')->nullable()->index();
            $table->string('phone', 20)->nullable();
            $table->string('whatsapp', 20)->nullable();

            // Address
            $table->string('address_line')->nullable();
            $table->string('city')->nullable()->index();
            $table->string('country')->nullable()->index();
            $table->string('postal_code', 15)->nullable();

            // Business time
            $table->string('working_days')->nullable(); // e.g. Sun–Thu
            $table->string('working_hours')->nullable(); // e.g. 03:00 PM – 06:00 PM

            // Social links
            $table->string('instagram_url')->nullable();
            $table->string('facebook_url')->nullable();
            $table->string('twitter_url')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('company_details');
    }
};
