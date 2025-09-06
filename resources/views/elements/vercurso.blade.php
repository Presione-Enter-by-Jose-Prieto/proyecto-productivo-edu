<style>
   .curso-body {
       background-color: #161a20;
       padding: 0;
       border-radius: 8px;
       box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
       border: 1px solid #2a2f36;
       overflow: hidden;
       transition: none !important;
   }
   
   .curso-body:hover {
       border-color: #2a2f36 !important;
       box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1) !important;
   }
   
   .curso-body .card-img-top {
       width: 100%;
       max-height: 500px;
       object-fit: cover;
       border-top-left-radius: 8px;
       border-top-right-radius: 8px;
       margin: 0;
       border-bottom: 1px solid #2a2f36;
   }
   
   .curso-body .card-body {
       padding: 20px;
   }
   
   .info-cards {
       display: flex;
       flex-wrap: wrap;
       gap: 15px;
       margin-bottom: 0;
   }
   
   .info-card {
       flex: 1;
       min-width: 150px;
       background-color: #1e293b;
       border-radius: 8px;
       padding: 15px;
       display: flex;
       align-items: center;
       gap: 12px;
       transition: transform 0.2s, box-shadow 0.2s;
   }
   
   .info-card:hover {
       transform: translateY(-2px);
       box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
   }
   
   .info-card i {
       font-size: 1.2rem;
       color: #60a5fa;
       background-color: rgba(96, 165, 250, 0.1);
       width: 36px;
       height: 36px;
       border-radius: 50%;
       display: flex;
       align-items: center;
       justify-content: center;
   }
   
   .info-content {
       display: flex;
       flex-direction: column;
   }
   
   .info-label {
       font-size: 0.75rem;
       color: #94a3b8;
       text-transform: uppercase;
       letter-spacing: 0.5px;
       margin-bottom: 2px;
   }
   
   .info-value {
       font-size: 0.9rem;
       font-weight: 500;
       color: #e2e8f0;
   }
   
   .section-divider {
       height: 1px;
       background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.1), transparent);
       margin: 25px 0;
   }
   
   .course-description {
       margin: 30px 0;
   }

   .course-description-2 {
       margin: 0;
   }
   
   .section-title {
       font-size: 1.3rem;
       color: #ffffff;
       margin-top: 0;
       margin-bottom: 20px;
       position: relative;
   }
   
   .description-content {
       color: #cbd5e1;
       line-height: 1.7;
       font-size: 1.05rem;
       max-width: 100%;
   }
   
   .description-content p {
       margin-bottom: 1.2em;
   }
   
   .description-content p:last-child {
       margin-bottom: 0;
   }
   
   .course-content-container {
       display: grid;
       grid-template-columns: 1fr 350px;
       gap: 2.5rem;
       margin-top: 2rem;
       align-items: flex-start;
   }
   
   .course-description {
       width: 100%;
       margin-bottom: 1.8rem;

   }
   
   .course-details-cards {
       display: flex;
       flex-direction: column;
       gap: 1.5rem;
       position: sticky;
       top: 1.5rem;
   }
   
   .detail-card {
       background: rgba(26, 32, 44, 0.6);
       border: 1px solid #2d3748;
       border-radius: 8px;
       padding: 1.5rem;
       transition: all 0.3s ease;
   }
   
   .detail-card:hover {
       border-color: #4299e1;
       box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
   }
   
   .detail-card h5 {
       color: #ffffff;
       font-size: 1.1rem;
       margin-top: 0;
       margin-bottom: 1rem;
       padding-bottom: 0.5rem;
       border-bottom: 1px solid #2d3748;
       display: flex;
       align-items: center;
   }
   
   .detail-card h5 i {
       color: #63b3ed;
       margin-right: 0.5rem;
   }
   
   .requisitos-lista {
       list-style: none;
       padding: 0;
       margin: 0;
   }
   
   .requisito-item {
       display: flex;
       align-items: flex-start;
       margin-bottom: 0.75rem;
       line-height: 1.5;
       color: #cbd5e1;
   }
   
   .requisito-item:last-child {
       margin-bottom: 0;
   }
   
   .requisito-item i {
       color: #68d391;
       margin-right: 0.75rem;
       margin-top: 0.25rem;
       font-size: 0.8rem;
       min-width: 16px;
   }
   
   @media (max-width: 992px) {
       .course-content-container {
           grid-template-columns: 1fr;
       }
       
       .course-details-cards {
           position: static;
           margin-top: 2rem;
       }
   }
   
   .detail-card {
       background-color: #181c24;
       border-radius: 8px;
       padding: 1.5rem;
       border: 1px solid #2a2f36;
       box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
   }
   
   .detail-card h5 {
       color: #f0f6fc;
       font-size: 1rem;
       font-weight: 600;
       margin-top: 0;
       margin-bottom: 1rem;
       padding-bottom: 0.5rem;
       border-bottom: 1px solid #2a2f36;
   }
   
   .objetivos-lista, .requisitos-lista {
       list-style: none;
       padding: 0;
       margin: 0;
   }
   
   .objetivo-item, .requisito-item {
       display: flex;
       align-items: flex-start;
       margin-bottom: 0.5rem;
       color: #c9d1d9;
       font-size: 0.9rem;
       line-height: 1.5;
   }
   
   .objetivo-item:last-child, .requisito-item:last-child {
       margin-bottom: 0;
   }
   
   .objetivo-item i, .requisito-item i {
       margin-right: 0.75rem;
       margin-top: 0.2rem;
       color: #8b949e;
       font-size: 0.8em;
       flex-shrink: 0;
   }
   
   .objetivo-item span, .requisito-item span {
       flex: 1;
   }
   
   .contact-info-card {
       background-color: #181c24;
       border-radius: 6px;
       padding: 0.75rem 1rem;
       margin-top: 1.5rem;
       border: 1px solid #2a2f36;
   }
   
   .contact-info-header {
       display: flex;
       align-items: center;
       gap: 0.5rem;
       color: #8b949e;
       font-size: 0.9rem;
       margin-bottom: 0.75rem;
       padding-bottom: 0.5rem;
       border-bottom: 1px solid #2a2f36;
   }
   
   .contact-info-header i {
       color: #58a6ff;
   }
   
   .contact-info-grid {
       display: flex;
       flex-direction: column;
       gap: 0.5rem;
   }
   
   .contact-item {
       display: flex;
       align-items: center;
       gap: 0.75rem;
       padding: 0.25rem 0;
       font-size: 0.9rem;
   }
   
   .contact-item i {
       color: #58a6ff;
       font-size: 0.9rem;
       min-width: 16px;
       text-align: center;
       opacity: 0.8;
   }
   
   .contact-value {
       color: #c9d1d9;
   }

   .boton-editar {
       display: flex;
       justify-content: flex-end;
       margin-top: 1.5rem;
   }
   
   .boton-editar a, .boton-editar a:hover, .boton-editar a:focus {
       text-decoration: none;
   }

   .form-group {
       margin-bottom: 1.5rem;
   }
