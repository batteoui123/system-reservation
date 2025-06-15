@extends('layouts.admin')

@section('title', 'Tableau de bord - Admin')

@section('content')
    <div class="container py-1">
        <h2 class="mb-4 fw-bold " style = "color: #1e3a8a">Tableau de bord administrateur</h2>

        {{-- Cards stylisées --}}
        <div class="row g-4 mb-5">
            <div class="col-md-4">
                <div class="card shadow-sm border-0 p-3" style="background-color: #eef2ff;">
                    <div class="d-flex align-items-center">
                        <div class="me-3">
                            <i class="fas fa-door-open fa-2x text-primary"></i>
                        </div>
                        <div>
                            <h6 class="text-secondary mb-1">Total des salles</h6>
                            <h3 class="fw-bold text-dark">{{ $totalLocaux }}</h3>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card shadow-sm border-0 p-3" style="background-color: #ecfdf5;">
                    <div class="d-flex align-items-center">
                        <div class="me-3">
                            <i class="fas fa-check-circle fa-2x text-success"></i>
                        </div>
                        <div>
                            <h6 class="text-secondary mb-1">Salles disponibles</h6>
                            <h3 class="fw-bold text-success">{{ $locauxLibres }}</h3>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card shadow-sm border-0 p-3" style="background-color: #fef2f2;">
                    <div class="d-flex align-items-center">
                        <div class="me-3">
                            <i class="fas fa-times-circle fa-2x text-danger"></i>
                        </div>
                        <div>
                            <h6 class="text-secondary mb-1">Salles occupées</h6>
                            <h3 class="fw-bold text-danger">{{ $locauxOccupes }}</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Réservations récentes --}}
        <h4 class="mb-3 text-dark">Réservations récentes</h4>
        @if($reservationsRecentes->isEmpty())
            <p class="text-muted">Aucune réservation récente.</p>
        @else
            <ul class="list-group shadow-sm rounded">
                @foreach($reservationsRecentes as $reservation)
                    <li class="list-group-item d-flex justify-content-between align-items-center border-0 border-bottom bg-white">
                        <div>
                            <i class="fas fa-calendar-check text-primary me-2"></i>
                            Une demande de réservation envoyée par
                            <strong>{{ $reservation->etudiant->utilisateur->nom }}</strong>
                            pour <strong>{{ $reservation->local->nom }}</strong><br>
                            <small class="text-muted">le {{ $reservation->created_at->format('d/m/Y') }} à {{ $reservation->created_at->format('H:i') }}</small>
                        </div>
                        <span class="badge rounded-pill" style="background-color: #dbeafe; color: #1e3a8a;">Confirmé</span>
                    </li>
                @endforeach
            </ul>
            <div class="mt-4 text-center">
                <a href="{{ route('admin.reservations.index') }}" class="btn btn-outline-primary px-4 py-2 rounded-3 shadow-sm">
                    Voir toutes les réservations
                </a>
            </div>
        @endif
    </div>
@endsection
