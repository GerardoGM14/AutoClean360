<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Prueba Firebase</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-br from-gray-100 to-blue-100 min-h-screen flex items-center justify-center">
    <div class="bg-white/30 backdrop-blur-md p-8 rounded-2xl shadow-xl text-center">
        <h1 class="text-2xl font-bold mb-4 text-gray-800">🚀 Firebase Test</h1>
        <p class="text-gray-700 text-lg mb-2">{{ $data['mensaje'] ?? 'Sin datos' }}</p>
        <small class="text-gray-500">{{ $data['timestamp'] ?? '' }}</small>
    </div>
</body>
</html>
