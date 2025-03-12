<?php

namespace App\Http\Controllers;

use App\Models\MainDoeuvre; // Importer le modèle MainDoeuvre
use Illuminate\Http\Request;

class MainDoeuvreController extends Controller
{
    // Méthode pour afficher tous les ouvriers
    public function index()
    {
        $mainDoeuvres = MainDoeuvre::all();
        return response()->json($mainDoeuvres);
    }

    // Méthode pour créer un nouvel ouvrier
    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'taux_horaire' => 'required|numeric',
        ]);

        $mainDoeuvre = MainDoeuvre::create([
            'nom' => $request->nom,
            'taux_horaire' => $request->taux_horaire,
        ]);

        return response()->json($mainDoeuvre, 201);
    }

    // Méthode pour afficher un ouvrier spécifique
    public function show($id)
    {
        $mainDoeuvre = MainDoeuvre::findOrFail($id);
        return response()->json($mainDoeuvre);
    }

    // Méthode pour mettre à jour un ouvrier
    public function update(Request $request, $id)
    {
        $mainDoeuvre = MainDoeuvre::findOrFail($id);

        $request->validate([
            'nom' => 'sometimes|string|max:255',
            'taux_horaire' => 'sometimes|numeric',
        ]);

        $mainDoeuvre->update($request->all());

        return response()->json($mainDoeuvre);
    }

    // Méthode pour supprimer un ouvrier
    public function destroy($id)
    {
        $mainDoeuvre = MainDoeuvre::findOrFail($id);
        $mainDoeuvre->delete();

        return response()->json(null, 204);
    }
} 