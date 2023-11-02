<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTareaEstudiantesTable extends Migration
{
    public function up()
    {
        Schema::create('tarea_estudiante', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('tarea_id');
            $table->unsignedBigInteger('user_id'); // Opción 1: Puedes usar user_id para representar a los estudiantes
            // $table->unsignedBigInteger('estudiante_id'); // Opción 2: Puedes usar estudiante_id en lugar de user_id

            $table->foreign('tarea_id')->references('id')->on('tareas')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade'); // Opción 1
            // $table->foreign('estudiante_id')->references('id')->on('users')->onDelete('cascade'); // Opción 2

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('tarea_estudiante');
    }
}
