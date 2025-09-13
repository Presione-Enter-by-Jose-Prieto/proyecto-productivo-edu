<h1 class="titulo">Cursos Disponibles </h1>
<div class="contenido-seccion">
   @if(session('success'))
      <div class="alert alert-success" data-message="{{ session('success') }}">
         {{ session('success') }}
      </div>
   @endif
   @if(session('error'))
      <div class="alert alert-danger" data-message="{{ session('error') }}">
         {{ session('error') }}
      </div>
   @endif
   @if($cursos->isEmpty())
      <div class="empty-state">
         <i class="fas fa-book-open empty-state-icon"></i>
         <h3>No hay cursos publicados en este momento</h3>
         <p>Vuelve más tarde para ver los próximos cursos disponibles.</p>
      </div>
   @else
   <style>
      .cursos-grid {
         display: grid;
         grid-template-columns: repeat(4, 1fr); /* 4 columnas fijas */
         gap: 20px;
         margin-top: 20px;
      }
      .curso-card {
         background: #161B23; /* Fondo oscuro */
         border: 1px solid #2a2f38;
         border-radius: 8px;
         overflow: hidden;
         box-shadow: 0 2px 6px rgba(0,0,0,0.5);
         display: flex;
         flex-direction: column;
         transition: transform 0.2s, box-shadow 0.2s;
         color: #f1f1f1;
      }
      .curso-card:hover {
         transform: translateY(-2px); /* hover más sutil */
         box-shadow: 0 4px 8px rgba(0,0,0,0.6);
      }
      .curso-card img.curso-imagen {
         width: 100%;
         height: 160px;
         object-fit: cover;
      }
      .curso-sin-imagen {
         width: 100%;
         height: 160px;
         display: flex;
         align-items: center;
         justify-content: center;
         background: #2a2f38;
         color: #888;
         font-size: 36px;
      }
      .curso-info {
         padding: 12px;
         flex: 1;
         display: flex;
         flex-direction: column;
      }
      .curso-info h3 {
         font-size: 16px;
         margin-bottom: 8px;
         color: #ffffff;
      }
      .curso-descripcion {
         font-size: 14px;
         color: #cccccc;
         margin-bottom: 8px;
      }
      .curso-metadata {
         margin-bottom: 8px;
         display: flex;
         gap: 6px;
         flex-wrap: wrap;
      }
      .curso-acciones {
         margin-top: auto;
         display: flex;
         justify-content: flex-end; /* botón a la derecha */
      }
      .curso-card.preinscrito {
         border: 2px solid #28a745;
         position: relative;
         overflow: hidden;
      }
      .curso-card.preinscrito::after {
         content: 'Preinscrito';
         position: absolute;
         top: 15px;
         right: -30px;
         background: #28a745;
         color: white;
         padding: 2px 30px;
         transform: rotate(45deg);
         font-size: 11px;
         font-weight: bold;
         box-shadow: 0 2px 4px rgba(0,0,0,0.4);
      }

      /* Responsivo */
      @media (max-width: 1200px) {
         .cursos-grid {
            grid-template-columns: repeat(3, 1fr);
         }
      }
      @media (max-width: 900px) {
         .cursos-grid {
            grid-template-columns: repeat(2, 1fr);
         }
      }
      @media (max-width: 600px) {
         .cursos-grid {
            grid-template-columns: 1fr;
         }
      }
   </style>

   <div class="cursos-grid">
      @foreach($cursos as $curso)
         @php
            $estaPreinscrito = auth()->check() && 
                           auth()->user()->cursos->contains('id', $curso->id);
         @endphp
         <div class="curso-card {{ $estaPreinscrito ? 'preinscrito' : '' }}">
            @if($curso->imagen)
               <img src="{{ asset('storage/' . $curso->imagen) }}" alt="{{ $curso->titulo }}" class="curso-imagen">
            @else
               <div class="curso-sin-imagen">
                  <i class="fas fa-image"></i>
               </div>
            @endif
            <div class="curso-info">
               <h3>{{ $curso->titulo }}</h3>
               <p class="curso-descripcion">
                  {{ $curso->descripcion }}
               </p>
               <div class="curso-metadata">
                  <span class="badge bg-warning text-dark" title="Categoría del curso">
                     <i class="fas {{ $curso->categoria === 'deportivo' ? 'fa-eye' : ($curso->categoria === 'borrador' ? 'fa-edit' : 'fa-clock') }}"></i>
                     {{ ucfirst($curso->categoria) }}
                  </span>
                  <span class="badge bg-info text-dark" title="Nivel del curso">
                     <i class="fas fa-graduation-cap"></i>
                     {{ ucfirst($curso->nivel) }}
                  </span>
               </div>
               <div class="curso-acciones">
                  <a href="{{ route('preinscripcion', ['seccion' => 'ver-curso', 'curso' => $curso->id]) }}" 
                     class="btn btn-sm" 
                     style="background-color: #0d6efd; color: white;" 
                     title="Ver detalles del curso">
                     <i class="fas fa-eye"></i>
                     <span>Ver detalles</span>
                  </a>
               </div>
            </div>
         </div>
      @endforeach
   </div>
   @endif
</div>
