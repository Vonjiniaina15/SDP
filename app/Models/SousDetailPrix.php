<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SousDetailPrix extends Model
{
    // Définition de la table associée
    protected $table = 'sous_details_prix';

    // Champs pouvant être remplis massivement
    protected $fillable = [
        'materiaux_id', 
        'main_doeuvre_id', 
        'equipements_id', 
        'transport_id', 
        'quantite_materiaux', 
        'heures_main_doeuvre', 
        'cout_total'
    ];

    // Relations avec d'autres modèles

    // Relation avec le modèle Materiaux
    public function materiaux()
    {
        return $this->belongsTo(Materiau::class, 'materiaux_id');
    }

    // Relation avec le modèle MainDoeuvre
    public function mainDoeuvre()
    {
        return $this->belongsTo(MainDoeuvre::class, 'main_doeuvre_id');
    }

    // Relation avec le modèle Equipements
    public function equipements()
    {
        return $this->belongsTo(Equipement::class, 'equipements_id');
    }

    // Relation avec le modèle Transport
    public function transport()
    {
        return $this->belongsTo(Transport::class, 'transport_id');
    }
}
