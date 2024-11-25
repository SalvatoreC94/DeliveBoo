@extends('layouts.app')

@section('page-title', 'Crea Piatto')

@section('main-content')
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <h1 class="text-center text-success">
                        Crea Nuovo Piatto
                    </h1>
                </div>
            </div>
        </div>
    </div>
    <div class="row my-5">
        <div class="col">
            <form method="post" action="{{ route('dishes.store') }}"> 
                @csrf

                <div class="mb-4">
                  <label for="name" class="form-label">Nome del piatto</label>
                  <input type="text" class="form-control" id="name" name="name">
                </div>
                <div class="mb-4">
                    <label for="description" class="form-label">Descrizione del piatto</label>
                    <input type="text" class="form-control" id="description" name="description">
                </div>
                <div class="mb-4">
                    <label for="price" class="form-label">Prezzo del piatto</label>
                    <input type="text" class="form-control" id="price" name="price">
                </div>
                <div class="mb-4">
                    <label for="image" class="form-label">Carica Immagine</label>
                    <input type="file" class="form-control" id="image" name="image">
                </div>
                {{-- <div class="mb-4">
                    <label for="visibility" class="form-label">Mostra piatto</label>
                    <input type="text" class="form-control" id="visibility" name="visibility">
                </div> --}}
                {{-- <div class="mb-4">
                    <label for="restaurant_id" class="form-label">Tipo Ristorante</label>
                    <select id="" name="">
                        <option value="">
                            Ristorante Cinese
                        </option>
                        <option value="">
                            Ristorante Giapponese
                        </option>
                    </select>
                    <input type="text" class="form-control" id="restaurant_id" name="restaurant_id">
                </div> --}}
                <button type="submit" class="btn btn-primary w-100 my-3">Aggiungi piatto</button>
            </form>
            <div class="mt-4">
                <a href="{{ route('dishes.index') }}" class="btn btn-success my-1">Torna indietro</a>
            </div>
        </div>
    </div>
@endsection
