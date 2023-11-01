<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Materia; // Asegúrate de importar el modelo correcto
use App\Models\User;
use App\Models\Calificacion;
use Illuminate\Support\Facades\Log;
use App\Models\Tarea;


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

    //Mostrar la vista de matricular
    public function mostrarFormularioMatricula(Materia $materia)
    {
        $estudiantes = User::role('Estudiante')->get(); // Obtén la lista de estudiantes disponibles para matricular

        return view('materias.matricular', compact('materia', 'estudiantes'));
    }


   /*  public function searchEstudiantes(Request $request)
    {
        $query = $request->input('query');
        $estudiantes = User::where('email', 'LIKE', "%$query%")->get();

        // Depura la consulta
        \Log::info($estudiantes);

        return view('estudiantes.suggestions', compact('estudiantes'));
    }
 */
    

    public function matricularEstudiantes(Request $request, Materia $materia)
    {
        $estudiantesIds = $request->input('estudiantes'); // Obtén los IDs de los estudiantes que deseas matricular
    
        // Asocia los estudiantes a la materia
        $materia->estudiantes()->attach($estudiantesIds);
    
        return redirect()->route('materias.show', $materia)->with('success', 'Estudiante matriculado correctamente.');
    }

 
    

    public function calificaciones(Materia $materia)
    {
        $matriculas = $materia->estudiantes; // Obtén los estudiantes matriculados en la materia
        $tareas = $materia->tareas; // Obtén las tareas asociadas a la materia

        return view('materias.calificaciones', compact('materia', 'matriculas', 'tareas'));
        
        
    }
    


    public function destroy(Materia $materia)
    {
        $materia->delete();
        return redirect()->route('materias.index')->with('success', 'Materia eliminada correctamente');
    }
}
