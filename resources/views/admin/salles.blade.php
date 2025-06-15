@extends('layouts.admin')

@section('title', 'Salles')

@section('content')
    <h2 class="mb-4 text-primary fw-bold">Gestion des Salles</h2>

    <table class="table table-hover table-bordered bg-white shadow rounded">
        <thead class="table-primary text-primary">
            <tr>
                <th>Nom</th>
                <th>Capacité</th>
                <th>Type</th>
                <th class="text-center" style="width: 220px;">Actions</th>
            </tr>
        </thead>
        <tbody>
            @php
                $salles = [
                    ['nom' => 'Salle A1', 'capacite' => 30, 'type' => 'Cours'],
                    ['nom' => 'Salle B2', 'capacite' => 20, 'type' => 'Réunion'],
                    ['nom' => 'Amphi C', 'capacite' => 100, 'type' => 'Amphithéâtre'],
                ];
            @endphp

            @forelse ($salles as $salle)
                <tr>
                    <td>{{ $salle['nom'] }}</td>
                    <td>{{ $salle['capacite'] }}</td>
                    <td>{{ $salle['type'] }}</td>
                    <td class="text-center">
                        <a href="#" class="btn btn-secondary btn-sm me-1">
                            <i class="fas fa-eye"></i>
                        </a>
                        <a href="#" class="btn btn-warning btn-sm me-1">
                            <i class="fas fa-edit"></i>
                        </a>
                        <button class="btn btn-danger btn-sm">
                            <i class="fas fa-trash"></i>
                        </button>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="text-center text-muted fst-italic py-4">
                        Aucune salle disponible.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <style>
        table.table {
            border-collapse: collapse;
            font-size: 0.95rem;
            width: 100%;
        }

        table.table thead th {
            background-color: #333;
            color: #eee;
            font-weight: 700;
            border: 1px solid #ccc;
            text-align: left;
            padding: 12px 15px;
        }

        table.table tbody tr {
            background-color: #fff;
            border-bottom: 1px solid #ddd;
            transition: background-color 0.3s ease;
        }

        table.table tbody tr:hover {
            background-color: #f2f2f2;
        }

        table.table tbody td {
            padding: 12px 15px;
            vertical-align: middle;
            border: 1px solid #ddd;
        }

        .btn-sm {
            font-size: 0.85rem;
            padding: 5px 10px;
            font-weight: 600;
        }

        .btn-secondary {
            background-color: #6b7280;
            border-color: #6b7280;
            color: white;
        }

        .btn-secondary:hover {
            background-color: #4b5563;
        }

        .btn-warning {
            background-color: #ffc107;
            border-color: #ffc107;
            color: #1e3a8a;
        }

        .btn-warning:hover {
            background-color: #e0a800;
        }

        .btn-danger {
            background-color: #a00;
            border-color: #a00;
            color: white;
        }

        .btn-danger:hover {
            background-color: #800;
        }

        td.text-center {
            display: flex;
            justify-content: center;
            gap: 10px;
            align-items: center;
        }
    </style>

@endsection
