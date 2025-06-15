<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8" />
    <title>@yield('title', 'Espace Étudiant')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <script src="https://kit.fontawesome.com/your-fontawesome-key.js" crossorigin="anonymous"></script>
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet" />

    <style>
        body {
            /* background: linear-gradient(to right, #e0e7ff, #dbeafe); */
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: #1e3a8a; /* bleu foncé, pour le texte général */
            min-height: 100vh;
        }

        .navbar {
            background: linear-gradient(to right, #e0e7ff, #dbeafe);
            box-shadow: 0 2px 8px rgb(0 0 0 / 0.1);
            border-bottom: 1px solid #cbd5e1;
        }

        .navbar-brand {
            display: flex;
            align-items: center;
            gap: 10px;
            color: #1e3a8a !important; /* bleu foncé */
            font-weight: 700;
            font-size: 1.25rem;
            user-select: none;
        }

        .navbar-brand img {
            height: 40px;
            width: auto;
        }

        .nav-link, .logout-btn {
            color: #1e3a8a !important; /* bleu foncé */
            font-weight: 600;
            transition: color 0.3s ease;
        }

        .nav-link:hover, .logout-btn:hover {
            color: #2563eb !important; /* bleu plus clair au hover */
            text-decoration: underline;
        }

        .logout-btn {
            cursor: pointer;
            background: transparent;
            border: none;
            padding: 0;
            font-size: 1rem;
        }
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg px-4 mb-4">
    <a class="navbar-brand" href="#">
        <img src="{{ asset('images/logo.png') }}" alt="Logo ENSTA" />
        ReservENSA
    </a>
    <div class="d-flex ms-auto align-items-center">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="logout-btn nav-link">
                <i class="fas fa-sign-out-alt me-1"></i> Déconnexion
            </button>
        </form>
    </div>
</nav>

<div class="container">
    @yield('content')
</div>

</body>
</html>
