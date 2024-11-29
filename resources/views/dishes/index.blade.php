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

        <div class="row my-2">
            <a href="{{ route('dishes.create') }}" class="btn btn-success mb-2">
                Aggiungi Piatto
            </a>
        </div>

        <div class="row">
            @if ($dishes->isEmpty())
                <p>Nessun piatto disponibile.</p>
            @else
                @foreach ($dishes as $dish)
              <div class="col-md-4 mb-3">
                    <div class="card">
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
                        <div class="d-flex justify-content-end">
                            <a href="{{ route('dishes.show', ['dish' => $dish->id]) }}" class="btn btn-primary me-2 mb-2">
                                Visualizza Piatto
                            </a>
                            <a href="{{ route('dishes.edit', ['dish' => $dish->id]) }}" class="btn btn-warning me-2 mb-2">
                                Modifica
                            </a>
                            <form onsubmit="return confirm('Attenzione! Stai cancellando questo elemento, vuoi continuare?')" action="{{ route('dishes.destroy', ['dish' => $dish->id]) }}" class="d-inline-block me-2 mb-2">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">
                                    Elimina
                                </button>
                            </form>
                        </div>
                        
                    </div>
                </div>
                @endforeach
            @endif
        </div>
        
        <div class="row my-2">
            <a href="{{ route('dishes.create') }}" class="btn btn-success mb-2">
                Aggiungi Piatto
            </a>
        </div>
    </div>
@endsection