</style>
@if(isset($curso))
   <div class="curso-detalle">
      <div class="d-flex justify-content-between align-items-center mb-4">
         <h1 class="titulo">
            {{ $curso->titulo }}
         </h1>
      </div>
       
      @if(session('success') && session('curso_id') == $curso->id)
         <div class="alert alert-success mb-4" style="margin: 0.5rem 0 1rem 0; border-radius: 6px;">
            <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
         </div>
      @elseif(session('error') && session('curso_id') == $curso->id)
         <div class="alert alert-danger mb-4" style="margin: 0.5rem 0 1rem 0; border-radius: 6px;">
            <i class="fas fa-exclamation-circle me-2"></i> {{ session('error') }}
         </div>
      @endif

      <div class="curso-body {{ strtolower($curso->nivel_formateado) === 'avanzado' ? 'nivel-avanzado' : '' }}">
         @if($curso->imagen)
            <img src="{{ asset('storage/' . $curso->imagen) }}" class="card-img-top" alt="{{ $curso->titulo }}" style="max-height: 400px; object-fit: cover;">
         @endif
         <div class="card-body">
            <div class="info-cards">
               <div class="info-card">
                  <i class="fas fa-tag"></i>
                  <div class="info-content">
                     <span class="info-label">Categoría</span>
                     <span class="info-value">{{ $curso->categoria_formateada }}</span>
                  </div>
               </div>
               
               <div class="info-card {{ strtolower($curso->nivel_formateado) === 'avanzado' ? 'nivel-avanzado' : '' }}">
                  <i class="fas fa-layer-group"></i>
                  <div class="info-content">
                     <span class="info-label">Nivel</span>
                     <span class="info-value">{{ $curso->nivel_formateado }}</span>
                  </div>
               </div>
               
               <div class="info-card">
                  <i class="fas fa-clock"></i>
                  <div class="info-content">
                     <span class="info-label">Duración</span>
                     <span class="info-value">{{ $curso->duracion_horas }} horas</span>
                  </div>
               </div>
               
               <div class="info-card">
                  <i class="fas fa-calendar-alt"></i>
                  <div class="info-content">
                     <span class="info-label">Inicia</span>
                     <span class="info-value">{{ $curso->fecha_inicio->format('d/m/Y') }}</span>
                  </div>
               </div>
                   
               @if($curso->cupo_maximo)
               <div class="info-card">
                  <i class="fas fa-users"></i>
                  <div class="info-content">
                     <span class="info-label">Cupo</span>
                     <span class="info-value">{{ $curso->cupo_maximo }} personas</span>
                  </div>
               </div>
               @endif
            </div>
               
         <div class="divider" style="height: 1px; background-color: #2a2f36; margin: 1.5rem 0;"></div>
               
            <div class="course-description">
               <div class="description-content">
                  <div class="course-content-container">
                     <div class="course-description-2">
                        <h3 class="section-title">Descripción del Curso</h3>
                        <div class="description-content">
                           {!! $curso->descripcion !!}
                        </div>
                     </div>
                           
                     <div class="course-details-cards">
                               
                     @if(!empty($curso->objetivos) && count($curso->objetivos) > 0)
                        <div class="detail-card">
                           <h5>Objetivos del Curso</h5>
                           <ul class="objetivos-lista">
                              @foreach($curso->objetivos as $objetivo)
                                 <li class="objetivo-item">
                                    <i class="fas fa-check"></i>
                                    <span>{{ $objetivo }}</span>
                                 </li>
                              @endforeach
                           </ul>
                        </div>
                     @endif
                               
                     @if(!empty($curso->requisitos) && count($curso->requisitos) > 0)
                        <div class="detail-card">
                           <h5>Requisitos</h5>
                           <ul class="requisitos-lista">
                              @foreach($curso->requisitos as $requisito)
                                 <li class="requisito-item">
                                    <i class="fas fa-check"></i>
                                    <span>{{ $requisito }}</span>
                                 </li>
                              @endforeach
                           </ul>
                        </div>
                     @endif

                     @if($curso->lugar || $curso->telefono_contacto || isset($curso->docente))
                        <div class="detail-card">
                           <h5>Información Adicional</h5>
                           <ul class="requisitos-lista">
                              @if($curso->lugar)
                              <li class="requisito-item">
                                 <i class="fas fa-map-marker-alt"></i>
                                 <span>Lugar: {{ $curso->lugar }}</span>
                              </li>
                              @endif
                              @if(isset($curso->docente))
                              <li class="requisito-item">
                                 <i class="fas fa-user-tie"></i>
                                 <span>Docente: {{ $curso->docente->name }}</span>
                              </li>
                              @endif
                              @if($curso->telefono_contacto)
                                 <li class="requisito-item">
                                    <i class="fas fa-phone"></i>
                                    <span>Número de Contacto: +57 {{ $curso->telefono_contacto }}</span>
                                 </li>
                              @endif
                           </ul>
                        </div>
                     @endif
                  </div>
               </div>
            </div>
         </div>
      </div>
      
      <div class="form-group text-right mt-4">
         <a href="{{ route('cursos.publicados') }}" class="btn-volver">
            <i class="fas fa-arrow-left"></i> Volver
         </a>
         @if(auth()->check())
            @if(auth()->user()->role === 'docente' && $curso->user_id === auth()->id())
               <a href="{{ route('cursos.edit', $curso->id) }}" class="btn btn-primary" style="text-decoration: none; margin-right: 20px;">
                  <i class="fas fa-edit me-1"></i> Editar Curso
               </a>
            @elseif(auth()->user()->role === 'user')
               @php
                  $estaPreinscrito = auth()->user()->cursos->contains($curso->id);
               @endphp
               @if($estaPreinscrito)
                  <div style="display: inline-flex; gap: 8px; margin-right: 8px;">
                     <form action="{{ route('cursos.eliminar-preinscripcion', $curso->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('¿Estás seguro de que deseas cancelar tu preinscripción a este curso?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" style="height: 38px; padding: 0 15px; margin-left: 10px; border: 1px solid #dc3545; color: rgba(255, 255, 255, 0.9); background-color: #dc3545; border-radius: 4px; font-weight: 500; cursor: pointer; display: inline-flex; align-items: center; margin-right: 16px;">
                           <i class="fas fa-times-circle" style="margin-right: 5px;"></i> Cancelar preinscripción
                        </button>
                     </form>
                  </div>
               @else
                  <form action="{{ route('cursos.preinscribir', $curso->id) }}" method="POST" class="d-inline ms-2">
                     @csrf
                     <button type="submit" class="btn btn-danger" style="color: white; height: 38px; display: inline-flex; align-items: center; margin-left: 10px; margin-right: 20px;">
                        <i class="fas fa-user-plus me-1"></i> Preinscribirme
                     </button>
                  </form>
               @endif
            @endif
         @endif
      </div>
   </div>
@else
   <div class="alert alert-danger">
      <i class="fas fa-exclamation-circle me-2"></i>
      No se encontró el curso solicitado o no tienes permiso para verlo.
   </div>
@endif