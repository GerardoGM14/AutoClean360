<!DOCTYPE html>
<html lang="es">
<script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

<head>
    <meta charset="UTF-8">
    <title>AutoClean360</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="relative font-sans text-gray-800 bg-white overflow-x-hidden">
    {{-- Fondo animado de partículas --}}
    <div id="tsparticles" class="fixed inset-0 -z-10"></div>

    {{-- Contenedor general --}}
    <div class="flex max-w-screen-xl mx-auto mt-6 rounded-2xl shadow-xl overflow-hidden bg-white/60 backdrop-blur-sm">

        {{-- Sidebar --}}
        @include('layouts.partials.sidebar')

        <div class="flex-1">
            {{-- Topbar --}}
            @include('layouts.partials.topbar')

            {{-- Contenido dinámico --}}
            <main class="p-6 space-y-6">
                @yield('content')
            </main>
        </div>
    </div>

    {{-- Scripts --}}
    <script src="https://cdn.jsdelivr.net/npm/tsparticles@2.11.1/tsparticles.bundle.min.js"></script>
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
    @stack('scripts')
</body>


</html>