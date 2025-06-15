@extends('layouts.app')

@section('title', 'Mes Réservations')

@section('content')
<div class="container mt-5">
    <h3 class="mb-4 text-primary">Mes Réservations</h3>
    <table class="table table-hover">
        <thead>
            <tr>
                <th>Local</th>
                <th>Date</th>
                <th>Créneau</th>
                <th>Statut</th>
                <th>Actions</th>
            </tr>
        </thead>
        
        <tbody>
            @foreach($reservations as $res)
                <tr>
                    <td>{{ $res->local->nom }}</td>
                    <td>{{ $res->date }}</td>
                    <td>{{ $res->creneau }}</td>
                    <td>
                        <span class="badge 
                            @if($res->statut == 'accepté') bg-success
                            @elseif($res->statut == 'refusé') bg-danger
                            @else bg-warning text-dark @endif">
                            {{ $res->statut }}
                        </span>
                    </td>
                    <td>
                        @if($res->statut == 'en attente')
                            <form method="POST" action="{{ route('etudiant.annuler', $res->id) }}">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-outline-danger btn-sm">Annuler</button>
                            </form>
                        @elseif($res->statut == 'refusé')
                            <small class="text-danger">{{ $res->motif_refus }}</small>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
