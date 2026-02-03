<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Acceso | EMICONSATH</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:300,400,500,600,700&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body { 
            font-family: 'Inter', sans-serif;
            position: relative;
        }

        /* Fondo con imagen visible */
        .bg-image {
            position: fixed;
            inset: 0;
            background-image: url('https://www.emiconsath.com/assets/fondo/fondo2%20(2).webp');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            z-index: 0;
        }

        /* Overlay oscuro suave */
        .bg-overlay {
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, 0.35);
            z-index: 1;
        }

        /* Contenedor principal */
        .login-container {
            min-h-screen;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
            position: relative;
            z-index: 10;
        }

        /* Panel de login BLANCO */
        .login-panel {
            width: 100%;
            max-width: 380px;
            background: #ffffff;
            border-radius: 16px;
            padding: 48px 36px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
            animation: slideUp 0.6s ease-out;
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Línea superior azul */
        .login-panel::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, #3b82f6 0%, #2563eb 100%);
            border-radius: 16px 16px 0 0;
        }

        /* Header */
        .login-header {
            text-align: center;
            margin-bottom: 40px;
        }

        .logo {
            height: 48px;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .logo img {
            max-height: 100%;
            object-fit: contain;
        }

        .login-title {
            font-size: 28px;
            font-weight: 700;
            color: #0f172a;
            letter-spacing: -0.5px;
            margin-bottom: 8px;
        }

        .login-subtitle {
            font-size: 13px;
            color: #64748b;
            font-weight: 400;
            letter-spacing: 0.5px;
            text-transform: uppercase;
        }

        /* Formulario */
        .login-form {
            display: flex;
            flex-direction: column;
            gap: 16px;
        }

        .form-group {
            position: relative;
        }

        .form-input {
            width: 100%;
            padding: 14px 16px;
            font-size: 14px;
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 10px;
            color: #0f172a;
            transition: all 0.3s ease;
            font-family: 'Inter', sans-serif;
            font-weight: 500;
        }

        .form-input::placeholder {
            color: #cbd5e1;
        }

        .form-input:focus {
            outline: none;
            background: #ffffff;
            border-color: #3b82f6;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
        }

        .form-input.error {
            border-color: #ef4444;
            background: #fef2f2;
        }

        /* Opciones */
        .form-options {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-top: 12px;
            font-size: 12px;
        }

        .checkbox-wrapper {
            display: flex;
            align-items: center;
            gap: 8px;
            cursor: pointer;
        }

        .checkbox-wrapper input[type="checkbox"] {
            width: 16px;
            height: 16px;
            cursor: pointer;
            accent-color: #3b82f6;
            border-radius: 4px;
        }

        .checkbox-label {
            color: #64748b;
            font-weight: 500;
            user-select: none;
        }

        .forgot-link {
            color: #3b82f6;
            text-decoration: none;
            font-weight: 600;
            transition: color 0.3s ease;
        }

        .forgot-link:hover {
            color: #2563eb;
        }

        /* Botón */
        .btn-login {
            width: 100%;
            padding: 14px 16px;
            margin-top: 8px;
            background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
            color: white;
            font-size: 14px;
            font-weight: 700;
            border: none;
            border-radius: 10px;
            cursor: pointer;
            transition: all 0.3s ease;
            letter-spacing: 0.5px;
            text-transform: uppercase;
            box-shadow: 0 4px 15px rgba(59, 130, 246, 0.3);
            position: relative;
            overflow: hidden;
        }

        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(59, 130, 246, 0.4);
        }

        .btn-login:active {
            transform: translateY(0);
        }

        /* Mensajes */
        .auth-status {
            background: #f0fdf4;
            border: 1px solid #bbf7d0;
            color: #166534;
            padding: 12px 16px;
            border-radius: 8px;
            font-size: 13px;
            margin-bottom: 24px;
            border-left: 3px solid #22c55e;
        }

        .error-message {
            background: #fef2f2;
            border: 1px solid #fecaca;
            color: #991b1b;
            padding: 12px 16px;
            border-radius: 8px;
            font-size: 12px;
            margin-bottom: 16px;
            border-left: 3px solid #ef4444;
        }

        .error-text {
            color: #dc2626;
            font-size: 12px;
            margin-top: 6px;
            display: block;
        }

        /* Footer */
        .login-footer {
            text-align: center;
            margin-top: 32px;
            padding-top: 24px;
            border-top: 1px solid #e2e8f0;
            font-size: 11px;
            color: #94a3b8;
            letter-spacing: 0.5px;
            text-transform: uppercase;
        }

        /* Toggle Password */
        .password-wrapper {
            position: relative;
        }

        .toggle-password {
            position: absolute;
            right: 14px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            cursor: pointer;
            color: #64748b;
            font-size: 18px;
            padding: 4px 8px;
            transition: color 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            width: 40px;
            height: 40px;
        }

        .toggle-password svg {
            width: 20px;
            height: 20px;
            stroke: currentColor;
        }

        .toggle-password:hover {
            color: #3b82f6;
        }

        /* Responsive */
        @media (max-width: 480px) {
            .login-panel {
                padding: 36px 24px;
            }

            .login-title {
                font-size: 24px;
            }

            .form-input,
            .btn-login {
                font-size: 13px;
                padding: 12px 14px;
            }
        }

        /* Animación de error */
        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            25% { transform: translateX(-5px); }
            75% { transform: translateX(5px); }
        }

        .shake {
            animation: shake 0.3s ease-in-out;
        }
    </style>
