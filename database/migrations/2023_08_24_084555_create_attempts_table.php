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
        Schema::create('attempts', function (Blueprint $table) {
            $table->bigIncrements("id");
            $table->foreignId("type_id")->references("id")->on("attempt_types")->cascadeOnDelete();
            $table->foreignId("user_id")->references("id")->on("users")->cascadeOnDelete();
            $table->foreignId("locale_id")->references("id")->on("locales")->cascadeOnDelete();
            $table->timestamp("start_at")->default(\Carbon\Carbon::now());
            $table->timestamp("end_at")->nullable();
            $table->integer("max_points");
            $table->integer("points")->default(0);
            $table->integer("time")->default(0);
            $table->integer("time_left")->default(0);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attempts');
    }
};
