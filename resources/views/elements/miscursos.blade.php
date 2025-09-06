@if(auth()->check() && auth()->user()->role === 'docente')
   <h1 class="titulo">Mis Cursos Creados</h1>
@elseif(auth()->check() && auth()->user()->role === 'user')
   <h1 class="titulo">Mis Cursos</h1>
@endif
                
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
         <div class="text-center py-5">
            <div class="mb-4">
               <i class="fas fa-book-reader fa-4x text-muted mb-3"></i>
            </div>
            <h3 class="mb-3">No estás inscrito en ningún curso</h3>
            <p class="text-muted">Explora nuestros cursos disponibles y comienza tu aprendizaje hoy mismo.</p>
            <a href="{{ route('preinscripcion', ['seccion' => 'cursos-disponibles']) }}" class="btn btn-primary mt-3">
               <i class="fas fa-search me-2"></i>Explorar cursos
            </a>
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
                     <div class="curso-acciones">
                        <a href="{{ route('preinscripcion', ['seccion' => 'ver-curso', 'curso' => $curso->id]) }}" class="btn btn-sm" style="background-color: #0d6efd; border-color: #0d6efd; color: white; transition: background-color 0.2s;" title="Ver detalles del curso" onmouseover="this.style.backgroundColor='#0b5ed7'" onmouseout="this.style.backgroundColor='#0d6efd'">
                           <i class="fas fa-eye"></i>
                           <span>Ver</span>
                        </a>
                        <a href="{{ route('cursos.edit', $curso) }}" class="btn btn-sm btn-warning" title="Editar curso">
                           <i class="fas fa-edit"></i>
                           <span>Editar</span>
                        </a>
                        <form action="{{ route('cursos.destroy', $curso) }}" method="POST" onsubmit="return confirm('¿Estás seguro de eliminar este curso? Esta acción no se puede deshacer.')" class="d-inline">
                           @csrf
                           @method('DELETE')
                           <button type="submit" class="btn btn-sm btn-danger" title="Eliminar curso">
                              <i class="fas fa-trash"></i>
                              <span>Eliminar</span>
                           </button>
                        </form>
                        @if($curso->estado === 'borrador')
                           <form action="{{ route('cursos.cambiar-estado', $curso) }}" method="POST" class="d-inline">
                              @csrf
                              @method('PATCH')
                              <input type="hidden" name="estado" value="publicado">
                              <button type="submit" class="btn btn-sm btn-success" title="Publicar curso">
                                 <i class="fas fa-upload"></i>
                                 <span>Publicar</span>
                              </button>
                           </form>
                        @elseif($curso->estado === 'publicado')
                           <form action="{{ route('cursos.cambiar-estado', $curso) }}" method="POST" class="d-inline">
                              @csrf
                              @method('PATCH')
                              <input type="hidden" name="estado" value="borrador">
                              <button type="submit" class="btn btn-sm btn-secondary" title="Pasar a borrador">
                                 <i class="fas fa-file-alt"></i>
                                 <span>Borrador</span>
                              </button>
                           </form>
                        @endif
                        <div style="width: 100%;">
                           <a href="{{ route('cursos.lista-preinscritos', $curso) }}" class="btn btn-sm" style="display: block; width: 100%; box-sizing: border-box; background-color: #198754; border-color: #198754; color: white !important; text-align: center; padding: 0.4rem 0.5rem; transition: background-color 0.2s;" title="Ver lista de preinscritos" onmouseover="this.style.backgroundColor='#157347'" onmouseout="this.style.backgroundColor='#198754'">
                              <i class="fas fa-users me-1" style="color: white !important;"></i>
                              <span style="color: white !important;">Ver lista de preinscritos</span>
                           </a>
                        </div>
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