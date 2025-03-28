<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Materiau extends Model
{
    use HasFactory;

    protected $table = 'materiaux'; // Ajoute cette ligne pour dire à Laravel d'utiliser la table "materiaux"

    protected $fillable = ['nom', 'prix_unitaire']; // Champs qui peuvent être remplis via un formulaire

    protected $casts = [
        'prix_unitaire' => 'decimal:2' // Assurer que le prix est un nombre décimal avec 2 chiffres après la virgule
    ];
}
