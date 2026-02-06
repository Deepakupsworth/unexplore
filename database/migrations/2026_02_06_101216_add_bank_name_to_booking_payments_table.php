<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('booking_payments', function (Blueprint $table) {

            // 🏦 Bank Name (for bank transfer)
            $table->string('bank_name')
                  ->nullable()
                  ->after('payment_method');

        });
    }

    public function down(): void
    {
        Schema::table('booking_payments', function (Blueprint $table) {

            $table->dropColumn('bank_name');

        });
    }
};
