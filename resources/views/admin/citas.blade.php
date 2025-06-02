@extends('layouts.app')

@section('content')
<h2 class="text-xl font-bold text-gray-700 mb-4">Solicitudes de Cita</h2>

<div id="lista-solicitudes-admin" class="space-y-4">
    {{-- Aquí se renderizarán las tarjetas dinámicas --}}
</div>
@endsection

@vite(['resources/js/admin/citas.js'])
