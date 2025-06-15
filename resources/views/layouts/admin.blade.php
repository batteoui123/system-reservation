<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8" />
    <title>@yield('title', 'Espace Admin')</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <!-- FontAwesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet" />

    <style>
        /* Fond dégradé doux comme la page d'accueil */
        body {
            min-height: 100vh;
            background: linear-gradient(to right, #e0e7ff, #dbeafe);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: #1e293b;
            margin: 0;
            display: flex;
            flex-direction: column;
        }

        /* Navbar blanc avec texte bleu foncé */
        .navbar {
            background-color: white;
            box-shadow: 0 2px 8px rgb(0 0 0 / 0.1);
            padding: 0.75rem 1.5rem;
        }
        .navbar-brand,
        .nav-link {
            color: #1e3a8a !important;
            font-weight: 600;
        }
        .nav-link:hover {
            color: #2563eb !important; /* bleu plus doux au hover */
        }

        /* Layout en flex: sidebar + contenu */
        .main-container {
            display: flex;
            flex: 1;
            min-height: calc(100vh - 56px); /* navbar height = 56px */
        }

        /* Sidebar */
        .sidebar {
            width: 250px;
            background-color: white;
            box-shadow: 2px 0 8px rgb(0 0 0 / 0.1);
            padding: 2rem 1.5rem;
            display: flex;
            flex-direction: column;
            gap: 1.2rem;
        }
        .sidebar a {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            font-weight: 600;
            font-size: 1.1rem;
            color: #1e3a8a;
            text-decoration: none;
            padding: 0.5rem 0.75rem;
            border-radius: 6px;
            transition: background-color 0.3s ease, color 0.3s ease;
        }
        .sidebar a i {
            font-size: 1.3rem;
            color: #2563eb; /* bleu icon */
        }
        .sidebar a:hover {
            background-color: #e0e7ff; /* léger bleu pâle au hover */
            color: #1e3a8a;
        }
        .sidebar a.active {
            background-color: #1e3a8a;
            color: white;
        }
        .sidebar a.active i {
            color: #93c5fd; /* bleu clair pour l’icône active */
        }

        /* Contenu principal */
        .content {
            flex: 1;
            padding: 2.5rem 3rem;
            background: white;
            box-shadow: inset 0 0 20px rgb(0 0 0 / 0.03);
            overflow-y: auto;
        }

        /* Bouton déconnexion */
        .btn-logout {
            border: 2px solid #2563eb;
            background: transparent;
            color: #1e3a8a;
            font-weight: 600;
            padding: 0.4rem 1.2rem;
            border-radius: 8px;
            transition: background-color 0.3s ease, color 0.3s ease;
            white-space: nowrap;
        }
        .btn-logout:hover {
            background-color: #2563eb;
            color: white;
        }

        /* Notification icon */
        .notification-dot {
            height: 10px;
            width: 10px;
            background-color: #2563eb;
            border-radius: 50%;
            display: inline-block;
            margin-left: 6px;
            box-shadow: 0 0 6px #2563eb;
        }

        /* Dropdown styling */
        .dropdown-menu {
            min-width: 220px;
            border-radius: 8px;
            box-shadow: 0 10px 20px rgb(0 0 0 / 0.15);
            font-weight: 600;
            color: #1e3a8a;
        }
        .dropdown-item i {
            color: #2563eb;
            margin-right: 10px;
            font-size: 1.1rem;
        }

    </style>
</head>
<body>
<nav class="navbar">
    <div class="container-fluid d-flex justify-content-between align-items-center">
        <a href="#" class="navbar-brand d-flex align-items-center gap-2 fw-bold">
            <img src="{{ asset('images/logo.png') }}" alt="Logo ENSA" style="height: 36px;">
            ReservENSA
        </a>
        <div class="d-flex align-items-center gap-3">
            <div class="nav-item dropdown">
                <a class="nav-link dropdown-toggle position-relative" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="color:#1e3a8a; font-weight: 600;">
                    <i class="fas fa-bell fa-lg"></i>
                    <span class="notification-dot"></span>
                </a>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li><a class="dropdown-item" href="#"><i class="fas fa-calendar-plus"></i> Nouvelle réservation</a></li>
                    <li><a class="dropdown-item" href="#"><i class="fas fa-building"></i> Salle modifiée</a></li>
                </ul>
            </div>
            <a href="{{ route('logout') }}" class="btn btn-logout">Se déconnecter</a>
        </div>
    </div>
</nav>

<div class="main-container">
    <aside class="sidebar">
        <a href="{{ route('admin.dashboard.index') }}" class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
            <i class="fas fa-chart-line"></i> Dashboard
        </a>
        <a href="{{ route('admin.reservations.index') }}" class="{{ request()->routeIs('admin.reservations') ? 'active' : '' }}">
            <i class="fas fa-calendar-check"></i> Réservations
        </a>
        <a href="{{ route('admin.salles.index') }}" class="{{ request()->routeIs('admin.salles') ? 'active' : '' }}">
            <i class="fas fa-door-open"></i> Salles
        </a>

    </aside>

    <main class="content">
        @yield('content')
    </main>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
