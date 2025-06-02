<aside class="w-64 bg-white/40 backdrop-blur-md text-gray-600 border-r border-gray-200 px-6 py-6 space-y-6">
    <!-- Logo más grande -->
    <div class="flex justify-center">
        <img src="https://i.postimg.cc/xTLG4dJ9/Logo-Auto-Clean.png"
            alt="Logo AutoClean"
            class="h-24 w-24 object-contain shadow-lg hover:scale-105 transition-transform duration-300" />
    </div>
    <nav class="space-y-2">
        <a href="/dashboard"
            class="block px-3 py-2 rounded-lg font-medium transition
       {{ request()->is('dashboard') ? 'bg-gray-800 text-white' : 'hover:bg-cyan-600 hover:text-white' }}">
            📶 Dashboard
        </a>
        <a href="/citas"
            class="block px-3 py-2 rounded-lg font-medium transition
       {{ request()->is('citas') ? 'bg-gray-800 text-white' : 'hover:bg-cyan-600 hover:text-white' }}">
            📆 Citas
        </a>
        <a href="/clientes"
            class="block px-3 py-2 rounded-lg font-medium transition
       {{ request()->is('clientes') ? 'bg-gray-800 text-white' : 'hover:bg-cyan-600 hover:text-white' }}">
            🫂 Clientes
        </a>
        <a href="/pagos"
            class="block px-3 py-2 rounded-lg font-medium transition
       {{ request()->is('pagos') ? 'bg-gray-800 text-white' : 'hover:bg-cyan-600 hover:text-white' }}">
            🏦 Pagos
        </a>
        <a href="/ubicacion"
            class="block px-3 py-2 rounded-lg font-medium transition
        {{ request()->is('ubicacion') ? 'bg-gray-800 text-white' : 'hover:bg-cyan-600 hover:text-white' }}">
            📍 Ubicación
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