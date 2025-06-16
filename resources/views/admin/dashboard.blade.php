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
                    <li class="list-group-item d-flex justify-content-between align-items-center border-0 border-bottom"><div class="reservation-notification">
                            Une demande de réservation d'une
                            <strong>{{ $reservation->local->type }}</strong>
                            est envoyée par l'étudiant
                            <strong>{{ $reservation->etudiant->utilisateur->nom }}</strong>
                            le {{ $reservation->created_at->format('d/m/Y') }} à {{ $reservation->created_at->format('H:i') }}
                        </div>


                        @php
                            $etat = $reservation->statut;
                        @endphp

                        <span class="badge rounded-pill

                            @if ($etat === 'accepte' || $etat === 'refuse'  ) bg-success
                            @else bg-warning text-dark
                            @endif
                        ">
                            @if ($etat === 'accepte' || $etat === 'refuse' )
                                <i class="fas fa-check-circle me-1"></i> Traité
                            @else
                                <i class="fas fa-clock me-1"></i> À traiter
                            @endif

                         </span>

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
