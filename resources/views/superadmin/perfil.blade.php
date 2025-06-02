@extends('layouts.app')

@section('content')
<div id="tsparticles" class="absolute inset-0 -z-10"></div>

<div class="p-6 max-w-xl mx-auto bg-white/80 backdrop-blur rounded-xl shadow-lg">
    <h2 class="text-2xl font-bold text-gray-800 mb-4">🧑‍💼 Editar Perfil</h2>

    <div class="mb-4">
        <label class="block text-sm font-medium text-gray-600">Nombre</label>
        <input type="text" id="nombre" class="input input-bordered w-full mt-1">
    </div>

    <div class="mb-4">
        <label class="block text-sm font-medium text-gray-600">Correo electrónico</label>
        <input type="email" id="correo" class="input input-bordered w-full mt-1">
    </div>

    <div class="mb-4">
        <label class="block text-sm font-medium text-gray-600">Nueva Contraseña</label>
        <input type="password" id="password" class="input input-bordered w-full mt-1" placeholder="Opcional">
    </div>

    <button id="guardarPerfil"
        class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-lg mt-4 w-full">
        Guardar Cambios
    </button>
</div>
@endsection

@vite('resources/js/superadmin/perfil.js')

@push('scripts')
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
@endpush