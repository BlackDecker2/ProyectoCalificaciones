<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TareaEstudiante extends Model
{
    protected $table = 'tarea_estudiante'; // Nombre de la tabla en la base de datos

    protected $fillable = ['tarea_id', 'user_id']; // Especifica las columnas que se pueden llenar

    // Establece la relación con el modelo Tarea
    public function tarea()
    {
        return $this->belongsTo(Tarea::class, 'tarea_id', 'id');
    }

    // Establece la relación con el modelo User (Estudiante)
    public function estudiante()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
