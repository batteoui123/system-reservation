@extends('layouts.admin')

@section('title', 'Gestion des Salles')

@section('content')
    <h2 class="mb-4 text-primary fw-bold">Gestion des Salles</h2>



    {{-- Message de succès --}}
    @if (session('success'))

        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    {{-- Filtrage --}}
    <form method="GET" action="{{ route('admin.salles.index') }}" class="mb-4 d-flex gap-2">

        <select name="type" class="form-select w-auto">
            <option value="">-- Tous les types --</option>
            <option value="salle" {{ request('type') == 'salle' ? 'selected' : '' }}>Salle</option>
            <option value="amphi" {{ request('type') == 'amphi' ? 'selected' : '' }}>Amphithéâtre</option>
            <option value="conference" {{ request('type') == 'conference' ? 'selected' : '' }}>Salle de conférence</option>
        </select>
        <button type="submit" class="btn btn-primary">Filtrer</button>

    </form>

    {{-- Formulaire d'ajout --}}
    <form method="POST" action="{{ route('admin.salles.store') }}" class="mb-4 border rounded p-3 bg-light">
        @csrf
        <div class="row g-2">
            <div class="col-md-4">
                <input type="text" name="nom" class="form-control" placeholder="Nom du local" required>
            </div>
            <div class="col-md-3">
                <input type="number" name="capacite" class="form-control" placeholder="Capacité" required>
            </div>
            <div class="col-md-3">
                <select name="type" class="form-select" required>
                    <option value="">-- Type --</option>
                    <option value="salle">Salle</option>
                    <option value="amphi">Amphi</option>
                    <option value="conference">Salle de conférence</option>
                </select>
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-success w-100">Ajouter</button>
            </div>
        </div>
    </form>

    {{-- Tableau des salles --}}
    <table class="table table-hover table-bordered bg-white shadow rounded">

        <thead class="table-primary text-primary">
        <tr>
            <th>Nom</th>
            <th>Capacité</th>
            <th>Type</th>
            <th class="text-center" style="width: 220px;">Actions</th>
        </tr>
        </thead>
        <tbody>
        @forelse ($locaux as $salle)
            <tr>
                <td>{{ $salle->nom }}</td>
                <td>{{ $salle->capacite }}</td>
                <td>{{ ucfirst($salle->type) }}</td>
                <td class="text-center">
                    {{-- Voir --}}
                    <a href="#" class="btn btn-secondary btn-sm me-1">
                        <i class="fas fa-eye"></i>
                    </a>

                    {{-- Bouton modifier (affiche un formulaire de modification sous la ligne) --}}
                    <button class="btn btn-warning btn-sm me-1" data-bs-toggle="collapse" data-bs-target="#editForm{{ $salle->id }}">
                        <i class="fas fa-edit"></i>
                    </button>

                    {{-- Supprimer --}}
                    <form method="POST" action="{{ route('admin.salles.destroy', $salle->id) }}" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm" onclick="return confirm('Supprimer ce local ?')">
                            <i class="fas fa-trash"></i>
                        </button>
                    </form>
                </td>
            </tr>

            {{-- Formulaire de modification (collapse Bootstrap) --}}
            <tr class="collapse" id="editForm{{ $salle->id }}">
                <td colspan="4">
                    <form method="POST" action="{{ route('admin.salles.update', $salle->id) }}" class="border rounded p-3 bg-light">
                        @csrf
                        @method('PUT')
                        <div class="row g-2 align-items-center">
                            <div class="col-md-4">
                                <input type="text" name="nom" value="{{ $salle->nom }}" class="form-control" required>
                            </div>
                            <div class="col-md-3">
                                <input type="number" name="capacite" value="{{ $salle->capacite }}" class="form-control" required>
                            </div>
                            <div class="col-md-3">
                                <select name="type" class="form-select" required>
                                    <option value="salle" {{ $salle->type == 'salle' ? 'selected' : '' }}>Salle</option>
                                    <option value="amphi" {{ $salle->type == 'amphi' ? 'selected' : '' }}>Amphi</option>
                                    <option value="conference" {{ $salle->type == 'conference' ? 'selected' : '' }}>Salle de conférence</option>
                                </select>
                            </div>
                            <div class="col-md-2">
                                <button type="submit" class="btn btn-primary w-100">Mettre à jour</button>
                            </div>
                        </div>
                    </form>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="4" class="text-center text-muted fst-italic py-4">Aucune salle disponible.</td>
            </tr>
        @endforelse

        </tbody>
    </table>
@endsection
