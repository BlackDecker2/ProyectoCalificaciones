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
    public function up()
{
    Schema::create('calificaciones', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('estudiante_id');
        $table->unsignedBigInteger('materia_id');
        $table->float('calificacion');
        $table->timestamps();

        $table->foreign('estudiante_id')->references('id')->on('users')->onDelete('cascade');
        $table->foreign('materia_id')->references('id')->on('materias')->onDelete('cascade');
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
