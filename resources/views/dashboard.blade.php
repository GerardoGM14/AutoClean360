@extends('layouts.app')

@section('content')

{{-- Grid de tarjetas con expansión --}}
<div class="grid grid-cols-1 md:grid-cols-3 gap-6">

    {{-- AUTOS LAVADOS --}}
    <div x-data="{ open: false, height: 0 }"
        x-init="$nextTick(() => height = $refs.content1.scrollHeight)"
        class="bg-white/80 backdrop-blur rounded-xl shadow-md border-l-8 border-cyan-500 transition-all duration-500 overflow-hidden">

        <div class="p-6">
            <h3 class="text-sm font-semibold text-gray-700">Autos Lavados</h3>
            <p class="text-3xl font-bold text-cyan-600 mt-2">25</p>

            <button @click="open = !open; height = $refs.content1.scrollHeight"
                class="mt-4 text-sm text-cyan-600 hover:underline focus:outline-none flex items-center gap-1">
                <span x-text="open ? 'Ocultar detalles' : 'Ver más detalles'"></span>
                <svg x-bind:class="{ 'rotate-180': open }"
                    class="w-4 h-4 transition-transform duration-300 transform"
                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M19 9l-7 7-7-7" />
                </svg>
            </button>
        </div>

        <div x-ref="content1"
            x-bind:style="open ? `height: ${height}px` : 'height: 0px'"
            class="transition-all duration-500 ease-in-out overflow-hidden">
            <div class="px-6 pb-6 text-sm text-gray-600">
                <ul class="list-disc pl-5 mt-2 space-y-1">
                    <li>10 Lavado rápido</li>
                    <li>8 Lavado premium</li>
                    <li>7 Interior + exterior</li>
                </ul>
            </div>
        </div>
    </div>

    {{-- PENDIENTES --}}
    <div x-data="{ open: false, height: 0 }"
        x-init="$nextTick(() => height = $refs.content2.scrollHeight)"
        class="bg-white/80 backdrop-blur rounded-xl shadow-md border-l-8 border-yellow-500 transition-all duration-500 overflow-hidden">

        <div class="p-6">
            <h3 class="text-sm font-semibold text-gray-700">Pendientes</h3>
            <p class="text-3xl font-bold text-yellow-500 mt-2">5</p>

            <button @click="open = !open; height = $refs.content2.scrollHeight"
                class="mt-4 text-sm text-yellow-600 hover:underline focus:outline-none flex items-center gap-1">
                <span x-text="open ? 'Ocultar detalles' : 'Ver más detalles'"></span>
                <svg x-bind:class="{ 'rotate-180': open }"
                    class="w-4 h-4 transition-transform duration-300 transform"
                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M19 9l-7 7-7-7" />
                </svg>
            </button>
        </div>

        <div x-ref="content2"
            x-bind:style="open ? `height: ${height}px` : 'height: 0px'"
            class="transition-all duration-500 ease-in-out overflow-hidden">
            <div class="px-6 pb-6 text-sm text-gray-600">
                <ul class="list-disc pl-5 mt-2 space-y-1">
                    <li>2 con cita agendada</li>
                    <li>3 esperando pago</li>
                </ul>
            </div>
        </div>
    </div>

    {{-- PAGOS DEL DÍA --}}
    <div x-data="{ open: false, height: 0 }"
        x-init="$nextTick(() => height = $refs.content3.scrollHeight)"
        class="bg-white/80 backdrop-blur rounded-xl shadow-md border-l-8 border-green-600 transition-all duration-500 overflow-hidden">

        <div class="p-6">
            <h3 class="text-sm font-semibold text-gray-700">Pagos del día</h3>
            <p class="text-3xl font-bold text-green-600 mt-2">S/ 380</p>

            <button @click="open = !open; height = $refs.content3.scrollHeight"
                class="mt-4 text-sm text-green-600 hover:underline focus:outline-none flex items-center gap-1">
                <span x-text="open ? 'Ocultar detalles' : 'Ver más detalles'"></span>
                <svg x-bind:class="{ 'rotate-180': open }"
                    class="w-4 h-4 transition-transform duration-300 transform"
                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M19 9l-7 7-7-7" />
                </svg>
            </button>
        </div>

        <div x-ref="content3"
            x-bind:style="open ? `height: ${height}px` : 'height: 0px'"
            class="transition-all duration-500 ease-in-out overflow-hidden">
            <div class="px-6 pb-6 text-sm text-gray-600">
                <ul class="list-disc pl-5 mt-2 space-y-1">
                    <li>S/ 150 Lavado rápido</li>
                    <li>S/ 230 Lavado premium</li>
                </ul>
            </div>
        </div>
    </div>

</div>
@endsection
@push('scripts')
@vite('resources/js/app.js')
@endpush
@vite('resources/js/admin/notificaciones.js')
<script>
    document.addEventListener("DOMContentLoaded", () => {
        const uid = localStorage.getItem("uid");
        if (uid && typeof guardarTokenAdmin === "function") {
            console.log("🔄 Ejecutando guardarTokenAdmin desde Blade...");
            guardarTokenAdmin(uid);
        } else {
            console.warn("⚠️ guardarTokenAdmin no está definido o UID no encontrado");
        }
    });
</script>
@vite('resources/js/admin/notificaciones.js')

