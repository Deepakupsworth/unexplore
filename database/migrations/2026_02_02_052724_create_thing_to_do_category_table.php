<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('thing_to_do_category', function (Blueprint $table) {
            $table->id();

            $table->foreignId('thing_id')
                ->constrained('things_to_do')
                ->cascadeOnDelete();

            $table->foreignId('category_id')
                ->constrained('categories')
                ->cascadeOnDelete();

            // prevent duplicate category assignment
            $table->unique(['thing_id', 'category_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('thing_to_do_category');
    }
};
