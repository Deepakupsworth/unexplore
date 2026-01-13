<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up(): void
    {
        Schema::create('currencies', function (Blueprint $table) {
            $table->bigIncrements('id');

            // Currency identity
            $table->string('code', 10)->unique();      // SAR, USD, INR
            $table->string('symbol', 10);              // $, ₹, ﷼
            $table->string('name', 50)->nullable();    // US Dollar

            // Conversion
            $table->decimal('rate', 12, 6)->default(1); // base → currency
            $table->boolean('is_base')->default(0);

            // Status
            $table->boolean('status')->default(1);

            $table->timestamps();

            // Indexes (performance)
            $table->index('status');
            $table->index('is_base');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('currencies');
    }
};
