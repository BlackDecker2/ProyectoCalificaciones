<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tarea extends Model
{
    use HasFactory;

    protected $fillable = ['nombre', 'descripcion', 'fecha_vencimiento','porcentaje', 'materia_id','archivo'];


    protected $dates = ['fecha_vencimiento']; // Define el campo como una fecha de Carbon

    public function materia()
    {
        return $this->belongsTo(Materia::class);
    }

    public function calificaciones()
    {
        return $this->hasMany(Calificacion::class);
    }

    public function tareasEstudiantes()
    {
        return $this->hasMany(TareaEstudiante::class, 'tarea_id', 'id');
    }


}
