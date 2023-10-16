<?php

namespace App\Policies;

use App\Models\Document;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class DocumentoPolicy
{
    public function viewAny(User $user)
    {
        return true; // todos los usuarios pueden ver sus propios documentos
    }
    
    public function view(User $user, Document $documento)
    {
        return $user->id === $documento->user_id; // el usuario sólo puede ver sus propios documentos
    }
    
    public function create(User $user)
    {
        return $user->hasPermissionTo('crear documentos');
    }
    
    public function update(User $user, Document $documento)
    {
        return $user->id === $documento->user_id && $user->hasPermissionTo('editar documentos');
    }
    
    public function delete(User $user, Document $documento)
    {
        return $user->id === $documento->user_id && $user->hasPermissionTo('eliminar documentos');
    }
    
}
