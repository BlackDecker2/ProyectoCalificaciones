
@extends('layouts.app')

@section('title')
    Editar Tarea - {{ $tareaEstudiante->nombre }}
@endsection

@section('content')
    <div class="container" style="margin-top: 40px">
        <h1 class="my-4">Editar Tarea</h1>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('tareas-estudiante.update', ['materia' => $materia->id, 'tareaEstudiante' => $tareaEstudiante->id]) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <input type="hidden" name="tarea_id" value="{{ $tareaEstudiante->tarea_id }}">

            <div class="form-group">
                <label for="nombre">Nombre de la tarea</label>
                <input type="text" name="nombre" id="nombre" class="form-control" value="{{ old('nombre', $tareaEstudiante->nombre) }}" required>
            </div>

            <div class="form-group">
                <label for="descripcion">Descripción de la tarea</label>
                <textarea name="descripcion" id="descripcion" class="form-control" required>{{ old('descripcion', $tareaEstudiante->descripcion) }}</textarea>
            </div>

            <div class="form-group">
                <label for="archivo">Archivo Adjunto</label>
                <input type="file" name="archivo" id="archivo" class="form-control-file">
            </div>

            <button type="submit" class="btn btn-info">Guardar Cambios</button>
            <a href="{{ route('tareas-estudiante.index', ['materia' => $materia->id, 'tarea' => $tareaEstudiante->tarea_id]) }}" class="btn btn-details">Cancelar</a>
        </form>
    </div>
@endsection
