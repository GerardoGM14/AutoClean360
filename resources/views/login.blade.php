<!DOCTYPE html>
<html lang="es">
<link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>


<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Autoclean360</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/tsparticles@2/tsparticles.bundle.min.js"></script>
</head>

<body class="relative min-h-screen flex items-center justify-center bg-white overflow-hidden">

    <!-- Fondo con partículas -->
    <div id="tsparticles" class="absolute inset-0 -z-10"></div>

    <!-- Contenedor principal -->
    <div class="bg-white shadow-2xl rounded-3xl w-full max-w-5xl flex overflow-hidden border border-gray-100">

        <!-- Ilustración izquierda -->
        <div class="w-1/2 hidden md:flex items-center justify-center bg-gradient-to-br from-[#e0f7ff] to-[#f8fcff] p-6">
            <img
                src="https://cdn3d.iconscout.com/3d/premium/thumb/inicio-de-sesion-seguridad-9428486-7678626.png?f=webp"
                alt="Login Illustration"
                class="w-full max-w-md transition-transform duration-300 hover:scale-105">
        </div>



        <!-- Formulario derecho -->
        <div class="w-full md:w-1/2 p-10 flex flex-col justify-center">
            <h1 class="text-2xl font-bold text-gray-800 mb-1">¡Bienvenido!</h1>
            <p class="text-sm text-gray-500 mb-6">Inicia sesión para acceder a Autoclean360</p>

            <form id="login-form" class="space-y-5">
                <input type="email" id="email" placeholder="Correo electrónico" class="w-full p-3 border border-gray-300 rounded-md focus:ring-2 focus:ring-cyan-500 outline-none" />
                <input type="password" id="password" placeholder="Contraseña" class="w-full p-3 border border-gray-300 rounded-md focus:ring-2 focus:ring-cyan-500 outline-none" />

                <div class="flex justify-between text-sm text-cyan-600">
                    <a href="#" class="hover:underline">¿Olvidaste tu contraseña?</a>
                </div>

                <button type="submit" class="w-full bg-cyan-500 hover:bg-cyan-600 text-white p-3 rounded-md font-semibold transition">
                    Iniciar sesión
                </button>
            </form>

            <!-- Otras opciones -->
            <!-- Sección de redes sociales actualizada -->
            <div class="my-6 text-center text-gray-400 text-sm">o inicia sesión con</div>
            <div class="flex justify-center space-x-4">
                <a href="#" title="Google Login" class="border border-gray-300 rounded-full p-2 w-10 h-10 flex items-center justify-center hover:bg-red-50">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/c/c1/Google_%22G%22_logo.svg/2048px-Google_%22G%22_logo.svg.png" alt="Google" class="w-5 h-5">
                </a>
                <a href="#" title="GitHub Login" class="border border-gray-300 rounded-full p-2 w-10 h-10 flex items-center justify-center hover:bg-gray-100">
                    <img src="https://github.githubassets.com/assets/GitHub-Mark-ea2971cee799.png" alt="GitHub" class="w-5 h-5">
                </a>
                <a href="#" title="Facebook Login" class="border border-gray-300 rounded-full p-2 w-10 h-10 flex items-center justify-center hover:bg-blue-50">
                    <img src="https://www.facebook.com/images/fb_icon_325x325.png" alt="Facebook" class="w-5 h-5">
                </a>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="absolute bottom-4 text-center w-full text-xs text-gray-400">
        © 2025 Gerardo Gonzalez
    </footer>

    <!-- Script de partículas -->
    <script>
        tsParticles.load("tsparticles", {
            background: {
                color: "#ffffff"
            },
            particles: {
                number: {
                    value: 70
                },
                color: {
                    value: "#00bcd4"
                },
                size: {
                    value: 2,
                    random: true
                },
                move: {
                    enable: true,
                    speed: 2.5
                },
                opacity: {
                    value: 1
                },
                links: {    
                    enable: true,
                    color: "#00bcd4",
                    opacity: 0.55
                }
            }
        });
    </script>

</body>

</html>