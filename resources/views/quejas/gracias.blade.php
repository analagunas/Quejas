@extends('layouts.public')

@section('content')
<div class="py-16">
    <div class="max-w-xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white shadow rounded-lg p-8 text-center">

            {{-- Ícono --}}
            <div class="flex justify-center mb-6">
                <svg xmlns="http://www.w3.org/2000/svg"
                    class="h-16 w-16 text-green-500"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M5 13l4 4L19 7" />
                </svg>
            </div>

            {{-- Mensaje --}}
            <h2 class="text-2xl font-bold text-gray-800 mb-4">
                ¡Gracias por compartir tu experiencia!
            </h2>

            <p class="text-gray-600 mb-6">
                Tu queja ha sido registrada correctamente.<br>
                La información será tratada de manera
                <strong>confidencial</strong> por el área correspondiente.
            </p>

            <p class="text-sm text-gray-500 mb-8">
                Si proporcionaste datos de contacto, podríamos comunicarnos
                contigo para dar seguimiento.
            </p>

            <p class="mt-4">
                Tu folio de seguimiento es:
            </p>

            <p class="text-3xl font-mono font-bold text-red-600 mt-2">
                {{ session('folio') }}
            </p>

            <br>

            {{-- Botón --}}
            <a href="{{ url('/') }}"
                class="inline-block bg-red-600 text-white px-6 py-3 rounded-lg font-semibold hover:bg-red-700 transition">
                Regresar al inicio
            </a>

        </div>
    </div>
</div>
@endsection