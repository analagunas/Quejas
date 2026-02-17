@extends('layouts.public')

@section('content')

<br>

<div class="flex justify-end">
    <a href="{{ route('dashboard') }}"
        style="background-color: #CD1719; color: white; font-weight: 600; padding: 0.5rem 1.5rem; border-radius: 0.5rem; box-shadow: 0 2px 4px rgba(0,0,0,0.2); transition: background-color 0.3s; text-decoration: none;"
        onmouseover="this.style.backgroundColor='#A01214';"
        onmouseout="this.style.backgroundColor='#CD1719';"
        class="inline-flex items-center gap-2">

        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none"
            viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M15 19l-7-7 7-7" />
        </svg>

        Regresar al Dashboard
    </a>
</div>


<br>


<div class="max-w-3xl mx-auto bg-white p-6 rounded shadow">

    <h2 class="text-xl font-bold mb-4">Detalle de Queja</h2>

    <p><strong>Unidad:</strong> {{ $complaint->unidad }}</p>
    <p><strong>Tema:</strong> {{ $complaint->topic?->name }}</p>
    <p><strong>Estatus actual:</strong> {{ $complaint->status }}</p>
    <p><strong>Descripción:</strong> {{ $complaint->situacion }}</p>

    {{-- FORM ADMIN --}}
    <div class="mt-6 border-t pt-4">

        <h3 class="font-semibold mb-2">
            Cambiar estatus y agregar comentario
        </h3>

        <form method="POST"
            action="{{ route('quejas.update-status', $complaint) }}"
            class="space-y-3">

            @csrf
            @method('PATCH')

            <select name="status"
                class="w-full border rounded p-2"
                required>

                <option value="Nueva" @selected($complaint->status == 'Nueva')>Nueva</option>
                <option value="En proceso" @selected($complaint->status == 'En proceso')>En proceso</option>
                <option value="Resuelta">Resuelta</option>

            </select>

            <textarea
                name="comment"
                class="w-full border rounded p-2"
                placeholder="Comentario del cambio..."
                required></textarea>

            <button class="bg-red-600 text-white px-4 py-2 rounded">
                Guardar cambio
            </button>

        </form>

    </div>

    {{-- HISTORIAL --}}
    @if($complaint->statusHistory->count())

    <div class="mt-6 border-t pt-4">

        <h3 class="text-lg font-semibold mb-3">
            Historial de cambios
        </h3>

        @foreach($complaint->statusHistory as $history)

        <div class="bg-gray-50 p-3 rounded border mb-3">

            <div class="flex justify-between text-sm">
                <span class="font-semibold">
                    {{ $history->user->name ?? 'Sistema' }}
                </span>

                <span class="text-gray-500">
                    {{ $history->created_at->format('d/m/Y H:i') }}
                </span>
            </div>

            <div class="mt-2 text-sm">
                <strong>
                    {{ $history->old_status }}
                </strong>
                →
                <strong>
                    {{ $history->new_status }}
                </strong>
            </div>

            @if($history->comment)
            <div class="mt-2 italic text-sm text-gray-700">
                "{{ $history->comment }}"
            </div>
            @endif

        </div>

        @endforeach

    </div>

    @endif

</div>

@endsection