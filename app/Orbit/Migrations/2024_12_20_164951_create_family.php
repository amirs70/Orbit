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
        Schema::create("families", function (Blueprint $table) {
            $table->bigIncrements("id")->autoIncrement();
            $table->string("first_name", 50);
            $table->string("last_name", 50);
            $table->timestamp("verified_at")->nullable()->default(null);
            $table->string("email", 200)->default(null)->nullable();
            $table->string("password", 255);
            $table->string("phone", 20);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists("family_logins");
    }
};
