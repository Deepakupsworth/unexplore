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
        Schema::create('seo_metas', function (Blueprint $table) {
            $table->id();
            $table->morphs('metaable'); // metaable_id + metaable_type
            $table->string('meta_title')->nullable();
            $table->text('meta_description')->nullable();
            $table->json('schema_json')->nullable();
            $table->string('language_code', 5); // en, hi
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('seo_metas');
    }

};
