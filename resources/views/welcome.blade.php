<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>EMICONSATH - Sistema de Contratos</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700;900&family=Sora:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        :root {
            --primary: #1a3a52;
            --secondary: #2d5a7b;
            --accent: #d4a574;
            --light: #f5f3f0;
            --dark: #0f1419;
        }

        body {
            font-family: 'Sora', sans-serif;
            background: var(--light);
            color: var(--dark);
            line-height: 1.6;
            overflow-x: hidden;
        }

        /* Animaciones de entrada */
        @keyframes fadeInDown {
            from {
                opacity: 0;
                transform: translateY(-30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes slideInRight {
            from {
                opacity: 0;
                transform: translateX(-50px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        /* Container Principal */
        .hero {
            min-height: 100vh;
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 60px;
            padding: 80px 60px;
            align-items: center;
            position: relative;
            overflow: hidden;
        }

        /* Fondo decorativo */
        .hero::before {
            content: '';
            position: absolute;
            width: 600px;
            height: 600px;
            background: radial-gradient(circle, rgba(212, 165, 116, 0.15) 0%, transparent 70%);
            border-radius: 50%;
            top: -200px;
            right: -300px;
            pointer-events: none;
        }

        .hero::after {
            content: '';
            position: absolute;
            width: 400px;
            height: 400px;
            background: radial-gradient(circle, rgba(45, 90, 123, 0.1) 0%, transparent 70%);
            border-radius: 50%;
            bottom: -100px;
            left: -150px;
            pointer-events: none;
        }

        /* Lado Izquierdo */
        .hero-left {
            z-index: 1;
        }

        .hero-left h1 {
            font-family: 'Playfair Display', serif;
            font-size: 64px;
            font-weight: 900;
            color: var(--primary);
            margin-bottom: 20px;
            animation: fadeInDown 1s ease-out;
            line-height: 1.2;
        }

        .hero-left .subtitle {
            font-size: 18px;
            color: var(--secondary);
            margin-bottom: 40px;
            font-weight: 300;
            animation: fadeInDown 1s ease-out 0.2s backwards;
        }

        .hero-left .description {
            font-size: 16px;
            color: #555;
            max-width: 500px;
            margin-bottom: 50px;
            line-height: 1.8;
            animation: fadeInDown 1s ease-out 0.4s backwards;
        }

        .features {
            display: flex;
            flex-direction: column;
            gap: 25px;
            margin-bottom: 50px;
            animation: fadeInDown 1s ease-out 0.6s backwards;
        }

        .feature-item {
            display: flex;
            align-items: flex-start;
            gap: 15px;
        }

        .feature-icon {
            font-size: 24px;
            min-width: 30px;
            color: var(--accent);
        }

        .feature-text {
            font-size: 14px;
            color: #666;
        }

        .feature-text strong {
            color: var(--primary);
            display: block;
            margin-bottom: 5px;
        }

        /* Lado Derecho - Tarjetas de Login */
        .hero-right {
            z-index: 1;
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .login-title {
            font-family: 'Playfair Display', serif;
            font-size: 40px;
            color: var(--primary);
            margin-bottom: 10px;
            animation: slideInRight 1s ease-out;
        }

        .login-subtitle {
            font-size: 14px;
            color: #888;
            margin-bottom: 40px;
            animation: slideInRight 1s ease-out 0.1s backwards;
        }

        /* Tarjetas de Roles */
        .role-card {
            background: white;
            border-left: 4px solid var(--accent);
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.08);
            transition: all 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
            animation: slideInRight 1s ease-out backwards;
            cursor: pointer;
            position: relative;
            overflow: hidden;
        }

        .role-card:nth-child(n+2) {
            animation-delay: calc(0.15s * var(--index, 1));
        }

        .role-card::before {
            content: '';
            position: absolute;
            top: 0;
            right: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, rgba(212, 165, 116, 0.05) 0%, transparent 100%);
            pointer-events: none;
        }

        .role-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 12px 40px rgba(0,0,0,0.15);
            border-left-color: var(--primary);
        }

        .role-header {
            display: flex;
            align-items: center;
            gap: 15px;
            margin-bottom: 15px;
        }

        .role-emoji {
            font-size: 32px;
        }

        .role-name {
            font-size: 18px;
            font-weight: 600;
            color: var(--primary);
        }

        .role-subname {
            font-size: 12px;
            color: #999;
            display: block;
            margin-top: 3px;
        }

        .role-credentials {
            background: #f9f7f4;
            padding: 15px;
            border-radius: 6px;
            margin-bottom: 12px;
        }

        .credential-item {
            font-size: 12px;
            margin-bottom: 8px;
        }

        .credential-item:last-child {
            margin-bottom: 0;
        }

        .credential-label {
            color: #999;
            font-size: 11px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 3px;
        }

        .credential-value {
            font-family: 'Courier New', monospace;
            font-size: 13px;
            color: var(--primary);
            font-weight: 600;
            background: white;
            padding: 6px 10px;
            border-radius: 4px;
            display: inline-block;
        }

        /* Botón CTA */
        .cta-button {
            display: inline-block;
            background: var(--primary);
            color: white;
            padding: 16px 40px;
            border-radius: 6px;
            text-decoration: none;
            font-weight: 600;
            font-size: 15px;
            transition: all 0.3s ease;
            margin-top: 20px;
            border: none;
            cursor: pointer;
            text-align: center;
        }

        .cta-button:hover {
            background: var(--secondary);
            transform: translateX(4px);
        }

        /* Footer */
        .footer {
            text-align: center;
            padding: 30px;
            color: #999;
            font-size: 12px;
            background: rgba(26, 58, 82, 0.02);
            border-top: 1px solid rgba(0,0,0,0.05);
        }

        /* Responsive */
        @media (max-width: 1024px) {
            .hero {
                grid-template-columns: 1fr;
                padding: 60px 40px;
            }

            .hero-left h1 {
                font-size: 48px;
            }

            .login-title {
                font-size: 32px;
            }
        }

        @media (max-width: 768px) {
            .hero {
                padding: 40px 20px;
                gap: 40px;
            }

            .hero-left h1 {
                font-size: 36px;
            }

            .login-title {
                font-size: 24px;
            }

            .role-card {
                padding: 20px;
            }
        }
    </style>
</head>
<body>
    <div class="hero">
        <!-- Lado Izquierdo -->
        <div class="hero-left">
           <img src="{{ asset('img/logo.png') }}" 
     alt="EMICONSATH"
     class="h-10 w-auto object-contain ml-1">


            <p class="subtitle">Sistema Integral de Gestión de Contratos</p>
            
            <p class="description">
                Plataforma especializada para administración de contratos laborales, control automático de vencimientos y vigilancia de estabilidad laboral. Diseñado para empresas mineras que requieren máximo control operativo y cumplimiento normativo.
            </p>

            <div class="features">
                <div class="feature-item">
                    <div class="feature-icon"></div>
                    <div class="feature-text">
                        <strong>163 Trabajadores</strong>
                        Gestión centralizada de todos tus colaboradores
                    </div>
                </div>
                <div class="feature-item">
                    <div class="feature-icon"></div>
                    <div class="feature-text">
                        <strong>Alertas Automáticas</strong>
                        Control de vencimientos y estabilidad laboral en tiempo real
                    </div>
                </div>
                <div class="feature-item">
                    <div class="feature-icon"></div>
                    <div class="feature-text">
                        <strong>Documentación Digital</strong>
                        Generación automática de contratos y adendas en PDF
                    </div>
                </div>
                <div class="feature-item">
                    <div class="feature-icon"></div>
                    <div class="feature-text">
                        <strong>Control de Acceso</strong>
                        Permisos diferenciados por rol y responsabilidad
                    </div>
                </div>
            </div>
        </div>

        <!-- Lado Derecho -->
        <div class="hero-right">
            <h2 class="login-title">Acceso al Sistema</h2>
            <p class="login-subtitle">Selecciona tu perfil para ingresar</p>



            @if (Route::has('login'))
                @auth
                    <a href="{{ route('dashboard') }}" class="cta-button">
                        Ir al Dashboard →
                    </a>
                @else
                    <a href="{{ route('login') }}" class="cta-button">
                        Iniciar Sesión →
                    </a>
                @endauth
            @endif
        </div>
    </div>

    <div class="footer">
        <p>© 2026 EMICONSATH S.A. | Sistema de Gestión de Contratos v1.0 | Todos los derechos reservados</p>
    </div>
</body>
</html>