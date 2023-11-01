<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Calificacion extends Model
{
    use HasFactory;

    protected $table = 'calificaciones';

    public function estudiante()
{
    return $this->belongsTo(User::class, 'estudiante_id');
}


    public function materia()
    {
        return $this->belongsTo(Materia::class, 'materia_id');
    }
}
