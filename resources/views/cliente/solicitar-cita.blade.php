@extends('layouts.cliente') {{-- Este archivo ya contiene sidebar y topbar del cliente --}}

@section('contenido-cliente')
<div class="max-w-3xl mx-auto mt-10 bg-white/80 backdrop-blur-md rounded-xl shadow-md p-8 space-y-6">
    <h2 class="text-2xl font-bold text-gray-800 text-center">Solicitar Cita</h2>

    <form id="form-cita" enctype="multipart/form-data" class="space-y-4">
        {{-- Servicio --}}
        <div>
            <label for="servicio" class="block text-sm font-medium text-gray-700 mb-1">Tipo de servicio</label>
            <input type="text" id="servicio" name="servicio" class="w-full px-4 py-2 border rounded-md bg-gray-100" placeholder="Selecciona un servicio" readonly onclick="abrirModalServicios()">
        </div>

        {{-- Precio --}}
        <div>
            <label for="precio" class="block text-sm font-medium text-gray-700 mb-1">Precio (S/)</label>
            <input type="text" id="precio" name="precio" class="w-full px-4 py-2 border rounded-md bg-gray-100" readonly>
        </div>

        {{-- Modal con animación --}}
        <div id="modal-servicios"
            class="fixed inset-0 bg-black/40 backdrop-blur-sm flex items-center justify-center z-50 
                   transition-all duration-300 ease-in-out opacity-0 pointer-events-none scale-95">

            <div class="bg-white rounded-xl shadow-lg p-6 w-full max-w-2xl">
                <h2 class="text-xl font-bold mb-4 text-center">Selecciona un tipo de servicio</h2>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    {{-- Servicio 1 --}}
                    <div onclick="seleccionarServicio('Lavado rápido', 20)"
                        class="cursor-pointer p-4 rounded-xl border hover:bg-cyan-50 shadow text-center transition">
                        <img src="https://cdn3d.iconscout.com/3d/premium/thumb/encerado-de-automovil-10383909-8363566.png?f=webp" alt="Lavado rápido" class="w-20 mx-auto mb-2">
                        <h3 class="font-semibold text-lg">🧼 Lavado rápido</h3>
                        <p class="font-semibold text-sm text-gray-500">Incluye enjuague exterior.</p>
                        <p class="text-sm text-gray-500">Jabón espumoso + secado rápido.</p>
                        <p class="text-sm text-gray-500">Ideal para mantenimiento frecuente.</p>
                        <p class="text-cyan-700 font-bold mt-1">S/ 20</p>
                    </div>

                    {{-- Servicio 2 --}}
                    <div onclick="seleccionarServicio('Lavado premium', 35)"
                        class="cursor-pointer p-4 rounded-xl border hover:bg-cyan-50 shadow text-center transition">
                        <img src="https://cdn3d.iconscout.com/3d/premium/thumb/lavado-de-coche-10383908-8363565.png?f=webp" alt="Lavado premium" class="w-20 mx-auto mb-2">
                        <h3 class="font-semibold text-lg">🧽 Lavado premium</h3>
                        <p class="font-semibold text-sm text-gray-500">Exterior + interior + llantas</p>
                        <p class="text-sm text-gray-500">Lavado exterior detallado con cera.</p>
                        <p class="text-sm text-gray-500">Limpieza de llantas y guardafangos.</p>
                        <p class="text-sm text-gray-500">Aspirado rápido del interior.</p>
                        <p class="text-sm text-gray-500">Perfume automotriz incluido.</p>
                        <p class="text-cyan-700 font-bold mt-1">S/ 35</p>
                    </div>

                    {{-- Servicio 3 --}}
                    <div onclick="seleccionarServicio('Lavado + Aspirado', 45)"
                        class="cursor-pointer p-4 rounded-xl border hover:bg-cyan-50 shadow text-center transition">
                        <img src="https://cdn3d.iconscout.com/3d/premium/thumb/maquina-de-lavado-de-autos-10383896-8363553.png?f=webp" alt="Lavado + Aspirado" class="w-20 mx-auto mb-2">
                        <h3 class="font-semibold text-lg">🏎️💨 Lavado + Aspirado</h3>
                        <p class="font-semibold text-sm text-gray-500"> Todo lo del Lavado Premium.</p>
                        <p class="text-sm text-gray-500">Aspirado completo de alfombras, maletera y asientos.</p>
                        <p class="text-sm text-gray-500">Limpieza de tapices y salpicadero.</p>
                        <p class="text-sm text-gray-500">El más completo para dejar tu auto impecable.</p>
                        <p class="text-cyan-700 font-bold mt-1">S/ 45</p>
                    </div>
                </div>

                <div class="mt-6 text-center">
                    <button onclick="seleccionarServicio('', '')"
                        type="button"
                        class="px-4 py-2 bg-gray-600 text-white rounded hover:bg-gray-700 transition">
                        Cancelar
                    </button>
                </div>
            </div>
        </div>

        {{-- Fecha --}}
        <div>
            <label for="fecha" class="block text-sm font-medium text-gray-700">Fecha</label>
            <input type="date" id="fecha" name="fecha" class="mt-1 block w-full px-4 py-2 border rounded-md shadow-sm focus:ring-cyan-500 focus:border-cyan-500">
        </div>

        {{-- Hora --}}
        <div>
            <label for="hora" class="block text-sm font-medium text-gray-700">Hora</label>
            <select id="hora" name="hora" class="mt-1 block w-full px-4 py-2 border rounded-md bg-white shadow-sm focus:ring-cyan-500 focus:border-cyan-500">
                <option disabled selected value="">Selecciona una hora</option>
                <option value="08:00">08:00</option>
                <option value="09:00">09:00</option>
                <option value="10:00">10:00</option>
                <option value="11:00">11:00</option>
                <option value="12:00">12:00</option>
                <option value="14:00">14:00</option>
                <option value="15:00">15:00</option>
                <option value="16:00">16:00</option>
            </select>
        </div>

        {{-- Placa --}}
        <div>
            <label for="placa" class="block text-sm font-medium text-gray-700">Placa del vehículo</label>
            <input type="text" id="placa" name="placa" maxlength="7"
                placeholder="Ej. ABC-123"
                class="mt-1 block w-full px-4 py-2 border rounded-md shadow-sm focus:ring-cyan-500 focus:border-cyan-500 uppercase tracking-widest"
                oninput="formatearPlaca(this)">
        </div>

        {{-- Imagen --}}
        <div>
            <label for="foto-carro" class="block text-sm font-medium text-gray-700">Foto del vehículo</label>
            <input type="file" id="foto-carro" accept="image/*" class="mt-1 block w-full text-sm text-gray-500">
        </div>

        {{-- Botón --}}
        <div class="flex justify-end">
            <button type="submit"
                class="bg-cyan-600 text-white px-6 py-2 rounded-md shadow hover:bg-cyan-700 transition relative flex items-center gap-2"
                id="btnEnviar">
                <span>Enviar Solicitud</span>
                <svg id="spinner" class="w-4 h-4 animate-spin hidden" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 4v4m0 0l3-3m-3 3L9 5m0 11a9 9 0 1018 0 9 9 0 10-18 0z" />
                </svg>
            </button>
        </div>
    </form>
</div>
@endsection

@push('scripts')
@vite('resources/js/cliente/cita.js')
@endpush

{{-- Script para formatear placa --}}
<script>
    function formatearPlaca(input) {
        let valor = input.value.toUpperCase().replace(/[^A-Z0-9]/g, ''); // Solo letras y números
        if (valor.length > 3) {
            valor = valor.slice(0, 3) + '-' + valor.slice(3, 6);
        }
        input.value = valor;
    }
</script>