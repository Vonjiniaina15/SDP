<?php

namespace App\Http\Controllers;

use App\Models\SousDetailPrix;
use Illuminate\Http\Request;

class SousDetailPrixController extends Controller
{
    public function index(Request $request)
    {
        if ($request->wantsJson() || $request->ajax()) {
            return response()->json(SousDetailPrix::all());
        }

        $sousDetailsPrix = SousDetailPrix::all();
        return view('sousdetailsprix.index', compact('sousDetailsPrix'));
    }

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
            'k1' => 'required|numeric',
            'r' => 'required|numeric',
        ]);

        $data = $request->all();
        $data['prix_unitaire'] = ($data['k1'] * $data['cout_total']) / $data['r'];

        $sousDetailPrix = SousDetailPrix::create($data);

        return response()->json($sousDetailPrix, 201);
    }

    public function show($id)
    {
        $sousDetailPrix = SousDetailPrix::findOrFail($id);
        return response()->json($sousDetailPrix);
    }

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
            'k1' => 'sometimes|numeric',
            'r' => 'sometimes|numeric',
        ]);

        $data = $request->all();

        // Recalcul du prix unitaire si K1 ou R ou coût total est modifié
        if (isset($data['k1']) || isset($data['r']) || isset($data['cout_total'])) {
            $k1 = $data['k1'] ?? $sousDetailPrix->k1;
            $r = $data['r'] ?? $sousDetailPrix->r;
            $cout_total = $data['cout_total'] ?? $sousDetailPrix->cout_total;
            $data['prix_unitaire'] = ($k1 * $cout_total) / $r;
        }

        $sousDetailPrix->update($data);

        return response()->json($sousDetailPrix);
    }

    public function destroy($id)
    {
        $sousDetailPrix = SousDetailPrix::findOrFail($id);
        $sousDetailPrix->delete();

        return response()->json(null, 204);
    }
}