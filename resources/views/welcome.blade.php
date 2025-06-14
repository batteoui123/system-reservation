<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>ReservENSA - Accueil</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

    <style>
        html, body {
            height: 100%;
            margin: 0;
            padding: 0;
        }

        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            font-family: 'Segoe UI', sans-serif;
            color: #1e293b;
             background: linear-gradient(to right, #e0e7ff, #dbeafe);
        }

        main {
            flex: 1;
        }

        .hero-section {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-align: center;
            padding: 4rem 1rem;
        }

        .hero-section h1 {
            font-size: 2.8rem;
            font-weight: bold;
            margin-bottom: 1rem;
            color: #1e3a8a;
        }

        .hero-section p {
            font-size: 1.2rem;
            max-width: 700px;
            margin-bottom: 2rem;
        }

        .btn-custom {
            padding: 12px 25px;
            font-size: 1.1rem;
            border-radius: 8px;
            transition: all 0.3s ease;
        }

        .btn-custom:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 15px rgba(0, 0, 0, 0.1);
        }

        footer {
            background-color: #1e3a8a;
            color: white;
            text-align: center;
            padding: 1rem 0;
            margin-top: auto;
        }

   
    
           .navbar {
            background-color: white;
        }

        .navbar-brand,
        .nav-link {
            color: #1e3a8a !important;
        }
      

        .nav-link:hover {
            color: #ffc107 !important;
        }

        .hero {
            padding: 80px 20px;
            text-align: center;
        }

        .hero h1 {
            font-size: 3rem;
            font-weight: bold;
            color: #1e3a8a;
        }

        .hero p {
            font-size: 1.2rem;
            color: #374151;
            margin-top: 10px;
        }

        .hero-buttons {
            margin-top: 40px;
            display: flex;
            justify-content: center;
            gap: 25px;
            flex-wrap: wrap;
        }

        .btn-custom {
            padding: 14px 30px;
            font-size: 1.1rem;
            border-radius: 12px;
            transition: 0.3s ease;
            min-width: 200px;
        }

        .btn-custom i {
            margin-right: 10px;
        }

        .btn-custom:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.1);
        }


    </style>
</head>

<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg shadow-sm">
    <div class="container">
        <a class="navbar-brand d-flex align-items-center gap-2 fw-bold" href="{{ url('/') }}">
    <img src="{{ asset('images/logo.png') }}" alt="Logo ENSA" style="height: 40px;">
    ReservENSA
</a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavbar">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="mainNavbar">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/') }}"><i class="fas fa-home"></i> Accueil</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('login.etudiant') }}"><i class="fas fa-user-graduate"></i> Étudiant</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('login.admin') }}"><i class="fas fa-user-cog"></i> Admin</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

    <!-- Main -->
    <main>
        <section class="hero-section">
            <h1>Bienvenue sur <span class="text-primary">ReservENSA</span></h1>
            <p>
            Gérez la réservation des salles à l'ENSA en toute simplicité. <br>
            Étudiants et administrateurs peuvent organiser TDs, réunions, clubs et soutenances efficacement.
        </p>
            <div class="hero-buttons">
            <a href="{{ route('login.etudiant') }}">
                <button class="btn btn-primary btn-custom">
                    <i class="fas fa-user-graduate"></i> Espace Étudiant
                </button>
            </a>
            <a href="{{ route('login.admin') }}">
                <button class="btn btn-outline-primary btn-custom">
                    <i class="fas fa-user-cog"></i> Espace Admin
                </button>
            </a>
        </div>
        </section>
    </main>

    <!-- Footer -->
    <footer>
        © 2025 ReservENSA · Projet ENSA · Tous droits réservés
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
