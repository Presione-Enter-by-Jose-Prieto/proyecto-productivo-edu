<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="titulo">
            <i class="fas fa-users text-primary me-2"></i>
            Lista de Preinscritos: <span class="text-primary">{{ $curso->titulo }}</span>
        </h1>
    </div>

    <div class="card shadow-sm">
        @if($preinscritos->isEmpty())
            <div class="empty-state-container">
                <div class="contenedor_no_cursos">
                    <div class="empty-state-icon mb-4">
                        <i class="fas fa-users fa-4x text-primary"></i>
                    </div>
                    <h3 class="mb-3 fw-bold">No hay usuarios preinscritos</h3>
                    <p class="text-muted mb-4">Aún no hay estudiantes interesados en este curso.</p>
                </div>
            </div>

        @else
            <div class="tabla-contenedor table-responsive w-100">
                <table class="table table-hover mb-0 w-100">
                    <thead class="table-header">
                        <tr class="bg-dark text-white">
                            <th>Nombre</th>
                            <th>Email</th>
                            <th>Fecha de preinscripción</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($preinscritos as $index => $usuario)
                            <tr>
                                <td>{{ $usuario->name }}</td>
                                <td>{{ $usuario->email }}</td>
                                <td>{{ $usuario->pivot->created_at->timezone('America/Bogota')->translatedFormat('d M Y h:i A') }}</td>

                                <td>
                                    <div class="btn-group btn-group-sm" role="group">
                                        <button type="button" class="btn btn-success btn-action" title="Aprobar usuario">
                                            <i class="fas fa-check me-1"></i> Aprobar
                                        </button>
                                        <button type="button" class="btn btn-danger btn-action" title="Rechazar usuario">
                                            <i class="fas fa-times me-1"></i> Rechazar
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
</div>

@push('styles')
<style>
    .tabla-contenedor {
        box-sizing: border-box;
        width: 100%;
        max-width: 100%;
        margin: 0;
        padding: 1rem;
        border-radius: 6px;
        background-color: rgba(22, 27, 34, 0.6);
        border: 1px solid #30363d;
    }
    
    .table {
        table-layout: fixed;
        width: 100%;
        margin: 0;
    }
    
    .table-header {
        background-color: #1a1f26;
    }
    
    .table thead th {
        text-align: center;
        vertical-align: middle;
        padding: 0.85rem 1rem;
        background-color: transparent;
        color: #e9ecef;
        font-weight: 600;
        text-transform: uppercase;
        font-size: 0.75rem;
        letter-spacing: 0.5px;
        border: none;
    }
    
    .table tbody td {
        text-align: center;
        vertical-align: middle;
        padding: 0.75rem 1rem;
    }
    
    .table tbody tr {
        border-bottom: 1px solid rgba(255, 255, 255, 0.05);
    }
    
    .table tbody tr:nth-child(odd) {
        background-color: rgba(255, 255, 255, 0.01);
    }
    
    .table tbody tr:nth-child(even) {
        background-color: rgba(255, 255, 255, 0.03);
    }
    
    .table tbody tr:last-child {
        border-bottom: none;
    }
    
    .btn-action {
        transition: all 0.2s ease;
        border-radius: 4px !important;
        display: inline-flex;
        align-items: center;
        justify-content: center;
    }
    
    .btn-success {
        background-color: #198754;
        border-color: #198754;
    }
    
    .btn-success:hover {
        background-color: #157347;
        border-color: #146c43;
    }
    
    .btn-danger {
        background-color: #dc3545;
        border-color: #dc3545;
    }
    
    .btn-danger:hover {
        background-color: #bb2d3b;
        border-color: #b02a37;
    }
    
    .btn-group-sm > .btn, .btn-sm {
        padding: 0.25rem 0.5rem;
        font-size: 0.75rem;
    }
</style>
@endpush