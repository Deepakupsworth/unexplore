<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('event_translations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('event_id')->constrained('events')->cascadeOnDelete();
            $table->string('language_code', 10);
            $table->string('title');
            $table->string('sub_title');
            $table->string('url');

            $table->text('description')->nullable();
            $table->timestamps();

            $table->unique(['event_id', 'language_code']);
        });
    }

    public function down(): void {
        Schema::dropIfExists('event_translations');
    }
};

