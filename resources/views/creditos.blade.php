@extends('templates.html')

@section('title', 'Creditos')

@push('styles')
    <style>
        .contenedor {
            width: 90%;
            padding: 15px 0 0 0;
            margin: 0 auto;
        }

        .titulo {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .creditos-row {
            display: flex;
            gap: 20px;
            justify-content: center;
            margin-top: 20px;
        }

        .creditos {
            width: 220px;
            height: 340px;
            padding: 24px 18px;
            border-radius: 12px;
            background-color: #161a20;
            border: 1px solid #33363b;
            display: flex;
            flex-direction: column;
            align-items: center;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
        }

        .creditos .card-img {
            width: 110px;
            height: 140px;
            border-radius: 10px;
            object-fit: cover;
            margin-bottom: 22px;
            border: 2px solid #33363b;
            background: #222;
        }

        .creditos .card-body {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: flex-start;
            width: 100%;
        }

        .creditos .nombre {
            font-weight: bold;
            font-size: 1.18em;
            margin-bottom: 10px;
            letter-spacing: 0.5px;
            text-align: center;
        }

        .creditos .rol {
            color: #b3b3b3;
            font-size: 1.05em;
            margin-bottom: 10px;
            text-align: center;
        }

        .creditos .trabajo {
            font-size: 1em;
            color: #e0e0e0;
            text-align: center;
        }
    </style>
@endpush

@section('content')
    <x-header />

    <div class="contenedor">
        <div class="titulo">
            <h1>Creditos</h1>
        </div>
        <div class="creditos-row">
            <div class="creditos">
                <img class="card-img" src="{{ asset('images/devs/jose.jpg') }}" alt="José Alejandro Prieto Salcedo">
                <div class="card-body">
                    <div class="nombre">José Alejandro Prieto Salcedo</div>
                    <div class="rol">Desarrollador</div>
                    <div class="trabajo">Interfaz de usuario</div>
                </div>
            </div>
            <div class="creditos">
                <img class="card-img" src="{{ asset('images/devs/james.jpg') }}" alt="James Sneider Mesa Gomez">
                <div class="card-body">
                    <div class="nombre">James Sneider Mesa Gomez</div>
                    <div class="rol">Base de datos</div>
                    <div class="trabajo">Gestión y modelado de datos</div>
                </div>
            </div>
            <div class="creditos">
                <img class="card-img" src="{{ asset('images/devs/emily.jpg') }}" alt="Emily Daniela Rojas Iscala">
                <div class="card-body">
                    <div class="nombre">Emily Daniela Rojas Iscala</div>
                    <div class="rol">Diseño</div>
                    <div class="trabajo">Diseño gráfico y experiencia de usuario</div>
                </div>
            </div>
        </div>
    </div>
@endsection
