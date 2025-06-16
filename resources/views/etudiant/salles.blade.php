@extends('layouts.etudiant')

@section('title', 'Salles disponibles')

@section('content')
    <h2 class="mb-4 text-primary fw-bold">Salles disponibles</h2>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif



    <form method="GET" action="{{ route('etudiant.salles') }}" class="mb-4 row g-3 align-items-end">
        <div class="col-md-2">
            <label class="form-label">Date</label>
            <input type="date" name="date" value="{{ request('date') }}" class="form-control" required>
        </div>
        <div class="col-md-2">
            <label class="form-label">Heure début</label>
            <input type="time" name="heure_debut" value="{{ request('heure_debut') }}" class="form-control" required>
        </div>
        <div class="col-md-2">
            <label class="form-label">Heure fin</label>
            <input type="time" name="heure_fin" value="{{ request('heure_fin') }}" class="form-control" required>
        </div>
        <div class="col-md-2">
            <label class="form-label">Type</label>
            <select name="type" class="form-select">
                <option value="">-- Tous les types --</option>
                <option value="salle" {{ request('type') == 'salle' ? 'selected' : '' }}>Salle</option>
                <option value="amphi" {{ request('type') == 'amphi' ? 'selected' : '' }}>Amphithéâtre</option>
                <option value="conference" {{ request('type') == 'conference' ? 'selected' : '' }}>Conférence</option>
            </select>
        </div>
        <div class="col-md-2">
            <label class="form-label">Nom</label>
            <select name="nom" class="form-select">
                <option value="">-- Toutes les salles --</option>
                @foreach($sallesParType as $nomSalle)
                    <option value="{{ $nomSalle }}" {{ request('nom') == $nomSalle ? 'selected' : '' }}>
                        {{ $nomSalle }}
                    </option>
                @endforeach

            </select>
        </div>

        <div class="col-md-2">
            <button type="submit" class="btn btn-primary w-100">Rechercher</button>
        </div>
    </form>

     Résultats
    <table class="table table-hover table-bordered bg-white shadow rounded">
        <thead class="table-primary text-primary">
        <tr>
            <th>Nom</th>
            <th>Capacité</th>
            <th>Type</th>
            <th class="text-center" style="width: 180px;">Actions</th>
        </tr>
        </thead>
        <tbody>
        @isset($locaux)
            @forelse ($locaux as $salle)
                {{-- affichage des salles --}}

                <tr>
                    <td>{{ $salle->nom }}</td>
                    <td>{{ $salle->capacite }}</td>
                    <td>{{ ucfirst($salle->type) }}</td>
                    <td class="text-center">
                        <form method="POST" action="{{ route('etudiant.reservation.create', $salle->id) }}">
                            @csrf
                            <input type="hidden" name="date" value="{{ request('date') }}">
                            <input type="hidden" name="heure_debut" value="{{ request('heure_debut') }}">
                            <input type="hidden" name="heure_fin" value="{{ request('heure_fin') }}">
                            <!-- Bouton -->
                            <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#modalReserver{{ $salle->id }}">
                                Réserver
                            </button>

                            <!-- Modal -->
                            <div class="modal fade" id="modalReserver{{ $salle->id }}" tabindex="-1" aria-labelledby="modalLabel{{ $salle->id }}" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <form method="POST" action="{{ route('etudiant.reservation.create', $salle->id) }}">
                                            @csrf
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="modalLabel{{ $salle->id }}">Motif de réservation</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
                                            </div>
                                            <div class="modal-body">
                                                <input type="hidden" name="date" value="{{ request('date') }}">
                                                <input type="hidden" name="heure_debut" value="{{ request('heure_debut') }}">
                                                <input type="hidden" name="heure_fin" value="{{ request('heure_fin') }}">
                                                <div class="mb-3">
                                                    <label for="motif" class="form-label">Motif</label>
                                                    <textarea name="motif_reservation" class="form-control" required></textarea>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-primary">Envoyer</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="4" class="text-center text-muted">Aucune salle disponible.</td></tr>
            @endforelse
        @endisset
        </tbody>
    </table>
@endsection
