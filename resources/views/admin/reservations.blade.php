@extends('layouts.admin')

@section('title', 'Réservations')

@section('content')
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card border-0 shadow-sm mb-4">
        <div class="card-header bg-gradient text-white" style="background: linear-gradient(90deg, #4e73df 0%, #1cc88a 100%);">
            <h5 class="mb-0 fw-bold" style = "color: #1e3a8a"><i class="fas fa-calendar-check me-2"></i>Gestion des réservations</h5>
        </div>
        <div class="card-body">

            {{-- Filtrage --}}
            <form method="GET" action="{{ route('admin.reservations.index') }}" class="row g-3 align-items-end mb-4">
                <div class="col-md-4">
                    <label for="date" class="form-label">Date :</label>
                    <input type="date" name="date" id="date" class="form-control shadow-sm" value="{{ request('date') }}">
                </div>

                <div class="col-md-4">
                    <label for="statut" class="form-label">Statut :</label>
                    <select name="statut" id="statut" class="form-select shadow-sm">
                        <option value="">-- Tous les statuts --</option>
                        <option value="en attente" {{ request('statut') == 'en attente' ? 'selected' : '' }}>En attente</option>
                        <option value="accepte" {{ request('statut') == 'accepte' ? 'selected' : '' }}>Accepté</option>
                        <option value="refuse" {{ request('statut') == 'refuse' ? 'selected' : '' }}>Refusé</option>
                    </select>
                </div>

                <div class="col-md-4 d-flex gap-2">
                    <button type="submit" class="btn btn-primary flex-grow-1 shadow-sm"><i class="fas fa-filter me-1"></i>Filtrer</button>
                    <a href="{{ route('admin.reservations.index') }}" class="btn btn-outline-secondary shadow-sm">Réinitialiser</a>
                </div>
            </form>

            {{-- Tableau --}}
            <div class="table-responsive">
                <table class="table table-hover align-middle shadow-sm">
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
                        <tr class="@if($res->statut === 'accepte') table-success @elseif($res->statut === 'refuse') table-danger @endif">
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
                                            <i class="fas fa-check"></i>
                                            {{ $res->statut === 'accepte' ? 'Déjà accepté' : 'Valider' }}
                                        </button>
                                    </form>

                                    {{-- Refuser --}}
                                    <button type="button" class="btn btn-danger btn-sm flex-fill @if($res->statut === 'refuse') disabled @endif"
                                            data-bs-toggle="modal" data-bs-target="#refuserModal{{ $res->id }}">
                                        <i class="fas fa-times"></i> {{ $res->statut === 'refuse' ? 'Déjà refusé' : 'Refuser' }}
                                    </button>

                                    {{-- Modal --}}
                                    <div class="modal fade" id="refuserModal{{ $res->id }}" tabindex="-1" aria-labelledby="refuserModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header bg-danger text-white">
                                                    <h5 class="modal-title">Refuser la réservation</h5>
                                                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                                                </div>
                                                <form action="{{ route('admin.reservations.refuser', $res->id) }}" method="POST">
                                                    @csrf
                                                    <div class="modal-body">
                                                        <p class="mb-2">Statut actuel :
                                                            <strong class="text-capitalize">{{ $res->statut }}</strong>
                                                        </p>
                                                        <label for="motif_refus" class="form-label">Motif (optionnel) :</label>
                                                        <textarea class="form-control" id="motif_refus" name="motif_refus" rows="3">{{ $res->motif_refus ?? '' }}</textarea>
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
        .card-header {
            border-radius: .375rem .375rem 0 0;
        }

        .table-hover tbody tr:hover {
            background-color: #f1f5f9;
        }

        .btn.disabled, .btn:disabled {
            opacity: 0.65;
            pointer-events: none;
        }

        .modal-content {
            border-radius: .75rem;
        }

        .modal-footer .btn {
            min-width: 100px;
        }
    </style>
@endsection
