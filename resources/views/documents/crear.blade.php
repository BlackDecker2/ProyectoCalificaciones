<!-- resources/views/documentos/create.blade.php -->

@extends('layouts.app')

@section('content')
    <h1>Crear documento</h1>

    <form action="{{ route('documents.store') }}" method="post" enctype="multipart/form-data">
        @csrf

        <div class="form-group">
            <label for="nombre">Nombre del documento</label>
            <input type="text" name="nombre" id="nombre" class="form-control" value="{{ old('nombre') }}" required>
        </div>

        <div class="form-group">
            <label for="descripcion">Descripción</label>
            <textarea name="descripcion" id="descripcion" class="form-control">{{ old('descripcion') }}</textarea>
        </div>

        <div class="form-group">
            <label for="archivo">Archivo</label>
            <input type="file" name="archivo" id="archivo" class="form-control-file" required>
        </div>

        <button type="submit" class="btn btn-primary">Crear</button>
        <a href="{{ route('documents.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
@endsection
