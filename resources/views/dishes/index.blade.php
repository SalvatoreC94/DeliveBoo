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
                    <div class="col-md-4">
                        <div class="card m-2">
                            <img src="{{ $dish->image ?? 'https://via.placeholder.com/150' }}" class="card-img-top"
                                alt="{{ $dish->name }}">
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
