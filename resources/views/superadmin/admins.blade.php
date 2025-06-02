@extends('layouts.app')

@section('content')
<div id="tsparticles" class="absolute inset-0 -z-10"></div>

<div class="p-6 bg-white/80 backdrop-blur rounded-xl shadow-lg max-w-5xl mx-auto">
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-2xl font-bold text-gray-800">👨‍💼 Administradores</h2>
        <button id="btnNuevo" class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-lg">
            + Nuevo Administrador
        </button>
    </div>

    <div class="overflow-x-auto">
        <table class="table-auto w-full border text-sm">
            <thead class="bg-gray-200 text-gray-600">
                <tr>
                    <th class="p-2">Nombre</th>
                    <th class="p-2">Correo</th>
                    <th class="p-2">Acciones</th>
                </tr>
            </thead>
            <tbody id="tablaAdmins" class="text-center bg-white">
                <!-- Dinámico desde JS -->
            </tbody>
        </table>
    </div>
</div>

<!-- Modal -->
<div id="modalAdmin"
    class="fixed inset-0 bg-black/30 backdrop-blur flex items-center justify-center hidden z-50">
    <div class="bg-white p-6 rounded-lg shadow-lg w-full max-w-md">
        <h3 class="text-lg font-bold text-gray-700 mb-4" id="modalTitulo">Nuevo Administrador</h3>

        <input type="text" id="nombreAdmin" placeholder="Nombre"
            class="input input-bordered w-full mb-3" />
        <input type="email" id="correoAdmin" placeholder="Correo"
            class="input input-bordered w-full mb-3" />
        <input type="password" id="claveAdmin" placeholder="Contraseña"
            class="input input-bordered w-full mb-3" />

        <div class="flex justify-end gap-2">
            <button id="btnCancelar"
                class="bg-gray-300 hover:bg-gray-400 px-4 py-2 rounded-lg">Cancelar</button>
            <button id="btnGuardar"
                class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-lg">Guardar</button>
        </div>
    </div>
</div>
@endsection

@vite('resources/js/superadmin/admins.js')

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