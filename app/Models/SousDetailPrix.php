<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SousDetailPrix extends Model
{
    // Si la table n'est pas le pluriel du nom du modèle, définis-la ici
    protected $table = 'sous_details_prix';

    // Spécifie les champs qui peuvent être assignés en masse
    protected $fillable = [
        'materiaux_id', 
        'main_doeuvre_id', 
        'equipements_id', 
        'transport_id', 
        'quantite_materiaux', 
        'heures_main_doeuvre', 
        'cout_total'
    ];

    // Définir les relations avec d'autres modèles

    // Relation avec le modèle Materiaux
    public function materiau()
    {
        return $this->belongsTo(Materiau::class, 'materiaux_id');
    }

    // Relation avec le modèle MainDoeuvre
    public function mainDoeuvre()
    {
        return $this->belongsTo(MainDoeuvre::class, 'main_doeuvre_id');
    }

    // Relation avec le modèle Equipement
    public function equipement()
    {
        return $this->belongsTo(Equipement::class, 'equipements_id');
    }

    // Relation avec le modèle Transport
    public function transport()
    {
        return $this->belongsTo(Transport::class, 'transport_id');
    }
}