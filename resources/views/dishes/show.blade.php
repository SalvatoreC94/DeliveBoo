@extends('layouts.app')

@section('page-title', 'Singolo Piatto')

@section('main-content')
    <div class="container py-5">
        <div class="row">
            <div class="col-5">
                <div class="card mb-3" style="max-width: 540px;">
                    <img src="{{ $dish->image }}" class="card-img-top" alt="{{ $dish->name }}">
                    <div class="row g-0">
                        {{-- <div class="col-md-4">
                            @if (isset($dish->image))
                                <img src="{{ asset('storage/' . $dish->image) }}" alt="{{ $dish->name }}" style="max-width: 250px">
                            @endif
                        </div> --}}
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
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="mt-4">
                <a href="{{ route('dishes.index') }}" class="btn btn-success my-1">Torna indietro</a>
            </div>
        </div>
    </div>
@endsection
