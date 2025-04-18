<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::table('main_doeuvres', function (Blueprint $table) {
        $table->string('unite')->default('')->after('taux_horaire');
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('main_doeuvres', function (Blueprint $table) {
            //
        });
    }
};
