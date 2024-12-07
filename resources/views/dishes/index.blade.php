@extends('layouts.app')

@section('page-title', 'Menù')

@section('main-content')
    <div class="container py-3">
        <div class="row ">
            <div class="ibm-plex-mono-bold text-center mb-4">
                <h1>Menù</h1>
            </div>
        </div>

        {{-- FILTRO PER RICERCA PIATTI ATTIVI/ELIMINATI --}}
        <div class="row mb-2">
            {{-- Filtro tutti i piatti --}}
            <div class="col-9">
                <a href="{{ route('dishes.index', ['filter' => 'all']) }}"
                    class="button-menu text-decoration-none ibm-plex-mono-regular me-3">
                    Tutti i Piatti
                </a>

                {{-- Filtro piatti Attivi --}}
                <a href="{{ route('dishes.index', ['filter' => 'active']) }}"
                    class="button-menu text-decoration-none me-3 ibm-plex-mono-regular position-relative">
                    Piatti Attivi
                    {{-- Contatore piatti attiivi --}}
                    @if ($activeCount > 0)
                        <span
                            class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger ibm-plex-mono-regular">
                            {{ $activeCount }} </span>
                    @endif
                </a>

                {{-- Filtro Piatti eliminati --}}
                <a href="{{ route('dishes.index', ['filter' => 'trashed']) }}"
                    class="button-menu text-decoration-none ibm-plex-mono-regular position-relative">
                    Piatti Eliminati
                    {{-- Contatore piatti Eliminati --}}
                    @if ($trashedCount > 0)
                        <span
                            class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger ibm-plex-mono-regular">{{ $trashedCount }}</span>
                    @endif
                </a>

                {{-- Filtro Ordini --}}

                <a href="{{ route('admin.restaurant.orders', ['restaurant' => $restaurant->id]) }}"
                    class="button-menu text-decoration-none ibm-plex-mono-regular text-center mb-2 ms-3">
                    Ordini
                </a>

            </div>

            {{-- AGGIUNGI PIATTO --}}
            <div class="col-3 d-flex justify-content-end">
                <a href="{{ route('dishes.create') }}"
                    class="button-menu text-decoration-none ibm-plex-mono-regular text-center mb-2">
                    Aggiungi Piatto
                </a>
            </div>

        </div>

        <div class="card mb-4">
            <div class="row g-0">
                <div class="col-12 rounded-20">
                    <div class=" row w-100 d-flex">
                        <div class="col-12 justify-content-center position-relative restaurant-image p-0">
                            {{-- Visualizzazione Piatto --}}
                            @if (filter_var($restaurant->image, FILTER_VALIDATE_URL))
                                <img src="{{ $restaurant->image }}" class="card-img-top w-100"
                                    alt="{{ $restaurant->name }}">
                            @elseif ($restaurant->image)
                                <img src="{{ asset('storage/' . $restaurant->image) }}" class="card-img-top"
                                    alt="{{ $restaurant->name }}">
                            @else
                                <img src="{{ asset('images/placeholder.png') }}" class="card-img-top"
                                    alt="Immagine non inserita">
                            @endif
                        </div>

                        <div class=" ibm-plex-mono-bold-white text-center position-absolute z-1">
                            <h1> {{ $restaurant->name }} </h1>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <section class="background-pattern p-5 rounded-1">


            {{-- SEZIONE PIATTI --}}
            <div class="row">
                @if ($dishes->isEmpty())
                    <div class="text-center mt-5">
                        <h1 class=" text-dark ibm-plex-mono-regular text-success opacity-75">Nessun piatto disponibile.</h1>
                    </div>
                @else
                    @foreach ($dishes as $dish)
                        <div class="col-md-4 mb-3">

                            <a href="{{ route('dishes.show', ['dish' => $dish->id]) }}" class="text-decoration-none">
                                <div class="card dish-card position-relative">
                                    {{-- Visualizzazione Piatto --}}
                                    @if (filter_var($dish->image, FILTER_VALIDATE_URL))
                                        <img src="{{ $dish->image }}" class="card-img-top" alt="{{ $dish->name }}">
                                    @elseif ($dish->image)
                                        <img src="{{ asset('storage/' . $dish->image) }}" class="card-img-top"
                                            alt="{{ $dish->name }}">
                                    @else
                                        <img src="{{ asset('images/placeholder.png') }}" class="card-img-top"
                                            alt="Immagine non disponibile">
                                    @endif

                                    <div class="card-body">
                                        <h5 class="ibm-plex-mono-semibold">{{ $dish->name }}</h5>
                                        <p class="ibm-plex-mono-regular">{{ $dish->description }}</p>
                                        <p class="ibm-plex-mono-regular">Prezzo: €{{ number_format($dish->price, 2) }}</p>
                                    </div>
                                    <div class="justify-content-end pb-2">

                                        {{-- PULSANTI PER ELIMINAZIONE E RIPRISTINO --}}
                                        <div class="d-flex justify-content-end">
                                            @if ($dish->trashed())
                                                {{-- Pulsante per ripristinare --}}
                                                <form action="{{ route('dishes.restore', ['id' => $dish->id]) }}"
                                                    method="POST" style="display:inline;">
                                                    @csrf
                                                    <button type="submit"
                                                        class="button-menu py-2  me-2">Ripristina</button>
                                                </form>

                                                {{-- Pulsante per eliminare definitivamente --}}
                                                <form
                                                    onsubmit="return confirm('Sei sicuro di voler eliminare DEFINITIVAMENTE questo piatto?')"
                                                    action="{{ route('dishes.forceDestroy', $dish->id) }}" method="POST"
                                                    style="display:inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                        class="btn btn-danger py-2  me-2">Elimina</button>
                                                </form>
                                            @else
                                                {{-- Pulsante per eliminazione soft --}}
                                                <form
                                                    onsubmit="return confirm('Attenzione! Stai cancellando questo elemento, vuoi continuare?')"
                                                    action="{{ route('dishes.destroy', $dish->id) }}" method="POST"
                                                    style="display:inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                        class="button-delete  position-absolute top-0 end-0">
                                                        <i class="fa-solid fa-trash"></i>
                                                    </button>
                                                </form>
                                            @endif
                                        </div>
                                    </div>

                                </div>

                            </a>
                        </div>
                    @endforeach
                @endif
            </div>

        </section>



    </div>
@endsection

<style scoped>
    .card {
        max-height: 450px;
        border: solid 2px #2f2f2f;
    }

    .dish-card:hover {
        transform: scale(1.05);
        /* Ingrandisce la card al passaggio del mouse */
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        border: solid 2px #2f2f2f;

    }

    h5 {
        color: #2f2f2f;
    }

    p {
        color: #2f2f2f
    }

    .fa-trash {
        color: white;
        font-size: 20px
    }

    .background-pattern {
        background-image: url(/images/background-pattern.png);
        background-size: contain;
        border: 2px solid #2f2f2f
    }
</style>
