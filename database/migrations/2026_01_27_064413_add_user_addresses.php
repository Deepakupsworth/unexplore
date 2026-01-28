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
        Schema::create('user_addresses', function (Blueprint $table) {
            $table->id();
        
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
        
            $table->string('address_title');
            $table->string('country', 100);
            $table->string('city', 100);
            $table->string('pin_code', 20);
            $table->text('full_address');
        
            $table->timestamps();
            $table->softDeletes(); // adds deleted_at
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
