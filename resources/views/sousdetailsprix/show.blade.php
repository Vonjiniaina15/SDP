@extends('layouts.app')

@section('title', 'Détail de Calcul du Prix Unitaire')

@section('content')
<div class="container">
    <h1 class="mb-4">Détail de Calcul : {{ $designation }}</h1>

    <div class="mb-3">
        <strong>N° Prix :</strong> {{ $numero }} <br>
        <strong>Unité :</strong> {{ $unite }}
    </div>

    {{-- MAIN D'OEUVRE --}}
    <h4 class="mt-4">Main d'œuvre</h4>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Désignation</th><th>U</th><th>Effectif</th><th>Coût Unitaire</th><th>Quantité</th><th>Personnel</th><th>Dépense</th>
            </tr>
        </thead>
        <tbody>
            @foreach($mainOeuvres as $item)
            <tr>
                <td>{{ $item->designation }}</td>
                <td>{{ $item->unite }}</td>
                <td>{{ $item->effectif }}</td>
                <td>{{ number_format($item->cout_unitaire, 2, ',', ' ') }}</td>
                <td>{{ $item->quantite }}</td>
                <td>{{ number_format($item->personnel, 2, ',', ' ') }}</td>
                <td>{{ number_format($item->depense, 2, ',', ' ') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    {{-- MATERIEL --}}
    <h4 class="mt-4">Matériel</h4>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Désignation</th><th>U</th><th>Coût Unitaire</th><th>Quantité</th><th>Dépense</th>
            </tr>
        </thead>
        <tbody>
            @foreach($materiels as $item)
            <tr>
                <td>{{ $item->designation }}</td>
                <td>{{ $item->unite }}</td>
                <td>{{ number_format($item->cout_unitaire, 2, ',', ' ') }}</td>
                <td>{{ $item->quantite }}</td>
                <td>{{ number_format($item->depense, 2, ',', ' ') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    {{-- MATERIAUX --}}
    <h4 class="mt-4">Matériaux</h4>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Désignation</th><th>U</th><th>Coût Unitaire</th><th>Quantité</th><th>Dépense</th>
            </tr>
        </thead>
        <tbody>
            @foreach($materiaux as $item)
            <tr>
                <td>{{ $item->designation }}</td>
                <td>{{ $item->unite }}</td>
                <td>{{ number_format($item->cout_unitaire, 2, ',', ' ') }}</td>
                <td>{{ $item->quantite }}</td>
                <td>{{ number_format($item->depense, 2, ',', ' ') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    {{-- RÉCAPITULATION --}}
    <h4 class="mt-4">Récapitulatif</h4>
    <table class="table table-bordered w-50">
        <tr>
            <th>Total Déboursé (D)</th>
            <td>{{ number_format($total_debourse, 2, ',', ' ') }} Ar</td>
        </tr>
        <tr>
            <th>Rendement (R)</th>
            <td>{{ number_format($rendement, 2, ',', ' ') }}</td>
        </tr>
        <tr>
            <th>Coefficient (K1)</th>
            <td>{{ number_format($coefficient_k1, 2, ',', ' ') }}</td>
        </tr>
        <tr class="table-success">
            <th>Prix Unitaire (K1 × D / R)</th>
            <td><strong>{{ number_format($prix_unitaire, 2, ',', ' ') }} Ar</strong></td>
        </tr>
    </table>
</div>
@endsection