<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MainDoeuvre extends Model
{
    use HasFactory;

    // Nom de la table (optionnel si Laravel peut le deviner)
    protected $table = 'main_doeuvres';

    // Champs remplissables pour éviter l'erreur MassAssignmentException
    protected $fillable = [
        'nom',
        'taux_horaire',
    ];

    // Activer les timestamps si la table a created_at et updated_at
    public $timestamps = true;
}