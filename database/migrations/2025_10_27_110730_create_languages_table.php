<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('languages', function (Blueprint $table) {
            $table->id();
            $table->string('code', 10)->unique();
            $table->string('name', 50);
            $table->string('direction', 3)->default('ltr'); // ltr or rtl
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('languages');
    }
};

