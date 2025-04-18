<?php

namespace App\Http\Controllers;

use App\Models\Materiau;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class MateriauxController extends Controller
{
    public function index(Request $request)
    {
        $query = Materiau::query();

        if ($request->has('search')) {
            $query->where('nom', 'ILIKE', "%{$request->search}%");
        }

        $materiaux = $query->paginate(10);

        if ($request->wantsJson() || $request->ajax()) {
            return response()->json([
                'success' => true,
                'data' => $materiaux
            ]);
        }

        return view('materiaux.index', compact('materiaux'));
    }

    public function store(Request $request): JsonResponse
    {
        $validatedData = $request->validate([
            'nom' => 'required|string|max:255',
            'prix_unitaire' => 'required|numeric|min:0',
            'unite' => 'required|string|max:20' 
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
        $materiau = Materiau::findOrFail($id);
        return response()->json([
            'success' => true,
            'data' => $materiau
        ]);
    }

    public function update(Request $request, $id): JsonResponse
    {
        $materiau = Materiau::findOrFail($id);

        $validatedData = $request->validate([
            'nom' => 'sometimes|string|max:255',
            'prix_unitaire' => 'sometimes|numeric|min:0',
            'unite' => 'sometimes|string|max:20' 
        ]);

        $materiau->update($validatedData);

        return response()->json([
            'success' => true,
            'message' => 'Matériau mis à jour avec succès.',
            'data' => $materiau
        ]);
    }

    public function destroy($id): JsonResponse
    {
        $materiau = Materiau::findOrFail($id);
        $materiau->delete();

        return response()->json([
            'success' => true,
            'message' => 'Matériau supprimé avec succès.'
        ], 200);
    }
}