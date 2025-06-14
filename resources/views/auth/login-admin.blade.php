@extends('layouts.app')

@section('title', 'Connexion Admin')

@section('content')
<style>
    body {
        background: linear-gradient(to right, #e0e7ff, #dbeafe);
    }

    .login-wrapper {
        /* min-height: 85vh; */
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .login-card {
        width: 400px;
        height: 420px;
        background-color: white;
        border-radius: 1rem;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        padding: 1.5rem;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }

    .login-header {
        text-align: center;
    }

    .login-header i {
        font-size: 2rem;
        color: #1e3a8a;
        margin-bottom: 0.3rem;
    }

    .login-header h3 {
        font-size: 1.2rem;
        margin-bottom: 0.3rem;
        color: #1e3a8a;
        font-weight: bold;
    }

    .login-header p {
        font-size: 0.85rem;
        color: #6b7280;
        margin-bottom: 0;
    }

    .form-label {
        font-weight: 600;
        font-size: 0.85rem;
        color: #1e3a8a;
        margin-bottom: 0.3rem;
    }

    .form-control {
        padding: 0.45rem 0.6rem;
        font-size: 0.9rem;
    }

    .btn-login {
        background-color: #1e3a8a;
        color: white;
        font-weight: 500;
        margin-top: 0.7rem;
        transition: background-color 0.3s ease;
    }

    .btn-login:hover {
        background-color: #3b4cca;
    }

    .login-footer {
        text-align: center;
        font-size: 0.85rem;
    }

    .login-footer a {
        color: #1e3a8a;
        text-decoration: none;
    }

    .login-footer a:hover {
        text-decoration: underline;
    }
</style>

<div class="login-wrapper">
    <div class="login-card">
        <div class="login-header">
            <i class="bi bi-person-badge-fill"></i>
            <h3>Connexion Admin</h3>
            <p>Accès réservé à l'administration</p>
        </div>

        <form method="POST" action="#">
            @csrf
            <div class="mb-2">
                <label for="email" class="form-label">Adresse email</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="admin@ensa.com" required>
            </div>
            <div class="mb-2">
                <label for="password" class="form-label">Mot de passe</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="********" required>
            </div>
            <button type="submit" class="btn btn-login w-100">Se connecter</button>
        </form>

        <div class="login-footer mt-2">
            <a href="{{ route('login.etudiant') }}">Je suis un étudiant</a>
        </div>
    </div>
</div>
@endsection
