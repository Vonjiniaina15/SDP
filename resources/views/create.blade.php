<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un équipement</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container">
    <h1 class="my-4">Ajouter un nouvel équipement</h1>

    <form action="{{ route('equipements.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="nom">Nom de l'équipement</label>
            <input type="text" name="nom" id="nom" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="prix_location">Prix de location</label>
            <input type="number" name="prix_location" id="prix_location" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-success">Ajouter l'équipement</button>
    </form>

    <a href="{{ route('equipements.index') }}" class="btn btn-secondary mt-3">Retour à la liste</a>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
</body>
</html>