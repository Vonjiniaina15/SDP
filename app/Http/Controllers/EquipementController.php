<?php

namespace App\Http\Controllers;

use App\Models\Equipement; // Importer le modèle Equipement
use Illuminate\Http\Request;

class EquipementController extends Controller
{
    // Méthode pour afficher tous les équipements
    public function index()
    {
        $equipements = Equipement::all();
        return view('test',['Equipement' =>$equipements, 'nom'=>'rakoto' ]);
    }

    // Méthode pour créer un nouvel équipement
    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'prix_location' => 'required|numeric',
        ]);

        $equipement = Equipement::create([
            'nom' => $request->nom,
            'prix_location' => $request->prix_location,
        ]);

        return response()->json($equipement, 201);
    }

    // Méthode pour afficher un équipement spécifique
    public function show($id)
    {
        $equipement = Equipement::findOrFail($id);
        return response()->json($equipement);
    }

    // Méthode pour mettre à jour un équipement
    public function update(Request $request, $id)
    {
        $equipement = Equipement::findOrFail($id);

        $request->validate([
            'nom' => 'sometimes|string|max:255',
            'prix_location' => 'sometimes|numeric',
        ]);

        $equipement->update($request->all());

        return response()->json($equipement);
    }

    // Méthode pour supprimer un équipement
    public function destroy($id)
    {
        $equipement = Equipement::findOrFail($id);
        $equipement->delete();

        return response()->json(null, 204);
    }
} 
