@extends('templates.htmlpre')

@section('title', 'Pre-inscripción')

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        // Función para ajustar automáticamente la altura de los textareas
        function autoResizeTextarea(textarea) {
            textarea.style.height = 'auto';
            textarea.style.height = (textarea.scrollHeight) + 'px';
        }

        // Aplicar a todos los textareas existentes
        document.addEventListener('DOMContentLoaded', function() {
            const textareas = document.querySelectorAll('textarea');
            
            textareas.forEach(textarea => {
                // Ajustar altura inicial
                autoResizeTextarea(textarea);
                
                // Ajustar altura al escribir
                textarea.addEventListener('input', function() {
                    autoResizeTextarea(this);
                });
            });
        });

        // Ocultar automáticamente las alertas después de 4 segundos
        document.addEventListener('DOMContentLoaded', function() {
            const alerts = document.querySelectorAll('.alert');
            
            alerts.forEach(alert => {
                // Configurar tiempo de desvanecimiento (3 segundos)
                setTimeout(() => {
                    alert.style.transition = 'opacity 0.5s ease-in-out';
                    alert.style.opacity = '0';
                    
                    // Eliminar el elemento del DOM después de la animación
                    setTimeout(() => {
                        alert.remove();
                    }, 500);
                    
                }, 3000);
            });
        });
    </script>
@endpush

