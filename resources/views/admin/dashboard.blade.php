@extends('layouts.admin')

@section('title', 'Tableau de bord - Admin')

@section('content')
    <div class="container py-5">
        <h2 class="mb-4 fw-bold text-dark">Tableau de bord administrateur</h2>


        {{-- Cards avec style doux --}}
        <div class="row g-4 mb-5">
            <div class="col-md-4">
                <div class="card shadow-sm border-0 bg-light">
                    <div class="card-body">
                        <h6 class="text-muted">Total des salles</h6>
                        <h3 class="fw-bold text-dark">{{ $totalLocaux }}</h3>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card shadow-sm border-0" style="background-color: #f0f9f9;">
                    <div class="card-body">
                        <h6 class="text-muted">Salles disponibles</h6>
                        <h3 class="fw-bold text-success">{{ $locauxLibres }}</h3>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card shadow-sm border-0" style="background-color: #fef6f6;">
                    <div class="card-body">
                        <h6 class="text-muted">Salles occupées</h6>
                        <h3 class="fw-bold text-danger">{{ $locauxOccupes }}</h3>
                    </div>
                </div>
            </div>
        </div>

        {{-- Réservations récentes --}}
        <h4 class="mb-3 text-secondary">Réservations récentes</h4>
        @if($reservationsRecentes->isEmpty())
            <p class="text-muted">Aucune réservation récente.</p>
        @else
            <ul class="list-group shadow-sm">
                @foreach($reservationsRecentes as $reservation)
                    <li class="list-group-item d-flex justify-content-between align-items-center border-0 border-bottom">
                        <div>
                           une  demande de reservation envoyée par
                            <strong>{{ $reservation->etudiant->utilisateur->nom }}
                            </strong>
                            <strong>{{ $reservation->local->nom }}</strong>

                            le {{ $reservation->created_at }} à {{ $reservation->created_at->format('H:i') }}

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
