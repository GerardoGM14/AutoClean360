<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>AutoClean360</title>
    @vite('resources/css/app.css')
    @vite('resources/js/app.js') <!-- Debe estar este -->
    <script src="//unpkg.com/alpinejs" defer></script>
</head>
<body class="bg-gray-100">
    @yield('content')
</body>
</html>
