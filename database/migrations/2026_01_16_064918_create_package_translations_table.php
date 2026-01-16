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
        Schema::create('package_translations', function (Blueprint $table) {
            $table->id();

            $table->foreignId('package_id')
                  ->constrained()
                  ->cascadeOnDelete();

            $table->string('language_code', 5);

            $table->string('title');
            $table->string('sub_title')->nullable();
            $table->longText('description')->nullable();

            $table->unique(['package_id', 'language_code']);
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('package_translations');
    }
};
