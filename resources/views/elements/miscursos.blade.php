@if(auth()->check() && auth()->user()->role === 'docente')
   <h1 class="titulo">Mis Cursos Creados</h1>
@elseif(auth()->check() && auth()->user()->role === 'user')
   <h1 class="titulo">Mis Cursos</h1>
@endif

<style>
    .cursos-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 20px;
        margin-top: 20px;
    }

    .curso-card {
        background: #161B23;
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
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(0,0,0,0.6);
    }

    .curso-card img.curso-imagen {
        width: 100%;
        height: 160px;
        object-fit: cover;
    }
    
    @media (max-width: 1400px) {
        .cursos-grid {
            grid-template-columns: repeat(3, 1fr);
        }
    }
    
    @media (max-width: 992px) {
        .cursos-grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }
    
    @media (max-width: 576px) {
        .cursos-grid {
            grid-template-columns: 1fr;
        }
    }
</style>
                
<div class="contenido-seccion">
   @if(session('success'))
      <div class="alert alert-success" data-message="{{ session('success') }}">
         {{ session('success') }}
      </div>
   @endif
                    
   @if(!isset($cursos) || $cursos->isEmpty())
      @if(auth()->check() && auth()->user()->role === 'docente')
         <div class="empty-state-container">
            <div class="contenedor_no_cursos">
               <div class="empty-state-icon mb-4">
                  <i class="fas fa-chalkboard-teacher fa-4x text-primary"></i>
               </div>
               <h3 class="mb-3 fw-bold">¡Comienza a crear contenido educativo!</h3>
               <p class="text-muted mb-4">Aún no has creado ningún curso. Comparte tu conocimiento con la comunidad educativa.</p>
               <div class="d-flex justify-content-center gap-3">
                  <a href="{{ route('cursos.create') }}" class="btn btn-primary px-4">
                     <i class="fas fa-plus-circle me-2"></i>Crear mi primer curso
                  </a>
               </div>
            </div>
         </div>
      @else
         <div class="empty-state-container">
            <div class="contenedor_no_cursos">
               <div class="empty-state-icon mb-4">
                  <i class="fas fa-book-reader fa-4x text-primary"></i>
               </div>
               <h3 class="mb-3 fw-bold">No estás inscrito en ningún curso</h3>
               <p class="text-muted mb-4">Explora nuestros cursos disponibles y comienza tu aprendizaje hoy mismo.</p>
               <div class="d-flex justify-content-center gap-3">
                  <a href="{{ route('cursos.publicados') }}" class="btn btn-primary px-4">
                     <i class="fas fa-search me-2"></i>Explorar cursos
                  </a>
               </div>
            </div>
         </div>
      @endif
   @else
      @if(auth()->user()->role === 'docente')
         <div class="cursos-grid">
            @foreach($cursos as $curso)
               <div class="curso-card">
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
                        <span class="badge {{ $curso->estado === 'publicado' ? 'bg-success' : ($curso->estado === 'borrador' ? 'bg-secondary' : 'bg-warning') }}" title="Estado del curso">
                           <i class="fas {{ $curso->estado === 'publicado' ? 'fa-eye' : ($curso->estado === 'borrador' ? 'fa-edit' : 'fa-clock') }}"></i>
                           {{ ucfirst($curso->estado) }}
                        </span>
                        <span class="badge bg-info" title="Nivel del curso">
                           <i class="fas fa-graduation-cap"></i>
                           {{ ucfirst($curso->nivel) }}
                        </span>
                     </div>
                     <div class="curso-acciones" style="width:100%; display:flex; flex-direction:column; gap:0.5rem;">

                        <!-- Fila 1: Ver + Editar + Publicar/Borrador -->
                        <div style="display:flex; width:100%; gap:0.5rem;">
                           <!-- Botón Ver -->
                           <a href="{{ route('preinscripcion', ['seccion' => 'ver-curso', 'curso' => $curso->id]) }}" 
                              class="btn btn-sm" 
                              style="flex: 1; background-color:#0d6efd; border-color:#0d6efd; color:white; text-align:center; transition:background-color 0.2s; padding: 0.25rem 0.5rem;" 
                              onmouseover="this.style.backgroundColor='#0b5ed7'" 
                              onmouseout="this.style.backgroundColor='#0d6efd'">
                              <i class="fas fa-eye"></i> Ver
                           </a>

                           <!-- Botón Editar -->
                           <a href="{{ route('cursos.edit', $curso) }}" 
                              class="btn btn-sm btn-warning" 
                              style="flex: 1; text-align:center; padding: 0.25rem 0.5rem;">
                              <i class="fas fa-edit"></i> Editar
                           </a>

                           @if($curso->estado === 'borrador')
                              <form action="{{ route('cursos.cambiar-estado', $curso) }}" method="POST" style="flex: 1; margin: 0;">
                                 @csrf
                                 @method('PATCH')
                                 <input type="hidden" name="estado" value="publicado">
                                 <button type="submit" class="btn btn-sm btn-success w-100" style="text-align:center; padding: 0.25rem 0.5rem;">
                                    <i class="fas fa-upload"></i> Publicar
                                 </button>
                              </form>
                           @elseif($curso->estado === 'publicado')
                              <form action="{{ route('cursos.cambiar-estado', $curso) }}" method="POST" style="flex: 1; margin: 0;">
                                 @csrf
                                 @method('PATCH')
                                 <input type="hidden" name="estado" value="borrador">
                                 <button type="submit" class="btn btn-sm btn-secondary w-100" style="text-align:center; padding: 0.25rem 0.5rem;">
                                    <i class="fas fa-file-alt"></i> Borrador
                                 </button>
                              </form>
                           @endif
                        </div>

                        <!-- Fila 2: Preinscritos + Inscritos -->
                        <div style="display:flex; width:100%; gap:0.5rem;">
                           <a href="{{ route('cursos.lista-preinscritos', $curso) }}" 
                              class="btn btn-sm" 
                              style="flex:1; background-color:#198754; border-color:#198754; color:white; text-align:center; transition:background-color 0.2s;" 
                              onmouseover="this.style.backgroundColor='#157347'" 
                              onmouseout="this.style.backgroundColor='#198754'">
                              <i class="fas fa-users"></i> Gestión de inscritos
                           </a>
                        </div>

                        <!-- Fila 3: Eliminar -->
                        <form action="{{ route('cursos.destroy', $curso) }}" method="POST" 
                              onsubmit="return confirm('¿Estás seguro de eliminar este curso? Esta acción no se puede deshacer.')" 
                              style="display:block; width:100%; margin:0;">
                           @csrf
                           @method('DELETE')
                           <button type="submit" class="btn btn-sm btn-danger" style="width:100%; text-align:center;">
                              <i class="fas fa-trash"></i> Eliminar
                           </button>
                        </form>

                     </div>
                  </div>
               </div>
            @endforeach
         </div>
      @elseif(auth()->user()->role === 'user')
         <div class="cursos-grid">
            @foreach($cursos as $curso)
               <div class="curso-card">
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
                        <span class="badge {{ $curso->estado === 'publicado' ? 'bg-success' : ($curso->estado === 'borrador' ? 'bg-secondary' : 'bg-warning') }}" title="Estado del curso">
                           <i class="fas {{ $curso->estado === 'publicado' ? 'fa-eye' : ($curso->estado === 'borrador' ? 'fa-edit' : 'fa-clock') }}"></i>
                           {{ ucfirst($curso->estado) }}
                        </span>
                        <span class="badge bg-info" title="Nivel del curso">
                           <i class="fas fa-graduation-cap"></i>
                           {{ ucfirst($curso->nivel) }}
                        </span>
                        @if(isset($curso->pivot->estado))
                           @php
                              $estadoClases = [
                                 'pendiente' => 'bg-warning',
                                 'aprobado' => 'bg-success',
                                 'rechazado' => 'bg-danger'
                              ][$curso->pivot->estado] ?? 'bg-secondary';
                              
                              $estadoIconos = [
                                 'pendiente' => 'fa-clock',
                                 'aprobado' => 'fa-check-circle',
                                 'rechazado' => 'fa-times-circle'
                              ][$curso->pivot->estado] ?? 'fa-question-circle';
                           @endphp
                           <span class="badge {{ $estadoClases }}" title="Estado de tu preinscripción">
                              <i class="fas {{ $estadoIconos }}"></i>
                              {{ ucfirst($curso->pivot->estado) }}
                           </span>
                        @endif
                        @if(isset($curso->pivot->fecha_inscripcion))
                           <span class="badge bg-primary" title="Fecha de inscripción">
                              <i class="far fa-calendar-alt"></i>
                              {{ \Carbon\Carbon::parse($curso->pivot->fecha_inscripcion)->format('d/m/Y') }}
                           </span>
                        @endif
                     </div>
                     <div class="curso-acciones">
                        <a href="{{ route('preinscripcion', ['seccion' => 'ver-curso', 'curso' => $curso->id]) }}" class="btn btn-sm btn-primary" title="Ver detalles del curso">
                           <i class="fas fa-eye"></i>
                           <span>Ver</span>
                        </a>
                        @if(isset($curso->pivot->estado) && in_array($curso->pivot->estado, ['pendiente', 'aprobado']))
                           <form action="{{ route('cursos.eliminar-preinscripcion', $curso->id) }}" method="POST" class="d-inline" onsubmit="return confirm('¿Estás seguro de que deseas cancelar tu preinscripción a este curso?');">
                              @csrf
                              @method('DELETE')
                              <button type="submit" class="btn btn-sm btn-danger" title="Cancelar preinscripción">
                                 <i class="fas fa-times"></i>
                                 <span>Cancelar</span>
                              </button>
                           </form>
                        @endif
                     </div>
                  </div>
               </div>
            @endforeach
         </div>
      @endif
   @endif
</div>