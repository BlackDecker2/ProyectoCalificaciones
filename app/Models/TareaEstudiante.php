<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TareaEstudiante extends Model
{
    use HasFactory;

    protected $table = 'tarea_estudiante';
    // Laravel usará automáticamente 'tarea_estudiante' como el nombre de la tabla

    protected $fillable = ['tarea_id', 'user_id', 'descripcion', 'archivo'];

    public function tarea()
    {
        return $this->belongsTo(Tarea::class, 'tarea_id', 'id');
    }

    public function estudiante()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}

