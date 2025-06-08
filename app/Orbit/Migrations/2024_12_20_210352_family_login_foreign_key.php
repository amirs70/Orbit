<?php

namespace App\Orbit\src\Migrations;

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('family_logins', function ($table) {
            $table->foreign("family_id")->references("id")->on("families");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('family_logins', function (Blueprint $table) {
            $table->dropForeign("family_logins_family_id_foreign");
        });
    }
};
