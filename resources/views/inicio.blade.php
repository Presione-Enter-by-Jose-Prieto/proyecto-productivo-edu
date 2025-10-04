@extends('templates.html')

@section('title', 'Docentro')

@push('styles')
    <style>
        .contenedor {
            width: 90%;
            max-width: 1200px;
            margin: 0 auto;
            padding: 2rem 0;
        }

        .section-title {
            text-align: left;
            color: #c9d1d9;
            margin: 0 0 1rem 0;
            font-size: 1.5rem;
            font-weight: 600;
        }

        /* Cursos Preview Section */
        .cursos-preview {
            padding: 1.5rem 0;
            position: relative;
        }

        .crear-curso-btn {
            position: absolute;
            top: 1.5rem;
            right: 0;
            background: #238636;
            color: white;
            border: none;
            padding: 0.4rem 1rem;
            border-radius: 6px;
            font-size: 0.8rem;
            font-weight: 500;
            cursor: pointer;
            transition: background-color 0.2s;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
        }

        .crear-curso-btn:hover {
            background: #2ea043;
        }

        .cursos-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(260px, 1fr));
            gap: 1rem;
            margin-top: 1rem;
        }

        .curso-card {
            background: #161b23;
            border: 1px solid #2a2f38;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 6px rgba(0,0,0,0.5);
            display: flex;
            flex-direction: column;
            transition: transform 0.2s, box-shadow 0.2s;
            color: #f1f1f1;
            height: 100%;
        }

        .curso-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0,0,0,0.6);
        }

        .curso-imagen-container {
            height: 110px;
            overflow: hidden;
        }

        .curso-imagen {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .curso-sin-imagen {
            height: 110px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #2a2f38;
            color: #888;
            font-size: 1.5rem;
        }

        .curso-info {
            padding: 0.75rem;
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        .curso-info h3 {
            margin: 0 0 0.4rem 0;
            color: #ffffff;
            font-size: 1rem;
            line-height: 1.2;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
            display: -webkit-box;
            text-overflow: ellipsis;
        }

        .curso-descripcion {
            font-size: 0.8rem;
            color: #cccccc;
            margin-bottom: 0.5rem;
            line-height: 1.3;
            flex-grow: 1;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .curso-meta {
            display: flex;
            gap: 0.4rem;
            margin-bottom: 0.5rem;
            flex-wrap: wrap;
        }

        .badge {
            background: rgba(88, 166, 255, 0.08);
            color: #58a6ff;
            padding: 0.2rem 0.5rem;
            border-radius: 12px;
            font-size: 0.75rem;
            font-weight: 500;
            display: inline-flex;
            align-items: center;
            gap: 0.3rem;
            border: 1px solid rgba(88, 166, 255, 0.2);
            transition: all 0.2s;
        }

        .badge i {
            font-size: 0.7rem; /* más pequeño */
            opacity: 1;
            color: inherit; /* mismo color que el texto */
        }

        .curso-divider {
            border-top: 1px solid #2a2f38;
            margin: 0.5rem 0;
        }

        .curso-acciones {
            display: flex;
            justify-content: flex-end;
        }

        .btn-ver-mas {
            background: #0d6efd;
            color: white;
            padding: 0.3rem 0.75rem;
            border-radius: 4px;
            text-decoration: none;
            font-weight: 500;
            font-size: 0.75rem;
            transition: all 0.2s;
            border: none;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 0.3rem;
        }

        .btn-ver-mas:hover {
            background: #0b5ed7;
            transform: translateY(-1px);
            box-shadow: 0 3px 8px rgba(13, 110, 253, 0.25);
        }

        .ver-todos-container {
            text-align: center;
            margin-top: 2rem;
        }

        .btn-ver-todos {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            background: transparent;
            color: #58a6ff;
            padding: 0.6rem 1.25rem;
            border-radius: 6px;
            text-decoration: none;
            font-weight: 500;
            border: 1px solid #30363d;
            font-size: 0.85rem;
            transition: all 0.2s;
        }

        .btn-ver-todos:hover {
            background: rgba(88, 166, 255, 0.1);
            border-color: #58a6ff;
            transform: translateY(-1px);
        }

        .empty-state {
            text-align: center;
            padding: 2rem 1rem;
            color: #8b949e;
            grid-column: 1 / -1;
        }

        .empty-state i {
            font-size: 2.5rem;
            margin-bottom: 0.5rem;
            color: #484f58;
            display: block;
        }

        .empty-state h3 {
            color: #c9d1d9;
            margin-bottom: 0.25rem;
            font-size: 1.1rem;
        }

        @media (max-width: 768px) {
            .cursos-grid {
                grid-template-columns: 1fr;
                max-width: 500px;
                margin: 0 auto;
            }
            
            .section-title {
                font-size: 1.25rem;
            }
        }
    </style>
@endpush

@section('content')
    <x-header />

    <div class="contenedor">
        <section class="cursos-preview">
            <h1 class="section-title">Cursos Disponibles</h1>
            @auth
                @if(auth()->user()->role === 'docente')
                    <a href="{{ route('cursos.create') }}" class="crear-curso-btn">
                        <i class="fas fa-plus"></i>
                        Crear Curso
                    </a>
                @endif
            @endauth
            
            @if(isset($cursos) && $cursos->count() > 0)
                <div class="cursos-grid">
                    @foreach($cursos->take(4) as $curso)
                        <div class="curso-card">
                            @if($curso->imagen)
                                <div class="curso-imagen-container">
                                    <img src="{{ asset('storage/' . $curso->imagen) }}" alt="{{ $curso->titulo }}" class="curso-imagen">
                                </div>
                            @else
                                <div class="curso-sin-imagen">
                                    <i class="fas fa-book"></i>
                                </div>
                            @endif
                            
                            <div class="curso-info">
                                <h3>{{ $curso->titulo }}</h3>
                                <p class="curso-descripcion">
                                    {{ Str::limit(strip_tags($curso->descripcion), 120) }}
                                </p>
                                <div class="curso-meta">
                                    <span class="badge">
                                        <i class="fas fa-clock"></i> {{ $curso->duracion_horas }}h
                                    </span>
                                    <span class="badge">
                                        <i class="fas fa-calendar"></i> {{ \Carbon\Carbon::parse($curso->fecha_inicio)->format('d/m/Y') }}
                                    </span>
                                </div>
                                <div class="curso-divider"></div>
                                <div class="curso-acciones">
                                    <a href="{{ route('preinscripcion', ['seccion' => 'ver-curso', 'curso' => $curso->id]) }}" class="btn-ver-mas">
                                        <i class="fas fa-eye"></i> Ver detalles
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                
                @if($cursos->count() > 4)
                    <div class="ver-todos-container" style="margin-top: 2.5rem; text-align: center;">
                        <a href="{{ route('cursos.publicados') }}" class="btn-ver-todos">
                            <span>Ver todos los cursos</span>
                            <i class="fas fa-arrow-right" style="transition: transform 0.2s ease-in-out; transform: translateX(0);"></i>
                        </a>
                        <style>
                            .ver-todos-container .btn-ver-todos:hover i {
                                transform: translateX(5px);
                            }
                        </style>
                    </div>
                @endif
            @else
                <div class="empty-state">
                    <i class="fas fa-book-open"></i>
                    <h3>No hay cursos disponibles en este momento</h3>
                </div>
            @endif
        </section>
    </div>
@endsection
