<div x-data="{ section: 'dashboard' }" class="col-span-1 flex flex-col justify-between">

    <div>
        <h2 class="text-2xl font-bold text-purple-800 mb-8">🚗 AutoClean360</h2>
        <nav class="flex flex-col gap-4">
            <button @click="section = 'dashboard'" class="bg-gradient-to-r from-pink-400 to-purple-500 text-white py-2 px-4 rounded-xl shadow hover:scale-105 transition">Dashboard</button>
            <button @click="section = 'reservas'" class="text-gray-700 hover:text-purple-600 transition">Reservas</button>
            <button @click="section = 'clientes'" class="text-gray-700 hover:text-purple-600 transition">Clientes</button>
            <button @click="section = 'pagos'" class="text-gray-700 hover:text-purple-600 transition">Pagos</button>
            <button @click="section = 'vehiculos'" class="text-gray-700 hover:text-purple-600 transition">Vehículos</button>
        </nav>
    </div>

    <div class="mt-8">
        <a href="#" class="block text-sm text-gray-400 hover:text-pink-600">Cerrar sesión</a>
    </div>

    <!-- Panel Dinámico -->
    <div class="col-span-3 ml-8 mt-10 w-full" x-cloak>
        <div x-show="section === 'dashboard'" x-transition>
            @include('layouts.partials.dashboard-panel')
        </div>
        <div x-show="section === 'reservas'" x-transition>
            @include('layouts.partials.reservas-panel')
        </div>
        <div x-show="section === 'clientes'" x-transition>
            @include('layouts.partials.clientes-panel')
        </div>
        <div x-show="section === 'pagos'" x-transition>
            @include('layouts.partials.pagos-panel')
        </div>
        <div x-show="section === 'vehiculos'" x-transition>
            @include('layouts.partials.vehiculos-panel')
        </div>
    </div>
</div>

