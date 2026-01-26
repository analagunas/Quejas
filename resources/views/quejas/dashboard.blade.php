@extends('layouts.public')

@section('header')
Dashboard de Quejas
@endsection

@section('content')

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
                    <td>{{ implode(', ', json_decode($complaint->temas, true)) }}</td>

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
                        <form method="POST" action="{{ route('quejas.update-status', $complaint) }}">
                            @csrf
                            @method('PATCH')

                            <select name="status" class="border rounded px-2 py-1">
                                <option value="nueva" @selected($complaint->status === 'nueva')>
                                    Nueva
                                </option>
                                <option value="en_proceso" @selected($complaint->status === 'en_proceso')>
                                    En proceso
                                </option>
                                <option value="resuelta" @selected($complaint->status === 'resuelta')>
                                    Resuelta
                                </option>
                            </select>

                            <button class="ml-2 bg-blue-600 text-white px-3 py-1 rounded">
                                Guardar
                            </button>
                        </form>

                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>


</div>

@endsection