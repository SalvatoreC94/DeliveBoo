<!-- resources/views/auth/login.blade.php -->

@extends('layouts.guest')

@section('main-content')
    <div class="container mt-5">
        <h2 class="mb-4">Login Ristoratore</h2>
        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
        <form method="POST" action="{{ route('login') }}" onsubmit="return validateLoginForm()">
            @csrf

            <!-- Email -->
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="email"
                    value="{{ old('email') }}" required>
                @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                <div class="invalid-feedback">Inserisci un indirizzo email valido.</div>
            </div>

            <!-- Password -->
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" name="password" class="form-control @error('password') is-invalid @enderror"
                    id="password" required>
                @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
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

    <script>
        function validateLoginForm() {
            let isValid = true;

            // Controllo tutti i campi obbligatori
            document.querySelectorAll('input[required]').forEach(function(field) {
                if (!field.value || field.value.trim() === "") {
                    field.classList.add('is-invalid');
                    isValid = false;
                } else {
                    field.classList.remove('is-invalid');
                }
            });

            return isValid;
        }
    </script>
@endsection
