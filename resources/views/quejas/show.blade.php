@extends('layouts.public')

@section('content')

<div class="max-w-5xl mx-auto py-8 px-4">

    <br>

    {{-- HEADER --}}
    <div class="flex justify-between items-center mb-6">

        <h1 class="text-2xl font-bold text-gray-800">
            Detalle de Queja
        </h1>

        <a href="{{ route('dashboard') }}"
            class="bg-red-600 hover:bg-red-700 text-white font-semibold px-5 py-2 rounded-lg shadow inline-flex items-center gap-2 transition">

            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5"
                fill="none" viewBox="0 0 24 24" stroke="currentColor">

                <path stroke-linecap="round" stroke-linejoin="round"
                    stroke-width="2"
                    d="M15 19l-7-7 7-7" />

            </svg>

            Regresar
        </a>

    </div>

    {{-- MENSAJES --}}
    @if(session('success'))
    <div class="bg-green-50 border border-green-200 text-green-700 p-4 rounded-lg mb-6">
        {{ session('success') }}
    </div>
    @endif

    @if(session('error'))
    <div class="bg-red-50 border border-red-200 text-red-700 p-4 rounded-lg mb-6">
        {{ session('error') }}
    </div>
    @endif

    {{-- CARD DETALLE --}}
    <div class="bg-white rounded-xl shadow p-6 mb-6">

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 text-sm">

            <div>
                <p class="text-gray-500">Unidad</p>
                <p class="font-semibold text-gray-800">
                    {{ $complaint->unidad }}
                </p>
            </div>

            <div>
                <p class="text-gray-500">Tema</p>
                <p class="font-semibold text-gray-800">
                    {{ $complaint->topic?->name ?? 'Sin tema' }}
                </p>
            </div>

            <div>
                <p class="text-gray-500">Estatus actual</p>

                <span class="inline-block px-3 py-1 rounded-full text-xs font-semibold
                    @if($complaint->status === 'Nueva') bg-blue-100 text-blue-700
                    @elseif($complaint->status === 'En proceso') bg-yellow-100 text-yellow-700
                    @elseif($complaint->status === 'Resuelta') bg-green-100 text-green-700
                    @else bg-gray-100 text-gray-700
                    @endif">

                    {{ $complaint->status }}

                </span>
            </div>

        </div>

        {{-- TEXTOS --}}
        <div class="mt-6 space-y-4 text-sm">

            <div>
                <p class="text-gray-500">Situación</p>
                <p class="text-gray-800">{{ $complaint->situacion }}</p>
            </div>

            <div>
                <p class="text-gray-500">Impacto</p>
                <p class="text-gray-800">{{ $complaint->impacto }}</p>
            </div>

            <div>
                <p class="text-gray-500">Mejora</p>
                <p class="text-gray-800">{{ $complaint->mejora }}</p>
            </div>

            <div>
                <p class="text-gray-500">Comentarios adicionales</p>
                <p class="text-gray-800">{{ $complaint->comentarios }}</p>
            </div>

        </div>

    </div>

    {{-- SI ESTA RESUELTA --}}
    @if($complaint->status === 'Resuelta')

    <div class="bg-green-50 border border-green-200 text-green-700 p-4 rounded-lg mb-6">
        ✅ Esta queja ya fue resuelta y no permite más cambios.
    </div>

    @endif

    {{-- FORM ADMIN SOLO SI NO ESTA RESUELTA --}}
    @if($complaint->status !== 'Resuelta')

    <div class="bg-white rounded-xl shadow p-6 mb-6">

        <h3 class="font-semibold text-lg mb-4 text-gray-800">
            Actualizar Estatus
        </h3>

        <form method="POST"
            action="{{ route('quejas.update-status', $complaint) }}"
            class="space-y-4">

            @csrf
            @method('PATCH')

            <select name="status"
                class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-red-500 focus:outline-none"
                required>

                <option value="Nueva" @selected($complaint->status == 'Nueva')>Nueva</option>
                <option value="En proceso" @selected($complaint->status == 'En proceso')>En proceso</option>
                <option value="Resuelta">Resuelta</option>

            </select>

            <textarea
                name="comment"
                rows="3"
                class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-red-500 focus:outline-none"
                placeholder="Agregar comentario..."
                required></textarea>

            <button
                class="bg-red-600 hover:bg-red-700 text-white font-semibold px-6 py-2 rounded-lg shadow transition">
                Guardar cambios
            </button>

        </form>

    </div>

    @endif

    {{-- HISTORIAL --}}
    @if($complaint->statusHistory->count())

    <div class="bg-white rounded-xl shadow p-6">

        <h3 class="text-lg font-semibold mb-4 text-gray-800">
            Historial de cambios
        </h3>

        <div class="space-y-4">

            @foreach($complaint->statusHistory as $history)

            <div class="border-l-4 border-red-500 bg-gray-50 p-4 rounded">

                <div class="flex justify-between text-xs text-gray-500 mb-2">
                    <span class="font-semibold text-gray-700">
                        {{ $history->user->name ?? 'Sistema' }}
                    </span>

                    <span>
                        {{ $history->created_at->format('d/m/Y H:i') }}
                    </span>
                </div>

                <div class="text-sm text-gray-800">
                    Cambio de
                    <span class="font-semibold text-blue-600">
                        {{ $history->old_status }}
                    </span>
                    a
                    <span class="font-semibold text-green-600">
                        {{ $history->new_status }}
                    </span>
                </div>

                @if($history->comment)
                <div class="mt-2 text-sm italic text-gray-700">
                    "{{ $history->comment }}"
                </div>
                @endif

            </div>

            @endforeach

        </div>

    </div>

    @endif

</div>

@endsection