@extends('layouts.admin')

@section('title', 'Réservations')

@section('content')



    <table class="table table-hover table-bordered bg-white shadow rounded">
        <thead class="table-primary text-primary">
            <tr>
                <th>Étudiant</th>
                <th>Local</th>
                <th>Date</th>
                <th>Créneau</th>
                <th class="text-center" style="width: 220px;">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($reservations as $res)
                <tr>
                    <td>{{ $res->etudiant->utilisateur->nom }}</td>
                    <td>{{ $res->local->nom }}</td>
                    <td>{{ \Carbon\Carbon::parse($res->date)->format('d/m/Y') }}</td>
                    <td>{{ $res->creneau }}</td>
                    <td class="text-center">
                        <form action="#" method="POST" class="d-inline-block me-2">
                            @csrf
                            <button class="btn btn-primary btn-sm" >
                                <i class="fas fa-check"></i> Valider
                            </button>
                        </form>

                        <form action="#" method="POST" class="d-inline-block">
                            @csrf
                            <input
                                type="text"
                                name="motif_refus"
                                placeholder="Motif refus"
                                class="form-control form-control-sm d-inline-block mb-1"
                                style="width: 130px;"
                                
                                title="Entrez un motif de refus"
                            />
                            <button class="btn btn-danger btn-sm w-100" >
                                <i class="fas fa-times"></i> Refuser
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center text-muted fst-italic py-4">
                        Aucune réservation pour le moment.
                    </td>
                </tr>
            @endforelse
        </tbody>
       
    </table>


    <style>
        /* Table réservations */
table.table {
    border-collapse: collapse;
    font-size: 0.95rem;
    width: 100%;
}

/* En-tête */
table.table thead th {
    background-color: #333; /* gris foncé */
    color: #eee; /* texte clair */
    font-weight: 700;
    border: 1px solid #ccc;
    text-align: left;
    padding: 12px 15px;
    border-radius: 0; /* plus d’arrondi */
}

/* Corps */
table.table tbody tr {
    background-color: #fff;
    border-bottom: 1px solid #ddd;
    transition: background-color 0.3s ease;
}

table.table tbody tr:hover {
    background-color: #f2f2f2; /* gris très clair au hover */
}

/* Cellules */
table.table tbody td {
    padding: 12px 15px;
    vertical-align: middle;
    border: 1px solid #ddd;
}

/* Actions - bouton */
.btn-sm {
    font-size: 0.85rem;
    padding: 5px 10px;
    border-radius: 0; /* plus d’arrondi */
    font-weight: 600;
    transition: background-color 0.2s ease;
}

/* Boutons actifs */
.btn-primary:not(:disabled) {
    background-color: #555; /* gris moyen */
    border-color: #555;
    color: #fff;
}

.btn-primary:not(:disabled):hover {
    background-color: #444;
    border-color: #444;
}

.btn-danger:not(:disabled) {
    background-color: #a00; /* rouge foncé */
    border-color: #a00;
    color: #fff;
}

.btn-danger:not(:disabled):hover {
    background-color: #800;
    border-color: #800;
}

/* Input motif refus */
input[name="motif_refus"] {
    font-size: 0.85rem;
    border-radius: 0;
    border: 1.5px solid #aaa;
    transition: border-color 0.2s ease;
    padding: 5px 8px;
}

input[name="motif_refus"]:focus {
    border-color: #555;
    box-shadow: none;
    outline: none;
}

/* Texte “Aucune réservation...” */
table.table tbody tr td.text-muted {
    font-style: italic;
    font-weight: 500;
}

/* Centrer les actions */
td.text-center {
    display: flex;
    justify-content: center;
    gap: 10px;
    align-items: center;
}

/* Petite marge entre le champ motif et bouton Refuser */
form.d-inline-block {
    display: flex;
    flex-direction: column;
    gap: 6px;
    width: 150px;
}

</style>
@endsection