</head>
<body class="antialiased">

    <div class="bg-image"></div>
    <div class="bg-overlay"></div>

    <div class="login-container">
        <div class="login-panel">
            
            <!-- Header -->
            <div class="login-header">
                <div class="logo">
                    <img src="{{ asset('img/logo.png') }}" alt="EMICONSATH">
                </div>
                <h1 class="login-title">Acceso</h1>
                <p class="login-subtitle">Sistema de Gestión de Contratos</p>
            </div>

            <!-- Status Message -->
            @if ($errors->any())
                <div class="error-message">
                    Credenciales inválidas. Por favor intenta de nuevo.
                </div>
            @endif

            <x-auth-session-status class="auth-status" :status="session('status')" />

            <!-- Formulario -->
            <form method="POST" action="{{ route('login') }}" class="login-form">
                @csrf

                <!-- Email -->
                <div class="form-group">
                    <input 
                        id="email" 
                        type="email" 
                        name="email" 
                        value="{{ old('email') }}" 
                        required 
                        autofocus
                        class="form-input @error('email') shake error @enderror"
                        placeholder="Correo electrónico"
                    >
                    @error('email')
                        <span class="error-text">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Password -->
                <div class="form-group">
                    <div class="password-wrapper">
                        <input 
                            id="password" 
                            type="password" 
                            name="password" 
                            required
                            class="form-input @error('password') error @enderror"
                            placeholder="Contraseña"
                        >
                        <button 
                            type="button" 
                            class="toggle-password" 
                            id="togglePassword"
                            onclick="togglePasswordVisibility()"
                            title="Mostrar/Ocultar contraseña"
                        >
                            <svg id="passwordIcon" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                            </svg>
                        </button>
                    </div>
                    @error('password')
                        <span class="error-text">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Opciones -->
                <div class="form-options">
                    <label class="checkbox-wrapper">
                        <input type="checkbox" name="remember">
                        <span class="checkbox-label">Recordarme</span>
                    </label>

                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" class="forgot-link">
                            ¿Olvidó su contraseña?
                        </a>
                    @endif
                </div>

                <!-- Botón -->
                <button type="submit" class="btn-login">
                    Ingresar
                </button>
            </form>

            <!-- Footer -->
            <div class="login-footer">
                © {{ date('Y') }} EMICONSATH S.A.
            </div>
        </div>
    </div>

    <script>
        function togglePasswordVisibility() {
            const passwordInput = document.getElementById('password');
            const passwordIcon = document.getElementById('passwordIcon');
            
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                // SVG de ocultar (ojo tachado)
                passwordIcon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-2.803m5.596-3.856a3.375 3.375 0 11-4.753 4.753M4.6 4.6l14.8 14.8"></path>';
            } else {
                passwordInput.type = 'password';
                // SVG de mostrar (ojo abierto)
                passwordIcon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>';
            }
        }
    </script>
</body>
</html>