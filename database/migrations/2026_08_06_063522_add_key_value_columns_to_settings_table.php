<?php

use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    public function up(): void
    {
        // Previously added key/value columns to 'settings' table.
        // Now that table is 'setting_footer' (site info) and 'setting' (key-value).
        // The 'setting' table already has key/value columns from its create migration.
        // This migration is now a no-op.
    }

    public function down(): void
    {
        // No-op.
    }
};
