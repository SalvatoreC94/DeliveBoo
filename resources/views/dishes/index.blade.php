@extends('layouts.app')

@section('page-title', 'Menù Piatti')

@section('main-content')
    <div class="container">
        <h1>Menù Piatti</h1>

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
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
@endsection
