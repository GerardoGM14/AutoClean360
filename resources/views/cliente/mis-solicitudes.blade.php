@extends('layouts.cliente') {{-- Este archivo ya contiene sidebar y topbar del cliente --}}

@section('contenido-cliente')

<h2 class="text-xl font-bold text-gray-700 mb-4">Mis Solicitudes de Cita</h2>

<div id="solicitudes-lista" class="space-y-4">
    {{-- Aquí se insertarán las tarjetas dinámicamente --}}
</div>

{{-- Modal oculto para subir comprobante --}}
<input type="file" id="comprobante-input" accept="image/*" class="hidden">

@endsection

@vite(['resources/js/cliente/mis-solicitudes.js'])

