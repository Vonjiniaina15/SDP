<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transport extends Model
{
    use HasFactory;

    protected $table = 'transports'; // Nom explicite de la table

    protected $fillable = ['destination', 'frais_transport']; // Champs modifiables via formulaire

    protected $casts = [
        'frais_transport' => 'decimal:2' // S'assurer que c'est bien un nombre décimal
    ];
}