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

        .creditos {
            width: 100%;
            padding: 15px;
            border-radius: 6px;
            background-color: #161a20;
            border: 1px solid #33363b;
            margin-top: 20px;
        }

        .creditos ul {
            list-style: none;
        }
    </style>
@endpush

@section('content')
    <x-header />

    <div class="contenedor">
        <div class="titulo">
            <h1>Creditos</h1>
        </div>
        <div class="creditos">
            <p>Desarrollado por:</p>
            <ul>
                <li>José Alejandro Prieto Salcedo</li>
                <li>James Sneider Mesa Gomez</li>
                <li>Emily Daniela Rojas Iscala</li>
            </ul>
        </div>
    </div>
@endsection
