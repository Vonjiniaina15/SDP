@extends('layouts.app')

@section('title', 'Créer un Équipement')

@section('content')
    <div class="card">
        <div class="card-header">Ajouter un nouvel équipement</div>
        <div class="card-body">
            <form action="{{ route('equipements.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label class="form-label">Nom de l'équipement</label>
                    <input type="text" class="form-control" name="nom" required>
                </div>
                <button type="submit" class="btn btn-primary">Ajouter</button>
            </form>
        </div>
    </div>
@endsection