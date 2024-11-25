@extends('layouts.app')

@section('page-title', 'Menù Piatti')

@section('main-content')
    <div class="row">
        <div class="mb-3">
            <a href="{{ route('dishes.create') }}" class="btn btn-success my-1  w-100">Aggiungi Piatto</a>
        </div>
        @foreach ($dishes as $dish)
            <div class="col-4">
                <div class="card mb-3" style="max-width: 540px;">
                    <div class="row g-0">
                        <div class="col-md-4">
                            @if (isset($dish->image))
                                <img src="{{ asset('storage/' . $dish->image) }}" alt="{{ $dish->name }}" style="width: 250px">
                            @endif
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <h5 class="card-title">
                                    {{ $dish->name }}
                                </h5>
                                <p class="card-text">
                                    <small class="text-body-secondary">
                                        {{ $dish->description }}
                                    </small>
                                </p>
                                <h6 class="card-title">
                                    € {{ $dish->price }}
                                </h6>
                                <div>
                                    <a href="{{ route('dishes.show', $dish->id) }}" class="btn btn-primary my-1  w-100">Visualizza</a>
                                    <a href="{{ route('dishes.edit', $dish->id) }}" class="btn btn-primary my-1  w-100">Modifica</a>
                                    <form action="{{ route('dishes.destroy', $dish->id) }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <input type="submit" value="Cancella" class="btn btn-danger my-1 w-100">
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
        
        <div>
            <a href="{{ route('dishes.create') }}" class="btn btn-success my-1  w-100">Aggiungi Piatto</a>
        </div>
    </div>
@endsection
