@extends('layouts.public')

@section('content')
<div class="py-12">
    <div class="max-w-3xl mx-auto bg-white p-8 rounded shadow">

        <h2 class="text-2xl font-bold text-center mb-2">
            Buzón de Quejas y Sugerencias
        </h2>

        <p class="text-center text-gray-600 mb-6">
            La información proporcionada es confidencial.
        </p>

        <form method="POST" action="{{ route('quejas.store') }}" class="space-y-6">
            @csrf

            {{-- Tipo --}}
            <div>
                <label class="font-semibold">¿Desea enviar la queja de forma anónima?</label>
                <div class="mt-2 flex gap-6">
                    <label>
                        <input type="radio" name="es_anonima" value="1" checked>
                        Sí
                    </label>
                    <label>
                        <input type="radio" name="es_anonima" value="0">
                        No
                    </label>
                </div>
            </div>

            {{-- Datos personales --}}
            <div id="datos-personales" class="space-y-4 hidden">
                <input type="text" name="nombre" placeholder="Nombre(s)" class="input">
                <input type="text" name="apellido_paterno" placeholder="Apellido paterno" class="input">
                <input type="text" name="apellido_materno" placeholder="Apellido materno" class="input">
                <input type="text" name="telefono" placeholder="Teléfono" class="input">
                <input type="email" name="correo" placeholder="Correo electrónico" class="input">
                <input type="text" name="puesto" placeholder="Puesto de trabajo" class="input">
            </div>

            <div class="mt-6">
                <label class="block font-medium text-gray-700 mb-1">
                    Unidad de adscripción <span class="text-red-500">*</span>
                </label>
                <p class="text-sm text-gray-500 mb-2">
                    Seleccione la unidad a la que pertenece para canalizar adecuadamente la queja.
                </p>

                <select name="unidad" required class="input">
                    <option value="">Seleccione su unidad</option>
                    @foreach([
                    'Palma',
                    'Hillton',
                    'Lomas',
                    'San Ángel',
                    'Dakota',
                    'Tacuba',
                    'El Rancho y La Viga (JABG)',
                    'B-Gari',
                    'Estacionamientos Pizarro',
                    'Lavandería'
                    ] as $unidad)
                    <option value="{{ $unidad }}">{{ $unidad }}</option>
                    @endforeach
                </select>
            </div>

            {{-- Tema --}}
            <div>
                <label class="font-semibold">Tema de la queja</label>
                <div class="grid grid-cols-2 gap-2 mt-2">
                    @foreach([
                    'Ambiente de trabajo',
                    'Jornadas de trabajo extensas',
                    'Violencia laboral',
                    'Cargas de trabajo',
                    'Liderazgo',
                    'Otros'
                    ] as $tema)
                    <label>
                        <input type="checkbox" name="temas[]" value="{{ $tema }}">
                        {{ $tema }}
                    </label>
                    @endforeach
                </div>
            </div>

            {{-- ===================== --}}
            {{-- Desarrollo de la queja --}}
            {{-- ===================== --}}

            <div class="space-y-5">

                <div>
                    <label class="block font-medium text-gray-700 mb-1">
                        Descripción de la situación <span class="text-red-500">*</span>
                    </label>
                    <p class="text-sm text-gray-500 mb-2">
                        Explique de manera clara y detallada la situación que desea reportar.
                    </p>
                    <textarea
                        name="situacion"
                        required
                        rows="4"
                        class="input"
                        placeholder="Ejemplo: Desde hace algunas semanas se presentan conductas inapropiadas en el área..."></textarea>
                </div>

                <div>
                    <label class="block font-medium text-gray-700 mb-1">
                        Impacto en su trabajo <span class="text-red-500">*</span>
                    </label>
                    <p class="text-sm text-gray-500 mb-2">
                        Indique cómo esta situación afecta su desempeño, bienestar o ambiente laboral.
                    </p>
                    <textarea
                        name="impacto"
                        required
                        rows="3"
                        class="input"
                        placeholder="Ejemplo: Dificulta la concentración, genera estrés o afecta la productividad..."></textarea>
                </div>

                <div>
                    <label class="block font-medium text-gray-700 mb-1">
                        Propuesta de mejora <span class="text-red-500">*</span>
                    </label>
                    <p class="text-sm text-gray-500 mb-2">
                        Si lo desea, sugiera posibles acciones o soluciones.
                    </p>
                    <textarea
                        name="mejora"
                        required
                        rows="3"
                        class="input"
                        placeholder="Ejemplo: Capacitación, mediación, ajustes en procesos..."></textarea>
                </div>

                <div>
                    <label class="block font-medium text-gray-700 mb-1">
                        Comentarios adicionales
                    </label>
                    <p class="text-sm text-gray-500 mb-2">
                        Información adicional que considere relevante (opcional).
                    </p>
                    <textarea
                        name="comentarios"
                        rows="2"
                        class="input"
                        placeholder="Comentarios opcionales"></textarea>
                </div>

            </div>

            {{-- ===================== --}}
            {{-- Unidad --}}
            {{-- ===================== --}}



            {{-- Enviar --}}
            <div class="text-center pt-4">
                <button class="bg-red-600 text-white px-6 py-3 rounded font-semibold hover:bg-red-700">
                    Enviar queja
                </button>
            </div>

        </form>
    </div>
</div>

{{-- Toggle --}}
<script>
    const radios = document.querySelectorAll('input[name="es_anonima"]');
    const datosPersonales = document.getElementById('datos-personales');

    radios.forEach(radio => {
        radio.addEventListener('change', function() {
            if (this.value === '0') {
                datosPersonales.classList.remove('hidden');
            } else {
                datosPersonales.classList.add('hidden');

                // Limpia los campos si vuelve a anónima
                datosPersonales.querySelectorAll('input').forEach(input => {
                    input.value = '';
                });
            }
        });
    });
</script>

@endsection