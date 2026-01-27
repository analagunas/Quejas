<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::dropIfExists('complaint_topic');
        Schema::dropIfExists('complaint_topics');
    }

    public function down()
    {
        // Opcional: solo si quieres poder recrearlas
        Schema::create('complaint_topic', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });

        Schema::create('complaint_topics', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
        });
    }
};
