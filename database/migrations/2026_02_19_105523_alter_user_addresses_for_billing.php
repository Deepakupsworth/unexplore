<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('user_addresses', function (Blueprint $table) {

            // Billing basic info
            $table->string('full_name')->nullable()->after('user_id');
            $table->string('phone', 30)->nullable()->after('full_name');
            $table->string('email')->nullable()->after('phone');

            // Default address flag
            $table->boolean('is_default')->default(false)->after('full_address');

            // Optional business fields
            $table->string('company_name')->nullable()->after('is_default');
            $table->string('gst_number')->nullable()->after('company_name');

            // helpful index
            $table->index(['user_id', 'is_default']);
        });
    }

    public function down(): void
    {
        Schema::table('user_addresses', function (Blueprint $table) {

            $table->dropColumn([
                'full_name',
                'phone',
                'email',
                'is_default',
                'company_name',
                'gst_number',
            ]);
        });
    }
};
