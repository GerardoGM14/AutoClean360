@extends('layouts.cliente') {{-- Layout personalizado del cliente --}}

@section('contenido-cliente')
<div class="p-6">
    <h2 class="text-2xl font-bold mb-4 text-cyan-700">📍 Nuestra Ubicación</h2>

    <!-- Contenedor del mapa -->
    <div id="map" class="w-full h-96 rounded-xl shadow-md border border-gray-300"></div>

    <!-- Mensaje de distancia -->
    <p id="distancia" class="mt-4 text-lg text-gray-700 font-semibold">
        Calculando distancia desde tu ubicación...
    </p>
</div>

{{-- Cargar Firebase + lógica personalizada --}}
@vite('resources/js/cliente/ubicacion.js')

<!-- Google Maps API con callback que llama a initMap -->
<script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAnoWdyxxh6kfHFG2Q9AoecbJJnEncGgI4&libraries=places">
</script>
@endsection


