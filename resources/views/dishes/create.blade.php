@extends('layouts.app')

@section('page-title', 'Crea Piatto')

@section('main-content')
    <div class="container py-5">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <h1 class="text-center text-success">Crea Nuovo Piatto</h1>
                    </div>
                </div>
            </div>
        </div>
        <div class="row my-5">
            <div class="col">
                <form method="post" action="{{ route('dishes.store') }}" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-4">
                        <label for="name" class="form-label">Nome del piatto</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    <div class="mb-4">
                        <label for="description" class="form-label">Descrizione del piatto</label>
                        <textarea class="form-control" id="description" name="description"></textarea>
                    </div>
                    <div class="mb-4">
                        <label for="price" class="form-label">Prezzo del piatto</label>
                        <input type="number" class="form-control" id="price" name="price" required min="0" step="0.01">
                    </div>
                    <div class="mb-4">
                        <label for="image" class="form-label">Carica Immagine</label>
                        <input type="file" class="form-control" id="image" name="image">
                    </div>
                    <div class="mb-4">
                        <label for="visibility" class="form-label">Visibilità</label>
                        <select class="form-control" id="visibility" name="visibility" required>
                            <option value="1">Visibile</option>
                            <option value="0">Non Visibile</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary w-100 my-3">Aggiungi piatto</button>
                </form>
                <div class="mt-4">
                    <a href="{{ route('dishes.index') }}" class="btn btn-success my-1">Torna indietro</a>
                </div>
            </div>
        </div>
    </div>
@endsection
