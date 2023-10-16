<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Materia; // Asegúrate de importar el modelo correcto
use App\Models\User;



class MateriaController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:ver-materia|crear-materia|editar-materia|borrar-materia', ['only' => ['index']]);
        $this->middleware('permission:crear-materia', ['only' => ['create', 'store']]);
        $this->middleware('permission:editar-materia', ['only' => ['edit', 'update']]);
        $this->middleware('permission:borrar-materia', ['only' => ['destroy']]);
    }

    public function index()
    {
        $materias = Materia::all();
        return view('materias.index', compact('materias'));
    }

    public function create()
    {
        $profesores = User::role('Profesor')->get();
        return view('materias.crear', compact('profesores'));

    }

    public function store(Request $request)
    {
        $materia = Materia::create([
            'nombre' => $request->input('nombre'),
            'codigo' => $request->input('codigo'),
        ]);

        
        
        // Sincroniza los profesores asociados con la materia
        $materia->profesores()->sync($request->input('profesores'));
        
        return redirect()->route('materias.index')->with('success', 'Materia creada correctamente');
        
    }

    public function edit(Materia $materia)
    {
        $profesores = User::role('Profesor')->get();
        return view('materias.editar', compact('profesores', 'materia'));
    }

    public function update(Request $request, Materia $materia)
    {
        $this->validate($request, [
            'nombre' => 'required',
            'codigo' => 'required|unique:materias,codigo,' . $materia->id,
            'profesores' => 'required|array',
            'profesores.*' => 'exists:users,id', // Valida que los profesores existan
            // Otras reglas de validación que puedas necesitar
        ]);

        // Actualiza los atributos de la materia
        $materia->nombre = $request->input('nombre');
        $materia->codigo = $request->input('codigo');
        
        // Asigna los profesores seleccionados
        $materia->profesores()->sync($request->input('profesores'));

        $materia->save();

        return redirect()->route('materias.index')->with('success', 'Materia actualizada correctamente');
    }

    public function show(Materia $materia)
    {
        $tareas = $materia->tareas; // Cargar las tareas relacionadas con la materia
        return view('materias.show', compact('materia', 'tareas'));
    }


    


    public function destroy(Materia $materia)
    {
        $materia->delete();
        return redirect()->route('materias.index')->with('success', 'Materia eliminada correctamente');
    }
}
