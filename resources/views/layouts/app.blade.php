<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <style>
            * { 
                margin: 0; 
                padding: 0; 
                box-sizing: border-box; 
            }

            html { 
                height: 100%; 
                width: 100%; 
            }

            body { 
                height: 100vh;
                width: 100vw;
                display: grid; 
                grid-template-columns: 256px 1fr; 
                background: #f3f4f6;
                overflow: hidden;
            }

            .sidebar { 
                grid-column: 1; 
                height: 100vh;
                display: flex;
                flex-direction: column;
                background: #111827;
                overflow: hidden;
            }

            .content { 
                grid-column: 2; 
                display: flex; 
                flex-direction: column; 
                height: 100vh;
                overflow: hidden;
            }

            header { 
                background: white; 
                padding: 1.5rem; 
                box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
                flex-shrink: 0;
            }

            main { 
                flex: 1; 
                padding: 2rem; 
                overflow-y: auto; 
                overflow-x: hidden;
                width: 100%; 
            }

            /* Scrollbar styling */
            ::-webkit-scrollbar {
                width: 8px;
                height: 8px;
            }

            ::-webkit-scrollbar-track {
                background: transparent;
            }

            ::-webkit-scrollbar-thumb {
                background: #cbd5e0;
                border-radius: 4px;
            }

            ::-webkit-scrollbar-thumb:hover {
                background: #a0aec0;
            }

            @media (max-width: 768px) { 
                body { 
                    grid-template-columns: 1fr;
                    height: auto;
                } 
                .sidebar { 
                    height: auto; 
                    max-height: 500px;
                } 
                .content {
                    height: auto;
                }
                main {
                    padding: 1.5rem;
                }
            }
        </style>
    </head>
    <body class="font-sans antialiased">
        <div class="sidebar">
            @include('layouts.navigation')
        </div>

        <div class="content">
            @isset($header)
            <header>
                <div class="max-w-full">
                    {{ $header }}
                </div>
            </header>
            @endisset

            <main>
                @yield('content')
                {{ $slot ?? '' }}
            </main>
        </div>
    </body>
</html>