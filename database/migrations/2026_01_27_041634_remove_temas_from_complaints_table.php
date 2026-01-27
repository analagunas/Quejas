<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('complaints', function (Blueprint $table) {

            // 1. Crear nueva columna FK
            $table->unsignedBigInteger('complaint_topic_id')
                ->nullable()
                ->after('temas');

            // 2. Crear la relación
            $table->foreign('complaint_topic_id')
                ->references('id')
                ->on('complaint_topics')
                ->onDelete('set null');

            // 3. Eliminar columna anterior
            $table->dropColumn('temas');
        });
    }

    public function down(): void
    {
        Schema::table('complaints', function (Blueprint $table) {

            // Restaurar columna antigua
            $table->string('temas')->nullable();

            // Quitar FK
            $table->dropForeign(['complaint_topic_id']);
            $table->dropColumn('complaint_topic_id');
        });
    }
};
