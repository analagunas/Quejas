<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('complaints', function (Blueprint $table) {
            $table->id();

            // Anonimato
            $table->boolean('es_anonima')->default(false);

            // Datos personales (opcionales)
            $table->string('nombre')->nullable();
            $table->string('apellido_paterno')->nullable();
            $table->string('apellido_materno')->nullable();
            $table->string('telefono')->nullable();
            $table->string('correo')->nullable();
            $table->string('puesto')->nullable();

            // Contenido
            $table->json('temas');
            $table->string('otro_tema')->nullable();
            $table->text('situacion');
            $table->text('impacto');
            $table->text('mejora');
            $table->text('comentarios')->nullable();

            // Unidad
            $table->string('unidad');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('complaints');
    }
};
