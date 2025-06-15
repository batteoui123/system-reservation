@extends('layouts.etudiant')

@section('title', 'Tableau de bord')

@section('content')
<div class="dashboard-container py-2">

    <div class="intro-text mb-5">
        <h2 class="section-title mb-3">Bienvenue sur votre espace étudiant</h2>
        <p class="lead text-muted">
            Cette plateforme vous permet de consulter vos réservations, découvrir les locaux disponibles et effectuer de nouvelles réservations facilement.  
            Simplifiez votre organisation et gagnez du temps !
        </p>
    </div>

    @php
    $reservations = collect([
        (object)[
            'local' => (object)['nom' => 'Salle A'],
            'date' => now()->subDays(2),
            'heure' => '10:00'
        ],
        (object)[
            'local' => (object)['nom' => 'Salle B'],
            'date' => now()->subDays(1),
            'heure' => '14:00'
        ]
    ]);
@endphp


    <div class="reservations-overview mb-4">
    <h3 class="mb-3 text-primary">Aperçu de vos réservations récentes</h3>

    @if($reservations->isEmpty())
        <p class="text-secondary fst-italic">Vous n'avez pas encore de réservation.</p>
    @else
        <ul class="list-group shadow-sm">
            @foreach($reservations->take(5) as $reservation)
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <div>
                        <strong>{{ $reservation->local->nom ?? 'Salle inconnue' }}</strong> —
                        {{ \Carbon\Carbon::parse($reservation->date)->format('d/m/Y') }} à {{ $reservation->heure }}
                    </div>
                    <span class="badge bg-primary rounded-pill">Confirmé</span>
                </li>
            @endforeach
        </ul>
    @endif
</div>


    <div class="d-flex justify-content-center mt-5">
        <a href="{{ route('etudiant.reserver', ['id' => $someId]) }}" class="btn btn-lg btn-primary px-5 py-3 shadow">
    Réserver une salle
</a>

    </div>
</div>

<style>


    .section-title {
        color: #1e3a8a;
        font-weight: 700;
        font-size: 2rem;
    }

    .intro-text p.lead {
        font-size: 1.1rem;
        max-width: 700px;
    }

    .reservations-overview h3 {
        font-weight: 600;
    }

    .list-group-item {
        border-radius: 8px;
        border: 1px solid #e0e7ff;
        margin-bottom: 8px;
        transition: background-color 0.2s ease;
        cursor: default;
    }

    .list-group-item:hover {
        background-color: #f0f5ff;
    }

    .badge.bg-primary {
        background-color: #2563eb !important;
        font-weight: 600;
    }

    .btn-primary {
        background-color: #2563eb;
        border: none;
        font-weight: 700;
        font-size: 1.2rem;
        border-radius: 10px;
        transition: background-color 0.3s ease;
    }

    .btn-primary:hover {
        background-color: #1e3a8a;
    }
</style>
@endsection
