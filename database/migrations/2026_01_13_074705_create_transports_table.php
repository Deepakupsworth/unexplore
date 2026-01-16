<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up(): void
    {
        Schema::create('transports', function (Blueprint $table) {
            $table->bigIncrements('id');

            // City-wise transport
            $table->foreignId('city_id')
                  ->nullable()
                  ->constrained()
                  ->nullOnDelete();

            // Transport type
            $table->enum('type', ['taxi','car','bus','train','flight'])
                  ->default('taxi');
             // ✅ OPTIONAL contact number
            $table->string('contact_number', 20)->nullable();

            // Capacity (VERY IMPORTANT)
            $table->integer('capacity')->default(4); // taxi = 4 pax

            // Active / inactive
            $table->boolean('status')->default(1);

            // Safety for packages & bookings
            $table->softDeletes();

            $table->timestamps();

            // Indexes
            $table->index('city_id');
            $table->index('type');
            $table->index('status');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('transports');
    }
};
