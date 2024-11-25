@extends('layouts.app')

@section('page-title', 'Modifica Piatto')

@section('main-content')
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <h1 class="text-center text-info">
                        Modifica Piatto
                    </h1>
                </div>
            </div>
        </div>
    </div>
    <div class="row my-5">
        <div class="col">
            <form method="post" action="{{ route('dishes.update', $dish->id) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-3">
                  <label for="name" class="form-label">Modifica nome del piatto</label>
                  <input type="text" class="form-control" id="name" name="name" value="{{ $dish->name }}">
                </div>
                <div class="mb-3">
                  <label for="description" class="form-label">Modifica Descrizione</label>
                  <input value="{{ $dish->description }}" type="text" class="form-control" id="description" name="description" value="{{ $dish->description }}">
                </div>
                <div class="mb-3">
                    <label for="price" class="form-label">Modifica Prezzo del piatto</label>
                    <input value="{{ $dish->price }}" type="text" class="form-control" id="price" name="price" value="{{ $dish->price }}">
                </div>
                <div class="mb-3">
                    <label for="image" class="form-label">Modifica immagine</label>
                    <input value="{{ $dish->image }}" type="file" class="form-control" id="image" name="image" value="{{ $dish->image }}">
                </div>
                <button type="submit" class="btn btn-primary">Crea</button>
            </form>
        </div>
        
        <div class="mt-4">
            <a href="{{ route('dishes.index') }}" class="btn btn-success my-1">Torna indietro</a>
        </div>
    </div>
@endsection
