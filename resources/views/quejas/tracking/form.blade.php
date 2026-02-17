@extends('layouts.public')

@section('content')

<div class="max-w-4xl mx-auto py-10 px-4">
    <br>
    {{-- HEADER --}}
    <div class="flex justify-between items-center mb-8">

        <h1 class="text-2xl font-bold text-gray-800">
            Seguimiento de Queja
        </h1>

        <a href="{{ route('portal') }}"
            class="bg-red-600 hover:bg-red-700 text-white font-semibold px-5 py-2 rounded-lg shadow inline-flex items-center gap-2 transition">

            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5"
                fill="none" viewBox="0 0 24 24" stroke="currentColor">

                <path stroke-linecap="round" stroke-linejoin="round"
                    stroke-width="2"
                    d="M15 19l-7-7 7-7" />

            </svg>

            Panel Principal
        </a>

    </div>

    {{-- CARD BUSQUEDA --}}
    <div class="bg-white rounded-xl shadow p-6 mb-6">

        <form method="POST"
            action="{{ route('quejas.tracking.search') }}"
            class="space-y-4">

            @csrf

            <input type="text"
                name="folio"
                placeholder="Ingresa tu folio (Ej. QJ-XXXX)"
                class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-red-500 focus:outline-none"
                required>

            <button
                class="w-full bg-red-600 hover:bg-red-700 text-white font-semibold py-3 rounded-lg shadow transition">
                Buscar Seguimiento
            </button>

        </form>

    </div>

    {{-- RESULTADO --}}
    @isset($complaint)

    {{-- SI ESTA RESUELTA --}}
    @if($complaint->status === 'Resuelta')
    <div class="bg-green-50 border border-green-200 text-green-700 p-4 rounded-lg mb-6 text-center">
        ✅ Esta queja ya fue resuelta. El seguimiento está cerrado.
    </div>
    @endif

    {{-- CARD HISTORIAL --}}
    <div class="bg-white rounded-xl shadow p-6">

        <h3 class="font-semibold text-lg text-gray-800 mb-6">
            Historial del folio: {{ $complaint->folio }}
        </h3>

        @forelse($complaint->statusHistory as $history)

        <div class="border-l-4 border-red-500 bg-gray-50 p-4 rounded mb-4">

            {{-- HEADER HISTORIAL --}}
            <div class="flex justify-between text-xs text-gray-500 mb-2">

                <span class="font-semibold text-gray-700">
                    @if($history->user_id == 1)
                    Usuario
                    @else
                    Administración
                    @endif
                </span>

                <span>
                    {{ $history->created_at->format('d/m/Y H:i') }}
                </span>

            </div>

            {{-- CAMBIO ESTATUS --}}
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

            {{-- COMENTARIO --}}
            @if($history->comment)
            <div class="mt-2 text-sm italic text-gray-700">
                "{{ $history->comment }}"
            </div>
            @endif

            {{-- RESPUESTA SOLO SI NO ESTA RESUELTA Y SOLO ULTIMO --}}
            @if($loop->last && $complaint->status !== 'Resuelta')

            <form method="POST"
                action="{{ route('quejas.tracking.reply', $complaint->id) }}"
                class="mt-4">

                @csrf

                <textarea
                    name="reply"
                    rows="3"
                    class="w-full border border-gray-300 rounded-lg p-3 text-sm focus:ring-2 focus:ring-red-500 focus:outline-none"
                    placeholder="Responder al último comentario..."
                    required></textarea>

                <button
                    class="bg-red-600 hover:bg-red-700 text-white font-semibold px-5 py-2 rounded-lg text-sm mt-3 shadow transition">
                    Enviar respuesta
                </button>

            </form>

            @endif

        </div>

        @empty
        <p class="text-gray-500 text-center">
            No hay movimientos registrados.
        </p>
        @endforelse

    </div>

    @elseif(request()->isMethod('post'))

    <div id="errorFolio"
        class="bg-red-50 border border-red-200 text-red-600 p-4 rounded-lg text-center transition-opacity duration-500">
        ❌ Folio no encontrado.
    </div>

    @endisset

</div>

<script>
    setTimeout(() => {
        let error = document.getElementById('errorFolio');
        if (error) {
            error.style.opacity = '0';
            setTimeout(() => error.remove(), 500);
        }
    }, 3000);
</script>


@endsection