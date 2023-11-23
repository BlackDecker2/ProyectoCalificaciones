@extends('layouts.app')

@section('title')
   Tareas - {{ $materia->nombre }}
@endsection

@section('content')
<section class="section">
    <div class="section-header">
        <h3 class="page__heading">Tareas de {{ $materia->nombre }}</h3>
        <!-- En materias.show.blade.php u otra vista donde muestres la información de la materia -->
        @can('matricular-estudiantes')
        
            <a href="{{ route('materias.matricular', $materia) }}" class="btn btn-details" style="margin-left: 45%;">Matricular Estudiantes</a>
            @endcan

            <a href="{{ route('materias.calificaciones', $materia) }}" class="btn btn-details" style="margin-left: 10px;">Ver Estudiantes</a>
        
    </div>
    <div class="section-body">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    @if (session('success'))
                    <div id="alert-success" class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
                
                @if (session('warning'))
                    <div id="alert-warning" class="alert alert-warning">
                        {{ session('warning') }}
                    </div>
                @endif
                
                <script>
                    // Ocultar la alerta de éxito después de 5 segundos
                    setTimeout(function() {
                        document.getElementById('alert-success').style.display = 'none';
                    }, 4000);
                
                    // Ocultar la alerta de advertencia después de 5 segundos
                    setTimeout(function() {
                        document.getElementById('alert-warning').style.display = 'none';
                    }, 4000);
                </script>
                    <div class="card-body-tareas" style="background-color: #d4d2d2">
                        @can('crear-tarea')
                        <a class="btn btn-warning" href="{{ route('tareas.create', ['materia' => $materia->id]) }}">Nueva Tarea</a>
                        @endcan
                        

                        <div class="accordion" id="accordionTareas" style="margin-top: 10px; background-color:rgba(197, 188, 188, 0.103);">
                            @foreach ($tareas as $tarea)
                                <div class="card">
                                    
                                    
                                    <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapse{{ $tarea->id }}" aria-expanded="true" aria-controls="collapse{{ $tarea->id }}" style="text-decoration: none; background-color:#ec0000e7; color: #fff7f7e0; font-family:'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif; font-size:2em; transition: color 0.8s;" onmouseover="this.style.color='black'" onmouseout="this.style.color='white'">
                                        {{ $tarea->nombre }}
                                    </button>
                                    
                                 

                                    <div id="collapse{{ $tarea->id }}" class="collapse" aria-labelledby="heading{{ $tarea->id }}" data-parent="#accordionTareas">
                                        <div class="card-body" style="background-color: rgba(170, 156, 156, 0.103); color:rgb(26, 23, 23)">
                                            <p><strong>Descripcion:</strong> {{ $tarea->descripcion }}</p>
                                            <p class="fec_vencimiento" style="color: red"><strong>Fecha de Vencimiento:</strong> {{ $tarea->fecha_vencimiento }}</p>
                                            <p><strong>Porcentaje:</strong> {{ $tarea->porcentaje }}</p>
                                            <p><strong>Materia:</strong> {{ $tarea->materia->nombre }}</p>
                                            
                                            @if ($tarea->archivo)
                                                <a class="btn btn-details" style="margin-top: 20px;" href="{{ asset('tareas/' . $tarea->archivo) }}" target="_blank">Ver Archivo</a>
                                                
                                                <!-- Botón de acciones con Dropdown -->
                                                <div class="btn-group" style="margin-top: 20px;">
                                                   <div class="dropdown dropup">
                                                        <button class="btn btn-info dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                            Acciones
                                                        </button>
                                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" style="border-block:inherit;">
                                                            @can('cargar-tarea')
                                                                <a class="dropdown-item" style="background-color: #ddd8d8" href="{{ route('tareas-estudiante.create', ['tareaId' => $tarea->id, 'materia' => $materia->id]) }}">Cargar Tarea</a>
                                                            @endcan
                                                            <a class="dropdown-item" style="background-color: #ddd8d8;" href="{{ route('tareas-estudiante.index', ['materia' => $materia->id, 'tarea' => $tarea->id]) }}">Ir a Tareas de Estudiantes</a>
                                                            @can('editar-tarea')
                                                                <a class="dropdown-item" style="background-color: #ddd8d8" href="{{ route('tareas.edit', ['materia' => $materia, 'tarea' => $tarea]) }}">Editar Tarea</a>
                                                            @endcan
                                                            @can('borrar-tarea')
                                                                <form action="{{ route('tareas.destroy', [$materia, $tarea]) }}" method="POST">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="submit" class="dropdown-item" style="background-color: #ddd8d8">Eliminar</button>
                                                                </form>
                                                            @endcan
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                        
                                    </div> 
                                </div>    
                            @endforeach  
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
