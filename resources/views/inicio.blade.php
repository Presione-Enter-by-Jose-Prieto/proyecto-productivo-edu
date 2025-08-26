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
            margin: 0 0 1.5rem 0;
            font-size: 1.75rem;
            font-weight: 600;
            padding: 0;
        }

        /* Cursos Preview Section */
        .cursos-preview {
            padding: 2rem 0;
        }



        .cursos-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 1.25rem;
            margin-top: 1.5rem;
        }

        .curso-card {
            background: #161b22;
            border-radius: 8px;
            overflow: hidden;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            border: 1px solid #30363d;
            display: flex;
            flex-direction: column;
            height: 100%;
        }

        .curso-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
            border-color: #58a6ff;
        }

        .curso-imagen-container {
            height: 140px;
            overflow: hidden;
        }

        .curso-imagen {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.3s ease;
        }

        .curso-card:hover .curso-imagen {
            transform: scale(1.05);
        }

        .curso-sin-imagen {
            height: 140px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #0d1117;
            color: #484f58;
            font-size: 2rem;
        }

        .curso-info {
            padding: 1rem;
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        .curso-info h3 {
            margin: 0 0 0.5rem 0;
            color: #c9d1d9;
            font-size: 1.1rem;
            line-height: 1.3;
            min-height: auto;
            max-height: 2.8em;
            overflow: hidden;
            text-overflow: ellipsis;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
        }

        .curso-descripcion {
            color: #8b949e;
            font-size: 0.85rem;
            margin-bottom: 0.75rem;
            line-height: 1.4;
            flex-grow: 1;
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .curso-meta {
            display: flex;
            gap: 0.5rem;
            margin-bottom: 0.75rem;
            flex-wrap: wrap;
        }

        .badge {
            background: rgba(88, 166, 255, 0.1);
            color: #58a6ff;
            padding: 0.25rem 0.6rem;
            border-radius: 12px;
            font-size: 0.75rem;
            display: inline-flex;
            align-items: center;
            gap: 0.25rem;
        }

        .badge i {
            font-size: 0.8em;
        }

        .btn-ver-mas {
            display: inline-block;
            background: #238636;
            color: white;
            padding: 0.4rem 1rem;
            border-radius: 4px;
            text-decoration: none;
            font-weight: 500;
            font-size: 0.85rem;
            transition: all 0.2s;
            text-align: center;
            border: none;
            cursor: pointer;
            margin-top: 0.25rem;
        }

        .btn-ver-mas:hover {
            background: #2ea043;
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(35, 134, 54, 0.2);
        }

        .ver-todos-container {
            text-align: center;
            margin-top: 3rem;
        }

        .btn-ver-todos {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            background: transparent;
            color: #58a6ff;
            padding: 0.75rem 1.5rem;
            border-radius: 6px;
            text-decoration: none;
            font-weight: 500;
            border: 1px solid #30363d;
            transition: all 0.2s;
        }

        .btn-ver-todos:hover {
            background: rgba(88, 166, 255, 0.1);
            border-color: #58a6ff;
            transform: translateY(-1px);
        }

        .empty-state {
            text-align: center;
            padding: 3rem 1rem;
            color: #8b949e;
            grid-column: 1 / -1;
        }

        .empty-state i {
            font-size: 3rem;
            margin-bottom: 1rem;
            color: #484f58;
            display: block;
        }

        .empty-state h3 {
            color: #c9d1d9;
            margin-bottom: 0.5rem;
        }

        @media (max-width: 768px) {
            .cursos-grid {
                grid-template-columns: 1fr;
                max-width: 500px;
                margin: 0 auto;
            }
            
            .bienvenida h1 {
                font-size: 2rem;
            }
            
            .section-title {
                font-size: 1.75rem;
            }
        }
    </style>
@endpush

@section('content')
    <x-header />

    <div class="contenedor">
        <section class="cursos-preview">
            <h1 class="section-title">Cursos Disponibles</h1>
            
            @if(isset($cursos) && $cursos->count() > 0)
                <div class="cursos-grid">
                    @foreach($cursos->take(3) as $curso)
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
                                        <i class="fas fa-calendar-alt"></i> {{ \Carbon\Carbon::parse($curso->fecha_inicio)->format('d/m/Y') }}
                                    </span>
                                </div>
                                <a href="{{ route('preinscripcion', ['seccion' => 'ver-curso', 'curso' => $curso->id]) }}" class="btn-ver-mas">
                                    Ver detalles
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
                
                @if($cursos->count() > 3)
                    <div class="ver-todos-container">
                        <a href="{{ route('cursos.publicados') }}" class="btn-ver-todos">
                            Ver todos los cursos
                            <i class="fas fa-arrow-right"></i>
                        </a>
                    </div>
                @endif
            @else
                <div class="empty-state">
                    <i class="fas fa-book-open"></i>
                    <h3>No hay cursos disponibles en este momento</h3>
                    <p>Vuelve más tarde para ver los próximos cursos.</p>
                </div>
            @endif
        </section>
    </div>
@endsection
