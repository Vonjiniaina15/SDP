<?php

namespace App\Http\Controllers;

use App\Models\Equipement;
use Illuminate\Http\Request;

class EquipementController extends Controller
{
    public function index()
    {
        $equipements = Equipement::paginate(10);
        return view('test', ['Equipement' => $equipements, 'nom' => 'rakoto']);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nom' => 'required|string|max:255',
            'prix_location' => 'required|numeric',
        ]);

        Equipement::create($validatedData);

        return redirect()->route('equipements.index')->with('success', 'Équipement ajouté avec succès.');
    }

    public function update(Request $request, Equipement $equipement)
    {
        $validatedData = $request->validate([
            'nom' => 'sometimes|string|max:255',
            'prix_location' => 'sometimes|numeric',
        ]);

        $equipement->update($validatedData);

        return redirect()->route('equipements.index')->with('success', 'Équipement mis à jour avec succès.');
    }

    public function destroy(Equipement $equipement)
    {
        $equipement->delete();

        return redirect()->route('equipements.index')->with('success', 'Équipement supprimé avec succès.');
    }
}