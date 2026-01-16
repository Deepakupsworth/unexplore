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
        Schema::create('package_info_translations', function (Blueprint $table) {
            $table->id();

            $table->foreignId('package_info_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->string('language_code', 5);
            $table->string('title');
            $table->longText('content');

            $table->unique(['package_info_id', 'language_code']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('package_info_translations');
    }
};
