@extends('layouts.app')

@section('title', 'Gestion des Matériaux')

@section('content')
<div class="container">
    <h1 class="my-4">Gestion des Matériaux</h1>

    <!-- Bouton pour ouvrir le modal d'ajout -->
    <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#materiauModal">
        Ajouter un Matériau
    </button>

    <!-- Tableau des matériaux -->
    <table id="materiauxTable" class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nom</th>
                <th>Prix Unitaire</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody></tbody>
    </table>
</div>

<!-- Modal pour l'ajout/modification -->
<div class="modal fade" id="materiauModal" tabindex="-1" aria-labelledby="materiauModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="materiauModalLabel">Ajouter un Matériau</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="materiauForm">
                    <input type="hidden" id="materiau_id">
                    <div class="mb-3">
                        <label for="nom" class="form-label">Nom</label>
                        <input type="text" class="form-control" id="nom" required>
                    </div>
                    <div class="mb-3">
                        <label for="prix_unitaire" class="form-label">Prix Unitaire</label>
                        <input type="number" class="form-control" id="prix_unitaire" required>
                    </div>
                    <button type="submit" class="btn btn-success">Enregistrer</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script>
document.addEventListener("DOMContentLoaded", function () {
    let materiauxTable = $('#materiauxTable').DataTable({
        ajax: "{{ route('materiaux.index') }}",
        columns: [
            { data: "id" },
            { data: "nom" },
            { data: "prix_unitaire" },
            {
                data: null,
                render: function (data, type, row) {
                    return `
                        <button class="btn btn-warning btn-edit" data-id="${row.id}" data-nom="${row.nom}" data-prix="${row.prix_unitaire}">Modifier</button>
                        <button class="btn btn-danger btn-delete" data-id="${row.id}">Supprimer</button>
                    `;
                }
            }
        ]
    });

    // Gestion du formulaire d'ajout/modification
    document.getElementById('materiauForm').addEventListener('submit', function (event) {
        event.preventDefault();
        let id = document.getElementById('materiau_id').value;
        let nom = document.getElementById('nom').value;
        let prix = document.getElementById('prix_unitaire').value;

        let url = id ? `/materiaux/${id}` : "{{ route('materiaux.store') }}";
        let method = id ? 'PUT' : 'POST';

        fetch(url, {
            method: method,
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            },
            body: JSON.stringify({ nom, prix_unitaire: prix })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                $('#materiauModal').modal('hide');
                materiauxTable.ajax.reload();
            } else {
                alert(data.message);
            }
        });
    });

    // Événement sur le bouton Modifier
    $('#materiauxTable tbody').on('click', '.btn-edit', function () {
        let id = $(this).data('id');
        let nom = $(this).data('nom');
        let prix = $(this).data('prix');

        document.getElementById('materiau_id').value = id;
        document.getElementById('nom').value = nom;
        document.getElementById('prix_unitaire').value = prix;
        
        $('#materiauModal').modal('show');
    });

    // Événement sur le bouton Supprimer
    $('#materiauxTable tbody').on('click', '.btn-delete', function () {
        let id = $(this).data('id');
        if (confirm("Voulez-vous vraiment supprimer ce matériau ?")) {
            fetch(`/materiaux/${id}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    materiauxTable.ajax.reload();
                } else {
                    alert(data.message);
                }
            });
        }
    });
});
</script>
@endsection