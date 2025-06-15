@extends('layouts.app')

@section('title', 'Réserver un local')

@section('content')
<div class="container mt-5">
    <div class="card shadow p-4 mx-auto" style="max-width: 500px;">
        <h4 class="text-primary mb-3">Réservation - {{ $local->nom }}</h4>
        <form method="POST" action="{{ route('etudiant.storeReservation') }}">
            @csrf
            <input type="hidden" name="local_id" value="{{ $local->id }}">
            <div class="mb-3">
                <label for="date" class="form-label">Date</label>
                <input type="date" class="form-control" name="date" required>
            </div>
            <div class="mb-3">
                <label for="creneau" class="form-label">Créneau horaire</label>
                <select class="form-select" name="creneau" required>
                    <option value="8h-10h">8h - 10h</option>
                    <option value="10h-12h">10h - 12h</option>
                    <option value="14h-16h">14h - 16h</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary w-100">Envoyer la demande</button>
        </form>
    </div>
</div>
@endsection
