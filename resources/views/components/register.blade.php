<div class="auth-container">
    <div class="auth-form-header">
        <h1>Crear una cuenta</h1>
    </div>
    <div class="auth-form-body">
        <form method="POST" action="{{ route('validar-register') }}" enctype="multipart/form-data">
            @csrf
            <div class="avatar-username-group">
                <div class="avatar-upload">
                    <label for="avatar-input" class="avatar-preview">
                        <img id="avatar-preview-img" src="" alt="">
                        <div class="avatar-placeholder-wrapper">
                            <svg id="avatar-placeholder-icon" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M23 19a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h4l2-3h6l2 3h4a2 2 0 0 1 2 2z"></path><circle cx="12" cy="13" r="4"></circle></svg>
                        </div>
                        <div class="avatar-edit-overlay">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path></svg>
                        </div>
                    </label>
                    <input id="avatar-input" name="avatar" type="file" accept="image/*" style="display: none;">
                </div>
                <div class="username-input-group">
                    <label class="form-label" for="username">Nombre de usuario único</label>
                    <input type="text" id="username" name="username" class="form-control input-block" placeholder="@usuario" required>
                </div>
            </div>

            <label class="form-label" for="name">Nombre de usuario</label>
            <input type="text" id="name" name="name" class="form-control input-block" required>

            <label class="form-label" for="email">Correo electrónico</label>
            <input type="email" id="email" name="email" class="form-control input-block" required>
            
            <label class="form-label" for="password">Contraseña</label>
            <input type="password" id="password" name="password" class="form-control input-block" required>

            <label class="form-label" for="password_confirmation">Confirmar contraseña</label>
            <input type="password" id="password_confirmation" name="password_confirmation" class="form-control input-block" required>
            
            <input type="submit" value="Registrarse" class="btn btn-primary btn-block">
        </form>
    </div>
    <div class="login-callout">
        <p>¿Ya tienes una cuenta? <a href="{{ route('login') }}">Inicia sesión</a>.</p>
    </div>
</div>

<style>
    .auth-container {
        width: 340px;
        margin: 0 auto;
        font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Helvetica, Arial, sans-serif, "Apple Color Emoji", "Segoe UI Emoji";
        color: #c3d0e5;
        transform: translateY(-40px);
    }

    .auth-form-header {
        text-align: center;
        margin-bottom: 1rem;
    }

    .auth-form-header h1 {
        font-size: 24px;
        font-weight: 300;
        letter-spacing: -0.5px;
    }

    .auth-form-body, .login-callout {
        background-color: #161a20;
        border: 1px solid #33363b;
        border-radius: 6px;
        padding: 16px;
    }

    .auth-form-body form {
        display: flex;
        flex-direction: column;
    }

    input[type="text"], 
    input[type="password"], 
    input[type="email"],
    input[type="file"] {
        border: 1px solid #33363b;
        background-color: #0d1117;
        color: #ffffff;
    }

    input[type="password"] {
        color-scheme: dark;
    }

    input[type="text"]:focus, 
    input[type="password"]:focus,
    input[type="email"]:focus,
    input[type="file"]:focus {
        box-shadow: 0 0 0 1.5px #1f6feb;
        border-color: #1f6feb;
        outline: none;
    }

    input:-webkit-autofill,
    input:-webkit-autofill:hover,
    input:-webkit-autofill:focus,
    input:-webkit-autofill:active {
        transition: background-color 5000s ease-in-out 0s;
        -webkit-text-fill-color: #ffffff !important;
    }
    
    .auth-form-body form label {
        display: block;
        margin-bottom: 8px;
        font-weight: 400;
        font-size: 14px;
        color: #f0f6fc;
    }

    .form-control {
        width: 100%;
        padding: 5px 12px;
        font-size: 14px;
        line-height: 20px;
        color: #c9d1d9;
        background-color: #0d1117;
        border: 1px solid #21262d;
        border-radius: 6px;
        box-sizing: border-box;
        margin-bottom: 16px;
    }

    .btn {
        width: 100%;
        padding: 5px 16px;
        font-size: 14px;
        font-weight: 500;
        line-height: 20px;
        border-radius: 6px;
        cursor: pointer;
        text-align: center;
    }

    .btn-primary {
        color: #ffffff;
        background-color: #238636;
        border: 1px solid #449854;
    }

    .btn-primary:hover {
        background-color: #29903b;
    }

    .form-label{
        margin-bottom: 3px;
    }

    .login-callout {
        color: #f0f6fc;
        margin-top: 16px;
        text-align: center;
        font-size: 14px;
        padding: 10px 16px;
        background-color: #0d1117;
        border: 1px solid #33363b;
        border-radius: 6px;
    }

    a {
        color: #4493f8;
        text-decoration: none;
    }

    a:hover {
        text-decoration: underline;
    }

    .avatar-username-group {
        display: flex;
        align-items: flex-end;
        gap: 15px;
        margin-bottom: 15px;
    }

    .avatar-upload {
        display: flex;
        justify-content: center;
        margin-bottom: 0;
        flex-shrink: 0;
    }

    .username-input-group {
        flex-grow: 1;
    }

    .avatar-preview {
        width: 80px;
        height: 80px;
        border-radius: 50%;
        border: 2px solid #30363d;
        cursor: pointer;
        position: relative;
        overflow: hidden;
        background-color: #161b22;
        transition: border-color 0.2s, background-color 0.2s;
    }

    .avatar-preview:hover {
        border-color: #1f6feb;
        background-color: #21262d;
    }

    .avatar-placeholder-wrapper {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
    }

    .avatar-preview.has-image .avatar-placeholder-wrapper {
        display: none;
    }

    .avatar-edit-overlay {
        position: absolute;
        width: 100%;
        height: 100%;
        top: 0;
        left: 0;
        display: flex;
        justify-content: center;
        align-items: center;
        background-color: rgba(0, 0, 0, 0.5);
        opacity: 0;
        transition: opacity 0.2s;
        pointer-events: none; /* Allows click-through */
    }

    .avatar-preview.has-image:hover .avatar-edit-overlay {
        opacity: 1;
    }

    #avatar-preview-img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        position: absolute;
        top: 0;
        left: 0;
    }

    #avatar-preview-img[src=""] {
        visibility: hidden;
    }
    
    #avatar-placeholder-icon {
        stroke: #c3d0e5;
        width: 32px;
        height: 32px;
        transition: stroke 0.2s;
    }

    .avatar-preview:hover #avatar-placeholder-icon {
        stroke: #1f6feb;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const avatarInput = document.getElementById('avatar-input');
        const avatarPreviewContainer = document.querySelector('.avatar-preview');
        const avatarPreviewImg = document.getElementById('avatar-preview-img');

        avatarInput.addEventListener('change', function(event) {
            const file = event.target.files[0];

            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    avatarPreviewImg.src = e.target.result;
                    avatarPreviewContainer.classList.add('has-image');
                }
                reader.readAsDataURL(file);
            } else {
                avatarPreviewImg.src = '';
                avatarPreviewContainer.classList.remove('has-image');
            }
        });
    });
</script>