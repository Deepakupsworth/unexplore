<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('package_policy_translations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('package_policy_id');
            $table->string('language_code', 5); // en, hi
            $table->longText('content');        // FULL editor content
            $table->timestamps();

            $table->unique(
                ['package_policy_id', 'language_code'],
                'pp_trans_policy_lang_unique'
            );

            $table->foreign('package_policy_id')
                  ->references('id')
                  ->on('package_policies')
                  ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('package_policy_translations');
    }
};

