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
        Schema::create('sous_details_prix', function (Blueprint $table) {
           $table->id();
           $table->foreignId('materiaux_id')->constrained('materiaux')->onDelete('cascade');
           $table->foreignId('main_doeuvre_id')->constrained('main_doeuvres')->onDelete('cascade');
           $table->foreignId('equipements_id')->constrained('equipements')->onDelete('cascade');
           $table->foreignId('transport_id')->constrained('transports')->onDelete('cascade');
           $table->decimal('quantite_materiaux', 10, 2);
           $table->decimal('heures_main_doeuvre', 10, 2);
           $table->decimal('cout_total', 10, 2);
           $table->timestamps();
        });
    }

        public function down()
    {
        Schema::dropIfExists('sous_details_prix');
    }
};