@push('styles')
    <style>
        /* Estilos para los créditos */
        .creditos-container {
            width: 100%;
            margin-top: 20px;
        }
        
        .creditos-texto {
            text-align: center;
            color: #6c757d;
            font-size: 0.85rem;
            letter-spacing: 0.3px;
            font-weight: 400;
            opacity: 0.8;
            margin-bottom: 0;
        }
        
        .creditos-texto i {
            margin-right: 0.25rem;
        }
        
        /* Textarea styles */
        textarea, textarea.form-control {
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Helvetica, Arial, sans-serif, "Apple Color Emoji", "Segoe UI Emoji";
            line-height: 1.5;
        }

        /* Contenedor base */
        .contenedor {
            border-right: 1px solid #30363d;
            border-bottom: 1px solid #30363d;
            border-left: 1px solid #30363d;
            border-top: none;
            border-radius: 0 0 6px 6px;
            background-color: #0d1117;
            padding: 1.5rem;
        }

        /* Contenedores de información */
        .info-principal, 
        .info-secundaria {
            box-sizing: border-box;
            width: 100%;
            max-width: 100%;
            margin-bottom: 1rem;
            padding: 1.25rem;
            background-color: rgba(22, 27, 34, 0.6);
            border-radius: 6px;
            border: 1px solid #30363d;
        }
        /* Sistema de grid para formularios */
        .form-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 1rem;
            width: 100%;
        }

        /* Grupos de formulario */
        .form-group {
            margin-bottom: 0.75rem;
            width: 100%;
        }

        /* Campos de formulario */
        .form-control {
            width: 100%;
            max-width: 100%;
            padding: 0.5rem 0.75rem;
            background-color: #0d1117;
            border: 1px solid #30363d;
            border-radius: 4px;
            color: #e6eefa;
            font-size: 0.9rem;
            transition: all 0.2s ease;
            box-sizing: border-box;
        }

        .form-control:focus {
            border-color: #1f6feb;
            box-shadow: 0 0 0 2px rgba(31, 111, 235, 0.2);
            outline: none;
        }

        /* Textareas */
        textarea.form-control {
            min-height: 100px;
            resize: vertical;
            line-height: 1.5;
        }

        /* Selectores */
        select.form-control {
            appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' fill='%236e7681' viewBox='0 0 16 16'%3E%3Cpath d='M7.247 11.14 2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 0.75rem center;
            background-size: 12px 12px;
            padding-right: 2rem;
        }

        /* Drag and drop file upload */
        .drop-zone {
            border: 2px dashed #58a6ff;
            border-radius: 8px;
            padding: 2rem;
            text-align: center;
            cursor: pointer;
            transition: all 0.3s ease;
            background-color: rgba(88, 166, 255, 0.05);
            position: relative;
            overflow: hidden;
        }
        
        .drop-zone.drag-over {
            background-color: rgba(88, 166, 255, 0.1);
            border-color: #1f6feb;
        }
        
        .drop-zone:hover {
            background-color: rgba(88, 166, 255, 0.1);
        }
        
        .drop-zone-content {
            pointer-events: none;
        }
        
        .drop-zone h5 {
            margin-bottom: 0.5rem;
            color: #e6eefa;
            font-weight: 500;
        }
        
        .drop-zone p {
            margin-bottom: 0.5rem;
            font-size: 0.9rem;
        }
        
        .file-input {
            display: none;
        }
        
        .file-name {
            display: block;
            margin-top: 0.5rem;
            font-size: 0.85rem;
            color: #8b949e;
        }
        
        .image-preview-container {
            margin-top: 1rem;
            position: relative;
            display: inline-block;
        }
        
        .image-preview {
            max-width: 100%;
            max-height: 200px;
            border-radius: 4px;
            display: block;
            margin: 0 auto;
        }
        
        .remove-image {
            position: absolute;
            top: 5px;
            right: 5px;
            opacity: 0;
            transition: opacity 0.2s ease;
            padding: 0.25rem 0.5rem;
            font-size: 0.75rem;
        }
        
        .image-preview-container:hover .remove-image {
            opacity: 1;
        }
        
        .btn-danger {
            background-color: #f85149;
            border-color: #f85149;
        }
        
        .btn-danger:hover {
            background-color: #da3633;
            border-color: #da3633;
        }

        /* Etiquetas */
        .form-label {
            display: block;
            margin-bottom: 0.4rem;
            font-size: 0.9rem;
            font-weight: 500;
            color: #c9d1d9;
        }

        .form-label.required::after {
            content: ' *';
            color: #f85149;
        }

        /* Texto de ayuda */
        .form-text {
            display: block;
            margin-top: 0.25rem;
            font-size: 0.8rem;
            color: #8b949e;
        }

        /* Grupo de botones */
        .form-actions {
            display: flex;
            gap: 0.75rem;
            flex-wrap: wrap;
            margin-top: 1.5rem;
            padding-top: 1rem;
            border-top: 1px solid #30363d;
            justify-content: flex-end;
        }
        
        /* Alinear botón de guardar a la derecha */
        .form-group.text-right {
            width: 100%;
            display: flex;
            justify-content: flex-end;
        }
        
        .form-group.text-right .btn-primary {
            margin-left: 0.75rem;
        }
        
        /* Estilo para el botón de reset */
        .btn-reset {
            background-color: #d73a49;
            color: white;
            border: 1px solid #d73a49;
            transition: all 0.2s ease;
        }
        
        .btn-reset:hover {
            background-color: #cb2431;
            border-color: #b31d28;
            color: white;
        }
        
        /* Estilo para el botón de volver sin guardar */
        .btn-volver {
            background-color: transparent;
            color: #7f8285;
            border: 1px solid #7f8285;
            transition: all 0.2s ease;
            padding: 0.5rem 1rem 0.5rem 2.5rem;
            border-radius: 6px;
            position: relative;
            font-weight: 500;
            font-size: 0.9rem;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            box-shadow: 0 1px 2px rgba(0,0,0,0.05);
        }
        
        .btn-volver:hover {
            background-color: rgba(0,0,0,0.02);
            color: #6c757d;
            border-color: #6c757d;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        
        .btn-volver i {
            position: absolute;
            left: 1rem;
            transition: transform 0.2s ease;
        }

        
        .btn-reset i {
            margin-right: 6px;
        }
        
        /* Estilos para los niveles */
        .niveles-container {
            display: flex;
            gap: 0.75rem;
            margin-top: 0.25rem;
        }

        .nivel-option {
            position: relative;
            cursor: pointer;
        }

        .nivel-radio {
            position: absolute;
            opacity: 0;
            width: 0;
            height: 0;
        }

        .nivel-pill {
            display: inline-block;
            padding: 0.3rem 0.9rem;
            border-radius: 4px;
            font-size: 0.85rem;
            font-weight: normal;
            border: 1px solid transparent;
        }

        /* Colores base para cada nivel */
        .nivel-basico {
            background-color: rgba(46, 204, 113, 0.1);
            color: #2ecc71;
            border-color: rgba(46, 204, 113, 0.2);
        }

        .nivel-intermedio {
            background-color: rgba(241, 196, 15, 0.1);
            color: #f1c40f;
            border-color: rgba(241, 196, 15, 0.2);
        }

        .nivel-avanzado {
            background-color: rgba(231, 76, 60, 0.1);
            color: #e74c3c;
            border-color: rgba(231, 76, 60, 0.2);
        }

        /* Efectos de hover - más visibles que el estado por defecto */
        .nivel-basico:hover {
            border-color: rgba(46, 204, 113, 0.5);
        }

        .nivel-intermedio:hover {
            border-color: rgba(241, 196, 15, 0.5);
        }

        .nivel-avanzado:hover {
            border-color: rgba(231, 76, 60, 0.5);
        }

        /* Estado seleccionado - más visible que el hover */
        .nivel-radio:checked + .nivel-basico {
            border-color: #2ecc71;
            border-width: 1.5px;
        }

        .nivel-radio:checked + .nivel-intermedio {
            border-color: #f1c40f;
            border-width: 1.5px;
        }

        .nivel-radio:checked + .nivel-avanzado {
            border-color: #e74c3c;
            border-width: 1.5px;
        }
        
        /* Estilos para botones de agregar objetivo/requisito */
        .btn-add-array {
            background: none;
            color: #58a6ff;
            border: 1px dashed #58a6ff;
            border-radius: 6px;
            padding: 0.35rem 0.75rem;
            font-size: 0.85rem;
            font-weight: 400;
            cursor: pointer;
            transition: all 0.15s ease;
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
            line-height: 1.3;
            margin-top: 0.5rem;
            margin-bottom: 1rem;
        }
        
        .btn-add-array:hover {
            background: rgba(88, 166, 255, 0.1);
            border-style: solid;
            transform: none;
            box-shadow: none;
            color: #79c0ff;
            border-color: #79c0ff;
        }
        
        .btn-add-array i {
            font-size: 0.85em;
            opacity: 0.9;
        }
        
        /* Estilos para los items de array */
        .array-input-item {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            margin-bottom: 0.5rem;
        }
        
        .array-input-item .form-control {
            flex: 1;
            margin-bottom: 0 !important;
            border-radius: 4px 0 0 4px !important;
            border-right: none;
        }
        
        .btn-remove-array {
            background: none;
            border: 1px solid #30363d;
            border-left: none;
            color: #f85149;
            width: 34px;
            height: 34px;
            border-radius: 0 4px 4px 0;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.2s ease;
            font-size: 1.1rem;
            line-height: 1;
            padding: 0;
        }
        
        .btn-remove-array:hover {
            background: rgba(248, 81, 73, 0.1);
        }

        /* Estilos para la sección de mis-cursos */
        .cursos-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 1.25rem;
            margin-top: 1.25rem;
        }

        .curso-card {
            background-color: #161b22;
            border: 1px solid #30363d;
            border-radius: 6px;
            overflow: hidden;
            transition: all 0.2s ease;
            display: flex;
            flex-direction: column;
            height: 100%;
        }

        .curso-card:hover {
            transform: translateY(-0.5px);
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            border-color: #426b99;
        }

        .curso-imagen {
            width: 100%;
            height: 160px;
            object-fit: cover;
            border-bottom: 1px solid #30363d;
        }

        .curso-sin-imagen {
            width: 100%;
            height: 160px;
            background-color: #0d1117;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #484f58;
            border-bottom: 1px solid #30363d;
        }

        .curso-info {
            padding: 0.85rem;
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        .curso-info h3 {
            color: #e6edf3;
            margin: 0 0 0.5rem 0;
            font-size: 1rem;
            line-height: 1.3;
            font-weight: 500;
        }

        .curso-descripcion {
            color: #8b949e;
            font-size: 0.8rem;
            margin-bottom: 0.75rem;
            line-height: 1.4;
            flex-grow: 1;
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .curso-metadata {
            display: flex;
            flex-wrap: wrap;
            gap: 0.4rem;
            margin-bottom: 0.75rem;
        }

        .badge {
            display: inline-flex;
            align-items: center;
            padding: 0.2rem 0.6rem;
            border-radius: 12px;
            font-size: 0.7rem;
            font-weight: 500;
            line-height: 1.2;
            color: #e6edf3;
            border: 1px solid transparent;
            white-space: nowrap;
        }

        .badge i {
            margin-right: 0.2rem;
            font-size: 0.7em;
        }

        .bg-success { 
            background-color: rgba(35, 134, 54, 0.15); 
            color: #3fb950;
            border-color: rgba(46, 160, 67, 0.3);
        }
        .bg-secondary { 
            background-color: rgba(110, 118, 129, 0.15); 
            color: #8b949e;
            border-color: rgba(139, 148, 158, 0.3);
        }
        .bg-warning { 
            background-color: rgba(158, 106, 3, 0.15); 
            color: #d29922;
            border-color: rgba(187, 136, 0, 0.3);
        }
        .bg-info { 
            background-color: rgba(31, 111, 235, 0.15); 
            color: #79c0ff;
            border-color: rgba(88, 166, 255, 0.3);
        }

        .curso-acciones {
            display: flex;
            flex-wrap: wrap;
            gap: 0.4rem;
            padding-top: 0.6rem;
            border-top: 1px solid #21262d;
        }
        
        .curso-acciones a {
            text-decoration: none;
        }
        curso-card
        .curso-acciones .btn {
            display: inline-flex;
            align-items: center;
            gap: 0.35rem;
            padding: 0.35rem 0.75rem;
            font-size: 0.85rem;
            border-radius: 4px;
            text-decoration: none;
            transition: all 0.2s ease;
        }

        .curso-acciones .btn i {
            font-size: 0.8em;
        }

        .curso-acciones .btn-primary {
            background-color: #238636;
            border: 1px solid #2ea043;
            color: #fff;
        }

        .curso-acciones .btn-primary:hover {
            background-color: #2ea043;
            border-color: #3fb950;
        }

        .curso-acciones .btn-warning {
            background-color: #9e6a03;
            border: 1px solid #bb8009;
            color: #fff;
        }

        .curso-acciones .btn-warning:hover {
            background-color: #bb8009;
            border-color: #d69e00;
        }

        .curso-acciones .btn-danger {
            background-color: #da3633;
            border: 1px solid #f85149;
            color: #fff;
        }

        .curso-acciones .btn-danger:hover {
            background-color: #f85149;
            border-color: #ff6a69;
        }

        .curso-acciones .btn-success {
            background-color: #238636;
            border: 1px solid #2ea043;
            color: #fff;
        }

        .curso-acciones .btn-success:hover {
            background-color: #2ea043;
            border-color: #3fb950;
        }

        .curso-acciones form {
            display: inline;
        }

        .alert {
            padding: 0.75rem 1.25rem;
            margin-bottom: 1.5rem;
            border: 1px solid transparent;
            border-radius: 6px;
            font-size: 0.9rem;
        }

        .alert-success {
            color: #56d364;
            background-color: rgba(35, 134, 54, 0.15);
            border-color: rgba(46, 160, 67, 0.4);
        }
        
        /* Estilo para mensaje de éxito cuando se cambia a borrador */
        .alert-success[data-message*="cambiado a borrador"] {
            color: #8b949e;
            background-color: rgba(139, 148, 158, 0.1);
            border-color: rgba(139, 148, 158, 0.4);
        }

        .alert-danger {
            color: #f85149;
            background-color: rgba(218, 54, 51, 0.15);
            border-color: rgba(248, 81, 73, 0.4);
        }

        .alert-info {
            color: #79c0ff;
            background-color: rgba(56, 139, 253, 0.15);
            border-color: rgba(56, 139, 253, 0.4);
        }

        /* Responsivo */
        @media (max-width: 768px) {
            .form-grid {
                grid-template-columns: 1fr;
            }
            
            .form-actions {
                flex-direction: column;
            }
            
            .form-actions .btn {
                width: 100%;
            }
        }

        .titulo {
            font-size: 1.5rem;
            font-weight: 600;
            margin: 0.6rem 0 1.25rem 0;
            color: #e6eefa;
        }

        /* Formulario más compacto */
        .form-curso {
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }

        /* Grupos de formulario más compactos */
        .form-group {
            margin-bottom: 0.75rem;
        }

        /* Etiquetas más compactas */
        .form-label {
            display: block;
            margin-bottom: 0.35rem;
            font-size: 0.9rem;
            font-weight: 500;
            color: #c9d1d9;
        }

        .form-label.required::after {
            content: ' *';
            color: #f85149;
        }

        /* Campos de formulario más compactos */
        .form-control {
            background-color: #161a20;
            border: 1px solid #30363d;
            border-radius: 4px;
            color: #e6eefa;
            width: 100%;
            padding: 0.4rem 0.65rem;
            font-size: 0.9rem;
            transition: border-color 0.15s, box-shadow 0.15s;
            height: auto;
            line-height: 1.3;
        }

        .form-control:focus {
            border-color: #1f6feb;
            box-shadow: 0 0 0 2px rgba(31, 111, 235, 0.15);
            outline: none;
        }

        .form-control::placeholder {
            color: #6e7681;
            font-size: 0.85rem;
        }

        /* Botones más compactos */
        /* Estilo para los íconos de calendario en inputs de fecha */
        input[type="date"]::-webkit-calendar-picker-indicator {
            filter: invert(1);
            opacity: 0.8;
            cursor: pointer;
        }
        
        input[type="date"]::-webkit-calendar-picker-indicator:hover {
            opacity: 1;
        }
        
        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 0.4rem 0.9rem;
            border-radius: 4px;
            font-size: 0.9rem;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.15s;
            border: 1px solid transparent;
            height: auto;
            line-height: 1.3;
        }

        .btn i {
            margin-right: 0.35rem;
            font-size: 0.9em;
        }

        .btn-primary {
            background-color: #1f6feb;
            color: white;
        }

        .btn-primary:hover {
            background-color: #1a5dc7;
        }

        .btn-secondary {
            background-color: #21262d;
            color: #c9d1d9;
            border: 1px solid #363b42;
        }

        .btn-secondary:hover {
            background-color: #2d333b;
            border-color: #8b949e;
        }

        /* Grid para campos en línea más compacto */
        .form-row {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 0.75rem;
            margin-bottom: 0.75rem;
        }

        /* Texto de ayuda más pequeño */
        .form-text {
            font-size: 0.8rem;
            color: #8b949e;
            margin: 0.15rem 0 0 0;
            line-height: 1.3;
        }

        /* Alertas más compactas */
        .alert {
            padding: 0.6rem 0.9rem;
            border-radius: 4px;
            margin-bottom: 1rem;
            font-size: 0.9rem;
            line-height: 1.4;
        }

        .alert-success {
            background-color: rgba(35, 134, 54, 0.15);
            border: 1px solid rgba(35, 134, 54, 0.4);
            color: #7ee287;
        }

        .alert-danger {
            background-color: rgba(248, 81, 73, 0.1);
            border: 1px solid rgba(248, 81, 73, 0.4);
            color: #ff7b72;
        }

        /* Sección de acciones del formulario */
        .form-actions {
            display: flex;
            gap: 0.75rem;
            margin-top: 1.25rem;
            padding-top: 1rem;
            border-top: 1px solid #30363d;
            flex-wrap: wrap;
        }

        /* Responsive */
        /* Estilos para textareas que se ajustan automáticamente */
        textarea.form-control {
            min-height: 100px;
            resize: none;
            overflow: hidden;
            transition: height 0.2s;
        }

        @media (max-width: 768px) {
            .contenedor {
                padding: 1rem;
                margin: 0.5rem;
                border-radius: 0;
                border-left: none;
                border-right: none;
            }

            .form-row {
                grid-template-columns: 1fr;
                gap: 0.5rem;
            }

            .form-actions {
                flex-direction: column;
                gap: 0.5rem;
            }

            .form-actions .btn {
                width: 100%;
            }
        }

        .contenedor_no_cursos {
            text-align: center;
            padding: 2rem;
            border: 1px solid #30363d;
            border-radius: 8px;
            background-color: #12171d;
        }
    </style>
@endpush

@section('content')
   @include('components.sidebar')
   <main class="contenedor">
      @switch($seccion ?? 'preinscripcion')
         @case('cursos-publicados')
            @include('elements.publicos')
            @break
         @case('mis-cursos')
            @include('elements.miscursos')
            @break
         @case('crear-curso')
            @include('elements.crearcurso')
            @break
         @case('ver-curso')
            @include('elements.vercurso')
            @break
         @case('editar-curso')
            @include('elements.editarcurso')
            @break
         @case('lista_preinscritos')
            @include('elements.lista_preinscritos')
            @break
         @default
            <h1 class="titulo">Pre-inscripción</h1>
            <div class="contenido-seccion">
               <div class="empty-state-container">
                  <div class="contenedor_no_cursos">
                     <div class="empty-state-icon mb-4">
                        <i class="fas fa-graduation-cap fa-4x text-primary"></i>
                     </div>
                     <h3 class="mb-3 fw-bold">¡Explora nuestros cursos disponibles!</h3>
                     <p class="text-muted mb-4">Encuentra el curso perfecto para potenciar tus habilidades y conocimientos.</p>
                     <div class="d-flex justify-content-center gap-3">
                        <a href="{{ route('preinscripcion', ['seccion' => 'cursos-disponibles']) }}" class="btn btn-primary px-4">
                           <i class="fas fa-book-open me-2"></i>Ver cursos disponibles
                           </a>
                        </div>
                     </div>
                  </div>
                  
                  <div class="creditos-container">
                     <p class="creditos-texto">
                        <i class="fas fa-code"></i> Desarrollado por José Alejandro Prieto Salcedo y Emily Daniela Rojas Iscala
                     </p>
                  </div>
               </div>
            </div>
      @endswitch
   </main>
@endsection
