@extends('layouts.app')

@section('page-title', 'Crea Piatto')

@section('main-content')
    <div class="container py-5">
        <div class="row">
            <div class="col">
                <div class="card" style="height: 100%">
                    <div class="card-body">
                        <h1 class="text-center text-success">Crea Nuovo Piatto</h1>
                    </div>
                </div>
            </div>
        </div>

        @if ($errors->any())
            <div class="alert alert-danger my-4">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>
                            {{ $error }}
                        </li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="row my-5">
            <div class="col">
                <form method="post" action="{{ route('dishes.store') }}" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-4">
                        <label for="name" class="form-label">Nome del piatto</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required>
                    
                        @error('name')
                            <div class="alert alert-danger">
                                {{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="description" class="form-label">Descrizione del piatto</label>
                        <textarea class="form-control" id="description" name="description" value="{{ old('description') }}"></textarea>
                    
                        @error('description')
                            <div class="alert alert-danger">
                                {{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="price" class="form-label">Prezzo del piatto</label>
                        <input type="number" class="form-control" id="price" name="price" required min="0" step="0.01" value="{{ old('price') }}">
                    
                        @error('price')
                            <div class="alert alert-danger">
                                {{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="image" class="form-label">Carica Immagine</label>
                        <input type="file" class="form-control" id="image" name="image" value="{{ old('image') }}">
                        
                        @error('image')
                            <div class="alert alert-danger">
                                {{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="visibility" class="form-label">Visibilità</label>
                        <select class="form-control" id="visibility" name="visibility" required>
                            <option value="1">Visibile</option>
                            <option value="0">Non Visibile</option>
                        </select>
                        
                        @error('visibility')
                            <div class="alert alert-danger">
                                {{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="mb-4">
                        {{-- <label for="category_id" class="form-label">Selezione Categoria</label>
                        <select class="form-control" id="category_id" name="category_id" required>
                            <option value=""></option>
                            @foreach ($categories as $category)
                                <option value="category_id"> {{ $category->name }} </option>
                            @endforeach
                        </select> --}}

                        <label for="category_id" class="form-label">Seleziona Categoria</label>
                        <select class="form-control" id="category_id" name="category_id" required>
                            <option value="" disabled>Seleziona una categoria</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                        
                        @error('category_id')
                            <div class="alert alert-danger">
                                {{ $message }}</div>
                        @enderror
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
