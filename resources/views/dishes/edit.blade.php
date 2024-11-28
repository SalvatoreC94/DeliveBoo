@extends('layouts.app')

@section('page-title', 'Modifica Piatto')

@section('main-content')
    <div class="container p-5">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <h1 class="text-center text-info">Modifica Piatto</h1>
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
                        <input type="text" class="form-control" id="name" name="name" value="{{ $dish->name }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Modifica Descrizione</label>
                        <textarea class="form-control" id="description" name="description">{{ $dish->description }}</textarea>
                    </div>
                    <div class="mb-3">
                        <label for="price" class="form-label">Modifica Prezzo del piatto</label>
                        <input type="number" class="form-control" id="price" name="price" value="{{ $dish->price }}" required min="0" step="0.01">
                    </div>
                    <div class="mb-3">
                        <label for="image" class="form-label">Modifica immagine</label>
                        <input type="file" class="form-control" id="image" name="image">
                    </div>
                    <div class="mb-4">
                        <label for="visibility" class="form-label">Visibilità</label>
                        <select class="form-control" id="visibility" name="visibility" required>
                            <option value="1" {{ $dish->visibility ? 'selected' : '' }}>Visibile</option>
                            <option value="0" {{ !$dish->visibility ? 'selected' : '' }}>Non Visibile</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Modifica</button>
                </form>
            </div>

            <div class="mt-4">
                <a href="{{ route('dishes.index') }}" class="btn btn-success my-1">Torna indietro</a>
            </div>
        </div>
    </div>
@endsection
