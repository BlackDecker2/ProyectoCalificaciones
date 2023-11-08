<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\TareaEstudiante;
use App\Models\Tarea;

class TareaEstudianteController extends Controller
{

    public function index(Tarea $tarea)
{
    // Obtiene las tareas de estudiantes relacionadas con la tarea específica
    $tareasEstudiantes = $tarea->tareasEstudiantes;

    return view('tareas-estudiante.index', compact('tarea', 'tareasEstudiantes'));
}

    public function create($tareaId)
    {
        // Cargar la tarea desde la base de datos
        $tarea = Tarea::find($tareaId);
    
        if (!$tarea) {
            return abort(404); // Manejar el caso si la tarea no se encuentra
        }
    
        return view('tareas-estudiante.create', compact('tarea'));
    }
    

    

    public function store(Request $request, Tarea $tarea)
{
    $request->validate([
        'nombre' => 'required',
        'descripcion' => 'required',
        'archivo' => 'required|file|mimes:pdf,docx,txt',
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

    return redirect()->route('home')->with('success', 'Tarea cargada correctamente');;
}



}
