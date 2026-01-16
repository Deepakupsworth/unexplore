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
        Schema::create('package_child_prices', function (Blueprint $table) {
            $table->id();

            $table->foreignId('package_id')
                  ->constrained()
                  ->cascadeOnDelete();

            $table->unsignedSmallInteger('min_age');
            $table->unsignedSmallInteger('max_age');

            $table->enum('price_type', ['fixed', 'percentage']);
            $table->decimal('price_value', 10, 2);
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('package_child_prices');
    }
};
