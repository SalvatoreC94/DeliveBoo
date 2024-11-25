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
                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="name"
                    value="{{ old('name') }}" required>
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Email -->
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                    id="email" value="{{ old('email') }}" required>
                @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Password -->
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" name="password" class="form-control @error('password') is-invalid @enderror"
                    id="password" required minlength="6">
                @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Conferma Password -->
            <div class="mb-3">
                <label for="password_confirmation" class="form-label">Conferma Password</label>
                <input type="password" name="password_confirmation"
                    class="form-control @error('password_confirmation') is-invalid @enderror" id="password_confirmation"
                    required minlength="6">
                @error('password_confirmation')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Nome Ristorante -->
            <div class="mb-3">
                <label for="restaurant_name" class="form-label">Nome Ristorante</label>
                <input type="text" name="restaurant_name"
                    class="form-control @error('restaurant_name') is-invalid @enderror" id="restaurant_name"
                    value="{{ old('restaurant_name') }}" required>
                @error('restaurant_name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Indirizzo Ristorante -->
            <div class="mb-3">
                <label for="address" class="form-label">Indirizzo</label>
                <input type="text" name="address" class="form-control @error('address') is-invalid @enderror"
                    id="address" value="{{ old('address') }}" required>
                @error('address')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Partita IVA -->
            <div class="mb-3">
                <label for="partita_iva" class="form-label">Partita IVA</label>
                <input type="text" name="partita_iva" class="form-control @error('partita_iva') is-invalid @enderror"
                    id="partita_iva" value="{{ old('partita_iva') }}" required pattern="\d{11}">
                @error('partita_iva')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Tipologia di Cucina -->
            <div class="mb-3">
                <label for="cuisine_type" class="form-label">Tipologia di Cucina</label>
                <select name="cuisine_type" id="cuisine_type"
                    class="form-select @error('cuisine_type') is-invalid @enderror" required>
                    <option value="">Seleziona una tipologia</option>
                    @foreach (config('categories') as $category)
                        <option value="{{ $category['name'] }}"
                            {{ old('cuisine_type') == $category['name'] ? 'selected' : '' }}>{{ $category['name'] }}
                        </option>
                    @endforeach
                </select>
                @error('cuisine_type')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Immagine Ristorante (opzionale) -->
            <div class="mb-3">
                <label for="image" class="form-label">Immagine del Ristorante (opzionale)</label>
                <input type="file" name="image" class="form-control @error('image') is-invalid @enderror"
                    id="image" accept="image/*">
                @error('image')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Pulsante di Registrazione -->
            <button type="submit" class="btn btn-primary">Registrati</button>
        </form>

        <!-- Link al Login -->
        <p class="mt-3">Hai già un account? <a href="{{ route('login') }}">Accedi qui</a></p>
    </div>

    <script>
        function validateRegistrationForm() {
            let isValid = true;
            const password = document.getElementById('password');
            const passwordConfirmation = document.getElementById('password_confirmation');

            // Validazione password e conferma password
            if (password.value !== passwordConfirmation.value) {
                passwordConfirmation.classList.add('is-invalid');
                isValid = false;
            } else {
                passwordConfirmation.classList.remove('is-invalid');
            }

            // Controllo tutti i campi obbligatori
            document.querySelectorAll('input[required], select[required]').forEach(function(field) {
                if (!field.value) {
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
