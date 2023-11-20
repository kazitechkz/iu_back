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
        Schema::table('attempt_settings', function (Blueprint $table) {
            $table->foreignId("owner_id")->nullable()->references('id')->on('users')->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasColumn('attempt_settings', 'owner_id')) {
            Schema::table('attempt_settings', function (Blueprint $table) {
                $table->dropColumn("owner_id");
            });
        }
    }
};
