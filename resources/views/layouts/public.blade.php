<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'NOM035') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased bg-gray-100">

    <!-- Header público -->
    <header class="bg-red-600">
        <div class="max-w-7xl mx-auto px-4 py-4 flex justify-between items-center">

            <!-- Logo + Nombre -->
            <div class="flex items-center gap-3 ">

                <h1 class="text-3xl font-bold text-white">
                    {{ config('app.name') }}
                </h1>
            </div>

        </div>
    </header>


    <main>
        @yield('content')
    </main>


</body>

</html>