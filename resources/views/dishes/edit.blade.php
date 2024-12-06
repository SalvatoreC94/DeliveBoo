@extends('layouts.app')

@section('page-title', 'Modifica Piatto')

@section('main-content')
    <div class="container p-5">
        <div class="row">
            <div class="col">
                <div class="card" style="height: 100%">
                    <div class="card-body">
                        <h1 class="text-center text-info">Modifica Piatto</h1>
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
                <form method="post" action="{{ route('dishes.update', $dish->id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <label for="name" class="form-label">Modifica nome del piatto</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ $dish->name }}" required>
                        
                        @error('name')
                            <div class="alert alert-danger">
                                {{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="mb-4">
                        <label for="description" class="form-label">Modifica Descrizione</label>
                        <textarea class="form-control" id="description" name="description">{{ $dish->description }}</textarea>

                        @error('description')
                            <div class="alert alert-danger">
                                {{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="mb-4">
                        <label for="price" class="form-label">Modifica Prezzo del piatto</label>
                        <input type="number" class="form-control" id="price" name="price" value="{{ $dish->price }}" required min="0" step="0.01">

                        @error('price')
                            <div class="alert alert-danger">
                                {{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="mb-4">
                        <label for="image" class="form-label">Modifica immagine</label>
                        <input type="file" class="form-control" id="image" name="image">

                        {{-- Visualizza immagine caricata se presente --}}
                        @if (filter_var($dish->image, FILTER_VALIDATE_URL))
                            <div class="mb-4" style="padding-left: 25px;">
                                <h5>
                                    Immagine attuale:
                                </h5>
                                <img src="{{ $dish->image }}" class="card-img-top" alt="{{ $dish->name }}" style="width:350px; object-fit: cover;">
                            </div>
                        @elseif ($dish->image)
                            <div class="mb-4" style="padding-left: 25px;">
                                <h5>
                                    Immagine attuale:
                                </h5>
                                <img src="{{ asset('storage/' .$dish->image) }}" alt="{{ $dish->name }}" style="width: 250px" style="width:350px; padding-left: 50px; object-fit: cover;">
                            </div>
                        @endif
                    </div>
                    
                    <div class="mb-4">
                        <label for="visibility" class="form-label">Visibilità</label>
                        <select class="form-control" id="visibility" name="visibility" required>
                            <option value="1" {{ $dish->visibility ? 'selected' : '' }}>Visibile</option>
                            <option value="0" {{ !$dish->visibility ? 'selected' : '' }}>Non Visibile</option>
                        </select>
                    </div>

                    <div class="mb-4">
                        <label for="category_id" class="form-label">Seleziona Categoria</label>
                        <select class="form-control" id="category_id" name="category_id" required>
                            <option value="" disabled {{ !$dish->category_id ? 'selected' : '' }}>Seleziona una categoria</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}" {{ $dish->category_id == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                        
                        @error('category_id')
                            <div class="alert alert-danger">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary">Modifica</button>
                </form>
            </div>

            {{-- <div class="mb-4">
                <label for="category_id" class="form-label">Selezione Categoria</label>
                <select class="form-control" id="category_id" name="category_id" required>
                    <option value=""></option>
                    @foreach ($dishes as $dish)
                        <option value="category_id"> {{ $dish->category->name }} </option>
                    @endforeach
                </select>
                
                @error('category_id')
                    <div class="alert alert-danger">
                        {{ $message }}</div>
                @enderror
            </div> --}}

            <div class="mt-4">
                <a href="{{ route('dishes.index') }}" class="btn btn-success my-1">Torna al menu</a>
            </div>
        </div>
    </div>
@endsection
