<?php

namespace App\Http\Controllers;

use App\Models\Materiau;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class MateriauxController extends Controller
{
    public function index(): JsonResponse
    {
        $materiaux = Materiau::all();
        return response()->json([
            'success' => true,
            'data' => $materiaux
        ]);
    }

    public function store(Request $request): JsonResponse
    {
        $validatedData = $request->validate([
            'nom' => 'required|string|max:255',
            'prix_unitaire' => 'required|numeric|min:0',
        ]);

        $materiau = Materiau::create($validatedData);

        return response()->json([
            'success' => true,
            'message' => 'Matériau ajouté avec succès.',
            'data' => $materiau
        ], 201);
    }

    public function show($id): JsonResponse
    {
        try {
            $materiau = Materiau::findOrFail($id);
            return response()->json([
                'success' => true,
                'data' => $materiau
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Matériau introuvable.'
            ], 404);
        }
    }

    public function update(Request $request, $id): JsonResponse
    {
        try {
            $materiau = Materiau::findOrFail($id);

            $validatedData = $request->validate([
                'nom' => 'sometimes|string|max:255',
                'prix_unitaire' => 'sometimes|numeric|min:0',
            ]);

            $materiau->update($validatedData);

            return response()->json([
                'success' => true,
                'message' => 'Matériau mis à jour avec succès.',
                'data' => $materiau
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Matériau introuvable.'
            ], 404);
        }
    }

    public function destroy($id): JsonResponse
    {
        try {
            $materiau = Materiau::findOrFail($id);
            $materiau->delete();

            return response()->json([
                'success' => true,
                'message' => 'Matériau supprimé avec succès.'
            ], 204);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Matériau introuvable.'
            ], 404);
        }
    }
}