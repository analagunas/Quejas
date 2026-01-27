@extends('layouts.public')

@section('header')
Dashboard de Quejas
@endsection

@section('content')
<br>
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

<div class="py-12 max-w-7xl mx-auto space-y-8">

    {{-- ===================== --}}
    {{-- Total --}}
    {{-- ===================== --}}
    <div class="bg-white p-6 rounded shadow text-center">
        <h3 class="text-lg font-semibold">Total de quejas</h3>
        <p class="text-4xl font-bold text-red-600">{{ $total }}</p>
    </div>
    {{-- ===================== --}}
    {{-- Por estatus --}}
    {{-- ===================== --}}
    <div class="bg-white p-6 rounded shadow">
        <h3 class="text-lg font-semibold mb-4">
            Quejas por estatus
        </h3>

        @php
        $labels = [
        'nueva' => 'Nueva',
        'en_proceso' => 'En proceso',
        'cerrada' => 'Cerrada',
        ];

        $colors = [
        'nueva' => 'text-red-600',
        'en_proceso' => 'text-yellow-600',
        'cerrada' => 'text-green-600',
        ];
        @endphp

        @foreach($byStatus as $status => $count)
        <div class="flex justify-between border-b py-2">
            <span class="{{ $colors[$status] ?? '' }}">
                {{ $labels[$status] ?? ucfirst($status) }}
            </span>
            <span class="font-semibold">
                {{ $count }}
            </span>
        </div>
        @endforeach
    </div>


    {{-- ===================== --}}
    {{-- Quejas por unidad --}}
    {{-- ===================== --}}
    <div class="bg-white p-6 rounded shadow">
        <h3 class="text-lg font-semibold mb-4">
            Quejas por unidad
        </h3>

        @foreach($byUnit as $unit => $count)
        <div class="flex justify-between border-b py-2">
            <span>{{ $unit }}</span>
            <span class="font-semibold">{{ $count }}</span>
        </div>
        @endforeach
    </div>


    {{-- ===================== --}}
    {{-- Por tema --}}
    {{-- ===================== --}}
    <div class="bg-white p-6 rounded shadow">
        <h3 class="font-semibold text-lg mb-4">Quejas por tema</h3>

        @foreach($byTheme as $theme => $count)
        <div class="flex justify-between border-b py-2">
            <span>{{ $theme }}</span>
            <span class="font-semibold">{{ $count }}</span>
        </div>
        @endforeach
    </div>

    <div class="bg-white p-6 rounded shadow">
        <h3 class="font-semibold text-lg mb-4">
            Listado de quejas
        </h3>

        <table class="w-full text-sm">
            <thead class="border-b">
                <tr class="text-left">
                    <th>Unidad</th>
                    <th>Tema</th>
                    <th>Estatus</th>
                    <th>Actualizar</th>
                </tr>
            </thead>

            <tbody>
                @foreach($complaints as $complaint)
                <tr class="border-b">
                    <td>{{ $complaint->unidad }}</td>
                    <td>{{ $complaint->topic?->name ?? 'Sin tema' }}</td>


                    <td>
                        <span class="px-2 py-1 rounded text-xs font-semibold
                        @if($complaint->status === 'Nueva') bg-blue-100 text-blue-800
                        @elseif($complaint->status === 'En proceso') bg-yellow-100 text-yellow-800
                        @else bg-green-100 text-green-800
                        @endif">
                            {{ $complaint->status }}
                        </span>
                    </td>

                    <td>
                        @if($complaint->status === 'Resuelta')
                        <span class="text-green-700 font-semibold">✔ Resuelta</span>
                        @else
                        <form method="POST" action="{{ route('quejas.update-status', $complaint) }}" class="space-y-2">
                            @csrf
                            @method('PATCH')

                            <select name="status" required class="border rounded p-1 w-full">
                                <option value="Nueva" @selected($complaint->status === 'Nueva')>Nueva</option>
                                <option value="En proceso" @selected($complaint->status === 'En proceso')>En proceso</option>
                                <option value="Resuelta">Resuelta</option>
                            </select>

                            <textarea
                                name="comment"
                                required
                                rows="2"
                                class="w-full border rounded p-2"
                                placeholder="Motivo del cambio de estatus..."></textarea>

                            <button class="bg-red-600 text-white px-2 py-1 rounded">
                                Guardar
                            </button>
                        </form>
                        @endif


                    </td>
                </tr>
                @if($complaint->statusHistory->count())
                <div class="mt-2 text-sm text-gray-600">
                    <strong>Historial:</strong>
                    <ul class="list-disc ml-5">
                        @foreach($complaint->statusHistory as $history)
                        <li>
                            <span class="font-semibold">{{ $history->user->name }}</span>
                            cambió de
                            <span class="text-blue-600">{{ $history->old_status }}</span>
                            a
                            <span class="text-green-600">{{ $history->new_status }}</span>
                            <br>
                            <em>"{{ $history->comment }}"</em>
                            <br>
                            <small>{{ $history->created_at->format('d/m/Y H:i') }}</small>
                        </li>
                        @endforeach
                    </ul>
                </div>
                @endif

                @endforeach
            </tbody>
        </table>
    </div>


</div>

@endsection