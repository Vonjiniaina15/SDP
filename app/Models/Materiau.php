<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Materiau extends Model
{
    use HasFactory;

    protected $table = 'materiaux';

    // Ajout de 'unite' ici pour permettre l'assignation en masse
    protected $fillable = ['nom', 'prix_unitaire', 'unite'];

    protected $casts = [
        'prix_unitaire' => 'decimal:2'
    ];
}
