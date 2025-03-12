<?php

namespace App\Http\Controllers;

use App\Models\Transport; // Importer le modèle Transport
use Illuminate\Http\Request;

class TransportController extends Controller
{
    // Méthode pour afficher tous les transports
    public function index()
    {
        $transports = Transport::all();
        return response()->json($transports);
    }

    // Méthode pour créer un nouveau transport
    public function store(Request $request)
    {
        $request->validate([
            'destination' => 'required|string|max:255',
            'frais_transport' => 'required|numeric',
        ]);

        $transport = Transport::create([
            'destination' => $request->destination,
            'frais_transport' => $request->frais_transport,
        ]);

        return response()->json($transport, 201);
    }

    // Méthode pour afficher un transport spécifique
    public function show($id)
    {
        $transport = Transport::findOrFail($id);
        return response()->json($transport);
    }

    // Méthode pour mettre à jour un transport
    public function update(Request $request, $id)
    {
        $transport = Transport::findOrFail($id);

        $request->validate([
            'destination' => 'sometimes|string|max:255',
            'frais_transport' => 'sometimes|numeric',
        ]);

        $transport->update($request->all());

        return response()->json($transport);
    }

    // Méthode pour supprimer un transport
    public function destroy($id)
    {
        $transport = Transport::findOrFail($id);
        $transport->delete();

        return response()->json(null, 204);
    }
}