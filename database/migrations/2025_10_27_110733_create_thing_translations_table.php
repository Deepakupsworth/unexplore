<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('thing_translations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('thing_id')->constrained('things_to_do')->cascadeOnDelete();
            $table->foreignId('language_id')->constrained('languages')->cascadeOnDelete();
            $table->string('name');
            $table->text('about')->nullable();
            $table->timestamps();

            $table->unique(['thing_id', 'language_id']);
        });
    }

    public function down(): void {
        Schema::dropIfExists('thing_translations');
    }
};

