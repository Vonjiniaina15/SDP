<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des équipements</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container">
    <h1 class="my-4">Liste des équipements</h1>

    <!-- Afficher les messages de succès -->
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <!-- Tableau des équipements -->
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nom</th>
                <th>Prix de location</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($equipements as $equipement)
                <tr>
                    <td>{{ $equipement->nom }}</td>
                    <td>{{ $equipement->prix_location }}</td>
                    <td>
                        <a href="{{ route('equipements.edit', $equipement) }}" class="btn btn-warning btn-sm">Modifier</a>
                        <form action="{{ route('equipements.destroy', $equipement) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet équipement ?')">Supprimer</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Pagination -->
    {{ $equipements->links() }}

    <a href="{{ route('equipements.create') }}" class="btn btn-primary my-3">Ajouter un équipement</a>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
</body>
</html>