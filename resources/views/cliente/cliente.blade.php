@extends('layouts.cliente') {{-- Este archivo ya contiene sidebar y topbar del cliente --}}

@section('contenido-cliente') {{-- <- ESTE NOMBRE ES EL CORRECTO --}}
<div class="flex min-h-screen">
    <div class="flex-1 flex flex-col">
        <main class="p-6 grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">

            {{-- Próxima Cita --}}
            <div x-data="{ open: false, height: 0 }" x-init="$nextTick(() => height = $refs.detallesCita.scrollHeight)"
                class="bg-white/80 backdrop-blur rounded-xl shadow-md border-l-8 border-cyan-600 transition-all duration-500 overflow-hidden">
                <div class="p-6">
                    <h3 class="text-lg font-bold text-cyan-600">Tu próxima cita</h3>
                    <p id="fechaCita" class="text-xl font-bold text-cyan-600 mt-2">Cargando...</p>
                    <button @click="open = !open; height = open ? $refs.detallesCita.scrollHeight : 0"
                        class="mt-4 text-sm text-cyan-600 hover:underline flex items-center gap-1">
                        <span x-text="open ? 'Ocultar detalles' : 'Ver más detalles'"></span>
                        <svg x-bind:class="{ 'rotate-180': open }" class="w-4 h-4 transition-transform duration-300"
                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                </div>
                <div x-ref="detallesCita" :style="`height: ${open ? height + 'px' : '0px'}`"
                    class="transition-all duration-500 ease-in-out overflow-hidden">
                    <div class="px-6 pb-6 text-sm text-gray-600">
                        <ul class="list-disc pl-5 mt-2 space-y-1" id="detallesCita">
                            <li>Servicio: ...</li>
                            <li>Placa: ...</li>
                            <li>Estado: ...</li>
                        </ul>
                    </div>
                </div>
            </div>

            {{-- Atenciones Pendientes --}}
            <div x-data class="bg-orange-100/90 backdrop-blur rounded-xl shadow-md border-l-8 border-orange-400">
                <div class="p-6">
                    <h3 class="text-lg font-bold text-orange-500">Atenciones pendientes</h3>
                    <ul id="citasPendientes" class="mt-4 text-sm text-gray-700 space-y-1">
                        <li>Cargando...</li>
                    </ul>
                </div>
            </div>

            {{-- Historial de Citas --}}
            <div x-data="{ open: false, height: 0 }" x-init="$nextTick(() => height = $refs.historial.scrollHeight)"
                class="bg-white/80 backdrop-blur rounded-xl shadow-md border-l-8 border-gray-600 transition-all duration-500 overflow-hidden">
                <div class="p-6">
                    <h3 class="text-lg font-bold text-gray-600">Historial de atenciones</h3>
                    <p class="text-xl font-bold text-gray-600 mt-2">Última visita:</p>
                    <button @click="open = !open; height = open ? $refs.historial.scrollHeight : 0"
                        class="mt-4 text-sm text-gray-600 hover:underline flex items-center gap-1">
                        <span x-text="open ? 'Ocultar historial' : 'Ver historial completo'"></span>
                        <svg x-bind:class="{ 'rotate-180': open }" class="w-4 h-4 transition-transform duration-300"
                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                </div>
                <div x-ref="historial" :style="`height: ${open ? height + 'px' : '0px'}`"
                    class="transition-all duration-500 ease-in-out overflow-hidden">
                    <div class="px-6 pb-6 text-sm text-gray-600">
                        <ul id="historialCitas" class="list-disc pl-5 mt-2 space-y-1">
                            <li>Cargando...</li>
                        </ul>
                    </div>
                </div>
            </div>

        </main>
    </div>
</div>
@endsection

@push('scripts')
@vite('resources/js/cliente/dashboard.js')
@endpush

