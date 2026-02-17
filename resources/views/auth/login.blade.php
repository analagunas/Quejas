<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Quejas Login | Restaurante El Cardenal</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen bg-gradient-to-br from-gray-100 via-white to-gray-200 flex items-center justify-center">

    <div class="w-full max-w-md px-6">

        {{-- BOTON REGRESAR --}}
        <div class="flex justify-end mb-4">
            <a href="{{ route('portal') }}"
                class="text-sm text-gray-500 hover:text-red-600 transition flex items-center gap-1">
                ← Panel principal
            </a>
        </div>

        {{-- CARD LOGIN --}}
        <div class="bg-white rounded-2xl shadow-2xl p-8">

            {{-- LOGO --}}
            <div class="text-center mb-6">
                <img src="{{ asset('images/logo.png') }}"
                    class="h-16 mx-auto mb-4">
                <h1 class="text-2xl font-bold text-red-600">
                    Iniciar sesión
                </h1>
                <p class="text-sm text-gray-500">
                    Acceso al panel de administración
                </p>
            </div>

            {{-- STATUS --}}
            @if(session('status'))
            <div class="mb-4 text-sm text-green-600 text-center">
                {{ session('status') }}
            </div>
            @endif

            {{-- FORM --}}
            <form method="POST" action="{{ route('login') }}" class="space-y-5">
                @csrf

                {{-- EMAIL --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Correo electrónico
                    </label>

                    <input type="email"
                        name="email"
                        value="{{ old('email') }}"
                        required
                        class="w-full rounded-lg border-gray-300 focus:border-red-500 focus:ring-red-500">

                    @error('email')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- PASSWORD --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Contraseña
                    </label>

                    <input type="password"
                        name="password"
                        required
                        class="w-full rounded-lg border-gray-300 focus:border-red-500 focus:ring-red-500">

                    @error('password')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- BOTON --}}
                <button
                    class="w-full bg-red-600 hover:bg-red-700 text-white font-semibold py-3 rounded-lg shadow transition">
                    Iniciar sesión
                </button>

            </form>

        </div>

        {{-- FOOTER --}}
        <p class="text-center text-xs text-gray-400 mt-6">
            © {{ date('Y') }} Restaurante El Cardenal
        </p>

    </div>

</body>

</html>