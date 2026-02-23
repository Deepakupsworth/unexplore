<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('package_day_items', function (Blueprint $table) {

            // 🔥 add package_id after package_day_id
            $table->foreignId('package_id')
                ->nullable()
                ->after('package_day_id');

            // optional index (recommended)
            $table->index('package_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('package_day_items', function (Blueprint $table) {

            // drop FK first
            $table->dropForeign(['package_id']);

            // drop index
            $table->dropIndex(['package_id']);

            // drop column
            $table->dropColumn('package_id');
        });
    }
};
