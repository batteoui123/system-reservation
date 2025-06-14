<!-- resources/views/layouts/app.blade.php -->
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'ReservENSA')</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background-color: #f8fafc;
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

        .main-content {
            padding-top: 80px;
        }
    </style>
</head>
<body>

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

    <div class="container main-content">
        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
