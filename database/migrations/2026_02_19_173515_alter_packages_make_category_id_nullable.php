<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('packages', function (Blueprint $table) {

            // 1️⃣ Drop foreign key first
            $table->dropForeign(['category_id']);

        });

        Schema::table('packages', function (Blueprint $table) {

            // 2️⃣ Make column nullable
            $table->unsignedBigInteger('category_id')->nullable()->change();

        });
    }

    public function down(): void
    {
        Schema::table('packages', function (Blueprint $table) {

            $table->unsignedBigInteger('category_id')->nullable(false)->change();

            $table->foreign('category_id')
                  ->references('id')
                  ->on('categories')
                  ->onDelete('cascade');
        });
    }
};
