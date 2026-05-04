<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        // eService Phase 1 cleanup: restaurant credit-order tables are disabled.
        // Keep this migration as a safe no-op so migrate:fresh can complete.
    }

    public function down(): void
    {
        if (Schema::hasTable('credit_orders')) {
            Schema::table('credit_orders', function ($table) {
                if (Schema::hasColumn('credit_orders', 'credit_account_user_id')) {
                    $table->dropColumn('credit_account_user_id');
                }
                if (Schema::hasColumn('credit_orders', 'used_by_name')) {
                    $table->dropColumn('used_by_name');
                }
                if (Schema::hasColumn('credit_orders', 'used_by_phone')) {
                    $table->dropColumn('used_by_phone');
                }
            });
        }
    }
};
