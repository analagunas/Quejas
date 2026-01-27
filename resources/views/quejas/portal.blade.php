<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Quejas | Restaurante El Cardenal</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100 min-h-screen flex items-center justify-center">

    <div class="bg-white rounded-2xl shadow-xl p-10 w-full max-w-3xl text-center">

        <img src="{{ asset('images/logo.png') }}" class="h-20 mx-auto mb-6">

        <h1 class="text-3xl font-bold text-red-600 mb-2">
            Sistema de Quejas
        </h1>

        <p class="text-gray-600 mb-10">
            Restaurante El Cardenal
        </p>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">

            <!-- Nueva Queja -->
            <a href="{{ route('quejas.create') }}"
                class="bg-red-600 hover:bg-red-700 text-white rounded-xl p-8 shadow-lg transition transform hover:-translate-y-1">
                <div class="text-5xl mb-4">📝</div>
                <h2 class="text-xl font-bold">Nueva Queja</h2>
                <p class="text-sm mt-2 opacity-90">
                    Registrar una queja o comentario
                </p>
            </a>

            <!-- Revisar Quejas -->
            <a href="{{ route('dashboard') }}"
                class="bg-red-600 hover:bg-red-700 text-white rounded-xl p-8 shadow-lg transition transform hover:-translate-y-1">
                <div class="text-5xl mb-4">🔒</div>
                <h2 class="text-xl font-bold">Revisar Quejas</h2>
                <p class="text-sm mt-2 opacity-90">
                    Acceso exclusivo para personal autorizado
                </p>
            </a>

            <a href="{{ route('quejas.tracking.form') }}"
                class="bg-red-600 hover:bg-red-700 text-white rounded-xl p-8 shadow hover:bg-red-50 transition">
                <div class="text-5xl mb-4">🔍</div>
                <h2 class="text-xl font-bold">Ver seguimiento</h2>
                <p class="text-sm mt-2">
                    Consulta el estado de tu queja con tu folio
                </p>
            </a>


        </div>

    </div>

</body>

</html>