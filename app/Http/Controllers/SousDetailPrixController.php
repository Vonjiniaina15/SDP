<?php

namespace App\Http\Controllers;

use App\Models\SousDetailPrix; // Importer le modèle SousDetailPrix
use Illuminate\Http\Request;

class SousDetailPrixController extends Controller
{
    // Méthode pour afficher tous les sous-détails de prix
    public function index(Request $request)
    {
        if ($request->wantsJson() || $request->ajax()) {
            return response()->json(SousDetailPrix::all());
        }
    
        $sousDetailsPrix = SousDetailPrix::all();
        return view('sousdetailsprix.index', compact('sousDetailsPrix'));
    }

    // Méthode pour créer un nouveau sous-détail de prix
    public function store(Request $request)
    {
        $request->validate([
            'materiaux_id' => 'required|exists:materiaux,id',
            'main_doeuvre_id' => 'required|exists:main_doeuvre,id',
            'equipements_id' => 'required|exists:equipements,id',
            'transport_id' => 'required|exists:transport,id',
            'quantite_materiaux' => 'required|numeric',
            'heures_main_doeuvre' => 'required|numeric',
            'cout_total' => 'required|numeric',
        ]);

        $sousDetailPrix = SousDetailPrix::create($request->all());

        return response()->json($sousDetailPrix, 201);
    }

    // Méthode pour afficher un sous-détail de prix spécifique
    public function show($id)
    {
        $sousDetailPrix = SousDetailPrix::findOrFail($id);
        return response()->json($sousDetailPrix);
    }

    // Méthode pour mettre à jour un sous-détail de prix
    public function update(Request $request, $id)
    {
        $sousDetailPrix = SousDetailPrix::findOrFail($id);

        $request->validate([
            'materiaux_id' => 'sometimes|exists:materiaux,id',
            'main_doeuvre_id' => 'sometimes|exists:main_doeuvre,id',
            'equipements_id' => 'sometimes|exists:equipements,id',
            'transport_id' => 'sometimes|exists:transport,id',
            'quantite_materiaux' => 'sometimes|numeric',
            'heures_main_doeuvre' => 'sometimes|numeric',
            'cout_total' => 'sometimes|numeric',
        ]);

        $sousDetailPrix->update($request->all());

        return response()->json($sousDetailPrix);
    }

    // Méthode pour supprimer un sous-détail de prix
    public function destroy($id)
    {
        $sousDetailPrix = SousDetailPrix::findOrFail($id);
        $sousDetailPrix->delete();

        return response()->json(null, 204);
    }
}