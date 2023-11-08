@extends('layouts.app')

@section('title', 'Tareas de Estudiantes')

@section('content')
    <div style="margin-top: 3em; class="container">
        <h1 class="my-4" >Tareas - {{ $tarea->nombre }}</h1>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <table class="table table-striped mt-2" >
            <thead style="background-color: rgb(221, 63, 63);">
                <tr >
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
                        {{-- <td>
                            <form action="{{ route('tareas-estudiante.calificar', ['tareaEstudiante' => $tareaEstudiante]) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <input type="number" name="calificacion" value="{{ $tareaEstudiante->calificacion }}">
                                <button type="submit" class="btn btn-primary">Calificar</button>
                            </form>
                        </td> --}}
                        <td>
                            <!-- Agrega aquí las acciones que desees, como editar o eliminar -->
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
