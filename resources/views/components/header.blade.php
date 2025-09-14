<header>
    <div class="contenedor-header">
        <div>
            <a href="{{ route('inicio') }}">Sistema de preinscripciones Corsaje</a>
        </div>
        <nav>
            <ul>
                <li><a href="{{ route('inicio') }}">Inicio</a></li>
                <li><a href="{{ route('creditos') }}">Creditos</a></li>
                <li><a href="#">Sobre este proyecto</a></li>
                
                @guest
                    <li class="login-btn-item"><a href="{{ route('login') }}" class="btn-header btn-header-secondary">Iniciar sesión</a></li>
                    <li class="register-btn-item"><a href="{{ route('registro') }}" class="btn-header btn-header-primary">Registrarse</a></li>
                @else
                    <li class="user-avatar" id="user-menu">
                        <button type="button" class="avatar-link" id="user-menu-button" aria-expanded="false" aria-haspopup="true">
                            @if(Auth::user()->avatar)
                                <img src="{{ asset('storage/' . Auth::user()->avatar) }}" alt="{{ Auth::user()->name }}" class="user-avatar-img">
                            @else
                                <div class="default-avatar">
                                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                                </div>
                            @endif
                            <span class="user-name">{{ Auth::user()->name }}</span>
                            <svg class="dropdown-arrow" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <polyline points="6 9 12 15 18 9"></polyline>
                            </svg>
                        </button>
                        <div class="dropdown-menu" id="user-dropdown" aria-labelledby="user-menu-button">
                            <a href="#" class="dropdown-item">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                    <circle cx="12" cy="7" r="4"></circle>
                                </svg>
                                <span>Perfil</span>
                            </a>
                            <a href="#" class="dropdown-item">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <circle cx="12" cy="12" r="3"></circle>
                                    <path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9c.4.75.4 1.62 0 2.4"></path>
                                </svg>
                                <span>Configuración</span>
                            </a>
                            <div class="dropdown-divider"></div>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="dropdown-item">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                                        <polyline points="16 17 21 12 16 7"></polyline>
                                        <line x1="21" y1="12" x2="9" y2="12"></line>
                                    </svg>
                                    <span>Cerrar sesión</span>
                                </button>
                            </form>
                        </div>
                    </li>
                @endguest
            </ul>
        </nav>
    </div>
</header>

