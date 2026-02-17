<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Quejas | Restaurante El Cardenal</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen bg-gradient-to-br from-gray-100 via-white to-gray-200 flex items-center justify-center">

    <div class="w-full max-w-6xl px-6">

        {{-- CARD PRINCIPAL --}}
        <div class="bg-white rounded-3xl shadow-2xl p-12">

            {{-- HEADER --}}
            <div class="text-center mb-12">

                <img src="{{ asset('images/logo.png') }}"
                    class="h-24 mx-auto mb-6">

                <h1 class="text-4xl font-bold text-red-600 mb-2">
                    Sistema de Quejas
                </h1>

                <p class="text-gray-500 text-lg">
                    Restaurante El Cardenal
                </p>

            </div>

            {{-- BOTONES EN FILA --}}
            <div class="flex flex-col md:flex-row gap-8 justify-center items-stretch">

                {{-- NUEVA QUEJA --}}
                <a href="{{ route('quejas.create') }}"
                    class="w-full md:w-72 group bg-white border border-gray-200 hover:border-red-400 rounded-2xl p-8 shadow hover:shadow-xl transition duration-300 transform hover:-translate-y-1 text-center">

                    <div class="text-4xl mb-4 transition group-hover:scale-110">
                        📝
                    </div>

                    <h2 class="text-xl font-bold text-gray-800 group-hover:text-red-600">
                        Nueva Queja
                    </h2>

                    <p class="text-sm text-gray-500 mt-2">
                        Registrar una queja o comentario
                    </p>

                </a>

                {{-- DASHBOARD --}}
                <a href="{{ route('dashboard') }}"
                    class="w-full md:w-72 group bg-white border border-gray-200 hover:border-red-400 rounded-2xl p-8 shadow hover:shadow-xl transition duration-300 transform hover:-translate-y-1 text-center">

                    <div class="text-4xl mb-4 transition group-hover:scale-110">
                        🔒
                    </div>

                    <h2 class="text-xl font-bold text-gray-800 group-hover:text-red-600">
                        Revisar Quejas
                    </h2>

                    <p class="text-sm text-gray-500 mt-2">
                        Acceso exclusivo para personal autorizado
                    </p>

                </a>

                {{-- SEGUIMIENTO --}}
                <a href="{{ route('quejas.tracking.form') }}"
                    class="w-full md:w-72 group bg-white border border-gray-200 hover:border-red-400 rounded-2xl p-8 shadow hover:shadow-xl transition duration-300 transform hover:-translate-y-1 text-center">

                    <div class="text-4xl mb-4 transition group-hover:scale-110">
                        🔍
                    </div>

                    <h2 class="text-xl font-bold text-gray-800 group-hover:text-red-600">
                        Seguimiento
                    </h2>

                    <p class="text-sm text-gray-500 mt-2">
                        Consulta el estado de tu queja con tu folio
                    </p>

                </a>

            </div>

        </div>

        {{-- FOOTER --}}
        <div class="text-center mt-6 text-xs text-gray-400">
            © {{ date('Y') }} Restaurante El Cardenal — Sistema Interno
        </div>

    </div>

</body>

</html>