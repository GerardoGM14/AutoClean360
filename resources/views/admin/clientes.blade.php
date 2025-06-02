@extends('layouts.app')

@section('content')
<div class="flex justify-between items-center mb-6">
    <h2 class="text-2xl font-bold text-gray-700">Gestión de Clientes</h2>
    <a href="{{ url('/clientes/crear') }}"
        class="bg-cyan-600 hover:bg-cyan-700 text-white font-semibold px-4 py-2 rounded-lg shadow transition">
        + Nuevo Cliente
    </a>
</div>

<div class="bg-white/80 backdrop-blur rounded-xl shadow-md overflow-x-auto">
    <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-cyan-600 text-white">
            <tr>
                <th class="px-6 py-3 text-left text-sm font-semibold">Nombre</th>
                <th class="px-6 py-3 text-left text-sm font-semibold">Correo</th>
                <th class="px-6 py-3 text-left text-sm font-semibold">Teléfono</th>
                <th class="px-6 py-3 text-left text-sm font-semibold">Vehículo</th>
                <th class="px-6 py-3 text-left text-sm font-semibold">Acciones</th>
            </tr>
        </thead>
        <tbody id="tabla-clientes" class="bg-white text-gray-700 divide-y divide-gray-200">
            <tr>
                <td colspan="5" class="px-6 py-4 text-center text-gray-400">Cargando clientes...</td>
            </tr>
        </tbody>
    </table>
</div>
@endsection
<script type="module" src="{{ asset('js/admin/clientes/index.js') }}"></script>