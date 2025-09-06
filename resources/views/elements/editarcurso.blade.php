@if(auth()->check() && auth()->user()->role === 'docente' && isset($curso) && $curso->user_id === auth()->id())
   <h1 class="titulo">
      <i class="fas fa-edit text-primary me-2"></i>
      Editar Curso: <span class="text-primary">{{ $curso->titulo }}</span>
   </h1>
   <div class="contenido-seccion">
      @if(session('success'))
         <div class="alert alert-success">
            {{ session('success') }}
         </div>
      @endif
      
      @if($errors->any())
         <div class="alert alert-danger">
            <ul class="mb-0">
               @foreach($errors->all() as $error)
                  <li>{{ $error }}</li>
               @endforeach
            </ul>
         </div>
      @endif

      <form action="{{ route('cursos.update', $curso->id) }}" method="POST" enctype="multipart/form-data" class="form-curso" id="form-editar-curso">
         @csrf
         @method('PUT')
         
         <div class="info-principal">
            <div class="form-group">
               <label for="titulo" class="form-label">Título del Curso</label>
               <input type="text" id="titulo" name="titulo" class="form-control" required 
                      value="{{ old('titulo', $curso->titulo) }}" placeholder="Ej: Introducción a la Programación">
            </div>

            <div class="form-group">
               <label for="descripcion" class="form-label">Descripción</label>
               <textarea id="descripcion" name="descripcion" class="form-control" rows="4" required
                         placeholder="Describe el contenido y objetivos del curso">{{ old('descripcion', $curso->descripcion) }}</textarea>
            </div>

            <style>
               #imagen-edit {
                  display: none;
               }
               .custom-file-upload-edit {
                  width: 100%;
                  height: 200px;
                  border: 2px dashed #30363d;
                  border-radius: 6px;
                  display: flex;
                  flex-direction: column;
                  align-items: center;
                  justify-content: center;
                  cursor: pointer;
                  background-color: #161a20;
                  transition: all 0.3s ease;
                  color: #e5e7eb;
                  margin-bottom: 15px;
               }
               .custom-file-upload-edit:hover {
                  border-color: #3b82f6;
               }
               .custom-file-upload-edit:hover i,
               .custom-file-upload-edit:hover span {
                  color: #3b82f6;
               }
               .custom-file-upload-edit i {
                  font-size: 48px;
                  color: #30363d;
                  margin-bottom: 10px;
                  transition: color 0.3s ease;
               }
               .custom-file-upload-edit span {
                  color: #30363d;
                  font-size: 16px;
                  transition: color 0.3s ease;
               }
               .image-previews-edit {
                  display: flex;
                  flex-wrap: wrap;
                  gap: 10px;
                  margin-top: 15px;
               }
               .preview-container-edit {
                  position: relative;
                  width: 150px;
                  height: 150px;
                  border-radius: 6px;
                  overflow: hidden;
               }
               .preview-image-edit {
                  width: 100%;
                  height: 100%;
                  object-fit: cover;
               }
               .remove-image-edit {
                  position: absolute;
                  top: 5px;
                  right: 5px;
                  background: #d73a49;
                  color: white;
                  border-radius: 50%;
                  width: 20px;
                  height: 20px;
                  display: flex;
                  align-items: center;
                  justify-content: center;
                  cursor: pointer;
                  font-size: 16px;
                  font-weight:500;
                  opacity: 0.8;
                  transition: opacity 0.2s ease;
                  border: 1px solid #d73a49;
               }
               .remove-image-edit:hover {
                  opacity: 1;
                  background: #dc2626;
               }
            </style>
            <div class="form-group">
               <label for="imagen-edit" class="form-label">Imagen del Curso</label>
               <label for="imagen-edit" class="custom-file-upload-edit">
                  <i class="fas fa-cloud-upload-alt"></i>
                  <span>Haz clic para subir una imagen</span>
               </label>
               <input type="file" id="imagen-edit" name="imagen" class="form-control" accept="image/*" onchange="previewEditImage(this)">
               <div id="image-preview-edit" class="image-preview-edit">
                  @if($curso->imagen)
                     <div class="preview-container-edit">
                        <img src="{{ asset('storage/' . $curso->imagen) }}" class="preview-image-edit" alt="Imagen del curso">
                        <button type="button" class="remove-image-edit" onclick="removeImage()">×</button>
                     </div>
                  @endif
               </div>
               <div class="eliminar-imagen-container">
                  <input type="hidden" name="eliminar_imagen" value="0">
                  <label class="eliminar-imagen-label">
                     <input type="checkbox" class="eliminar-imagen-checkbox" id="eliminar_imagen" name="eliminar_imagen" value="1" {{ old('eliminar_imagen', false) ? 'checked' : '' }}>
                     <span class="eliminar-imagen-custom">
                        <i class="fas fa-check"></i>
                     </span>
                     <span class="eliminar-imagen-text">Eliminar imagen actual</span>
                  </label>
               </div>
               <style>
                  .eliminar-imagen-container {
                     padding: 4px 10px;
                     border: 1px solid #ff4d4d;
                     border-radius: 4px;
                     background-color: #161a20;
                     display: inline-block;
                     margin-top: 10px;
                  }
                  .eliminar-imagen-label {
                     display: flex;
                     align-items: center;
                     cursor: pointer;
                     margin: 0;
                     font-size: 12px;
                     color: #ff6b6b;
                     line-height: 1.2;
                  }
                  .eliminar-imagen-checkbox {
                     display: none;
                  }
                  .eliminar-imagen-custom {
                     display: inline-flex;
                     align-items: center;
                     justify-content: center;
                     width: 10px;
                     height: 10px;
                     border: 1px solid #ff4d4d;
                     border-radius: 3px;
                     margin-right: 8px;
                     background-color: rgba(255, 255, 255, 0.05);
                  }
                  .eliminar-imagen-checkbox:checked + .eliminar-imagen-custom {
                     background-color: #ff4d4d;
                  }
                  .eliminar-imagen-custom i {
                     font-size: 9px;
                     color: white;
                     display: none;
                  }
                  .eliminar-imagen-checkbox:checked + .eliminar-imagen-custom i {
                     display: block;
                  }
                  .eliminar-imagen-text {
                     font-weight: 400;
                  }
                  .eliminar-imagen-label:hover .eliminar-imagen-custom {
                     background-color: rgba(255, 107, 107, 0.2);
                  }
               </style>
               <script>
                  function previewEditImage(input) {
                     const previewContainer = document.getElementById('image-preview-edit');
                     
                     // Clear existing preview
                     previewContainer.innerHTML = '';
                     
                     if (input.files && input.files[0]) {
                        const file = input.files[0];
                        
                        if (!file.type.startsWith('image/')) {
                           alert('Por favor, selecciona un archivo de imagen válido.');
                           input.value = '';
                           return;
                        }
                        
                        const reader = new FileReader();
                        
                        reader.onload = function(e) {
                           const previewDiv = document.createElement('div');
                           previewDiv.className = 'preview-container-edit';
                           
                           const img = document.createElement('img');
                           img.src = e.target.result;
                           img.className = 'preview-image-edit';
                           
                           const removeBtn = document.createElement('button');
                           removeBtn.type = 'button';
                           removeBtn.className = 'remove-image-edit';
                           removeBtn.innerHTML = '×';
                           removeBtn.onclick = function() {
                              previewContainer.innerHTML = '';
                              input.value = '';
                              document.getElementById('eliminar_imagen').checked = true;
                           };
                           
                           previewDiv.appendChild(img);
                           previewDiv.appendChild(removeBtn);
                           previewContainer.appendChild(previewDiv);
                        };
                        
                        reader.readAsDataURL(file);
                     }
                  }
                  
                  function removeImage() {
                     const previewContainer = document.getElementById('image-preview-edit');
                     const fileInput = document.getElementById('imagen-edit');
                                        
                     previewContainer.innerHTML = '';
                     fileInput.value = '';
                     document.getElementById('eliminar_imagen').checked = true;
                  }
               </script>
            </div>

            <div class="form-group">
               <label for="categoria" class="form-label">Categoría</label>
               <select id="categoria" name="categoria" class="form-control" required>
                  <option value="" disabled {{ old('categoria', $curso->categoria) ? '' : 'selected' }}>Selecciona una categoría</option>
                  <option value="deportivo" {{ old('categoria', $curso->categoria) == 'deportivo' ? 'selected' : '' }}>Deportivo</option>
                  <option value="disciplinario" {{ old('categoria', $curso->categoria) == 'disciplinario' ? 'selected' : '' }}>Disciplinario</option>
                  <option value="pedagogico" {{ old('categoria', $curso->categoria) == 'pedagogico' ? 'selected' : '' }}>Pedagógico</option>
                  <option value="idiomas" {{ old('categoria', $curso->categoria) == 'idiomas' ? 'selected' : '' }}>Idiomas</option>
                  <option value="otro" {{ old('categoria', $curso->categoria) == 'otro' ? 'selected' : '' }}>Otro</option>
               </select>
            </div>

            <div class="form-group">
               <label class="form-label">Nivel</label>
               <div class="niveles-container">
                  <label class="nivel-option">
                     <input type="radio" name="nivel" value="basico" class="nivel-radio" 
                        {{ old('nivel', $curso->nivel) == 'basico' ? 'checked' : '' }} required>
                     <span class="nivel-pill nivel-basico">Básico</span>
                  </label>
                  <label class="nivel-option">
                     <input type="radio" name="nivel" value="intermedio" class="nivel-radio"
                        {{ old('nivel', $curso->nivel) == 'intermedio' ? 'checked' : '' }}>
                     <span class="nivel-pill nivel-intermedio">Intermedio</span>
                  </label>
                  <label class="nivel-option">
                     <input type="radio" name="nivel" value="avanzado" class="nivel-radio"
                        {{ old('nivel', $curso->nivel) == 'avanzado' ? 'checked' : '' }}>
                     <span class="nivel-pill nivel-avanzado">Avanzado</span>
                  </label>
               </div>
            </div>

            <div class="form-group">
               <label for="duracion_horas" class="form-label">Duración (horas)</label>
               <input type="number" id="duracion_horas" name="duracion_horas" class="form-control" 
                  value="{{ old('duracion_horas', $curso->duracion_horas) }}" min="1" required>
            </div>

            <div class="form-row">
               <div class="form-group col-md-6">
                  <label for="fecha_inicio" class="form-label">Fecha de Inicio</label>
                  <input type="date" id="fecha_inicio" name="fecha_inicio" class="form-control" 
                     value="{{ old('fecha_inicio', $curso->fecha_inicio ? \Carbon\Carbon::parse($curso->fecha_inicio)->format('Y-m-d') : '') }}" required>
               </div>
               <div class="form-group col-md-6">
                  <label for="fecha_fin" class="form-label">Fecha de Finalización</label>
                  <input type="date" id="fecha_fin" name="fecha_fin" class="form-control" 
                     value="{{ old('fecha_fin', $curso->fecha_fin ? \Carbon\Carbon::parse($curso->fecha_fin)->format('Y-m-d') : '') }}" required>
               </div>
            </div>

            <div class="form-group">
               <label for="cupo_maximo" class="form-label">Cupo Máximo de Estudiantes</label>
               <input type="number" id="cupo_maximo" name="cupo_maximo" class="form-control" 
                  value="{{ old('cupo_maximo', $curso->cupo_maximo) }}" min="1" required>
            </div>

            <div class="form-group">
               <div class="d-flex justify-content-between align-items-center">
                  <label class="form-label">Objetivos de Aprendizaje</label>
                  <button type="button" class="btn-add-array" onclick="addObjective()">+ Agregar Objetivo</button>
               </div>
               <div id="objetivos-container">
                  @if(old('objetivos'))
                     @foreach(old('objetivos') as $index => $objetivo)
                        <div class="array-input-item">
                           <input type="text" name="objetivos[]" class="form-control mb-2" 
                              value="{{ $objetivo }}" placeholder="Objetivo #{{ $index + 1 }}" required>
                           <button type="button" class="btn-remove-array" onclick="removeArrayItem(this)">×</button>
                        </div>
                     @endforeach
                  @else
                     @foreach($curso->objetivos as $index => $objetivo)
                        <div class="array-input-item">
                           <input type="text" name="objetivos[]" class="form-control mb-2" 
                              value="{{ $objetivo }}" placeholder="Objetivo #{{ $index + 1 }}" required>
                           <button type="button" class="btn-remove-array" onclick="removeArrayItem(this)">×</button>
                        </div>
                     @endforeach
                  @endif
               </div>
            </div>

            <div class="form-group">
               <div class="d-flex justify-content-between align-items-center">
                  <label class="form-label">Requisitos Previos (Opcional)</label>
                  <button type="button" class="btn-add-array" onclick="addRequirement()">+ Agregar Requisito</button>
               </div>
               <div id="requisitos-container">
                  @if(old('requisitos'))
                     @foreach(old('requisitos') as $index => $requisito)
                        <div class="array-input-item">
                           <input type="text" name="requisitos[]" class="form-control mb-2" 
                              value="{{ $requisito }}" placeholder="Requisito #{{ $index + 1 }}">
                           <button type="button" class="btn-remove-array" onclick="removeArrayItem(this)">×</button>
                        </div>
                     @endforeach
                  @else
                     @foreach($curso->requisitos as $index => $requisito)
                        <div class="array-input-item">
                           <input type="text" name="requisitos[]" class="form-control mb-2" 
                              value="{{ $requisito }}" placeholder="Requisito #{{ $index + 1 }}">
                           <button type="button" class="btn-remove-array" onclick="removeArrayItem(this)">×</button>
                        </div>
                     @endforeach
                  @endif
               </div>
            </div>

            <div class="form-group">
               <label for="telefono_contacto" class="form-label">Teléfono de Contacto</label>
               <input type="tel" id="telefono_contacto" name="telefono_contacto" class="form-control" 
                  value="{{ old('telefono_contacto', $curso->telefono_contacto) }}" placeholder="Ej: +51 987 654 321">
            </div>

            <div class="form-group">
               <label for="lugar" class="form-label">Lugar del Curso</label>
               <input type="text" id="lugar" name="lugar" class="form-control" 
                  value="{{ old('lugar', $curso->lugar) }}" placeholder="Ej: Aula 101, Pabellón Principal">
            </div>
         </div> <!-- Cierre de info-secundaria -->
         
         <div class="form-group text-right mt-4">
            <a href="{{ route('preinscripcion', ['seccion' => 'mis-cursos']) }}" class="btn-volver">
               <i class="fas fa-arrow-left"></i> Volver sin guardar
            </a>
            <button type="submit" class="btn btn-primary">
               <i class="fas fa-save"></i> Guardar Cambios
            </button>
         </div>
      </form>
   </div>
