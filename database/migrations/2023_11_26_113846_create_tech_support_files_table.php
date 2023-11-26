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
        Schema::create('tech_support_files', function (Blueprint $table) {
            $table->bigIncrements("id");
            $table->foreignId("message_id")->references("id")->on("tech_support_messages")->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId("file_url")->references("id")->on("files")->cascadeOnDelete()->cascadeOnUpdate();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tech_support_files');
    }
};
