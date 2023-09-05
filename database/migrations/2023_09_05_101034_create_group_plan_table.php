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
        Schema::create('commercial_group_plan', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('plan_id');
            $table->foreign('plan_id')->references('id')->on(config('subby.tables.plans'))
                ->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId("group_id")->references("id")->on("commercial_groups")->cascadeOnDelete();
            $table->timestamps();
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
