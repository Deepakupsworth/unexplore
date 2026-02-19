<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('static_pages', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique();          // about-us, events, packages
            $table->string('page_title');               // H1
            $table->string('meta_title')->nullable();
            $table->text('meta_description')->nullable();
            $table->json('schema_json')->nullable();
            $table->string('language_code', 5); // en, hi
            $table->timestamps();
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('static_pages');
    }
    
};
