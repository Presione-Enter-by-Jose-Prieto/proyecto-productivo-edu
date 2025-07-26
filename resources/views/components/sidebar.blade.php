@php
    $user = auth()->user();
    $isDocente = $user && $user->role === 'docente';
@endphp

<aside class="sidebar">
    <div class="sidebar-header">
        <h2>Menú de Cursos</h2>
    </div>
    <nav class="sidebar-nav">
        <ul class="nav-links">
            <li class="nav-item {{ request()->routeIs('preinscripcion') && (request('seccion') === null || request('seccion') === 'preinscripcion') ? 'active' : '' }}">
                <a href="{{ route('preinscripcion', ['seccion' => 'preinscripcion']) }}" class="nav-link">
                    <i class="fas fa-clipboard-list"></i>
                    <span>Preinscripción</span>
                </a>
            </li>
            <li class="nav-item {{ request()->routeIs('cursos.publicados') || (request()->routeIs('preinscripcion') && request('seccion') === 'ver-curso') ? 'active' : '' }}">
                <a href="{{ route('cursos.publicados') }}" class="nav-link">
                    <i class="fas fa-list"></i>
                    <span>Cursos Disponibles</span>
                </a>
            </li>
            <li class="nav-item {{ request('seccion') === 'mis-cursos' || request()->routeIs('cursos.mis-cursos') || (request()->routeIs('preinscripcion') && $seccion === 'editar-curso') ? 'active' : '' }}">
                <a href="{{ route('cursos.mis-cursos') }}" class="nav-link">
                    <i class="fas fa-book"></i>
                    <span>Mis Cursos</span>
                </a>
            </li>
            @if($isDocente)
            <li class="nav-item {{ request('seccion') === 'crear-curso' || request()->routeIs('cursos.create') ? 'active' : '' }}">
                <a href="{{ route('cursos.create') }}" class="nav-link">
                    <i class="fas fa-plus-circle"></i>
                    <span>Crear Curso</span>
                </a>
            </li>
            @endif
        </ul>
    </nav>
    
    @if($user)
    <div class="user-info">
        <div class="user-avatar">
            <img src="{{ asset('storage/' . Auth::user()->avatar) }}" alt="{{ Auth::user()->name }}" class="avatar-img">
        </div>
        <div class="user-details">
            <div class="user-name-role">
                <span class="user-name">{{ Auth::user()->name }}</span>
                <span class="user-role">{{ ucfirst(Auth::user()->role) }}</span>
            </div>
        </div>
    </div>
    @endif
    
    <div class="sidebar-footer">
        <form method="GET" action="{{ route('inicio') }}" class="home-form">
            <button type="submit" class="home-btn">
                <i class="fas fa-home"></i>
                <span>Volver al inicio</span>
            </button>
        </form>
        <form method="POST" action="{{ route('logout') }}" class="logout-form">
            @csrf
            <button type="submit" class="logout-btn">
                <i class="fas fa-sign-out-alt"></i>
                <span>Cerrar sesión</span>
            </button>
        </form>
    </div>
</aside>

<style>
.sidebar {
    width: 220px;
    height: 100vh;
    background-color: #161b22;
    color: #e6eefa;
    position: fixed;
    left: 0;
    top: 0;
    display: flex;
    flex-direction: column;
    border-right: 1px solid #30363d;
    box-shadow: 2px 0 10px rgba(0, 0, 0, 0.1);
    z-index: 1000;
}

.sidebar-header {
    padding: 15px 12px;
    border-bottom: 1px solid #30363d;
    text-align: center;
}

.sidebar-header h2 {
    margin: 0;
    font-size: 1.3rem;
    color: #58a6ff;
}

.sidebar-nav {
    flex: 1;
    overflow-y: auto;
    padding: 15px 0;
}

.nav-links {
    list-style: none;
    padding: 0;
    margin: 0;
}

.nav-item {
    margin: 4px 8px;
    border-radius: 4px;
    transition: all 0.2s ease;
}

.nav-item.active {
    background-color: #21262d;
}

.nav-item:hover:not(.active) {
    background-color: #21262d;
}

.nav-link {
    display: flex;
    align-items: center;
    padding: 8px 12px;
    color: #c9d1d9;
    text-decoration: none;
    font-size: 0.9rem;
}

.nav-link i {
    width: 18px;
    margin-right: 10px;
    text-align: center;
    font-size: 0.95rem;
}

.nav-item.active .nav-link i,
.nav-item:hover .nav-link i {
    color: #58a6ff;
}

.user-info {
    padding: 8px 12px;
    border-top: 1px solid #30363d;
    border-bottom: 1px solid #30363d;
    margin: 8px 0;
    display: flex;
    align-items: center;
    gap: 12px;
}

.user-avatar {
    width: 36px;
    height: 36px;
    border-radius: 50%;
    overflow: hidden;
    flex-shrink: 0;
    border: 2px solid #58a6ff;
}

.avatar-img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.user-details {
    min-width: 0;
    flex: 1;
}

.user-name-role {
    display: flex;
    flex-direction: column;
    gap: 2px;
}

.user-name {
    font-size: 0.85rem;
    color: #e6eefa;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
    line-height: 1.2;
}

.user-role {
    display: inline-block;
    font-size: 0.7rem;
    color: #8b949e;
    background-color: #21262d;
    padding: 1px 6px;
    border-radius: 8px;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
    max-width: fit-content;
}

.sidebar-footer {
    padding: 8px 10px 12px;
    border-top: 1px solid #30363d;
    display: flex;
    flex-direction: column;
    gap: 6px;
}

.home-form,
.logout-form {
    width: 100%;
    margin: 0;
}

.home-btn,
.logout-btn {
    display: flex;
    align-items: center;
    width: 100%;
    padding: 8px 15px;
    background: transparent;
    border: none;
    color: #c9d1d9;
    cursor: pointer;
    font-size: 0.9rem;
    border-radius: 6px;
    transition: all 0.2s ease;
    text-align: left;
}

.home-btn i,
.logout-btn i {
    margin-right: 10px;
    width: 20px;
    text-align: center;
}

.home-btn {
    color: #c9d1d9;
}

.home-btn:hover {
    background-color: #21262d;
    color: #58a6ff;
}

.logout-btn {
    color: #f85149;
}

.logout-btn:hover {
    background-color: #21262d;
    color: #ff6b6b;
}

.logout-btn i {
    margin-right: 10px;
    width: 20px;
    text-align: center;
}
</style>

@push('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
@endpush