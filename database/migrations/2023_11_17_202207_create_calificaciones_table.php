<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCalificacionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    // En la migración de Calificacion
public function up()
{
    Schema::create('calificaciones', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('tarea_estudiante_id');
        $table->double('puntuacion', 1, 2);
        $table->timestamps();

        $table->foreign('tarea_estudiante_id')->references('id')->on('tarea_estudiante')->onDelete('cascade');
    });
}


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('calificaciones');
    }
}
