@extends('layouts.cliente')

@section('contenido')
{{-- Panel Principal del Cliente --}}
<div class="grid grid-cols-1 md:grid-cols-2 gap-6">

    {{-- Próxima Cita --}}
    <div x-data="{ open: false, height: 0 }"
        x-init="$nextTick(() => height = $refs.cita.scrollHeight)"
        class="bg-white/80 backdrop-blur rounded-xl shadow-md border-l-8 border-cyan-600 transition-all duration-500 overflow-hidden">
        <div class="p-6">
            <h3 class="text-sm font-semibold text-gray-700">Tu próxima cita</h3>
            <div id="proxima-cita" class="text-sm text-gray-700 mt-2"></div>
            <button @click="open = !open; height = $refs.cita.scrollHeight"
                class="mt-4 text-sm text-cyan-600 hover:underline flex items-center gap-1">
                <span x-text="open ? 'Ocultar detalles' : 'Ver más detalles'"></span>
                <svg x-bind:class="{ 'rotate-180': open }" class="w-4 h-4 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M19 9l-7 7-7-7" />
                </svg>
            </button>
        </div>
        <div x-ref="cita" class="px-6 pb-6 transition-all duration-500 ease-in-out overflow-hidden"></div>
    </div>

    {{-- Historial --}}
    <div x-data="{ open: false, height: 0 }"
        x-init="$nextTick(() => height = $refs.historial.scrollHeight)"
        class="bg-white/80 backdrop-blur rounded-xl shadow-md border-l-8 border-gray-600 transition-all duration-500 overflow-hidden">
        <div class="p-6">
            <h3 class="text-sm font-semibold text-gray-700">Historial de atenciones</h3>
            <div id="historial-citas" class="text-sm text-gray-600 mt-2"></div>
            <button @click="open = !open; height = $refs.historial.scrollHeight"
                class="mt-4 text-sm text-gray-600 hover:underline flex items-center gap-1">
                <span x-text="open ? 'Ocultar historial' : 'Ver historial completo'"></span>
                <svg x-bind:class="{ 'rotate-180': open }" class="w-4 h-4 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M19 9l-7 7-7-7" />
                </svg>
            </button>
        </div>
        <div x-ref="historial" class="px-6 pb-6 transition-all duration-500 ease-in-out overflow-hidden"></div>
    </div>


</div>
@endsection
@vite('resources/js/admin/notificaciones.js')

<script type="module">
    import {
        guardarTokenAdmin
    } from '/resources/js/admin/notificaciones.js';

    const uid = localStorage.getItem("uid");
    if (uid) {
        guardarTokenAdmin(uid);
    }
</script>