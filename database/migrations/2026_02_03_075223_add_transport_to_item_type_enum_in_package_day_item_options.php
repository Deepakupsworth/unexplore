<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    public function up(): void
    {
        DB::statement("
            ALTER TABLE package_day_item_options
            MODIFY item_type ENUM('transport','hotel','event','todo') NOT NULL
        ");
    }

    public function down(): void
    {
        DB::statement("
            ALTER TABLE package_day_item_options
            MODIFY item_type ENUM('hotel','event','todo') NOT NULL
        ");
    }
};
