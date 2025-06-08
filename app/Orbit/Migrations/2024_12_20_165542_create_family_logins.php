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
        Schema::create("family_logins", function (Blueprint $table) {
            $table->bigIncrements("id")->autoIncrement();
            $table->bigInteger("family_id")->unsigned()->index();
            $table->string("token", 255);
            $table->string("ip", 100);
            $table->string("agent", 255);
            $table->string("hash", 255);
            $table->string("package", 50);
            $table->integer("status");
            $table->boolean("is_active");
            $table->string("connection", 255)->nullable()->default(null);
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
