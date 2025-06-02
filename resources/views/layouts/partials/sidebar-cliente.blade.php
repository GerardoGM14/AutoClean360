<aside class="w-64 bg-white/40 backdrop-blur-md text-gray-600 border-r border-gray-200 px-6 py-6 space-y-6">
    <!-- Logo -->
    <div class="flex justify-center">
        <img src="https://i.postimg.cc/xTLG4dJ9/Logo-Auto-Clean.png"
            alt="Logo AutoClean"
            class="h-24 w-24 object-contain shadow-lg hover:scale-105 transition-transform duration-300" />
    </div>

    <!-- Navegación -->
    <nav class="space-y-2">

        <a href="/cliente/dashboard"
            class="block px-3 py-2 rounded-lg font-medium transition
        {{ request()->is('cliente/dashboard') ? 'bg-gray-800 text-white' : 'hover:bg-cyan-600 hover:text-white' }}">
            🏠Inicio
        </a>

        <a href="{{ route('cliente.solicitudes') }}"
            class="block px-3 py-2 rounded-lg font-medium transition
        {{ request()->is('cliente/mis-solicitudes') ? 'bg-gray-800 text-white' : 'hover:bg-cyan-600 hover:text-white' }}">
            📩 Mis Solicitudes
        </a>

        <a href="{{ route('cliente.solicitar-cita') }}"
            class="block px-3 py-2 rounded-lg font-medium transition
        {{ request()->is('cliente/nueva-cita') ? 'bg-gray-800 text-white' : 'hover:bg-cyan-600 hover:text-white' }}">
            🗓️ Solicitar Cita
        </a>

        <a href="/cliente/historial-pagos"
            class="block px-3 py-2 rounded-lg font-medium transition
        {{ request()->is('cliente/historial-pagos') ? 'bg-gray-800 text-white' : 'hover:bg-cyan-600 hover:text-white' }}">
            💳 Historial de Pagos
        </a>

        <a href="/cliente/soporte"
            class="block px-3 py-2 rounded-lg font-medium transition
        {{ request()->is('cliente/soporte') ? 'bg-gray-800 text-white' : 'hover:bg-cyan-600 hover:text-white' }}">
            🛠️ Soporte
        </a>

        <a href="/cliente/ubicacion"
            class="block px-3 py-2 rounded-lg font-medium transition
        {{ request()->is('cliente/ubicacion') ? 'bg-gray-800 text-white' : 'hover:bg-cyan-600 hover:text-white' }}">
            🗺️ Ubicación
        </a>
    </nav>

    <!-- Botón de cerrar sesión -->
    <div class="border-t-4 border-red-500 pt-4">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit"
                class="w-full px-3 py-2 text-red-600 border border-red-500 rounded-lg hover:bg-red-500 hover:text-white font-medium transition duration-300">
                Cerrar Sesión
            </button>
        </form>
    </div>
</aside>