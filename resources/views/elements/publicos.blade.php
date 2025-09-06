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
      .curso-card.preinscrito {
         border: 1px solid #28a745;
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
         font-size: 10px;
         font-weight: bold;
         box-shadow: 0 2px 4px rgba(0,0,0,0.2);
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
               <span class="badge bg-warning" title="Categoría del curso">
                  <i class="fas {{ $curso->categoria === 'deportivo' ? 'fa-eye' : ($curso->categoria === 'borrador' ? 'fa-edit' : 'fa-clock') }}"></i>
                  {{ ucfirst($curso->categoria) }}
               </span>
               <span class="badge bg-info" title="Nivel del curso">
                  <i class="fas fa-graduation-cap"></i>
                  {{ ucfirst($curso->nivel) }}
               </span>
            </div>
            <div class="curso-acciones" style="display: flex; justify-content: flex-end;">
               <a href="{{ route('preinscripcion', ['seccion' => 'ver-curso', 'curso' => $curso->id]) }}" class="btn btn-sm" style="background-color: #0d6efd; color: white;" title="Ver detalles del curso">
                  <i class="fas fa-eye"></i>
                  <span>Ver detalles</span>
               </a>
            </div>
         </div>
      @endforeach
   </div>
@endif