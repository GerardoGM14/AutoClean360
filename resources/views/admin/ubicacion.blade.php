@extends('layouts.app')

@section('content')
<div class="p-6">
    <h2 class="text-xl font-bold text-gray-700 mb-4">📍 Configurar Ubicación del Lavadero</h2>

    <div id="map" class="w-full h-[500px] rounded-xl shadow border"></div>

    <div class="mt-6 flex flex-col gap-2">
        <label class="text-sm text-gray-600">Latitud</label>
        <input id="lat" type="text" class="border border-gray-300 rounded-lg p-2 shadow w-full max-w-md bg-white text-gray-800" readonly>

        <label class="text-sm text-gray-600">Longitud</label>
        <input id="lng" type="text" class="border border-gray-300 rounded-lg p-2 shadow w-full max-w-md bg-white text-gray-800" readonly>

        <button id="guardarUbicacion" class="mt-4 bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-lg">
            Guardar Ubicación
        </button>
    </div>
</div>
@endsection

{{-- Carga primero el script que define window.initMap --}}
@vite('resources/js/admin/ubicacion.js')

{{-- Luego llama a Google Maps que usará callback=initMap --}}
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAnoWdyxxh6kfHFG2Q9AoecbJJnEncGgI4&callback=initMap"></script>