@extends('layouts.app')

@section('title', 'Gestion des Transports')

@section('content')
<div class="container">
    <h1 class="my-4">Gestion des Transports</h1>

    <!-- Bouton pour ouvrir le modal d'ajout -->
    <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#transportModal">
        Ajouter un Transport
    </button>

    <!-- Tableau des transports -->
    <table id="transportsTable" class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Destination</th>
                <th>Frais Transport</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody></tbody>
    </table>
</div>

<!-- Modal pour l'ajout/modification -->
<div class="modal fade" id="transportModal" tabindex="-1" aria-labelledby="transportModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="transportModalLabel">Ajouter un Transport</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="transportForm">
                    <input type="hidden" id="transport_id">
                    <div class="mb-3">
                        <label for="destination" class="form-label">Destination</label>
                        <input type="text" class="form-control" id="destination" required>
                    </div>
                    <div class="mb-3">
                        <label for="frais_transport" class="form-label">Frais Transport</label>
                        <input type="number" class="form-control" id="frais_transport" required>
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
document.addEventListener("DOMContentLoaded", function () {
    let transportsTable = $('#transportsTable').DataTable({
        ajax: "{{ route('transports.index') }}",
        columns: [
            { data: "id" },
            { data: "destination" },
            { data: "frais_transport" },
            {
                data: null,
                render: function (data, type, row) {
                    return `
                        <button class="btn btn-warning btn-edit" data-id="${row.id}" data-destination="${row.destination}" data-frais="${row.frais_transport}">Modifier</button>
                        <button class="btn btn-danger btn-delete" data-id="${row.id}">Supprimer</button>
                    `;
                }
            }
        ]
    });

    // Gestion du formulaire d'ajout/modification
    document.getElementById('transportForm').addEventListener('submit', function (event) {
        event.preventDefault();
        let id = document.getElementById('transport_id').value;
        let destination = document.getElementById('destination').value;
        let frais = document.getElementById('frais_transport').value;

        let url = id ? `/transports/${id}` : "{{ route('transports.store') }}";
        let method = id ? 'PUT' : 'POST';

        fetch(url, {
            method: method,
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            },
            body: JSON.stringify({ destination, frais_transport: frais })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                $('#transportModal').modal('hide');
                transportsTable.ajax.reload();
            } else {
                alert(data.message);
            }
        });
    });

    // Événement sur le bouton Modifier
    $('#transportsTable tbody').on('click', '.btn-edit', function () {
        let id = $(this).data('id');
        let destination = $(this).data('destination');
        let frais = $(this).data('frais');

        document.getElementById('transport_id').value = id;
        document.getElementById('destination').value = destination;
        document.getElementById('frais_transport').value = frais;
        
        $('#transportModal').modal('show');
    });

    // Événement sur le bouton Supprimer
    $('#transportsTable tbody').on('click', '.btn-delete', function () {
        let id = $(this).data('id');
        if (confirm("Voulez-vous vraiment supprimer ce transport ?")) {
            fetch(`/transports/${id}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    transportsTable.ajax.reload();
                } else {
                    alert(data.message);
                }
            });
        }
    });
});
</script>
@endsection
