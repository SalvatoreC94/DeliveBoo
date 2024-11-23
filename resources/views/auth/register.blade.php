<!-- resources/views/auth/register.blade.php -->

@extends('layouts.guest')

@section('main-content')
    <div class="container mt-5">
        <h2 class="mb-4">Registrazione Ristoratore</h2>
        <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data"
            onsubmit="return validateRegistrationForm()">
            @csrf

            <!-- Nome Utente -->
            <div class="mb-3">
                <label for="name" class="form-label">Nome Utente</label>
                <input type="text" name="name" class="form-control" id="name" required>
                <div class="invalid-feedback">Il nome utente è obbligatorio.</div>
            </div>

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

            <!-- Conferma Password -->
            <div class="mb-3">
                <label for="password_confirmation" class="form-label">Conferma Password</label>
                <input type="password" name="password_confirmation" class="form-control" id="password_confirmation"
                    required>
                <div class="invalid-feedback">La conferma della password è obbligatoria.</div>
            </div>

            <!-- Nome Ristorante -->
            <div class="mb-3">
                <label for="restaurant_name" class="form-label">Nome Ristorante</label>
                <input type="text" name="restaurant_name" class="form-control" id="restaurant_name" required>
                <div class="invalid-feedback">Il nome del ristorante è obbligatorio.</div>
            </div>

            <!-- Indirizzo Ristorante -->
            <div class="mb-3">
                <label for="address" class="form-label">Indirizzo</label>
                <input type="text" name="address" class="form-control" id="address" required>
                <div class="invalid-feedback">L'indirizzo è obbligatorio.</div>
            </div>

            <!-- Partita IVA -->
            <div class="mb-3">
                <label for="partita_iva" class="form-label">Partita IVA</label>
                <input type="text" name="partita_iva" class="form-control" id="partita_iva" required>
                <div class="invalid-feedback">La partita IVA è obbligatoria.</div>
            </div>

            <!-- Tipologia di Cucina -->
            <div class="mb-3">
                <label for="cuisine_type" class="form-label">Tipologia di Cucina</label>
                <select name="cuisine_type" id="cuisine_type" class="form-select" required>
                    <option value="">Seleziona una tipologia</option>
                    @foreach (config('categories') as $category)
                        <option value="{{ $category['name'] }}">{{ $category['name'] }}</option>
                    @endforeach
                </select>
                <div class="invalid-feedback">Seleziona una tipologia di cucina.</div>
            </div>

            <!-- Immagine Ristorante (opzionale) -->
            <div class="mb-3">
                <label for="image" class="form-label">Immagine del Ristorante (opzionale)</label>
                <input type="file" name="image" class="form-control" id="image">
            </div>

            <!-- Pulsante di Registrazione -->
            <button type="submit" class="btn btn-primary">Registrati</button>
        </form>

        <!-- Link al Login -->
        <p class="mt-3">Hai già un account? <a href="{{ route('login') }}">Accedi qui</a></p>
    </div>
@endsection
