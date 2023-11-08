@extends('layouts.app')

@section('title', 'Cargar Nueva Tarea')

@section('content')
    <div class="container" style="margin-top: 40px">
        <h1 class="my-4">Cargar Nueva Tarea</h1>

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

        <form action="{{ route('tareas-estudiante.store') }}" method="post" enctype="multipart/form-data">
            @csrf
        
            <input type="hidden" name="tarea_id" value="{{ $tarea->id }}">

        
            <div class="form-group">
                <label for="nombre">Nombre de la tarea</label>
                <input type="text" name="nombre" id="nombre" class="form-control" value="{{ old('nombre') }}" required>
            </div>
        
            <div class="form-group">
                <label for="descripcion">Descripción de la tarea</label>
                <textarea name="descripcion" id="descripcion" class="form-control" required>{{ old('descripcion') }}</textarea>
            </div>
        
            <div class="form-group">
                <label for="archivo">Archivo Adjunto</label>
                <input type="file" name="archivo" id="archivo" class="form-control-file">
            </div>
        
            <button type="submit" class="btn btn-primary">Cargar Tarea</button>
            <a href="{{ route('home') }}" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
@endsection
