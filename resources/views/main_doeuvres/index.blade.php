@extends('layouts.app')

@section('content')
<div class="container mx-auto p-4">
    <h1 class="text-2xl font-bold mb-4">Gestion de la Main d'Œuvre</h1>

    <!-- Formulaire d'ajout -->
    <form id="addForm" class="mb-4 bg-gray-100 p-4 rounded">
        <div class="flex space-x-4">
            <input type="text" id="nom" name="nom" placeholder="Nom" required class="border p-2 rounded w-1/2">
            <input type="number" id="taux_horaire" name="taux_horaire" placeholder="Taux Horaire" required class="border p-2 rounded w-1/4">
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Ajouter</button>
        </div>
    </form>

    <!-- Tableau des ouvriers -->
    <table class="w-full border-collapse border">
        <thead>
            <tr class="bg-gray-200">
                <th class="border p-2">Nom</th>
                <th class="border p-2">Taux Horaire</th>
                <th class="border p-2">Actions</th>
            </tr>
        </thead>
        <tbody id="mainDoeuvreList">
            @foreach ($mainDoeuvres as $ouvrier)
                <tr data-id="{{ $ouvrier->id }}">
                    <td class="border p-2 editable" contenteditable="true">{{ $ouvrier->nom }}</td>
                    <td class="border p-2 editable" contenteditable="true">{{ $ouvrier->taux_horaire }}</td>
                    <td class="border p-2">
                        <button class="bg-green-500 text-white px-2 py-1 rounded updateBtn">Modifier</button>
                        <button class="bg-red-500 text-white px-2 py-1 rounded deleteBtn">Supprimer</button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

<!-- Script AJAX pour gestion dynamique -->
<script>
document.addEventListener("DOMContentLoaded", function () {
    const addForm = document.getElementById("addForm");
    const mainDoeuvreList = document.getElementById("mainDoeuvreList");

    // Ajouter un ouvrier
    addForm.addEventListener("submit", function (e) {
        e.preventDefault();
        let formData = new FormData(addForm);

        fetch("{{ route('main-doeuvres.store') }}", {
            method: "POST",
            body: formData,
            headers: {
                "X-CSRF-TOKEN": "{{ csrf_token() }}",
            }
        }).then(response => response.json())
          .then(data => {
              mainDoeuvreList.innerHTML += `
                <tr data-id="${data.id}">
                    <td class="border p-2 editable" contenteditable="true">${data.nom}</td>
                    <td class="border p-2 editable" contenteditable="true">${data.taux_horaire}</td>
                    <td class="border p-2">
                        <button class="bg-green-500 text-white px-2 py-1 rounded updateBtn">Modifier</button>
                        <button class="bg-red-500 text-white px-2 py-1 rounded deleteBtn">Supprimer</button>
                    </td>
                </tr>`;
              addForm.reset();
          });
    });

    // Écoute les boutons Modifier et Supprimer
    mainDoeuvreList.addEventListener("click", function (e) {
        let row = e.target.closest("tr");
        let id = row.dataset.id;

        if (e.target.classList.contains("updateBtn")) {
            let nom = row.children[0].innerText;
            let taux_horaire = row.children[1].innerText;

            fetch(`/main-doeuvres/${id}`, {
                method: "PUT",
                body: JSON.stringify({ nom, taux_horaire }),
                headers: {
                    "X-CSRF-TOKEN": "{{ csrf_token() }}",
                    "Content-Type": "application/json"
                }
            }).then(response => response.json())
              .then(data => alert("Mise à jour réussie !"));
        }

        if (e.target.classList.contains("deleteBtn")) {
            fetch(`/main-doeuvres/${id}`, {
                method: "DELETE",
                headers: {
                    "X-CSRF-TOKEN": "{{ csrf_token() }}"
                }
            }).then(() => {
                row.remove();
            });
        }
    });
});
</script>
@endsection