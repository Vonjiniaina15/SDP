<?php

namespace App\Http\Controllers;

use App\Models\Materiau; // Assurez-vous que le modèle est importé
use Illuminate\Http\Request;

class MateriauxController extends Controller
{
    public function index()
    {
        $materiaux = Materiau::all();
        return response()->json($materiaux);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'prix_unitaire' => 'required|numeric',
        ]);

        $materiau = Materiau::create($request->all());
        return response()->json($materiau, 201);
    }

    public function show($id)
    {
        $materiau = Materiau::findOrFail($id);
        return response()->json($materiau);
    }

    public function update(Request $request, $id)
    {
        $materiau = Materiau::findOrFail($id);
        $materiau->update($request->all());
        return response()->json($materiau);
    }

    public function destroy($id)
    {
        $materiau = Materiau::findOrFail($id);
        $materiau->delete();
        return response()->json(null, 204);
    }
}