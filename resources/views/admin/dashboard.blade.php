@extends('layouts.app')

<head>
    <!--Adobe Font-->
    <link rel="stylesheet" href="https://use.typekit.net/lyi7tbf.css">
</head> 

@section('page-title', 'Dashboard')

@section('main-content')
<div class="container">
    <div class="my-3">
        <h1 class="my-title text-center">
            Benvenuto su deliveBoo!
        </h1>
        <p class="subtitle-dashboard ibm-plex-mono-regular text-center mb-4">
            Qui potrai gestire tutte le informazioni sul tuo ristorante.
        </p>
    </div>
    

    <div class="dashboard-card col-12 col-md-4">
        <div class="row">
            <div class="col-12">
                <p class="button-title ibm-plex-mono-semibold text-center m-4">
                    Dove vuoi andare?
                </p>

                <hr>

                <div class="row my-3">
                    <div class="col-12 d-flex justify-content-center align-items-center">
                        <h5 class="ibm-plex-mono-semibold me-4">
                            Vai al menù
                        </h5>
                        <button class="button-menu">
                            <a class="ibm-plex-mono-regular text-decoration-none text-light"  href="{{ route('dishes.index') }}">Guarda!</a>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

<style scoped>
    .my-title{
        margin-top: 50px;
        color: #2f2f2f;
    }
    .subtitle-dashboard {
        font-size: 20px;
    }
    .button-title{
        font-size: 18px;
        text-align: center;
    }

    .dashboard-card{
        display: flex;
        justify-content: center;
        border: none;
        border-radius: 20px;
        box-shadow: 2px 8px 42px #2f2f2f;
        padding: 10px;
        width: 1000px;
        margin: auto;
    }
</style>
