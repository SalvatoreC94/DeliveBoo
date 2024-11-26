<!-- resources/views/auth/login.blade.php -->

@extends('layouts.guest')

@section('main-content')
    <div class="container mt-5">
        <h2 class="mb-4">Login Ristoratore</h2>
        <form method="POST" action="{{ route('login') }}" onsubmit="return validateForm()">
            @csrf

            <!-- Email -->
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" name="email" class="form-control" id="email" required>
                <div class="invalid-feedback">Inserisci un indirizzo email valido.</div>
            </div>

            <!-- Password -->
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" name="password" class="form-control" id="password" required>
                <div class="invalid-feedback">La password è obbligatoria.</div>
            </div>

            <!-- Ricordami -->
            <div class="mb-3 form-check">
                <input type="checkbox" name="remember" class="form-check-input" id="remember">
                <label class="form-check-label" for="remember">Ricordami</label>
            </div>

            <!-- Pulsante di Login -->
            <button type="submit" class="btn btn-primary">Accedi</button>
        </form>

        
        @if (session('userDeleted'))
            <div class="row">
                <div class="col">
                    <div class="card my-2 alert alert-danger">
                        {{ session('userDeleted') }}
                    </div>
                </div>
            </div>
        @endif

        <!-- Link alla Registrazione -->
        <p class="mt-3">Non hai un account? <a href="{{ route('register') }}">Registrati qui</a></p>
    </div>
@endsection
