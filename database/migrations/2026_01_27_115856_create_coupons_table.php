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
        Schema::create('coupons', function (Blueprint $table) {
            $table->id();
        
            $table->string('code')->unique();            // FINFIRST25
            $table->string('title')->nullable();         // Optional admin title
        
            $table->enum('discount_type', ['amount', 'percentage']);
            $table->decimal('discount_value', 10, 2);
            $table->decimal('max_discount', 10, 2)->nullable(); // upto
        
            // package scope only
            $table->enum('applies_to', ['all', 'category', 'package']);
        
            $table->date('starts_at')->nullable();
            $table->date('ends_at')->nullable();
        
            $table->integer('usage_limit')->nullable();       // total
            $table->integer('usage_per_user')->nullable();    // per user
        
            $table->boolean('is_active')->default(true);
        
            $table->timestamps();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('coupons');
    }
};
