@if(auth()->check() && auth()->user()->role === 'docente')
   <h1 class="titulo">Crear Nuevo Curso</h1>
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

      <form action="{{ route('cursos.store') }}" method="POST" enctype="multipart/form-data" class="form-curso" id="form-crear-curso">
         @csrf
                            
         <div class="info-principal">

            <div class="form-group">
               <label for="titulo" class="form-label">Título del Curso</label>
               <input type="text" id="titulo" name="titulo" class="form-control" required 
               value="{{ old('titulo') }}" placeholder="Ej: Introducción a la Programación">
            </div>
    
            <div class="form-group">
               <label for="descripcion" class="form-label">Descripción</label>
               <textarea id="descripcion" name="descripcion" class="form-control" rows="4" required
               placeholder="Describe el contenido y objetivos del curso">{{ old('descripcion') }}</textarea>
            </div>
    
            <style>
               #imagen {
                  display: none;
               }
               .custom-file-upload {
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
               .custom-file-upload:hover {
                  border-color: #3b82f6;
               }
               .custom-file-upload:hover i,
               .custom-file-upload:hover span {
                  color: #3b82f6;
               }
               .custom-file-upload i {
                  font-size: 48px;
                  color: #30363d;
                  margin-bottom: 10px;
                  transition: color 0.3s ease;
               }
               .custom-file-upload span {
                  color: #30363d;
                  font-size: 16px;
                  transition: color 0.3s ease;
               }
               .image-previews {
                  display: flex;
                  flex-wrap: wrap;
                  gap: 10px;
                  margin-top: 15px;
               }
               .preview-container {
                  position: relative;
                  width: 150px;
                  height: 150px;
                  border-radius: 6px;
                  overflow: hidden;
               }
               .preview-image {
                  width: 100%;
                  height: 100%;
                  object-fit: cover;
               }
               .preview-container {
                  position: relative;
                  width: 150px;
                  height: 150px;
                  border-radius: 6px;
                  overflow: hidden;
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
               <label for="imagen" class="form-label">Imagen del Curso</label>
               <label for="imagen" class="custom-file-upload">
                  <i class="fas fa-cloud-upload-alt"></i>
                  <span>Haz clic para subir una imagen</span>
                  <input type="file" id="imagen" name="imagen" accept="image/*" onchange="previewImage(this)">
               </label>
               <div id="image-preview" class="image-preview"></div>
               <small class="form-text">Formatos permitidos: JPG, PNG, JPEG</small>
               @error('imagen')
                  <div class="text-danger">{{ $message }}</div>
               @enderror
               <script>
               function previewImage(input) {
                  const previewContainer = document.getElementById('image-preview');
                  previewContainer.innerHTML = '';
                  
                  if (input.files && input.files[0]) {
                     const file = input.files[0];
                  
                     // Check file type
                     if (!file.type.match('image.*')) {
                        alert('El archivo no es una imagen válida.');
                        input.value = '';
                        return;
                     }
                     
                     const reader = new FileReader();
                     
                     reader.onload = function(e) {
                        const preview = document.createElement('div');
                        preview.className = 'preview-container';
                        
                        const img = document.createElement('img');
                        img.src = e.target.result;
                        img.className = 'preview-image';
                        
                        const removeBtn = document.createElement('button');
                        removeBtn.type = 'button';
                        removeBtn.className = 'remove-image-edit';
                        removeBtn.innerHTML = '×';
                        removeBtn.onclick = function() {
                           input.value = '';
                           previewContainer.innerHTML = '';
                           updateFileInputLabel(false);
                        };
                        
                        preview.appendChild(img);
                        preview.appendChild(removeBtn);
                        previewContainer.appendChild(preview);
                        updateFileInputLabel(true);
                     };
                     
                     reader.readAsDataURL(file);
                  }
               }
               
               function updateFileInputLabel(hasFile) {
                  const span = document.querySelector('.custom-file-upload span');
                  if (hasFile) {
                     span.textContent = 'Imagen seleccionada';
                  } else {
                     span.textContent = 'Haz clic para subir una imagen';
                  }
               }
               </script>
            </div>
    
            <div class="form-group">
               <label for="categoria" class="form-label">Categoría</label>
               <select id="categoria" name="categoria" class="form-control" required>
                  <option value="" disabled selected>Selecciona una categoría</option>
                  <option value="deportivo" {{ old('categoria') == 'deportivo' ? 'selected' : '' }}>Deportivo</option>
                  <option value="disciplinario" {{ old('categoria') == 'disciplinario' ? 'selected' : '' }}>Disciplinario</option>
                  <option value="pedagogico" {{ old('categoria') == 'pedagogico' ? 'selected' : '' }}>Pedagógico</option>
                  <option value="idiomas" {{ old('categoria') == 'idiomas' ? 'selected' : '' }}>Idiomas</option>
                  <option value="otro" {{ old('categoria') == 'otro' ? 'selected' : '' }}>Otro</option>
               </select>
            </div>
    
            <div class="form-group">
               <label class="form-label">Nivel</label>
               <div class="niveles-container">
                  <label class="nivel-option">
                     <input type="radio" name="nivel" value="basico" class="nivel-radio" 
                            {{ old('nivel') == 'basico' ? 'checked' : 'checked' }} required>
                     <span class="nivel-pill nivel-basico">Básico</span>
                  </label>
                  <label class="nivel-option">
                     <input type="radio" name="nivel" value="intermedio" class="nivel-radio"
                            {{ old('nivel') == 'intermedio' ? 'checked' : '' }}>
                     <span class="nivel-pill nivel-intermedio">Intermedio</span>
                  </label>
                  <label class="nivel-option">
                     <input type="radio" name="nivel" value="avanzado" class="nivel-radio"
                            {{ old('nivel') == 'avanzado' ? 'checked' : '' }}>
                     <span class="nivel-pill nivel-avanzado">Avanzado</span>
                  </label>
               </div>
               <small class="form-text" style="margin-top: 10px;">Selecione el nivel de ficultad media que tenga el curso</small>
            </div>

            <div class="info-secundaria">
               
               <div class="form-group">
                  <label for="duracion_horas" class="form-label">Duración (horas)</label>
                  <input type="number" id="duracion_horas" name="duracion_horas" class="form-control" 
                        value="{{ old('duracion_horas') }}" min="1" placeholder="Ej: 10" required>
               </div>
      
               <div class="form-row">
                  <div class="form-group col-md-6">
                     <label for="fecha_inicio" class="form-label">Fecha de Inicio</label>
                     <input type="date" id="fecha_inicio" name="fecha_inicio" class="form-control" 
                           value="{{ old('fecha_inicio', date('Y-m-d')) }}" required>
                  </div>
                  <div class="form-group col-md-6">
                     <label for="fecha_fin" class="form-label">Fecha de Finalización</label>
                     <input type="date" id="fecha_fin" name="fecha_fin" class="form-control" 
                           value="{{ old('fecha_fin') }}" required>
                  </div>
               </div>

               <div class="form-group">
                  <label for="telefono_contacto" class="form-label">Teléfono de Contacto</label>
                  <input type="tel" id="telefono_contacto" name="telefono_contacto" class="form-control" 
                                             value="{{ old('telefono_contacto') }}" placeholder="Ej: +51 987 654 321">
               </div>

               <div class="form-group">
                  <label for="lugar" class="form-label">Lugar del Curso</label>
                  <input type="text" id="lugar" name="lugar" class="form-control" 
                                             value="{{ old('lugar') }}" placeholder="Ej: Aula 101, Pabellón Principal">
               </div>
      
               <div class="form-group">
                  <label for="cupo_maximo" class="form-label">Cupo Máximo de Estudiantes</label>
                  <input type="number" id="cupo_maximo" name="cupo_maximo" class="form-control" 
                                             value="{{ old('cupo_maximo') }}" min="1" placeholder="Ej: 20" required>
               </div>
      
               <div class="form-group">
                  <div class="d-flex justify-content-between align-items-center">
                     <label class="form-label">Objetivos de Aprendizaje</label>
                     <button type="button" class="btn-add-array" onclick="addObjective()">+ Agregar Objetivo</button>
                     <small class="form-text" style="margin-bottom: 10px;">Agrege por lo menos un objetivo de aprendizaje</small>
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
                        <div class="array-input-item">
                           <input type="text" name="objetivos[]" class="form-control mb-2" 
                                 placeholder="Objetivo #1" required>
                           <button type="button" class="btn-remove-array" onclick="removeArrayItem(this)">×</button>
                        </div>
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
                     @endif
                  </div>
               </div>

            </div>

            <div class="form-group text-right mt-4">
               <button type="button" class="btn btn-reset" onclick="resetForm()">
                  <i class="fas fa-undo"></i> Resetear Formulario
               </button>
               <button type="submit" class="btn btn-primary">
                  <i class="fas fa-save"></i> Guardar Curso
               </button>
            </div>

            <script>
               function resetForm() {
                  // Reset the form
                  document.getElementById('form-crear-curso').reset();
                  
                  // Clear main image preview
                  const mainPreview = document.getElementById('image-preview');
                  mainPreview.innerHTML = '';
                  
                  // Clear additional images preview
                  const additionalPreviews = document.getElementById('additional-images-preview');
                  if (additionalPreviews) {
                     additionalPreviews.innerHTML = '';
                  }
                  
                  // Reset file inputs
                  const fileInput = document.getElementById('imagen');
                  if (fileInput) fileInput.value = '';
                  
                  const additionalImagesInput = document.getElementById('imagenes_adicionales');
                  if (additionalImagesInput) additionalImagesInput.value = '';
                  
                  // Update file input label
                  const labelSpan = document.querySelector('.custom-file-upload span');
                  if (labelSpan) labelSpan.textContent = 'Haz clic para subir una imagen';
                  
                  // Show file input if it was hidden
                  const fileUpload = document.querySelector('.custom-file-upload');
                  if (fileUpload) fileUpload.style.display = 'flex';
               }                         
            </script>
         </div>
      </form>
   </div>
@else
   <div class="acceso-denegado">
      <h2>Acceso denegado</h2>
      <p>No tienes permisos para acceder a esta sección.</p>
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
            <button type="button" class="btn-remove-array" onclick="removeArrayItem(this)">×</button>`;
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