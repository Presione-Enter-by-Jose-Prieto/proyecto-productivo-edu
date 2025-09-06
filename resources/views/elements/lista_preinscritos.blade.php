<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="titulo">
            <i class="fas fa-users text-primary me-2"></i>
            Lista de Preinscritos: <span class="text-primary">{{ $curso->titulo }}</span>
        </h1>
    </div>

    <div class="card shadow-sm">
        @if($preinscritos->isEmpty())
            <div class="card-body text-center py-5">
               <i class="fas fa-users fa-3x text-muted mb-3"></i>
               <p class="text-muted mb-0">No hay usuarios preinscritos en este curso.</p>
            </div>
        @else
            <div class="tabla-contenedor table-responsive w-100">
                <table class="table table-hover mb-0 w-100">
                    <thead class="table-light encabezados">
                        <tr style="border: 1px solid #30363d;">
                            <th class="text-center" style="width: 5%;">#</th>
                            <th class="text-center" style="width: 25%;">Nombre</th>
                            <th class="text-center" style="width: 35%;">Email</th>
                            <th class="text-center" style="width: 20%;">Fecha de preinscripción</th>
                            <th class="text-center" style="width: 15%;">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($preinscritos as $index => $usuario)
                            <tr>
                                <td class="text-center">{{ $index + 1 }}</td>
                                <td class="text-center text-truncate" style="max-width: 200px;" title="{{ $usuario->name }}">{{ $usuario->name }}</td>
                                <td class="text-center text-truncate" style="max-width: 300px;" title="{{ $usuario->email }}">{{ $usuario->email }}</td>
                                <td class="text-center text-nowrap">{{ $usuario->pivot->created_at->format('d/m/Y H:i') }}</td>
                                <td>
                                    <div class="btn-group btn-group-sm">
                                        <a href="#" class="btn btn-sm btn-success" title="Aprobar">
                                            <i class="fas fa-check"></i>
                                        </a>
                                        <a href="#" class="btn btn-sm btn-danger" title="Rechazar">
                                            <i class="fas fa-times"></i>
                                        </a>
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
      margin-bottom: 1rem;
      padding: 1.25rem;
      border-radius: 6px;
      background-color: rgba(22, 27, 34, 0.6);
      border: 1px solid #30363d;
   }
   .encabezados th {
      color: #e9ecef;
      font-weight: 600;
      text-transform: uppercase;
      font-size: 0.75rem;
      letter-spacing: 0.5px;
      padding: 0.85rem 1rem;
      border: none;
      position: relative;
      transition: all 0.2s ease;
      border: 1px solid #30363d;
   }

    .table {
        table-layout: fixed;
        width: 100%;
    }
    
    .table th {
        font-weight: 600;
        text-transform: uppercase;
        font-size: 0.75rem;
        letter-spacing: 0.5px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }
    
    .table td {
        vertical-align: middle;
        text-align: center;
    }
    
    .table th {
        text-align: center;
    }
    
    .btn-sm {
        padding: 0.25rem 0.5rem;
        font-size: 0.75rem;
    }
    
    .card {
        border: none;
        overflow: hidden;
    }
    
    .card-header {
        border-bottom: none;
    }
</style>
@endpush