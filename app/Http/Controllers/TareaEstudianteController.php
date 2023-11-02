<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TareaEstudiante;
use App\Models\Materia;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class TareaEstudianteController extends Controller
{
    public function create()
    {
        return view('tareas-estudiante.create');

    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required',
            'descripcion' => 'required',
            'archivo' => 'required|file|mimes:pdf,docx,txt',
        ]);

        $user = Auth::user(); // Obtén al usuario actual (estudiante)

        $archivo = $request->file('archivo');
        $nombreArchivo = $archivo->getClientOriginalName();

        // Guarda el archivo en una ubicación específica
        $archivo->storeAs('tareas_estudiante', $nombreArchivo, 'public');

        // Crea la tarea del estudiante
        $tareaEstudiante = new TareaEstudiante([
            'nombre' => $request->input('nombre'),
            'descripcion' => $request->input('descripcion'),
            'archivo' => $nombreArchivo,
        ]);

        // Asocia la tarea con el estudiante
        $user->tareasEstudiante()->save($tareaEstudiante);

        return redirect()->route('dashboard')->with('success', 'Tarea creada correctamente');
    }

    // Otras acciones para editar y eliminar tareas (puedes agregarlas según tus necesidades)

    // public function edit(TareaEstudiante $tareaEstudiante)
    // {
    //     return view('tareas-estudiante.edit', compact('tareaEstudiante'));
    // }

    // public function update(Request $request, TareaEstudiante $tareaEstudiante)
    // {
    //     // Lógica para actualizar la tarea del estudiante
    // }

    // public function destroy(TareaEstudiante $tareaEstudiante)
    // {
    //     // Lógica para eliminar la tarea del estudiante
    // }
}
