@extends('layouts.app')
@vite(['resources/css/app.css', 'resources/js/app.js', 'resources/js/cliente.js'])

@section('content')
<div class="max-w-2xl mx-auto bg-white/80 backdrop-blur rounded-xl shadow-md p-8">
    <h2 class="text-2xl font-bold text-gray-700 mb-6">Registrar Cliente</h2>

    <form id="form-crear-cliente">
        {{-- Validación por DNI --}}
        <div class="mb-4">
            <label class="block text-sm font-semibold text-gray-700 mb-1">DNI</label>
            <div class="flex gap-2">
                <input type="text" id="dni" name="dni" maxlength="8" class="w-full px-4 py-2 rounded-lg border border-gray-300" placeholder="Ingrese DNI">
                <button type="button" id="btn-validar-dni" class="bg-cyan-600 hover:bg-cyan-700 text-white font-semibold px-4 py-2 rounded-lg">
                    Validar DNI
                </button>
            </div>
        </div>

        {{-- Datos obtenidos de RENIEC --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Nombres</label>
                <input type="text" id="nombres" name="nombres" class="w-full px-4 py-2 rounded-lg border border-gray-300 bg-gray-100" readonly>
            </div>
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Apellido Paterno</label>
                <input type="text" id="apellidoPaterno" name="apellidoPaterno" class="w-full px-4 py-2 rounded-lg border border-gray-300 bg-gray-100" readonly>
            </div>
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Apellido Materno</label>
                <input type="text" id="apellidoMaterno" name="apellidoMaterno" class="w-full px-4 py-2 rounded-lg border border-gray-300 bg-gray-100" readonly>
            </div>
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Tipo Documento</label>
                <input type="text" id="tipoDocumento" name="tipoDocumento" value="DNI" class="w-full px-4 py-2 rounded-lg border border-gray-300 bg-gray-100" readonly>
            </div>
        </div>

        {{-- Campos rellenables --}}
        <div class="mb-4">
            <label class="block text-sm font-semibold text-gray-700 mb-1">Correo</label>
            <input type="email" name="email" id="email" class="w-full px-4 py-2 rounded-lg border border-gray-300" placeholder="ejemplo@correo.com">
        </div>

        <div class="mb-4">
            <label class="block text-sm font-semibold text-gray-700 mb-1">Teléfono</label>
            <input type="text" name="telefono" id="telefono" class="w-full px-4 py-2 rounded-lg border border-gray-300" placeholder="987654321">
        </div>

        <div class="mb-4">
            <label class="block text-sm font-semibold text-gray-700 mb-1">Dirección</label>
            <input type="text" name="direccion" id="direccion" class="w-full px-4 py-2 rounded-lg border border-gray-300" placeholder="Dirección exacta">
        </div>

        <div class="mb-6">
            <label class="block text-sm font-semibold text-gray-700 mb-1">Placa del vehículo</label>
            <input type="text" name="placa" id="placa" class="w-full px-4 py-2 rounded-lg border border-gray-300 uppercase" placeholder="ABC-123">
        </div>

        <div class="flex justify-end">
            <button type="submit" class="bg-green-600 hover:bg-green-700 text-white font-semibold px-6 py-2 rounded-lg">
                Guardar Cliente
            </button>
        </div>
    </form>
</div>
@endsection
