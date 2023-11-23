@extends('layouts.app')

@section('title', 'Tareas de Estudiantes')

@section('content')
    <div style="margin-top: 3em;" class="container">
        <h1 class="my-4">Tareas - {{ $tarea->nombre }}</h1>
        <a href="{{ route('tareas.index', ['materia' => $materia->id]) }}" class="btn btn-details">Volver a Tareas</a>
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <table class="table table-striped mt-2">
            <thead style="background-color: rgb(221, 63, 63);">
                <tr>
                    <th style="color: white;">Estudiante</th>
                    <th style="color: white;">Descripción</th>
                    <th style="color: white;">Archivo</th>
                    <th style="color: white;">Calificación</th>
                    <th style="color: white;">Acciones</th>
                </tr>
            </thead>
            <tbody class="table table-bordered">
                @foreach ($tareasEstudiantes as $tareaEstudiante)
                    <tr>
                        <td>{{ $tareaEstudiante->estudiante->name }}</td>
                        <td>{{ $tareaEstudiante->descripcion }}</td>
                        <td>
                            @if ($tareaEstudiante->archivo)
                                <a href="{{ asset('tareas_estudiante/' . $tareaEstudiante->archivo) }}" target="_blank">
                                    Ver Archivo
                                </a>
                            @else
                                No hay archivo adjunto.
                            @endif
                        </td>
                        <td>
                            @if ($tareaEstudiante->calificacion)
                                {{ $tareaEstudiante->calificacion->puntaje }}
                            @else
                                <form class="calificacion-form" action="{{ route('tareas-estudiante.calificar', ['tareaEstudiante' => $tareaEstudiante->id]) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <input type="number" name="calificacion" step="0.01" value="{{ old('calificacion') }}">
                                    <input type="hidden" name="tareaEstudianteId" value="{{ $tareaEstudiante->id }}">
                                    <button type="submit" class="btn btn-details">Calificar</button>
                                </form>
                            @endif
                        </td>
                        <td>
                            @if ($tareaEstudiante->calificacion)
                                <button class="btn btn-info edit-calificacion-btn" data-tareaestudiante-id="{{ $tareaEstudiante->id }}" style="margin-left: 8px;">Editar</button>
                            @endif
                            <!-- Agrega aquí las acciones que desees, como editar o eliminar -->
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Modal para la edición de calificaciones -->
    <div class="modal fade" id="editCalificacionModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Editar Calificación</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Formulario de edición de calificación -->
                    <form id="editCalificacionForm" action="" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="calificacion">Calificación:</label>
                            <input type="number" name="calificacion" step="0.01" class="form-control" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Actualizar Calificación</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Script para abrir el modal -->
    <script>
        $('.edit-calificacion-btn').click(function () {
            var tareaEstudianteId = $(this).data('tareaestudiante-id');
            var actionUrl = "{{ url('tareas-estudiante') }}/" + tareaEstudianteId + "/calificar";

            $('#editCalificacionForm').attr('action', actionUrl);
            $('#editCalificacionModal').modal('show');
        });
    </script>

@endsection
