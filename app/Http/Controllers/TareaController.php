<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tarea;

use App\Models\Materia;

class TareaController extends Controller
{

    public function __construct()
    {
        $this->middleware('permission:ver-tarea|crear-tarea|editar-tarea|borrar-tarea', ['only' => ['index']]);
        $this->middleware('permission:crear-tarea', ['only' => ['create', 'store']]);
        $this->middleware('permission:editar-tarea', ['only' => ['edit', 'update']]);
        $this->middleware('permission:borrar-tarea', ['only' => ['destroy']]);
    }


    public function index(Materia $materia)
    {
        $tareas = $materia->tareas; // Obtiene las tareas de la materia

      
        return view('tareas.index', compact('materia', 'tareas'));
    }
    

    // Mostrar una tarea
    public function show(Tarea $tarea)
    {
        return view('tareas.show', compact('tarea'));
    }

    // Crear una nueva tarea
    public function create(Request $request, $materia_id)
    {
        $materia = Materia::findOrFail($materia_id);
        $tareas = Tarea::where('materia_id', $materia->id)->get();

        return view('tareas.create', compact('materia', 'tareas'));
    }



public function store(Request $request, Materia $materia)
{   
    
    $request->validate([
        'nombre' => 'required',
        'descripcion' => 'required',
        'fecha_vencimiento' => 'required|date',
        'porcentaje' => 'required',
        'archivo' => 'required|file|mimes:pdf,docx,txt,jpg,zip,rar,png,sql',
    ]);

    $archivo = $request->file('archivo');
    $nombreArchivo = $archivo->getClientOriginalName();
    $archivo->move(public_path('/tareas/'), $nombreArchivo); // Ajusta la ubicación según tus necesidades

    // Crea la tarea en la base de datos y asóciala con la materia
    $tarea = new Tarea([
        'nombre' => $request->input('nombre'), // Asigna la descripción como nombre
        'descripcion' => $request->input('descripcion'),
        'fecha_vencimiento' => $request->input('fecha_vencimiento'),
        'porcentaje' => $request->input('porcentaje'),
        'archivo' => $nombreArchivo, // Guarda el nombre del archivo, no el archivo en sí    ]);
    ]);

    // Asocia la tarea con la materia
    $materia->tareas()->save($tarea);

    return redirect()->route('materias.show', $materia)->with('success', 'Tarea creada correctamente');
}

    

    // Editar una tarea
    public function edit(Materia $materia, Tarea $tarea)
{
    // Verifica si la tarea está asociada a la materia
    if ($materia->tareas->contains($tarea)) {
        $tareas = $materia->tareas; // Cargar todas las tareas de la materia
        return view('tareas.edit', compact('materia', 'tarea', 'tareas'));
    } else {
        // Si la tarea no está asociada a la materia, puedes manejar el error aquí
        return redirect()->route('materias.show', $materia)->with('error', 'No se encontró la tarea especificada.');
    }
}


    public function update(Request $request, Tarea $tarea)
    {
        $request->validate([
            'nombre' => 'required',
            'descripcion' => 'required',
            'fecha_vencimiento' => 'required|date',
            'porcentaje' => 'required|integer|min:0|max:100',
            'archivo' => 'sometimes|mimes:pdf,docx,txt,jpg,zip,rar',
        ]);

        $tarea->nombre = $request->input('nombre');
        $tarea->descripcion = $request->input('descripcion');
        $tarea->fecha_vencimiento = $request->input('fecha_vencimiento');
        $tarea->porcentaje = $request->input('porcentaje');

        if ($request->hasFile('archivo')) {
            $archivo = $request->file('archivo');
            $nombre_archivo = time() . '_' . $archivo->getClientOriginalName();
            $ruta_archivo = $archivo->storeAs('tareas', $nombre_archivo);
            $tarea->archivo = $nombre_archivo;
        }

        $tarea->save();

        return redirect()->route('tareas.index', ['materia' => $tarea->materia->id])
            ->with('success', 'La tarea se actualizó correctamente');
    }

    // Eliminar una tarea
    public function destroy(Materia $materia, Tarea $tarea)
{
    // Primero, verifica si la tarea existe
    if (!$tarea) {
        return redirect()->back()->with('error', 'La tarea no existe.');
    }

    // Aquí puedes agregar una lógica adicional, como comprobar si el usuario tiene permiso para eliminar la tarea.

    // Elimina el archivo adjunto (si está almacenado en el servidor)
    // Esto supone que tienes acceso al nombre del archivo en la tarea
    if ($tarea->archivo) {
        // Puedes usar la función unlink para eliminar el archivo
        $archivoPath = public_path('tareas/' . $tarea->archivo);
        if (file_exists($archivoPath)) {
            unlink($archivoPath);
        }
    }

    // Elimina la tarea de la base de datos
    $tarea->delete();

    return redirect()->route('materias.show', $materia)->with('success', 'Tarea eliminada correctamente.');
}
}
