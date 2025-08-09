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
            margin-right: 10px;
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
                <h1 class="titulo">Cursos Disponibles</h1>
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
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
                @break

            @case('mis-cursos')
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
                                                <a href="{{ route('preinscripcion', ['seccion' => 'ver-curso', 'curso' => $curso->id]) }}" class="btn btn-sm" style="background-color: #0d6efd; color: white;" title="Ver detalles del curso">
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
                                            </div>
                                            <div class="curso-acciones">
                                                <a href="{{ route('preinscripcion', ['seccion' => 'ver-curso', 'curso' => $curso->id]) }}" class="btn btn-sm" style="background-color: #0d6efd; color: white;" title="Ver detalles del curso">
                                                    <i class="fas fa-eye"></i>
                                                    <span>Ver</span>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    @endif
                </div>
                @break

            @case('crear-curso')
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
                                        <button type="button" class="btn-add-array" style="margin-bottom: 5px;" onclick="addObjective()">+ Agregar Objetivo</button>
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
                                    }                          </script>
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
                @break

            @case('ver-curso')
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
                                
                                <div class="form-group text-right mt-4">
                                    <a href="{{ route('cursos.publicados') }}" class="btn-volver">
                                        <i class="fas fa-arrow-left"></i> Volver
                                    </a>
                                    @if(auth()->check())
                                        @if(auth()->user()->role === 'docente' && $curso->user_id === auth()->id())
                                            <a href="{{ route('cursos.edit', $curso->id) }}" class="btn btn-primary" style="text-decoration: none;">
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
                                                        <button type="submit" style="height: 38px; padding: 0 15px; border: 1px solid #dc3545; color: rgba(255, 255, 255, 0.9); background-color: #dc3545; border-radius: 4px; font-weight: 500; cursor: pointer; display: inline-flex; align-items: center;">
                                                            <i class="fas fa-times-circle" style="margin-right: 5px;"></i> Cancelar preinscripción
                                                        </button>
                                                    </form>
                                                    <button style="height: 38px; padding: 0 15px; border: 1px solid #0d6efd; background-color: #0d6efd; color: white; border-radius: 4px; font-weight: 500; display: inline-flex; align-items: center; cursor: not-allowed;" disabled>
                                                        <i class="fas fa-check-circle" style="margin-right: 5px;"></i> Ya estás preinscrito
                                                    </button>
                                                </div>
                                            @else
                                                <form action="{{ route('cursos.preinscribir', $curso->id) }}" method="POST" class="d-inline ms-2">
                                                    @csrf
                                                    <button type="submit" class="btn btn-danger" style="color: white; height: 38px; display: inline-flex; align-items: center;">
                                                        <i class="fas fa-user-plus me-1"></i> Preinscribirme
                                                    </button>
                                                </form>
                                            @endif
                                        @endif
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="alert alert-danger">
                        <i class="fas fa-exclamation-circle me-2"></i>
                        No se encontró el curso solicitado o no tienes permiso para verlo.
                    </div>
                @endif
                @break
                
            @case('editar-curso')
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
                            </div> <!-- Cierre de info-principal -->
                            
                            <div class="info-secundaria">

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
        @endswitch
    </main>
@endsection