<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        color: #e6eefa;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    header {
        background-color: #0d1117;
        padding: 1rem 0;
        border-bottom: 1px solid #2a2e33;
        width: 100%;
        position: sticky;
        top: 0;
    }

    .contenedor-header {
        width: 90%;
        margin: 0 auto;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    nav ul {
        display: flex;
        list-style: none;
    }

    nav li {
        margin-left: 1.5rem;
        display: flex;
        align-items: center;
    }

    .register-btn-item {
        margin-left: 0.75rem;
    }

    .login-btn-item {
        margin-left: 3rem;
    }

    .btn-header {
        padding: 5px 12px;
        border-radius: 6px;
        text-decoration: none;
        font-size: 14px;
        font-weight: 500;
        line-height: 20px;
        transition: all 0.2s ease-in-out;
        height: 32px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
    }

    .btn-header-secondary {
        border: 1px solid #30363d;
        color: #c9d1d9;
    }

    .btn-header-secondary:hover {
        border-color: #8b949e;
        background-color: #161b22;
    }

    .btn-header-primary {
        border: 1px solid #0078d4;
        background-color: #0078d4;
        color: #ffffff;
    }

    .btn-header-primary:hover {
        background-color: #1f6feb;
        border-color: #1f6feb;
    }
    
    nav > ul > li:not(.login-btn-item):not(.register-btn-item) > a {
        color: #9ba3b4;
        text-decoration: none;
        transition: color 0.2s ease-in-out;
    }
    
    nav > ul > li:not(.login-btn-item):not(.register-btn-item) > a:hover {
        color: #c3d0e5;
    }
    
    a {
        text-decoration: none;
    }

    /* Estilos para el avatar de usuario */
    .user-avatar {
        position: relative;
        margin-left: 1.5rem;
        display: flex;
        align-items: center;
    }

    .avatar-link {
        display: flex;
        align-items: center;
        text-decoration: none;
        color: #c9d1d9;
        gap: 6px;
        padding: 4px 8px 4px 4px;
        border-radius: 6px;
        transition: all 0.2s ease-in-out;
        border: 1px solid transparent;
        background: none;
        cursor: pointer;
        font-family: inherit;
        font-size: 14px;
        line-height: 1;
        height: 32px;
        box-sizing: border-box;
    }

    .avatar-link:hover {
        background-color: rgba(240, 246, 252, 0.1);
        border-color: #30363d;
    }

    .user-avatar-img {
        width: 20px;
        height: 20px;
        border-radius: 50%;
        object-fit: cover;
        border: 1px solid #30363d;
    }

    .default-avatar {
        width: 20px;
        height: 20px;
        border-radius: 50%;
        background-color: #1f6feb;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 600;
        color: white;
        font-size: 10px;
        border: 1px solid rgba(240, 246, 252, 0.1);
        flex-shrink: 0;
    }

    .user-name {
        font-size: 13px;
        font-weight: 500;
        color: #c9d1d9;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        max-width: 120px;
    }

    .dropdown-menu {
        position: absolute;
        top: calc(100% + 8px);
        right: 0;
        background-color: #161b22;
        border: 1px solid #30363d;
        border-radius: 6px;
        padding: 4px 0;
        min-width: 180px;
        box-shadow: 0 8px 24px rgba(1, 4, 9, 0.5);
        display: none;
        z-index: 1000;
        overflow: hidden;
        opacity: 0;
        transform: translateY(-10px);
        transition: opacity 0.1s ease-in-out, transform 0.1s ease-in-out;
    }

    .dropdown-menu.show {
        display: block;
        opacity: 1;
        transform: translateY(0);
    }

    .dropdown-arrow {
        transition: transform 0.2s ease-in-out;
        margin-left: 2px;
    }

    [aria-expanded="true"] .dropdown-arrow {
        transform: rotate(180deg);
    }

    .dropdown-menu::before {
        content: '';
        position: absolute;
        top: -8px;
        right: 16px;
        width: 0;
        height: 0;
        border-left: 8px solid transparent;
        border-right: 8px solid transparent;
        border-bottom: 8px solid #30363d;
    }

    .dropdown-item {
        display: flex;
        align-items: center;
        padding: 8px 16px;
        color: #c9d1d9;
        text-decoration: none;
        transition: all 0.1s ease-in-out;
        border: none;
        background: none;
        width: 100%;
        text-align: left;
        cursor: pointer;
        font-size: 14px;
        gap: 8px;
    }

    .dropdown-item:hover {
        background-color: #1f6feb;
        color: #ffffff;
    }

    .dropdown-item svg {
        width: 16px;
        height: 16px;
    }

    .dropdown-divider {
        height: 1px;
        background-color: #30363d;
        margin: 4px 0;
        width: 100%;
    }

    .dropdown-menu form {
        width: 100%;
    }

    .dropdown-menu button.dropdown-item {
        width: 100%;
        text-align: left;
        border: none;
        background: none;
        cursor: pointer;
        padding: 8px 16px;
        color: #c9d1d9;
        font-size: 14px;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .dropdown-menu button.dropdown-item:hover {
        background-color: #f85149;
        color: #ffffff;
    }

    /* 🔝 Forzar menú de usuario sobre todo */
.user-avatar {
    position: relative; /* referencia del dropdown */
    z-index: 10000; /* asegurar que el contenedor está por encima */
}

.dropdown-menu {
    position: absolute;
    top: calc(100% + 8px);
    right: 0;
    background-color: #161b22;
    border: 1px solid #30363d;
    border-radius: 6px;
    padding: 4px 0;
    min-width: 180px;
    box-shadow: 0 8px 24px rgba(1, 4, 9, 0.5);
    display: none;
    overflow: hidden;
    opacity: 0;
    transform: translateY(-10px);
    transition: opacity 0.1s ease-in-out, transform 0.1s ease-in-out;

    /* ✅ ajustes críticos */
    z-index: 99999;  /* mucho mayor que cualquier otro */
    pointer-events: auto;
}

.dropdown-menu.show {
    display: block;
    opacity: 1;
    transform: translateY(0);
}

/* Prevenir que header o contenedores bloqueen el dropdown */
header,
.contenedor-header,
nav {
    position: relative;
    z-index: auto !important;
}

</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const menuButton = document.getElementById('user-menu-button');
        const dropdownMenu = document.getElementById('user-dropdown');
        
        if (menuButton && dropdownMenu) {
            // Alternar menú al hacer clic en el botón
            menuButton.addEventListener('click', function(e) {
                e.stopPropagation();
                const isExpanded = this.getAttribute('aria-expanded') === 'true';
                this.setAttribute('aria-expanded', !isExpanded);
                dropdownMenu.classList.toggle('show', !isExpanded);
            });

            // Cerrar menú al hacer clic fuera
            document.addEventListener('click', function(e) {
                const isClickInside = menuButton.contains(e.target) || dropdownMenu.contains(e.target);
                if (!isClickInside && dropdownMenu.classList.contains('show')) {
                    menuButton.setAttribute('aria-expanded', 'false');
                    dropdownMenu.classList.remove('show');
                }
            });

            // Evitar que el menú se cierre al hacer clic dentro de él
            dropdownMenu.addEventListener('click', function(e) {
                e.stopPropagation();
            });
        }
    });
</script>