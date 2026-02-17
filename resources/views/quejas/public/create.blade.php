@extends('layouts.public')

@section('content')

<div class="max-w-5xl mx-auto py-10 px-4">
    <br>
    {{-- HEADER --}}
    <div class="flex justify-between items-center mb-8">

        <div>
            <h1 class="text-2xl font-bold text-gray-800">
                Buzón de Quejas y Sugerencias
            </h1>

        </div>

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

    {{-- CARD PRINCIPAL --}}
    <div class="bg-white rounded-2xl shadow-lg p-8">

        <img src="{{ asset('images/logo.png') }}"
            class="h-20 mx-auto mb-6">

        <p class="text-gray-600 text-sm leading-relaxed text-justify max-w-3xl mx-auto mb-8">
            Agradecemos su visita a este medio, recuerde que esta hecho para usted y fue diseñado con el propósito de prevenir y/o corregir cualquier comportamiento que pueda generar algún riesgo psicosocial, violencia laboral, así como promover un entorno organizacional favorable.
            La información obtenida es TOTALMENTE CONFIDENCIAL Y PRIVADA, y será utilizada únicamente con el fin de dar solución a la queja o denuncia presentada. Bajo ninguna circunstancia se generarán represalias a aquellos trabajadores que de buena fe presenten una queja o denuncia relacionadas a prácticas opuestas al entorno organizacional favorable o actos de violencia laboral.
            Así mismo, agradecemos que nos proporcione la siguiente información para actuar de manera inmediata.
        </p>

        <form method="POST"
            action="{{ route('quejas.store') }}"
            class="space-y-8">

            @csrf

            {{-- ANONIMO --}}
            <div class="bg-gray-50 rounded-xl p-5">

                <label class="font-semibold text-gray-800">
                    ¿Desea enviar la queja de forma anónima?
                </label>

                <div class="flex gap-8 mt-3">

                    <label class="flex items-center gap-2 cursor-pointer">
                        <input type="radio" name="es_anonima" value="1" checked class="accent-red-600">
                        <span>Sí</span>
                    </label>

                    <label class="flex items-center gap-2 cursor-pointer">
                        <input type="radio" name="es_anonima" value="0" class="accent-red-600">
                        <span>No</span>
                    </label>

                </div>

            </div>

            {{-- DATOS PERSONALES --}}
            <div id="datos-personales"
                class="grid grid-cols-1 md:grid-cols-2 gap-4 hidden">

                <input type="text" name="nombre" placeholder="Nombre(s)" class="input">
                <input type="text" name="apellido_paterno" placeholder="Apellido paterno" class="input">
                <input type="text" name="apellido_materno" placeholder="Apellido materno" class="input">
                <input type="text" name="telefono" placeholder="Teléfono" class="input">
                <input type="email" name="correo" placeholder="Correo electrónico" class="input md:col-span-2">

            </div>

            {{-- PUESTO + UNIDAD --}}
            <div class="grid md:grid-cols-2 gap-6">

                <div>
                    <label class="label">Puesto de trabajo *</label>
                    <select name="puesto" class="input w-full">
                        <option value="">Seleccione</option>
                        @foreach($positions as $position)
                        <option value="{{ $position->name }}">
                            {{ $position->name }}
                        </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="label">Unidad *</label>
                    <select name="unidad" required class="input">
                        <option value="">Seleccione</option>
                        @foreach([
                        'Palma','Hillton','Lomas','San Ángel','Dakota','Tacuba',
                        'El Rancho y La Viga (JABG)','B-Gari',
                        'Estacionamientos Pizarro','Lavandería'
                        ] as $unidad)
                        <option value="{{ $unidad }}">{{ $unidad }}</option>
                        @endforeach
                    </select>
                </div>

            </div>

            {{-- TEMA --}}
            <div>
                <label class="label">Tema de la queja *</label>
                <select name="complaint_topic_id" class="input w-full" required>
                    <option value="">Seleccione un tema</option>
                    @foreach($topics as $topic)
                    <option value="{{ $topic->id }}">
                        {{ $topic->name }}
                    </option>
                    @endforeach
                </select>
            </div>

            {{-- TEXTAREAS --}}
            <div class="space-y-6">

                <div>
                    <label class="label">Descripción *</label>
                    <textarea name="situacion" required rows="4"
                        class="input w-full"
                        placeholder="Describe la situación"></textarea>
                </div>

                <div>
                    <label class="label">Impacto *</label>
                    <textarea name="impacto" required rows="3"
                        class="input w-full"></textarea>
                </div>

                <div>
                    <label class="label">Propuesta de mejora *</label>
                    <textarea name="mejora" required rows="3"
                        class="input w-full"></textarea>
                </div>

                <div>
                    <label class="label">Comentarios adicionales</label>
                    <textarea name="comentarios" rows="2"
                        class="input w-full"></textarea>
                </div>

            </div>

            {{-- BOTON --}}
            <div class="pt-4">
                <button
                    class="w-full bg-red-600 hover:bg-red-700 text-white font-semibold py-3 rounded-xl shadow-lg transition">
                    Enviar queja
                </button>
            </div>

        </form>

    </div>

</div>

{{-- TOGGLE --}}
<script>
    const radios = document.querySelectorAll('input[name="es_anonima"]');
    const datosPersonales = document.getElementById('datos-personales');

    radios.forEach(radio => {
        radio.addEventListener('change', function() {
            if (this.value === '0') {
                datosPersonales.classList.remove('hidden');
            } else {
                datosPersonales.classList.add('hidden');
                datosPersonales.querySelectorAll('input').forEach(input => input.value = '');
            }
        });
    });
</script>

@endsection