@extends('templates.html')

@section('title', 'Docentro')

@push('styles')
    <style>
        .contenedor {
            width: 90%;
            padding: 15px 0 0 0;
            margin: 0 auto;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .bienvenida {
            width: 40%;
            display: flex;
            flex-direction: column;
            text-align: center;
            margin-top: 15px;
        }

        .bienvenida h1 {
            font-size: 40px;
            font-weight: 700;
            letter-spacing: -0.5px;
        }

        .tarjeta {
            width: 100%;
            padding: 10px 15px 15px 15px;
            cursor: pointer;
            border-radius: 6px;
            background-color: #161a20;
            border: 1px solid #33363b;
            margin-top: 20px;
        }

        .servicios-container {
            width: 80%;
            margin: 0 auto;
            display: flex;
            gap: 20px;
            margin-top: 25px;
        }

        .tarjeta {
            transition: all 0.3s ease;
        }

        .tarjeta:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.3);
            border-color: #4a5568;
        }

        .tarjeta h3 {
            display: flex;
            justify-content: center;
            margin-bottom: 10px;
            transition: color 0.3s ease;
        }

        .tarjeta:hover h3 {
            color: #4299e1;
        }

        img {
            width: 100%;
            height: 200px;
            object-fit: cover;
            border: 2px solid #33363b;
            border-radius: 6px;
        }
    </style>
@endpush

@section('content')
    <x-header />

    <div class="contenido">
        
        <div class="contenedor">
            <div class="bienvenida">
                <h1>La mejor herramienta para la gestión estudiantil</h1>
            </div>
        </div>
    
        <div class="servicios-container">
            <a class="tarjeta servicio-item" href="{{ route('asistencia') }}">
                <h3>Toma automática de asistencias a clase</h3>
                <img src="{{ asset('storage/asistencias.webp') }}" alt="Imagen de asistencia">
                <p>Sistema eficiente para el registro de asistencia.</p>
            </a>
            <a class="tarjeta servicio-item" href="{{ route('mensajeria') }}">
                <h3>Mensajería</h3>
                <img src="{{ asset('storage/mensajeria.webp') }}" alt="Imagen de mensajería">
                <p>Comunicación directa entre usuarios.</p>
            </a>
            <a class="tarjeta servicio-item" href="{{ route('preinscripcion') }}">
                <h3>Pre-inscripción a cursos</h3>
                <img src="{{ asset('storage/cursosextension.webp') }}" alt="Imagen de pre-inscripción">
                <p>Gestión sencilla de inscripciones.</p>
            </a>
        </div>
    </div>
@endsection
