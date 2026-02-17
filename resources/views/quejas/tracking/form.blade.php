@extends('layouts.public')

@section('content')

<br>

<div class="flex justify-end">
    <a href="{{ route('portal') }}"
        style="background-color: #CD1719; color: white; font-weight: 600; padding: 0.5rem 1.5rem; border-radius: 0.5rem; box-shadow: 0 2px 4px rgba(0,0,0,0.2); transition: background-color 0.3s; text-decoration: none;"
        onmouseover="this.style.backgroundColor='#A01214';"
        onmouseout="this.style.backgroundColor='#CD1719';"
        class="inline-flex items-center gap-2">

        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none"
            viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M15 19l-7-7 7-7" />
        </svg>

        Regresar al Panel Principal
    </a>
</div>


<br>

<div class="max-w-3xl mx-auto bg-white p-8 rounded shadow">

    <h2 class="text-2xl font-bold text-red-600 mb-6 text-center">
        Seguimiento de Queja
    </h2>

    {{-- BUSCAR FOLIO --}}
    <form method="POST" action="{{ route('quejas.tracking.search') }}" class="mb-6">
        @csrf

        <input type="text"
            name="folio"
            placeholder="Ingresa tu folio (ej. QJ-GIZSTH)"
            class="w-full border rounded p-3 mb-3"
            required>
        <br>
        <br>

        <button class="bg-red-600 text-white px-6 py-2 rounded hover:bg-red-700 w-full">
            Buscar
        </button>
    </form>

    {{-- RESULTADO --}}
    @isset($complaint)

    <div class="border-t pt-4">

        <h3 class="font-bold mb-3">
            Historial del folio: {{ $complaint->folio }}
        </h3>

        @forelse($complaint->statusHistory as $history)

        <div class="border rounded p-3 mb-3 bg-gray-50">

            {{-- QUIEN COMENTA --}}
            <p class="text-sm font-semibold">
                @if($history->user_id == 1)
                Usuario
                @else
                Administración
                @endif
            </p>

            <p>
                <strong>Estado:</strong>
                {{ $history->old_status }} → {{ $history->new_status }}
            </p>

            <p>
                <strong>Comentario:</strong>
                {{ $history->comment }}
            </p>

            <p class="text-sm text-gray-500">
                Fecha: {{ $history->created_at->format('d/m/Y H:i') }}
            </p>

            {{-- SOLO RESPONDER AL ÚLTIMO --}}
            @if($loop->last)

            <form method="POST"
                action="{{ route('quejas.tracking.reply', $complaint->id) }}"
                class="mt-3">

                @csrf

                <textarea
                    name="reply"
                    class="w-full border rounded p-2 text-sm"
                    placeholder="Responder al último comentario..."
                    required></textarea>

                <button
                    class="bg-blue-600 text-white px-4 py-2 rounded text-sm mt-2 hover:bg-blue-700">
                    Enviar respuesta
                </button>

            </form>

            @endif

        </div>

        @empty
        <p class="text-gray-500">No hay movimientos registrados.</p>
        @endforelse

    </div>

    @elseif(request()->isMethod('post'))

    <p class="text-red-600 text-center">
        ❌ Folio no encontrado.
    </p>

    @endisset

</div>

@endsection