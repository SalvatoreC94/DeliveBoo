@extends('layouts.guest')

@section('main-content')
    <div class="container vh-100 p-5">
        <div class="row">
            <div class="col-12">
                <h1 class="text-center">
                    Benvenuto futuro ristoratore!
                </h1>
                <p class="text-center ibm-plex-mono-regular">
                    Entra a far parte della grande famiglia di deliveBoo e inizia la tua attività ora!
                </p>
            </div>
            
            <div class="row">
                <div class="col-12">
                    <div class="card w-50">
                        <div class="card-body text-center">
                            <div>
                                <h5 class="mt-2 ibm-plex-mono-semibold">
                                    Registrati ora!
                                </h5>
                                <button class="button-menu w-100 ibm-plex-mono-regular">
                                    <a class="nav-link" href="{{ route('register') }}">Registrati</a>
                                </button>
                            </div>

                            <hr class="mb-3 mt-3">

                            <div>
                                <h5 class=" ibm-plex-mono-semibold">
                                    Ti sei già registrato?
                                </h5>
                                <button class="button-menu w-100 ibm-plex-mono-regular">
                                    <a class="nav-link" href="{{ route('login') }}">Login</a>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
    </div>

    <!--Stile-->

    <style scoped>
        .card{
            margin-top: 40px;
            padding:20px;
            border-radius: 15px;
            display:flex;
            justify-content: center;
        }

        h5{
            font-size: 18px;
            margin-bottom: 15px;
        }

    </style>

    <!-- Passare l'URL della rotta di registrazione a Vue -->
    <script>
        window.Laravel = {!! json_encode(['restaurant_register_url' => route('restaurant.register')]) !!};
    </script>

    <!-- Includi il tuo script Vue -->
    <script src="{{ mix('js/app.js') }}"></script>
@endsection
