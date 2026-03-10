<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('golf_contact_queries', function (Blueprint $table) {
            $table->id();

            $table->string('name');
            $table->string('email');
            $table->string('phone',20)->nullable();

            $table->string('subject')->nullable();
            $table->text('message');

            // future relation
            $table->unsignedBigInteger('golf_id')->nullable();

            $table->enum('status',['new','in_progress','resolved'])->default('new');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('golf_contact_queries');
    }
};