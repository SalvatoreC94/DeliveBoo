@extends('layouts.guest')

@section('main-content')
    <div class="container mt-5">
        <h2 class="mb-4">Registrazione Ristoratore</h2>
        <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
            @csrf

            <!-- Nome Utente -->
            <div class="mb-3">
                <label for="username" class="form-label">Nome Utente</label>
                <input type="text" name="username" id="username"
                    class="form-control @error('username') is-invalid @enderror" value="{{ old('username') }}" required
                    autocomplete="username">
                @error('username')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Email -->
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" name="email" id="email"
                    class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" required
                    autocomplete="email">
                @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Password -->
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" name="password" id="password"
                    class="form-control @error('password') is-invalid @enderror" required autocomplete="new-password">
                @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Conferma Password -->
            <div class="mb-3">
                <label for="password_confirmation" class="form-label">Conferma Password</label>
                <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" required
                    autocomplete="new-password">
            </div>

            <!-- Nome Ristorante -->
            <div class="mb-3">
                <label for="restaurant_name" class="form-label">Nome Ristorante</label>
                <input type="text" name="restaurant_name" id="restaurant_name"
                    class="form-control @error('restaurant_name') is-invalid @enderror" value="{{ old('restaurant_name') }}"
                    required autocomplete="organization">
                @error('restaurant_name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Indirizzo -->
            <div class="mb-3">
                <label for="address" class="form-label">Indirizzo</label>
                <input type="text" name="address" id="address"
                    class="form-control @error('address') is-invalid @enderror" value="{{ old('address') }}" required
                    autocomplete="street-address">
                @error('address')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Partita IVA -->
            <div class="mb-3">
                <label for="partita_iva" class="form-label">Partita IVA</label>
                <input type="text" name="partita_iva" id="partita_iva"
                    class="form-control @error('partita_iva') is-invalid @enderror" value="{{ old('partita_iva') }}"
                    required pattern="\d{11}" autocomplete="tax-number">
                @error('partita_iva')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Tipologia di Cucina -->
            <div class="mb-3">
                <label class="form-label">Tipologia di Cucina</label>
                <div id="cuisine_type">
                    @foreach ($categories as $category)
                        <div class="form-check">
                            <input class="form-check-input @error('cuisine_type') is-invalid @enderror" type="checkbox"
                                name="cuisine_type[]" value="{{ $category->id }}" id="category-{{ $category->id }}">
                            <label class="form-check-label" for="category-{{ $category->id }}">
                                {{ $category->name }}
                            </label>
                        </div>
                    @endforeach
                    @error('cuisine_type')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <!-- Immagine -->
            <div class="mb-3">
                <label for="image" class="form-label">Immagine del Ristorante (opzionale)</label>
                <input type="file" name="image" id="image"
                    class="form-control @error('image') is-invalid @enderror" accept="image/*">
                @error('image')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Pulsante di Registrazione -->
            <button type="submit" class="btn btn-primary">Registrati</button>
        </form>
    </div>

    <!-- Link al Login -->
    <p class="mt-3">Hai già un account? <a href="{{ route('login') }}">Accedi qui</a></p>
    </div>

    <script>
        function validateRegistrationForm() {
            let isValid = true;

            // Validazione password e conferma password
            const password = document.getElementById('password');
            const passwordConfirmation = document.getElementById('password_confirmation');

            if (password && passwordConfirmation) {
                if (password.value !== passwordConfirmation.value) {
                    passwordConfirmation.classList.add('is-invalid');
                    isValid = false;
                } else {
                    passwordConfirmation.classList.remove('is-invalid');
                }
            } else {
                console.error('Password fields missing!');
            }

            // Controllo tutti i campi obbligatori
            document.querySelectorAll('input[required], select[required]').forEach(function(field) {
                if (!field.value || field.value.trim() === "") {
                    console.log(`Campo non valido: ${field.name || field.id}`);
                    field.classList.add('is-invalid');
                    isValid = false;
                } else {
                    field.classList.remove('is-invalid');
                }
            });

            console.log('Form validation result:', isValid);
            return isValid;
        }
    </script>
@endsection
