@extends('layouts.app')

@section('title', 'Liste des locaux')

@section('content')
<div class="container mt-5">
    <h2 class="mb-4 text-primary">Liste des locaux disponibles</h2>
    <div class="row row-cols-1 row-cols-md-3 g-4">
        @foreach($locaux as $local)
            <div class="col">
                <div class="card h-100 shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">{{ $local->nom }}</h5>
                        <p class="card-text">Type : {{ $local->type }}</p>
                        <p class="card-text">Capacité : {{ $local->capacite }}</p>
                        <p class="card-text">
                            <span class="badge {{ $local->status == 'libre' ? 'bg-success' : 'bg-danger' }}">
                                {{ ucfirst($local->status) }}
                            </span>
                        </p>
                        @if($local->status == 'libre')
                            <a href="{{ route('etudiant.reserver', $local->id) }}" class="btn btn-outline-primary btn-sm">
                                Réserver
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
