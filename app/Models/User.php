<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\Document;
use App\Models\TareaEstudiante;

// spatie
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    
    public function documents(): BelongsToMany
    {
        return $this->belongsToMany(Document::class, 'document_user', 'user_id', 'document_id');
    }

    public function calificaciones()
    {
        return $this->hasMany(Calificacion::class);
    }

    public function tareasEstudiante(): HasMany
    {
        return $this->hasMany(TareaEstudiante::class);
    }

    public function haCargadoTarea($tarea)
    {
        return $this->tareasEstudiante()->where('tarea_id', $tarea->id)->exists();
    }
    public function tareaEstudiante()
    {
        return $this->hasMany(TareaEstudiante::class);
    }
}
