@extends('layouts.guest')

@section('main-content')
    <div class="container mt-5">
        <h2 class="mb-4">Registrazione Ristoratore</h2>

        @if (session('success'))
            <div class="alert alert-success mt-3" id="success-message">
                {{ session('success') }}
            </div>
        @endif

        <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data" id="registration-form">
            @csrf

            <!-- Nome Utente -->
            <div class="mb-3">
                <label for="username" class="form-label">Nome Utente <span class="text-danger">*</span></label>
                <input type="text" name="username" id="username" class="form-control" value="{{ old('username') }}"
                    required autocomplete="username" minlength="3" maxlength="50">
                <div class="invalid-feedback">Il nome utente deve avere tra 3 e 50 caratteri.</div>
            </div>

            <!-- Email -->
            <div class="mb-3">
                <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}"
                    required autocomplete="email">
                <div class="invalid-feedback">Inserisci un indirizzo email valido.</div>
            </div>

            <!-- Password -->
            <div class="mb-3">
                <label for="password" class="form-label">Password <span class="text-danger">*</span></label>
                <input type="password" name="password" id="password" class="form-control" required
                    autocomplete="new-password" minlength="6" maxlength="100">
                <div class="invalid-feedback">La password deve avere almeno 6 caratteri.</div>
            </div>

            <!-- Conferma Password -->
            <div class="mb-3">
                <label for="password_confirmation" class="form-label">Conferma Password <span
                        class="text-danger">*</span></label>
                <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" required
                    autocomplete="new-password">
                <div class="invalid-feedback">La password di conferma deve corrispondere alla password.</div>
            </div>

            <!-- Nome Ristorante -->
            <div class="mb-3">
                <label for="restaurant_name" class="form-label">Nome Ristorante <span class="text-danger">*</span></label>
                <input type="text" name="restaurant_name" id="restaurant_name" class="form-control"
                    value="{{ old('restaurant_name') }}" required autocomplete="organization" minlength="3"
                    maxlength="100">
                <div class="invalid-feedback">Il nome del ristorante deve avere tra 3 e 100 caratteri.</div>
            </div>

            <!-- Indirizzo -->
            <div class="mb-3">
                <label for="address" class="form-label">Indirizzo <span class="text-danger">*</span></label>
                <input type="text" name="address" id="address" class="form-control" value="{{ old('address') }}"
                    required autocomplete="street-address" minlength="5" maxlength="150">
                <div class="invalid-feedback">L'indirizzo deve avere tra 5 e 150 caratteri.</div>
            </div>

            <!-- Partita IVA -->
            <div class="mb-3">
                <label for="partita_iva" class="form-label">Partita IVA <span class="text-danger">*</span></label>
                <input type="text" name="partita_iva" id="partita_iva" class="form-control"
                    value="{{ old('partita_iva') }}" required pattern="\d{11}" minlength="11" maxlength="11"
                    autocomplete="tax-number">
                <div class="invalid-feedback">La partita IVA deve essere composta da 11 cifre.</div>
            </div>

            <!-- Tipologia di Cucina -->
            <div class="mb-3">
                <label class="form-label">Tipologia di Cucina <span class="text-danger">*</span></label>
                <div id="cuisine_type">
                    @foreach ($categories as $category)
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="cuisine_type[]"
                                value="{{ $category->id }}" id="category-{{ $category->id }}">
                            <label class="form-check-label" for="category-{{ $category->id }}">
                                {{ $category->name }}
                            </label>
                        </div>
                    @endforeach
                    <div class="invalid-feedback d-block">Seleziona almeno una tipologia di cucina.</div>
                </div>
            </div>

            <!-- Immagine -->
            <div class="mb-3">
                <label for="image" class="form-label">Immagine del Ristorante (opzionale)</label>
                <input type="file" name="image" id="image" class="form-control" accept="image/*">
                <div class="invalid-feedback">Carica un'immagine valida (jpeg, png, jpg, gif, svg).</div>
            </div>

            <!-- Pulsante di Registrazione -->
            <button type="submit" class="btn btn-primary">Registrati</button>
        </form>
    </div>

    <!-- Link al Login -->
    <p class="mt-3">Hai già un account? <a href="{{ route('login') }}">Accedi qui</a></p>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Nascondere il messaggio di successo dopo 5 secondi
            const successMessage = document.getElementById('success-message');
            if (successMessage) {
                setTimeout(() => {
                    successMessage.style.display = 'none';
                }, 5000);
            }

            // Aggiunge un listener di input a ciascun campo per validare in tempo reale
            document.querySelectorAll('input, select').forEach(function(field) {
                field.addEventListener('input', function() {
                    validateField(field);
                });
            });

            // Funzione di validazione dei campi in tempo reale
            function validateField(field) {
                if (field.checkValidity()) {
                    field.classList.remove('is-invalid');
                    field.classList.add('is-valid');
                } else {
                    field.classList.remove('is-valid');
                    field.classList.add('is-invalid');
                }
            }

            // Validazione della conferma della password
            const password = document.getElementById('password');
            const passwordConfirmation = document.getElementById('password_confirmation');
            if (password && passwordConfirmation) {
                passwordConfirmation.addEventListener('input', function() {
                    if (password.value !== passwordConfirmation.value) {
                        passwordConfirmation.classList.add('is-invalid');
                    } else {
                        passwordConfirmation.classList.remove('is-invalid');
                    }
                });
            }

            // Reset del form dopo la registrazione
            @if (session('success'))
                const registrationForm = document.getElementById('registration-form');
                if (registrationForm) {
                    registrationForm.reset();
                    document.querySelectorAll('.is-valid, .is-invalid').forEach(function(field) {
                        field.classList.remove('is-valid', 'is-invalid');
                    });
                }
            @endif
        });
    </script>
@endsection
