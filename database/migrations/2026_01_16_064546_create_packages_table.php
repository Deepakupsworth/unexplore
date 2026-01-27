<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('packages', function (Blueprint $table) {
            $table->id();

            $table->string('slug')->unique();

            $table->enum('status', ['draft', 'active', 'inactive'])
                ->default('draft');

            $table->enum('package_type', ['fixed', 'customized'])
                ->default('fixed');

            $table->foreignId('category_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->unsignedSmallInteger('duration_days');
            $table->unsignedSmallInteger('duration_nights');

            $table->unsignedSmallInteger('base_persons')->default(2);
            $table->unsignedSmallInteger('max_persons');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('packages');
    }
};
