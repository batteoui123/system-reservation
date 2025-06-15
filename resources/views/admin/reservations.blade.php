@extends('layouts.admin')

@section('title', 'Réservations')

@section('content')
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">Gestion des réservations</h5>
        </div>
        <div class="card-body p-0">


            <form method="GET" action="{{ route('admin.reservations.index') }}" class="row g-3 align-items-end mb-4">
                <div class="col-md-4">
                    <label for="date" class="form-label">Date :</label>
                    <input type="date" name="date" id="date" class="form-control" value="{{ request('date') }}">
                </div>

                <div class="col-md-4">
                    <label for="statut" class="form-label">Statut :</label>
                    <select name="statut" id="statut" class="form-select">
                        <option value="">-- Tous les statuts --</option>
                        <option value="en attente" {{ request('statut') == 'en attente' ? 'selected' : '' }}>En attente</option>
                        <option value="accepte" {{ request('statut') == 'accepte' ? 'selected' : '' }}>Accepté</option>
                        <option value="refuse" {{ request('statut') == 'refuse' ? 'selected' : '' }}>Refusé</option>
                    </select>
                </div>

                <div class="col-md-4 d-flex gap-2">
                    <button type="submit" class="btn btn-primary flex-grow-1">Filtrer</button>
                    <a href="{{ route('admin.reservations.index') }}" class="btn btn-outline-secondary">Réinitialiser</a>
                </div>
            </form>


            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="table-light">
                    <tr>
                        <th>Étudiant</th>
                        <th>Local</th>
                        <th>Date</th>
                        <th>Créneau</th>
                        <th>Statut</th>
                        <th class="text-center" style="width: 300px;">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse ($reservations as $res)
                        <tr class="@if($res->statut === 'accepte') bg-success bg-opacity-10 @elseif($res->statut === 'refuse') bg-danger bg-opacity-10 @endif">
                            <td>{{ $res->etudiant->utilisateur->nom }}</td>
                            <td>{{ $res->local->nom }}</td>
                            <td>{{ \Carbon\Carbon::parse($res->date)->format('d/m/Y') }}</td>
                            <td>{{ $res->heure_debut }} - {{ $res->heure_fin }}</td>
                            <td>
                                @if($res->statut === 'accepte')
                                    <span class="badge bg-success"><i class="fas fa-check-circle me-1"></i> Accepté</span>
                                @elseif($res->statut === 'refuse')
                                    <span class="badge bg-danger"><i class="fas fa-times-circle me-1"></i> Refusé</span>
                                @else
                                    <span class="badge bg-warning text-dark"><i class="fas fa-clock me-1"></i> En attente</span>
                                @endif
                            </td>
                            <td class="text-center">
                                <div class="d-flex justify-content-center gap-2">
                                    {{-- Valider --}}
                                    <form action="{{ route('admin.reservations.valider', $res->id) }}" method="POST" class="flex-fill">
                                        @csrf
                                        <button class="btn btn-success btn-sm w-100 @if($res->statut === 'accepte') disabled @endif">
                                            <i class="fas fa-check"></i> @if($res->statut === 'accepte') Déjà accepté @else Valider @endif
                                        </button>
                                    </form>

                                    {{-- Refuser avec modal --}}
                                    <button type="button" class="btn btn-danger btn-sm flex-fill @if($res->statut === 'refuse') disabled @endif"
                                            data-bs-toggle="modal" data-bs-target="#refuserModal{{ $res->id }}">
                                        <i class="fas fa-times"></i> @if($res->statut === 'refuse') Déjà refusé @else Refuser @endif
                                    </button>

                                    <!-- Modal pour le motif de refus -->
                                    <div class="modal fade" id="refuserModal{{ $res->id }}" tabindex="-1" aria-labelledby="refuserModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header bg-danger text-white">
                                                    <h5 class="modal-title" id="refuserModalLabel">Modifier le statut</h5>
                                                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <form action="{{ route('admin.reservations.refuser', $res->id) }}" method="POST">
                                                    @csrf
                                                    <div class="modal-body">
                                                        <div class="mb-3">
                                                            <label class="form-label">Statut actuel:
                                                                <strong>{{ ucfirst($res->statut) }}</strong>
                                                            </label>
                                                            <hr>
                                                            <label for="motif_refus" class="form-label">Motif (optionel):</label>
                                                            <textarea class="form-control" id="motif_refus" name="motif_refus" rows="3"
                                                                      @if($res->statut === 'refuse') value="{{ $res->motif_refus ?? '' }}" @endif
                                                                      @if($res->statut !== 'refuse')  @endif></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                                                        <button type="submit" class="btn btn-danger">Confirmer</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted fst-italic py-4">
                                Aucune réservation pour le moment.
                            </td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <style>
        /* Style amélioré pour les boutons désactivés */
        .btn.disabled {
            opacity: 0.7;
            cursor: not-allowed;
        }

        .btn-success.disabled {
            background-color: #28a745;
            border-color: #28a745;
        }

        .btn-danger.disabled {
            background-color: #dc3545;
            border-color: #dc3545;
        }

        /* Effet de survol uniquement pour les boutons actifs */
        .btn-success:not(.disabled):hover {
            background-color: #218838;
            border-color: #1e7e34;
        }

        .btn-danger:not(.disabled):hover {
            background-color: #c82333;
            border-color: #bd2130;
        }
    </style>
@endsection
