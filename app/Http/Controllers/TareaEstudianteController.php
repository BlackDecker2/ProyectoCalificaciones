<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\TareaEstudiante;
use App\Models\Materia;
use App\Models\Tarea;

class TareaEstudianteController extends Controller
{

    public function index(Materia $materia, Tarea $tarea)
    {
    // Obtiene las tareas de estudiantes relacionadas con la tarea específica
    $tareasEstudiantes = $tarea->tareasEstudiantes;

    return view('tareas-estudiante.index', compact('materia', 'tarea', 'tareasEstudiantes'));
    }

    public function create(Materia $materia, $tareaId)
    {
        // Cargar la tarea desde la base de datos
        $tarea = Tarea::find($tareaId);
    
        if (!$tarea) {
            return abort(404); // Manejar el caso si la tarea no se encuentra
        }
    
        return view('tareas-estudiante.create', compact('materia','tarea'));
    }
    

    

    public function store(Request $request, Materia $materia, Tarea $tarea)
    {
        $request->validate([
            'nombre' => 'required',
            'descripcion' => 'required',
            'archivo' => 'required|file|mimes:pdf,docx,txt,jpg,zip,rar,png,sql',
        ]);
    
        // Obtiene el usuario actualmente autenticado
        $user = Auth::user();
    
        $archivo = $request->file('archivo');
        $nombreArchivo = $archivo->getClientOriginalName();
        $archivo->move(public_path('/tareas_estudiante/'), $nombreArchivo); // Ajusta la ubicación según tus necesidades
    
        $tareaId = $request->input('tarea_id');
    
        $tareaEstudiante = new TareaEstudiante([
            'nombre' => $request->input('nombre'),
            'descripcion' => $request->input('descripcion'),
            'archivo' => $nombreArchivo,
        ]);
    
        // Asigna el ID del usuario autenticado como 'user_id'
        $tareaEstudiante->user_id = $user->id;
    
        $tareaEstudiante->tarea_id = $tareaId;
    
        $user->tareasEstudiante()->save($tareaEstudiante);
    
        return redirect()->route('tareas.index', ['materia' => $materia->id])->with('success', 'Tarea cargada correctamente');
    }

    public function edit(Materia $materia, TareaEstudiante $tareaEstudiante)
    {
        return view('tareas-estudiante.edit', compact('materia', 'tareaEstudiante'));
    }





    public function update(Request $request, Materia $materia, TareaEstudiante $tareaEstudiante)
{
    $request->validate([
        'nombre' => 'required',
        'descripcion' => 'required',
        'archivo' => 'file|mimes:pdf,docx,txt,jpg,zip,rar,png,sql',
    ]);

    $tareaEstudiante->update([
        'nombre' => $request->input('nombre'),
        'descripcion' => $request->input('descripcion'),
        // Agrega aquí la lógica para actualizar el archivo si se proporciona uno nuevo
    ]);

    if ($request->hasFile('archivo')) {
        // Agrega aquí la lógica para manejar el archivo adjunto
        // Puedes usar el mismo código que en tu método store
    }

    return redirect()->route('tareas.index', ['materia' => $materia])
        ->with('success', 'Tarea estudiante actualizada correctamente');
}


    


public function calificar(Request $request, TareaEstudiante $tareaEstudiante)
{
    $request->validate([
        'calificacion' => 'required|numeric|between:0,5|regex:/^\d+(\.\d{1,2})?$/',
    ]);

    // Crea o actualiza la calificación asociada
    $tareaEstudiante->calificacion()->updateOrCreate([], ['puntaje' => $request->calificacion]);

    return redirect()->back()->with('success', 'Tarea calificada correctamente.');
}






}
