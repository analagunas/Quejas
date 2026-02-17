@extends('layouts.public')

@section('header')
Dashboard de Quejas
@endsection

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

<div class="py-12 max-w-7xl mx-auto space-y-8">

    {{-- TOTAL --}}
    <div class="bg-white p-6 rounded shadow text-center">
        <h3 class="text-lg font-semibold">Total de quejas</h3>
        <p class="text-4xl font-bold text-red-600">
            {{ $total }}
        </p>
    </div>

    {{-- POR ESTATUS --}}
    <div class="bg-white p-6 rounded shadow">
        <h3 class="text-lg font-semibold mb-4">
            Quejas por estatus
        </h3>

        @php
        $labels = [
        'nueva' => 'Nueva',
        'en_proceso' => 'En proceso',
        'cerrada' => 'Cerrada',
        'resuelta' => 'Resuelta'
        ];

        $colors = [
        'nueva' => 'text-blue-600',
        'en_proceso' => 'text-yellow-600',
        'cerrada' => 'text-gray-600',
        'resuelta' => 'text-green-600'
        ];
        @endphp

        @foreach($byStatus as $status => $count)
        <div class="flex justify-between border-b py-2">
            <span class="{{ $colors[strtolower($status)] ?? '' }}">
                {{ $labels[strtolower($status)] ?? ucfirst($status) }}
            </span>

            <span class="font-semibold">
                {{ $count }}
            </span>
        </div>
        @endforeach
    </div>

    {{-- POR UNIDAD --}}
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

    {{-- POR TEMA --}}
    <div class="bg-white p-6 rounded shadow">
        <h3 class="text-lg font-semibold mb-4">
            Quejas por tema
        </h3>

        @foreach($byTheme as $theme => $count)
        <div class="flex justify-between border-b py-2">
            <span>{{ $theme }}</span>
            <span class="font-semibold">{{ $count }}</span>
        </div>
        @endforeach
    </div>

    {{-- TABLA LISTADO --}}
    <div class="bg-white p-6 rounded shadow">

        <h3 class="text-lg font-semibold mb-4">
            Listado de quejas
        </h3>

        <div class="overflow-x-auto">

            <table class="w-full text-sm">

                <thead class="border-b bg-gray-50">
                    <tr class="text-left">
                        <th class="p-2">Folio</th>
                        <th class="p-2">Unidad</th>
                        <th class="p-2">Tema</th>
                        <th class="p-2">Estatus</th>
                        <th class="p-2">Fecha</th>
                        <th class="p-2">Acciones</th>
                    </tr>
                </thead>

                <tbody>

                    @forelse($complaints as $complaint)

                    <tr class="border-b hover:bg-gray-50">

                        <td class="p-2 font-semibold">
                            {{ $complaint->folio }}
                        </td>

                        <td class="p-2">
                            {{ $complaint->unidad }}
                        </td>

                        <td class="p-2">
                            {{ $complaint->topic?->name ?? 'Sin tema' }}
                        </td>

                        <td class="p-2">

                            <span class="px-2 py-1 rounded text-xs font-semibold
                                @if($complaint->status === 'Nueva') bg-blue-100 text-blue-800
                                @elseif($complaint->status === 'En proceso') bg-yellow-100 text-yellow-800
                                @elseif($complaint->status === 'Resuelta') bg-green-100 text-green-800
                                @else bg-gray-100 text-gray-800
                                @endif">

                                {{ $complaint->status }}

                            </span>

                        </td>

                        <td class="p-2 text-gray-600 text-xs">
                            {{ $complaint->created_at->format('d/m/Y') }}
                        </td>

                        <td class="p-2">

                            <a href="{{ route('quejas.show', $complaint->id) }}"
                                class="bg-blue-600 hover:bg-blue-700 text-white px-3 py-1 rounded text-xs font-semibold">

                                Ver detalle

                            </a>

                        </td>

                    </tr>

                    @empty

                    <tr>
                        <td colspan="6" class="text-center p-4 text-gray-500">
                            No hay quejas registradas.
                        </td>
                    </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>

@endsection