@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto">
    <h2 class="text-2xl font-bold text-gray-800 mb-6">Editar Cliente</h2>
    <form id="form-editar-cliente" class="bg-white/80 p-6 rounded-xl shadow space-y-4">
        <input type="hidden" id="cliente-id" value="{{ $uid }}">

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label for="nombres" class="block text-sm font-medium">Nombres</label>
                <input id="nombres" type="text" class="w-full rounded-lg border px-4 py-2" required>
            </div>
            <div>
                <label for="apellidoPaterno" class="block text-sm font-medium">Apellido Paterno</label>
                <input id="apellidoPaterno" type="text" class="w-full rounded-lg border px-4 py-2" required>
            </div>
            <div>
                <label for="apellidoMaterno" class="block text-sm font-medium">Apellido Materno</label>
                <input id="apellidoMaterno" type="text" class="w-full rounded-lg border px-4 py-2" required>
            </div>
            <div>
                <label for="email" class="block text-sm font-medium">Correo Electrónico</label>
                <input id="email" type="email" class="w-full rounded-lg border px-4 py-2" required>
            </div>
            <div>
                <label for="telefono" class="block text-sm font-medium">Teléfono</label>
                <input id="telefono" type="text" class="w-full rounded-lg border px-4 py-2" required>
            </div>
            <div>
                <label for="direccion" class="block text-sm font-medium">Dirección</label>
                <input id="direccion" type="text" class="w-full rounded-lg border px-4 py-2">
            </div>
            <div>
                <label for="placa" class="block text-sm font-medium">Placa</label>
                <input id="placa" type="text" class="w-full rounded-lg border px-4 py-2">
            </div>
        </div>

        <div class="mt-6 text-right">
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-2 rounded-lg shadow">
                Guardar Cambios
            </button>
        </div>
    </form>
</div>
@endsection

<script type="module" src="{{ asset('js/admin/clientes/editar.js') }}"></script>
