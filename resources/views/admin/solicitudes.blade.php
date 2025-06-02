@extends('layouts.app')

@section('content')
<h2 class="text-2xl font-bold text-gray-700 mb-6">Solicitudes de Citas</h2>

<div id="contenedor-solicitudes" class="space-y-4">
    <div class="text-center text-gray-400">Cargando solicitudes...</div>
</div>
@endsection

<script type="module" src="{{ asset('js/admin/citas/solicitudes.js') }}"></script>
