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
<div class="py-12">
    <div class="max-w-3xl mx-auto bg-white p-8 rounded shadow">

        <img src="{{ asset('images/logo.png') }}" alt="Logo" class="h-20 w-auto mx-auto mb-4">

        <h2 class="text-3xl font-bold text-red-600 mb-2 text-center">
            Buzón de Quejas y Sugerencias
        </h2>

        <p class="text-justify max-w-prose mx-auto">
            Agradecemos su visita a este medio, recuerde que esta hecho para usted y fue diseñado con el propósito de prevenir y/o corregir cualquier comportamiento que pueda generar algún riesgo psicosocial, violencia laboral, así como promover un entorno organizacional favorable.
            La información obtenida es TOTALMENTE CONFIDENCIAL Y PRIVADA, y será utilizada únicamente con el fin de dar solución a la queja o denuncia presentada. Bajo ninguna circunstancia se generarán represalias a aquellos trabajadores que de buena fe presenten una queja o denuncia relacionadas a prácticas opuestas al entorno organizacional favorable o actos de violencia laboral.
            Así mismo, agradecemos que nos proporcione la siguiente información para actuar de manera inmediata.
        </p>
        <br>

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
            </div>
            <label class="block font-medium text-gray-700 mb-1">
                Puesto de trabajo <span class="text-red-500">*</span>
            </label>
            <p class="text-sm text-gray-500 mb-2">
                Seleccione su puesto para canalizar adecuadamente la queja.
            </p>
            <select name="puesto" class="input w-full">

                <option value="">Seleccione su puesto</option>

                @foreach($positions as $position)
                <option value="{{ $position->name }}">
                    {{ $position->name }}
                </option>
                @endforeach
            </select>


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
                <div>
                    <label class="font-semibold block mb-2">Tema de la queja</label>

                    <select name="complaint_topic_id" class="input w-full" required>
                        <option value="">Seleccione un tema</option>

                        @foreach($topics as $topic)
                        <option value="{{ $topic->id }}">
                            {{ $topic->name }}
                        </option>
                        @endforeach
                    </select>
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
                        class="input w-full max-w-none"
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
                        class="input w-full max-w-none"
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
                        class="input w-full max-w-none"
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
                        class="input w-full max-w-none"
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