@extends('layouts.guest')

@section('main-content')
    <div class="container vh-100 p-5">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <h1 class="text-center text-primary">
                            Welcome!
                        </h1>
                        <br>
                        La welcome page è una pagina pubblica (NON protetta)
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Passare l'URL della rotta di registrazione a Vue -->
    <script>
        window.Laravel = {!! json_encode(['restaurant_register_url' => route('restaurant.register')]) !!};
    </script>

    <!-- Includi il tuo script Vue -->
    <script src="{{ mix('js/app.js') }}"></script>
@endsection
