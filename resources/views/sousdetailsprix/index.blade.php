@extends('layouts.app')

@section('title', 'Gestion des Sous-Détails de Prix')

@section('content')
<div class="container">
    <h1 class="my-4">Gestion des Sous-Détails de Prix</h1>

    <!-- Bouton pour ouvrir le modal d'ajout -->
    <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#sousDetailModal">
        Ajouter un Sous-Détail de Prix
    </button>

    <!-- Tableau des sous-détails de prix -->
    <table id="sousDetailsPrixTable" class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Materiau</th>
                <th>Main d'oeuvre</th>
                <th>Equipement</th>
                <th>Transport</th>
                <th>Quantité</th>
                <th>Heures Main d'oeuvre</th>
                <th>Coût Total</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($sousDetailsPrix as $sousDetail)
            <tr>
                <td>{{ $sousDetail->id }}</td>
                <td>{{ $sousDetail->materiau->nom }}</td>
                <td>{{ $sousDetail->mainDoeuvre->nom }}</td>
                <td>{{ $sousDetail->equipement->nom }}</td>
                <td>{{ $sousDetail->transport->destination }}</td>
                <td>{{ $sousDetail->quantite_materiaux }}</td>
                <td>{{ $sousDetail->heures_main_doeuvre }}</td>
                <td>{{ $sousDetail->cout_total }}</td>
                <td>
                    <button class="btn btn-warning btn-edit" data-id="{{ $sousDetail->id }}">Modifier</button>
                    <button class="btn btn-danger btn-delete" data-id="{{ $sousDetail->id }}">Supprimer</button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<!-- Modal pour l'ajout/modification -->
<div class="modal fade" id="sousDetailModal" tabindex="-1" aria-labelledby="sousDetailModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="sousDetailModalLabel">Ajouter un Sous-Détail de Prix</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="sousDetailForm">
                    <input type="hidden" id="sous_detail_id">
                    <!-- Champs pour les détails -->
                    <div class="mb-3">
                        <label for="materiaux_id" class="form-label">Matériau</label>
                        <select class="form-select" id="materiaux_id">
                            <!-- Matériaux à remplir dynamiquement -->
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="main_doeuvre_id" class="form-label">Main d'Oeuvre</label>
                        <select class="form-select" id="main_doeuvre_id">
                            <!-- Main d'oeuvre à remplir dynamiquement -->
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="equipements_id" class="form-label">Equipement</label>
                        <select class="form-select" id="equipements_id">
                            <!-- Equipements à remplir dynamiquement -->
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="transport_id" class="form-label">Transport</label>
                        <select class="form-select" id="transport_id">
                            <!-- Transports à remplir dynamiquement -->
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="quantite_materiaux" class="form-label">Quantité de Matériaux</label>
                        <input type="number" class="form-control" id="quantite_materiaux" required>
                    </div>
                    <div class="mb-3">
                        <label for="heures_main_doeuvre" class="form-label">Heures de Main d'Oeuvre</label>
                        <input type="number" class="form-control" id="heures_main_doeuvre" required>
                    </div>
                    <div class="mb-3">
                        <label for="cout_total" class="form-label">Coût Total</label>
                        <input type="number" class="form-control" id="cout_total" required>
                    </div>
                    <button type="submit" class="btn btn-success">Enregistrer</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script>
// Ajouter un script pour peupler les sélecteurs dynamique pour matériaux, main d'oeuvre, équipements, et transports, etc.
document.addEventListener("DOMContentLoaded", function () {
    // Gestion du formulaire d'ajout/modification
    document.getElementById('sousDetailForm').addEventListener('submit', function (event) {
        event.preventDefault();
        let id = document.getElementById('sous_detail_id').value;
        let materiaux_id = document.getElementById('materiaux_id').value;
        let main_doeuvre_id = document.getElementById('main_doeuvre_id').value;
        let equipements_id = document.getElementById('equipements_id').value;
        let transport_id = document.getElementById('transport_id').value;
        let quantite_materiaux = document.getElementById('quantite_materiaux').value;
        let heures_main_doeuvre = document.getElementById('heures_main_doeuvre').value;
        let cout_total = document.getElementById('cout_total').value;

        let url = id ? `/sousdetailsprix/${id}` : "{{ route('sousdetailsprix.store') }}";
        let method = id ? 'PUT' : 'POST';

        fetch(url, {
            method: method,
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            },
            body: JSON.stringify({
                materiaux_id, main_doeuvre_id, equipements_id, transport_id,
                quantite_materiaux, heures_main_doeuvre, cout_total
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                window.location.reload();
            } else {
                alert(data.message);
            }
        });
    });
});
</script>
@endsection