@else
   <div class="acceso-denegado">
      <h2>Acceso denegado</h2>
      <p>No tienes permisos para editar este curso.</p>
   </div>
@endif
@push('scripts')
   <script>
      // Función para previsualizar la imagen
      function previewImage(input) {
         const preview = document.getElementById('image-preview');
         if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
               preview.src = e.target.result;
               preview.style.display = 'block';
            }
            reader.readAsDataURL(input.files[0]);
         }
      }

      // Función para agregar un nuevo campo de objetivo
      function addObjective() {
         const container = document.getElementById('objetivos-container');
         const count = container.querySelectorAll('.array-input-item').length + 1;
         const div = document.createElement('div');
         div.className = 'array-input-item';
         div.innerHTML = `
            <input type="text" name="objetivos[]" class="form-control mb-2" 
               placeholder="Objetivo #${count}" required>
            <button type="button" class="btn-remove-array" onclick="removeArrayItem(this)">×</button>
         `;
         container.appendChild(div);
      }

      // Función para agregar un nuevo campo de requisito
      function addRequirement() {
         const container = document.getElementById('requisitos-container');
         const count = container.querySelectorAll('.array-input-item').length + 1;
         const div = document.createElement('div');
         div.className = 'array-input-item';
         div.innerHTML = `
            <input type="text" name="requisitos[]" class="form-control mb-2" 
               placeholder="Requisito #${count}">
               <button type="button" class="btn-remove-array" onclick="removeArrayItem(this)">×</button>
         `;
         container.appendChild(div);
      }

      // Función para eliminar un campo de array
      function removeArrayItem(button) {
         button.closest('.array-input-item').remove();
         // Renumerar los campos restantes
         const container = button.closest('.form-group').querySelectorAll('.array-input-item');
         container.forEach((item, index) => {
            const input = item.querySelector('input');
            const placeholder = input.name.includes('objetivos') ? 'Objetivo' : 'Requisito';
            input.placeholder = `${placeholder} #${index + 1}`;
         });
      }
   </script>
@endpush