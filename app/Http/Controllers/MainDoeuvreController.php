<?php

namespace App\Http\Controllers;

use App\Models\MainDoeuvre;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class MainDoeuvreController extends Controller
{
    // Afficher tous les ouvriers
    public function index(Request $request)
    {
        $mainDoeuvres = MainDoeuvre::all();
    
        if ($request->wantsJson()) {
            return response()->json([
                'success' => true,
                'data' => $mainDoeuvres
            ]);
        }
    
        return view('main_doeuvres.index', compact('mainDoeuvres'));
    }

    // Créer un nouvel ouvrier
    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'taux_horaire' => 'required|numeric',
            'unite' => 'required|string|max:10'
        ]);

        $mainDoeuvre = MainDoeuvre::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Main d\'œuvre créée avec succès.',
            'data' => $mainDoeuvre
        ], 201);
    }

    // Afficher un ouvrier spécifique
    public function show($id): JsonResponse
    {
        try {
            $mainDoeuvre = MainDoeuvre::findOrFail($id);
            return response()->json([
                'success' => true,
                'data' => $mainDoeuvre
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Main d\'œuvre introuvable.'
            ], 404);
        }
    }

    // Mettre à jour un ouvrier
    public function update(Request $request, $id): JsonResponse
    {
        try {
            $mainDoeuvre = MainDoeuvre::findOrFail($id);

            $validated = $request->validate([
                'nom' => 'sometimes|string|max:255',
                'taux_horaire' => 'sometimes|numeric',
                'unite' => 'sometimes|string|max:10'
            ]);

            $mainDoeuvre->update($validated);

            return response()->json([
                'success' => true,
                'message' => 'Main d\'œuvre mise à jour avec succès.',
                'data' => $mainDoeuvre
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Erreur lors de la mise à jour.'
            ], 400);
        }
    }

    // Supprimer un ouvrier
    public function destroy($id): JsonResponse
    {
        try {
            $mainDoeuvre = MainDoeuvre::findOrFail($id);
            $mainDoeuvre->delete();

            return response()->json([
                'success' => true,
                'message' => 'Main d\'œuvre supprimée avec succès.'
            ], 204);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Erreur lors de la suppression.'
            ], 400);
        }
    }
}