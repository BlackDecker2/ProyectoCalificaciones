<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
//Spatie

use Spatie\Permission\Models\Permission;


class SeederTablaPermisos extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permisos = [
            //tabla roles
            'ver-rol',
            'crear-rol',
            'editar-rol',
            'borrar-rol',
            //tabla documentos
            'ver-documento',
            'crear-documento',
            'editar-documento',
            'borrar-documento',
            'compartir-documento',
            'descargar-documento',
            //tabla usuarios
            'ver-usuario',
            'crear-usuario',
            'editar-usuario',
            'borrar-usuario',
            //tabla materia
            'ver-materia',
            'crear-materia',
            'editar-materia',
            'borrar-materia',
            //tabla tarea
            'ver-tarea',
            'crear-tarea',
            'editar-tarea',
            'borrar-tarea',
            
        ];
        foreach($permisos as $permiso){
            Permission::create(['name'=>$permiso]);
        }
        //
    }
}
