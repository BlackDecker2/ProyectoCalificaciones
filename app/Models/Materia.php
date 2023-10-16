<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Materia extends Model
{
    protected $table = 'materias';

    protected $fillable = ['nombre', 'codigo'];

    public function tareas()
    {
        return $this->hasMany(Tarea::class);
    }

    public function profesores()
    {
        return $this->belongsToMany(User::class, 'materia_user', 'materia_id', 'user_id');
    }



}
