<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="titulo">
            <i class="fas fa-users text-primary me-2"></i>
            Lista de Preinscritos: <span class="text-primary">{{ $curso->titulo }}</span>
        </h1>
    </div>

    {{-- Pendientes --}}
    <div class="tabla-contenedor table-responsive">
        <table class="table table-hover mb-0 w-100">
            <thead class="table-header">
                <tr class="bg-warning text-dark fw-bold">
                    <th colspan="4" style="text-align:left; font-size:1.1rem; padding:1rem;">Preinscritos Pendientes</th>
                </tr>
                <tr class="bg-dark text-white">
                    <th>Nombre</th>
                    <th>Email</th>
                    <th>Fecha de preinscripción</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse($pendientes as $usuario)
                    <tr>
                        <td>{{ $usuario->name }}</td>
                        <td>{{ $usuario->email }}</td>
                        <td>{{ \Carbon\Carbon::parse($usuario->pivot->fecha_inscripcion)->timezone('America/Bogota')->translatedFormat('d M Y h:i A') }}</td>
                        <td>
                            <div class="btn-group btn-group-sm" role="group">
                                <form action="{{ route('cursos.aprobarPreinscrito', [$curso->id, $usuario->id]) }}" method="POST" style="display:inline;">
                                    @csrf
                                    <button type="submit" style="color: white" class="btn btn-success btn-action btn-compact" title="Aprobar usuario">
                                        <i class="fas fa-check me-1"></i> Aprobar
                                    </button>
                                </form>
                                <form action="{{ route('cursos.rechazarPreinscrito', [$curso->id, $usuario->id]) }}" method="POST" style="display:inline;">
                                    @csrf
                                    <button type="submit" style="color: white;" class="btn btn-danger btn-action btn-compact" title="Rechazar usuario">
                                        <i class="fas fa-times me-1"></i> Rechazar
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4">
                            <div class="empty-state-container">
                                <div class="contenedor_no_cursos">
                                    <div class="empty-state-icon mb-4">
                                        <i class="fas fa-users fa-4x text-warning"></i>
                                    </div>
                                    <h3 class="mb-3 fw-bold">No hay usuarios pendientes</h3>
                                    <p class="text-muted mb-4">Aún no hay estudiantes esperando aprobación.</p>
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Aprobados --}}
    <div class="tabla-contenedor table-responsive">
        <table class="table table-hover mb-0 w-100">
            <thead class="table-header">
                <tr class="bg-success text-white fw-bold">
                    <th colspan="4" style="text-align:left; font-size:1.1rem; padding:1rem;">Estudiantes Inscritos</th>
                </tr>
                <tr class="bg-dark text-white">
                    <th>Nombre</th>
                    <th>Email</th>
                    <th>Fecha de inscripción</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse($aprobados as $usuario)
                    <tr>
                        <td>{{ $usuario->name }}</td>
                        <td>{{ $usuario->email }}</td>
                        <td>{{ \Carbon\Carbon::parse($usuario->pivot->fecha_inscripcion)->timezone('America/Bogota')->translatedFormat('d M Y h:i A') }}</td>
                        <td>
                            <form action="{{ route('cursos.eliminarInscrito', [$curso->id, $usuario->id]) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" style="color: white" class="btn btn-danger btn-action btn-compact" title="Eliminar inscripción">
                                    <i class="fas fa-trash me-1"></i> Eliminar
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4">
                            <div class="empty-state-container">
                                <div class="contenedor_no_cursos">
                                    <div class="empty-state-icon mb-4">
                                        <i class="fas fa-users fa-4x text-success"></i>
                                    </div>
                                    <h3 class="mb-3 fw-bold">No hay usuarios inscritos</h3>
                                    <p class="text-muted mb-4">Aún no hay estudiantes aprobados en este curso.</p>
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@push('styles')
<style>
    .tabla-contenedor {
        box-sizing: border-box;
        width: 100%;
        max-width: 100%;
        margin: 0 0 2rem 0;
        padding: 0;
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
        padding: 0.75rem 1rem;
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

    /* Botones compactos con texto */
    .btn-compact {
        padding: 0.25rem 0.5rem;
        font-size: 0.7rem;
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
</style>
@endpush
