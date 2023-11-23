<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// En el modelo Calificacion
class Calificacion extends Model
{

    use HasFactory;

    protected $table = 'calificaciones';

    protected $fillable = ['tarea_estudiante_id', 'puntaje'];

    public function tareaEstudiante()
    {
        return $this->belongsTo(TareaEstudiante::class);
    }
}

