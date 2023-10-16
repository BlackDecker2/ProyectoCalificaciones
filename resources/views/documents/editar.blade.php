<!-- resources/views/documentos/edit.blade.php -->

@extends('layouts.app')

@section('content')
    <h1>Editar documento</h1>

    <form action="{{ route('documents.update', $document) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="nombre">Nombre del documento</label>
            <input type="text" name="nombre" id="nombre" class="form-control" value="{{ old('nombre', $document->nombre) }}" required>
        </div>

        <div class="form-group">
            <label for="descripcion">Descripción</label>
            <textarea name="descripcion" id="descripcion" class="form-control">{{ old('descripcion', $document->descripcion) }}</textarea>
        </div>

        <div class="form-group">
            <label for="archivo">Archivo</label>
            <input type="file" name="archivo" id="archivo" class="form-control-file">
        </div>

        <button type="submit" class="btn btn-primary">Actualizar</button>
        <a href="{{ route('documents.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
@endsection
