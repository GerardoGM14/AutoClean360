<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>AutoClean360</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{-- AlpineJS y tsparticles --}}
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/tsparticles@2.11.1/tsparticles.bundle.min.js"></script>
</head>

<body class="relative font-sans text-gray-800 bg-white overflow-x-hidden">
    {{-- Fondo de partículas animadas --}}
    <div id="tsparticles" class="fixed inset-0 -z-10"></div>

    {{-- Contenedor principal centrado --}}
    <div class="flex max-w-screen-xl mx-auto mt-6 rounded-2xl shadow-xl overflow-hidden bg-white/60 backdrop-blur-sm">
        {{-- Sidebar del cliente --}}
        @include('layouts.partials.sidebar-cliente')

        {{-- Contenedor del contenido principal --}}
        <div class="flex-1">
            {{-- Topbar del cliente --}}
            @include('layouts.partials.topbar-cliente')

            {{-- Contenido dinámico de cada página --}}
            <main class="p-6 space-y-6">
                @yield('contenido-cliente')
            </main>
        </div>
    </div>

    {{-- Script para las partículas --}}
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            tsParticles.load("tsparticles", {
                background: {
                    color: "#ffffff"
                },
                particles: {
                    number: {
                        value: 70
                    },
                    color: {
                        value: "#00bcd4"
                    },
                    size: {
                        value: 2,
                        random: true
                    },
                    move: {
                        enable: true,
                        speed: 2.5
                    },
                    opacity: {
                        value: 0.75
                    },
                    links: {
                        enable: true,
                        color: "#00bcd4",
                        opacity: 0.35
                    }
                }
            });
        });
    </script>

    {{-- Scripts específicos por vista --}}
    @stack('scripts')
</body>
</html>

