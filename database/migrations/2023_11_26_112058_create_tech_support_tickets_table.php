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
        Schema::create('tech_support_tickets', function (Blueprint $table) {
            $table->bigIncrements("id");
            $table->foreignId("type_id")->references("id")->on("tech_support_types")->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId("category_id")->references("id")->on("tech_support_categories")->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId("user_id")->references("id")->on("users")->cascadeOnDelete()->cascadeOnUpdate();
            $table->string("title",255);
            $table->boolean("is_closed")->default(false);
            $table->boolean("is_resolved")->default(false);
            $table->boolean("is_answered")->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tech_support_tickets');
    }
};
