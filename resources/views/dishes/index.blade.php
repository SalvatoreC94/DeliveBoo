@extends('layouts.app')

@section('page-title', 'Menù Piatti')

@section('main-content')
    <div class="container py-5 vh-100">
        <h1 class>Menù Piatti</h1>

        @if ($dishes->isEmpty())
            <p>Nessun piatto disponibile.</p>
        @else
            <div class="row">
                @foreach ($dishes as $dish)
                  <div class="col-md-4 mb-3">
                        <div class="card">
                            <img src="{{ $dish->image }}" class="card-img-top" alt="{{ $dish->name }}">
                            <div class="card-body">
                                <h5 class="card-title">{{ $dish->name }}</h5>
                                <p class="card-text">{{ $dish->description }}</p>
                                <p class="card-text">Prezzo: €{{ number_format($dish->price, 2) }}</p>
                            </div>
                            <div class="d-flex justify-content-end">
                                <a href="{{ route('dishes.show', ['dish' => $dish->id]) }}" class="btn btn-primary me-2 mb-2">
                                    Guarda!
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
            </div>
        @endif
    </div>
@endsection
