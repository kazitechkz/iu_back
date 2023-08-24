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
        Schema::create('group_plan', function (Blueprint $table) {
            $table->bigIncrements("id");
            $table->foreignId("group_id")->references("id")->on("groups")->cascadeOnDelete();
            $table->unsignedInteger('plan_id');
            $table->foreign('plan_id')->references('id')->on(config('subby.tables.plans'))
                ->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('group_plan');
    }
};
