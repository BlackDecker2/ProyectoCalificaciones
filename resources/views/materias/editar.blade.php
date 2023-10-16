@extends('layouts.app')

@section('title', 'Editar Materia')

@section('content')
<div class="container" style="margin-top: 40px;">
    <h1 class="my-4">Editar Materia</h1>

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

    <form action="{{ route('materias.update', ['materia' => $materia]) }}" method="post">
        @csrf
        @method('PUT')
    
        <div class="form-group">
            <label for="nombre">Nombre de la materia</label>
            <input type="text" name="nombre" id="nombre" class="form-control" value="{{ old('nombre', $materia->nombre) }}" required>
        </div>
    
        <div class="form-group">
            <label for="codigo">Código de la materia</label>
            <input type="text" name="codigo" id="codigo" class="form-control" value="{{ old('codigo', $materia->codigo) }}" required>
        </div>
    
        <div class="form-group">
            <label for="profesores">Profesores:</label>
            <select name="profesores[]" id="profesores" class="form-control" multiple>
                @foreach ($profesores as $profesor)
                    <option value="{{ $profesor->id }}" @if(in_array($profesor->id, $materia->profesores->pluck('id')->toArray())) selected @endif>{{ $profesor->name }}</option>
                @endforeach
            </select>
        </div>
        
        
    
        <button type="submit" class="btn btn-primary">Actualizar Materia</button>
        <a href="{{ route('materias.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
    
</div>
@endsection
