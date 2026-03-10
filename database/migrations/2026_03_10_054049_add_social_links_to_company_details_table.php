<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('company_details', function (Blueprint $table) {
            $table->string('youtube_url')->nullable()->after('twitter_url');
            $table->string('linkedin_url')->nullable()->after('youtube_url');
            $table->string('threads_url')->nullable()->after('linkedin_url');
        });
    }

    public function down(): void
    {
        Schema::table('company_details', function (Blueprint $table) {
            $table->dropColumn(['youtube_url','linkedin_url','threads_url']);
        });
    }
};
