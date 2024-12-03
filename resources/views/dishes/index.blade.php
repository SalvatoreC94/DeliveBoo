@extends('layouts.app')

@section('page-title', 'Menù Piatti')

@section('main-content')
    <div class="container py-5">
        <div class="row mb-4">
            <div class="card" style="height: 100%">
                <div class="card-body text-center">
                    <h1>Menù Piatti</h1>
                </div>
            </div>
        </div>

        {{-- FILTRO PER RICERCA PIATTI ATTIVI/ELIMINATI --}}
        <div class="mb-3">
            {{-- Filtro piatti Attivi --}}
            <a href="{{ route('dishes.index', ['filter' => 'active']) }}" class="btn btn-primary">
                Piatti Attivi
                {{-- Contatore piatti attiivi --}}
                @if ($activeCount>0)
                    <span class="badge bg-danger"> {{ $activeCount }} </span>
                @endif
            </a>

            {{-- Filtro Piatti eliminati --}}
            <a href="{{ route('dishes.index', ['filter' => 'trashed']) }}" class="btn btn-warning">
                Piatti Eliminati
                {{-- Contatore piatti Eliminati --}}
                @if ($trashedCount > 0)
                    <span class="badge bg-danger">{{ $trashedCount }}</span>
                @endif
            </a>

            {{-- Filtro tutti i piatti --}}
            <a href="{{ route('dishes.index', ['filter' => 'all']) }}" class="btn btn-secondary">
                Tutti i Piatti
                {{-- Contatore tutti i piatti --}}
                @if ($allCount>0)
                    <span class="badge bg-danger"> {{ $allCount }} </span>
                @endif
            </a>
        </div> 
        
        {{-- AGGIUNGI PIATTO --}}
        <div class="row my-2">
            <a href="{{ route('dishes.create') }}" class="btn btn-success mb-2">
                Aggiungi Piatto
            </a>
        </div>

        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <div>
                            <h1> {{ $restaurant->name }} </h1>
                        </div>
                        <div>
                            {{-- Visualizzazione Piatto --}}
                            @if (filter_var($restaurant->image, FILTER_VALIDATE_URL))
                                    <img src="{{ $restaurant->image }}" class="card-img-top" alt="{{ $restaurant->name }}">
                                @elseif ($restaurant->image)
                                    <img src="{{ asset('storage/' . $restaurant->image) }}" class="card-img-top" alt="{{ $restaurant->name }}">
                                @else
                                    <img src="{{ asset('images/placeholder.png') }}" class="card-img-top" alt="Immagine non inserita">
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- SEZIONE PIATTI --}}
        <div class="row">
            @if ($dishes->isEmpty())
                <div class="text-center mt-5">
                    <h1 class="display-1 text-success opacity-75">Nessun piatto disponibile.</h1>
                </div>
            @else
                @foreach ($dishes as $dish)
                    <div class="col-md-4 mb-3">
                        <div class="card">
                            {{-- Visualizzazione Piatto --}}
                            @if (filter_var($dish->image, FILTER_VALIDATE_URL))
                                    <img src="{{ $dish->image }}" class="card-img-top" alt="{{ $dish->name }}">
                                @elseif ($dish->image)
                                    <img src="{{ asset('storage/' . $dish->image) }}" class="card-img-top" alt="{{ $dish->name }}">
                                @else
                                    <img src="{{ asset('images/placeholder.png') }}" class="card-img-top" alt="Immagine non disponibile">
                            @endif

                            <div class="card-body">
                                <h5 class="card-title">{{ $dish->name }}</h5>
                                <p class="card-text">{{ $dish->description }}</p>
                                <p class="card-text">Prezzo: €{{ number_format($dish->price, 2) }}</p>
                            </div>
                            <div class="justify-content-end pb-2">
                                <div class="d-flex justify-content-end">
                                    <a href="{{ route('dishes.show', ['dish' => $dish->id]) }}" class="btn btn-primary me-2 mb-2">
                                        Visualizza Piatto
                                    </a>
                                    <a href="{{ route('dishes.edit', ['dish' => $dish->id]) }}" class="btn btn-warning me-2 mb-2">
                                        Modifica
                                    </a>
                                </div>
                                
                                {{-- PULSANTI PER ELIMINAZIONE E RIPRISTINO --}}
                                <div class="d-flex justify-content-end">
                                    @if ($dish->trashed())
                                        {{-- Pulsante per ripristinare --}}
                                        <form action="{{ route('dishes.restore', ['id' => $dish->id]) }}" method="POST" style="display:inline;">
                                            @csrf
                                            <button type="submit" class="btn btn-success me-2">Ripristina</button>
                                        </form>
                                
                                        {{-- Pulsante per eliminare definitivamente --}}
                                        <form onsubmit="return confirm('Sei sicuro di voler eliminare DEFINITIVAMENTE questo piatto?')" action="{{ route('dishes.forceDestroy', $dish->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">Elimina Definitivamente</button>
                                        </form>
                                    @else
                                        {{-- Pulsante per eliminazione soft --}}
                                        <form onsubmit="return confirm('Attenzione! Stai cancellando questo elemento, vuoi continuare?')" action="{{ route('dishes.destroy', $dish->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-secondary me-2">Elimina</button>
                                        </form>
                                    @endif
                                </div>
                            </div>
                            
                        </div>
                    </div>
                @endforeach
            @endif
        </div>

        {{-- AGGIUNGI PIATTO --}}
        <div class="row my-2">
            <a href="{{ route('dishes.create') }}" class="btn btn-success mb-2">
                Aggiungi Piatto
            </a>
        </div>
    </div>
@endsection
