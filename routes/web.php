<?php

use Illuminate\Support\Facades\Route;
//agregamos los siguientes controladores
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RolController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\MateriaController;
use App\Http\Controllers\TareaController;
use App\Http\Controllers\TareaEstudianteController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Auth::routes();



//y creamos un grupo de rutas protegidas para los controladores
Route::group(['middleware' => ['auth']], function() {
    
    Route::resource('roles', RolController::class);
    Route::resource('usuarios', UsuarioController::class);
    Route::resource('documents', DocumentController::class);
    Route::resource('tareas', TareaController::class);
    Route::resource('materias', MateriaController::class);
    Route::resource('tareas-estudiante', TareaEstudianteController::class);
    
});

 // Ruta para mostrar el formulario de carga de tareas
 Route::get('/materias/{materia}/tareas/create', [TareaController::class, 'create'])->name('tareas.create');

 // Ruta para manejar la carga de tareas
 Route::post('/materias/{materia}/tareas', [TareaController::class, 'store'])->name('tareas.store');


Route::get('/materias/crear', [MateriaController::class, 'create'])->name('materias.crear');
Route::post('/materias', [MateriaController::class, 'store'])->name('materias.store');
Route::get('/materias/{materia}', [MateriaController::class, 'show'])->name('materias.show');
// Ruta para mostrar el formulario de edición
Route::get('materias/{materia}/editar',  [MateriaController::class, 'edit'])->name('materias.editar');

// Ruta para procesar la actualización de la materia
Route::put('materias/{materia}',  [MateriaController::class, 'update'])->name('materias.update');



// Ruta para mostrar el formulario de creación de tarea
Route::get('materias/{materia}/tareas/create', [TareaController::class, 'create'])->name('tareas.create');

// Ruta para almacenar la tarea
Route::post('materias/{materia}/tareas', [TareaController::class, 'store'])->name('tareas.store');

Route::get('materias/{materia}/tareas', [TareaController::class, 'index'])->name('tareas.index');
//Ruta para matricular Estudiante
Route::get('/materias/{materia}/matricular',  [MateriaController::class, 'mostrarFormularioMatricula'])->name('materias.matricular');

// Otras rutas específicas para estudiantes, si es necesario



Route::post('/materias/{materia}/matricular', [MateriaController::class, 'matricularEstudiantes'])->name('materias.matricularEstudiantes');
Route::delete('/materias/{materia}/desmatricular-estudiantes', [MateriaController::class, 'desmatricularEstudiantes'])->name('materias.desmatricular-estudiantes');



// Rutas para mostrar calificaciones
Route::get('/materias/{materia}/calificaciones', [MateriaController::class, 'calificaciones'])->name('materias.calificaciones');

// Rutas para buscar estudiantes por correo electrónico
Route::post('/materias/{materia}/search-estudiantes', [MateriaController::class,'searchEstudiantes'])->name('materias.searchEstudiantes');



Route::get('materias/{materia}/tareas/{tarea}/edit', [TareaController::class, 'edit'])->name('tareas.edit');
Route::delete('materias/{materia}/tareas/{tarea}', [TareaController::class, 'destroy'])->name('tareas.destroy');


Route::get('download/{id}', [DocumentController::class, 'download'])->name('documents.download');

Route::get('documents/{document}/share', [DocumentController::class, 'share'])->name('documents.share');
Route::post('documents/{document}/share', [DocumentController::class, 'doShare'])->name('documents.doShare');



// Rutas para las tareas de estudiantes
Route::get('materias/{materia}/tareas-estudiante/index/{tarea}', [TareaEstudianteController::class, 'index'])->name('tareas-estudiante.index');


Route::get('materias/{materia}/tareas-estudiante/create/{tareaId}', [TareaEstudianteController::class, 'create'])->name('tareas-estudiante.create');
// routes/web.php

Route::post('/tareas-estudiante', [TareaEstudianteController::class, 'store'])->name('tareas-estudiante.store');
// En routes/web.php
Route::put('/tareas-estudiante/{tareaEstudiante}/calificar', [TareaEstudianteController::class, 'calificar'])->name('tareas-estudiante.calificar');
