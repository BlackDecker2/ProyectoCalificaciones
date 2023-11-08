@extends('layouts.app')

@section('title')
   Tareas - {{ $materia->nombre }}
@endsection

@section('content')
<section class="section">
    <div class="section-header">
        <h3 class="page__heading">Tareas de {{ $materia->nombre }}</h3>
        <!-- En materias.show.blade.php u otra vista donde muestres la información de la materia -->
        <a href="{{ route('materias.matricular', $materia) }}" class="btn btn-lighting" style="margin-left: 45%;">Matricular Estudiantes</a>
        <a href="{{ route('materias.calificaciones', $materia) }}" class="btn btn-lighting" style="margin-left: 10px;">Ver Estudiantes</a>

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
                    <div class="card-body">
                        @can('crear-tarea')
                        <a class="btn btn-warning" href="{{ route('tareas.create', ['materia' => $materia->id]) }}">Nueva Tarea</a>
                        @endcan
                        

                        <div class="accordion" id="accordionTareas" style="margin-top: 10px; background-color:rgba(197, 188, 188, 0.103);">
                            @foreach ($tareas as $tarea)
                                <div class="card">
                                    
                                    
                                    <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapse{{ $tarea->id }}" aria-expanded="true" aria-controls="collapse{{ $tarea->id }}" style="text-decoration: none; background-color:rgba(192, 190, 190, 0.267); color: #ff0000e0; font-family:'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif; font-size:2em; transition: color 0.3s;" onmouseover="this.style.color='#007bff'" onmouseout="this.style.color='#333'">
                                        {{ $tarea->nombre }}
                                    </button>
                                    
                                 

                                    <div id="collapse{{ $tarea->id }}" class="collapse" aria-labelledby="heading{{ $tarea->id }} "  data-parent="#accordionTareas">
                                        <div class="card-body" style="background-color: rgba(170, 156, 156, 0.103); color:rgb(26, 23, 23)">
                                            <p><strong>Descripcion:</strong> {{ $tarea->descripcion }}</p>
                                            <p class="fec_vencimiento" style="color: red"><strong>Fecha de Vencimiento:</strong> {{ $tarea->fecha_vencimiento }}</p>
                                            <p><strong>Porcentaje:</strong> {{ $tarea->porcentaje }}</p>
                                            <p><strong>Materia:</strong> {{ $tarea->materia->nombre }}</p>
                                            @if ($tarea->archivo)
                                            <a class="btn btn-light" style="margin-top: 20px"  href="{{ asset('tareas/' . $tarea->archivo) }}" target="_blank">Ver Archivo</a>
                                            @endif
                                           
                                                @can('cargar-tarea')
                                                <a class="btn btn-success" href="{{ route('tareas-estudiante.create', ['tareaId' => $tarea->id]) }}">Cargar Tarea</a>
                                                @endcan

                                                <a class="btn btn-index" href="{{ route('tareas-estudiante.index', ['tarea' => $tarea]) }}">Ver Tareas de Estudiantes</a>


                                            @can('editar-tarea')
                                            <a href="{{ route('tareas.edit', ['materia' => $materia, 'tarea' => $tarea]) }}" class="btn btn-primary" style="margin-top: 22px">Editar Tarea</a>
                                            @endcan
                                            @can('borrar-tarea')
                                            <form action="{{ route('tareas.destroy', [$materia, $tarea]) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger" style="margin-top: 20px">Eliminar</button>
                                            </form>
                                            @endcan

                                        
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
