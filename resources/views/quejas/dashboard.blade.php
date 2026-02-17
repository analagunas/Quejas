@extends('layouts.public')

@section('header')
Dashboard de Quejas
@endsection

@section('content')

<div class="max-w-7xl mx-auto px-4 py-8">
    <br>
    {{-- HEADER --}}
    <div class="flex justify-between items-center mb-8">

        <h1 class="text-2xl font-bold text-gray-800">
            Dashboard de Quejas
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

    {{-- KPI CARDS --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">

        {{-- TOTAL --}}
        <div class="bg-white rounded-xl shadow p-6">
            <p class="text-sm text-gray-500">Total de Quejas</p>
            <p class="text-3xl font-bold text-red-600 mt-1">
                {{ $total }}
            </p>
        </div>

        {{-- NUEVAS --}}
        <div class="bg-white rounded-xl shadow p-6">
            <p class="text-sm text-gray-500">Nuevas</p>
            <p class="text-3xl font-bold text-blue-600 mt-1">
                {{ $byStatus['Nueva'] ?? 0 }}
            </p>
        </div>

        {{-- EN PROCESO --}}
        <div class="bg-white rounded-xl shadow p-6">
            <p class="text-sm text-gray-500">En proceso</p>
            <p class="text-3xl font-bold text-yellow-600 mt-1">
                {{ $byStatus['En proceso'] ?? 0 }}
            </p>
        </div>

        {{-- RESUELTAS --}}
        <div class="bg-white rounded-xl shadow p-6">
            <p class="text-sm text-gray-500">Resueltas</p>
            <p class="text-3xl font-bold text-green-600 mt-1">
                {{ $byStatus['Resuelta'] ?? 0 }}
            </p>
        </div>

    </div>

    {{-- GRID DE LISTAS --}}
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">

        {{-- POR UNIDAD --}}
        <div class="bg-white rounded-xl shadow p-6">
            <h3 class="font-semibold text-gray-800 mb-4">
                Quejas por Unidad
            </h3>

            @foreach($byUnit as $unit => $count)
            <div class="flex justify-between border-b py-2 text-sm">
                <span class="text-gray-700">{{ $unit }}</span>
                <span class="font-semibold">{{ $count }}</span>
            </div>
            @endforeach
        </div>

        {{-- POR TEMA --}}
        <div class="bg-white rounded-xl shadow p-6">
            <h3 class="font-semibold text-gray-800 mb-4">
                Quejas por Tema
            </h3>

            @foreach($byTheme as $theme => $count)
            <div class="flex justify-between border-b py-2 text-sm">
                <span class="text-gray-700">{{ $theme }}</span>
                <span class="font-semibold">{{ $count }}</span>
            </div>
            @endforeach
        </div>

    </div>

    {{-- TABLA --}}
    <div class="bg-white rounded-xl shadow p-6">

        <h3 class="font-semibold text-gray-800 mb-6">
            Listado de Quejas
        </h3>

        <div class="overflow-x-auto">

            <table class="w-full text-sm">

                <thead>
                    <tr class="text-left text-gray-500 border-b">
                        <th class="pb-3">Folio</th>
                        <th class="pb-3">Unidad</th>
                        <th class="pb-3">Tema</th>
                        <th class="pb-3">Estatus</th>
                        <th class="pb-3">Fecha</th>
                        <th class="pb-3 text-right">Acciones</th>
                    </tr>
                </thead>

                <tbody>

                    @forelse($complaints as $complaint)

                    <tr class="border-b hover:bg-gray-50 transition">

                        <td class="py-3 font-semibold text-gray-800">
                            {{ $complaint->folio }}
                        </td>

                        <td class="py-3 text-gray-700">
                            {{ $complaint->unidad }}
                        </td>

                        <td class="py-3 text-gray-700">
                            {{ $complaint->topic?->name ?? 'Sin tema' }}
                        </td>

                        <td class="py-3">

                            <span class="px-3 py-1 rounded-full text-xs font-semibold
                                @if($complaint->status === 'Nueva') bg-blue-100 text-blue-700
                                @elseif($complaint->status === 'En proceso') bg-yellow-100 text-yellow-700
                                @elseif($complaint->status === 'Resuelta') bg-green-100 text-green-700
                                @else bg-gray-100 text-gray-700
                                @endif">

                                {{ $complaint->status }}

                            </span>

                        </td>

                        <td class="py-3 text-xs text-gray-500">
                            {{ $complaint->created_at->format('d/m/Y') }}
                        </td>

                        <td class="py-3 text-right">

                            <a href="{{ route('quejas.show', $complaint->id) }}"
                                class="inline-flex items-center bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg text-xs font-semibold shadow transition">

                                Ver detalle
                            </a>


                        </td>

                    </tr>

                    @empty

                    <tr>
                        <td colspan="6"
                            class="text-center py-6 text-gray-500">
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