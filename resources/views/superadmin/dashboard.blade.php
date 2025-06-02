@extends('layouts.app')

@section('content')
<div id="tsparticles" class="absolute inset-0 -z-10"></div>

<div class="p-6 max-w-5xl mx-auto">
    <h2 class="text-2xl font-bold text-gray-800 mb-6">🛠 Panel del Superadministrador</h2>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <!-- Card Editar Perfil -->
        <div id="cardPerfil"
            class="bg-white/80 backdrop-blur border border-gray-200 rounded-xl p-6 shadow-lg cursor-pointer hover:scale-105 transition-transform duration-300">
            <img src="https://cdn-icons-png.flaticon.com/512/847/847969.png" class="w-16 mb-3" />
            <h3 class="text-lg font-semibold text-gray-800">Editar Perfil</h3>
            <p class="text-sm text-gray-600">Modifica tus datos como superadmin</p>
        </div>

        <!-- Card CRUD Admins -->
        <div id="cardAdmins"
            class="bg-white/80 backdrop-blur border border-gray-200 rounded-xl p-6 shadow-lg cursor-pointer hover:scale-105 transition-transform duration-300">
            <img src="https://cdn-icons-png.flaticon.com/512/747/747376.png" class="w-16 mb-3" />
            <h3 class="text-lg font-semibold text-gray-800">Gestión de Administradores</h3>
            <p class="text-sm text-gray-600">Agrega, edita o elimina administradores</p>
        </div>
    </div>
</div>

<!-- Modal Perfil -->
<div id="modalPerfil" class="fixed inset-0 bg-black/30 backdrop-blur flex items-center justify-center hidden z-50">
    <div class="bg-white p-6 rounded-lg shadow-lg w-full max-w-md">
        <h3 class="text-lg font-bold text-gray-700 mb-4">Editar Perfil</h3>

        <input type="text" id="nombrePerfil" placeholder="Nombre completo"
            class="input input-bordered w-full mb-3" />
        <input type="password" id="clavePerfil" placeholder="Nueva contraseña"
            class="input input-bordered w-full mb-3" />

        <div class="flex justify-end gap-2">
            <button class="bg-gray-300 hover:bg-gray-400 px-4 py-2 rounded-lg" id="btnCerrarPerfil">Cancelar</button>
            <button class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-lg"
                id="btnGuardarPerfil">Guardar</button>
        </div>
    </div>
</div>

<!-- Modal CRUD Admins -->
<div id="modalAdmins" class="fixed inset-0 bg-black/30 backdrop-blur flex items-center justify-center hidden z-50">
    <div class="bg-white p-6 rounded-lg shadow-lg w-full max-w-xl">
        <h3 class="text-lg font-bold text-gray-700 mb-4">Gestión de Administradores</h3>

        <input type="text" id="nombreAdmin" placeholder="Nombre"
            class="input input-bordered w-full mb-3" />
        <input type="email" id="correoAdmin" placeholder="Correo"
            class="input input-bordered w-full mb-3" />
        <input type="password" id="claveAdmin" placeholder="Contraseña"
            class="input input-bordered w-full mb-3" />

        <div class="flex justify-end gap-2 mb-6">
            <button id="btnGuardarAdmin"
                class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-lg">Guardar</button>
        </div>

        <div>
            <h4 class="text-md font-semibold mb-2">Listado</h4>
            <ul id="listaAdmins" class="space-y-2">
                <!-- JS genera los elementos -->
            </ul>
        </div>

        <div class="flex justify-end pt-4">
            <button id="btnCerrarAdmins"
                class="bg-gray-300 hover:bg-gray-400 px-4 py-2 rounded-lg">Cerrar</button>
        </div>
    </div>
</div>
@endsection

@vite('resources/js/superadmin/dashboard.js')

@push('scripts')
<script>
    document.addEventListener("DOMContentLoaded", () => {
        tsParticles.load("tsparticles", {
            background: { color: "#ffffff" },
            particles: {
                number: { value: 70 },
                color: { value: "#00bcd4" },
                size: { value: 2, random: true },
                move: { enable: true, speed: 2.5 },
                opacity: { value: 0.75 },
                links: { enable: true, color: "#00bcd4", opacity: 0.35 }
            }
        });
    });
</script>
@endpush
