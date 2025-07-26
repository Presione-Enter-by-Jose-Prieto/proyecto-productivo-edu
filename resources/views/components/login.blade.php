<div class="auth-container">
    <div class="auth-form-header">
        <h1>Iniciar sesión</h1>
    </div>
    <div class="auth-form-body">
        <form action="{{ route('validar-login') }}" method="POST">
            @csrf
            <label class="form-label" for="email">Correo electrónico</label>
            <input type="text" id="email" name="email" class="form-control input-block" required>
            
            <div class="password-wrapper">
                <label for="password">Contraseña</label>
                <a href="#" class="forgot-password">¿Olvidaste tu contraseña?</a>
            </div>
            <input type="password" id="password" name="password" class="form-control input-block" required>
            
            <input type="submit" value="Iniciar sesión" class="btn btn-primary btn-block">
        </form>
    </div>
    <div class="login-callout">
        <p>¿Eres nuevo aquí? <a href="{{ route('registro') }}">Crea una cuenta</a></p>
    </div>
</div>

<style>
    .auth-container {
        width: 280px;
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

    input[type="text"], input[type="password"] {
        border: 1px solid #33363b;
        background-color: #0d1117;
        color: #ffffff;
    }

    input[type="password"] {
        color-scheme: dark;
    }

    input[type="text"]:focus , input[type="password"]:focus{
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
        color: #24292f;
        background-color: #ffffff;
        border: 1px solid #d0d7de;
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
    
    .password-wrapper {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 3px;
    }

    .forgot-password {
        font-size: 12px;
        margin-bottom: 8px;
    }

    .login-callout {
        background-color: #0d1117;
        color: #f0f6fc;
        margin-top: 16px;
        text-align: center;
        font-size: 14px;
        padding: 10px 16px;
    }

    a {
        color: #4493f8;
        text-decoration: none;
    }

    a:hover {
        text-decoration: underline;
    }
</style>
