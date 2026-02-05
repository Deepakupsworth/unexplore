<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('package_package_policy', function (Blueprint $table) {

            $table->unsignedBigInteger('package_id');
            $table->unsignedBigInteger('package_policy_id');

            // composite primary key
            $table->primary(['package_id', 'package_policy_id']);

            // foreign keys
            $table->foreign('package_id')
                  ->references('id')
                  ->on('packages')
                  ->onDelete('cascade');

            $table->foreign('package_policy_id')
                  ->references('id')
                  ->on('package_policies')
                  ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('package_package_policy');
    }
};
