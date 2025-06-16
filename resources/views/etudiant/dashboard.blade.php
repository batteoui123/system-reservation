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


    <div class="reservations-overview mb-4">
        <h3 class="mb-3 text-primary">Aperçu de vos réservations récentes</h3>
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

        @if($reservations->isEmpty())
            <p class="text-secondary fst-italic">Vous n'avez pas encore de réservation.</p>
        @else
            <div class="table-responsive">
                <table class="table table-hover align-middle shadow-sm rounded">
                    <thead class="table-light">
                        <tr>
                            <th>Local</th>
                            <th>Date</th>
                            <th>Créneau</th>
                            <th>Statut</th>
                            <th>Motif de refus</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($reservations as $res)
                            <tr>
                                <td>{{ $res->local->nom }}</td>
                                <td>{{ \Carbon\Carbon::parse($res->date)->format('d/m/Y') }}</td>
                                <td>{{ $res->creneau }}</td>
                                <td>


                                        @if($res->statut == 'accepte')
                                            <span class="badge bg-success   "> accepté  </span>
                                        @elseif($res->statut == 'refuse')
                                            <span class="badge bg-danger "> refusé  </span>
                                        @elseif($res->statut == 'en attente')
                                            <span class="badge bg-primary "> en cours </span>

                                        @endif



                                </td>
                                <td><small class="text-danger d-block">{{ $res->motif_refus }}</small></td>

                                <td>
                                    @if($res->statut == 'en attente')
                                        <form method="POST" action="{{ route('etudiant.annuler', $res->id) }}">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-outline-danger btn-sm">Annuler</button>
                                        </form>
                                    @else
                                        <small class="text-muted"></small>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>

    <div class="d-flex justify-content-center mt-5">
        <a href="/etudiant/salles" class="btn btn-lg btn-primary px-5 py-3 shadow">
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

    .table-hover tbody tr:hover {
        background-color: #f0f4ff;
    }

    .table td, .table th {
        vertical-align: middle;
    }

    .badge {
        font-size: 0.9rem;
        padding: 0.5em 0.75em;
        border-radius: 8px;
    }
</style>
@endsection
