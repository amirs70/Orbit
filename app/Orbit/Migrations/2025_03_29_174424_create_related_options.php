<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create("related_options", function (Blueprint $table) {
            $table->id();
            $table->string("related_to");
            $table->integer("related_id");
            $table->integer("belong_id")->nullable()->default(null);
            $table->string("name");
            $table->longText("value")->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists("relative_options");
    }
};
