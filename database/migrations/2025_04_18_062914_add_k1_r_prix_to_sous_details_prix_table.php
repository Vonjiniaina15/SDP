<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddK1RPrixToSousDetailsPrixTable extends Migration
{
    public function up()
    {
        Schema::table('sous_details_prix', function (Blueprint $table) {
            $table->float('k1')->default(1);
            $table->float('r')->default(1);
            $table->float('prix_unitaire')->nullable();
        });
    }

    public function down()
    {
        Schema::table('sous_details_prix', function (Blueprint $table) {
            $table->dropColumn(['k1', 'r', 'prix_unitaire']);
        });
    }
}