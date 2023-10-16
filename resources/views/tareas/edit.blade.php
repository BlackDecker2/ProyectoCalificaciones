@extends('layouts.app')

@section('title', 'Editar Tarea')

@section('content')
<div class="container">
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

    <form action="{{ route('tareas.update', ['materia' => $materia, 'tarea' => $tarea]) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="nombre">Nombre de la tarea</label>
            <input type="text" name="nombre" id="nombre" class="form-control" value="{{ old('nombre', $tarea->nombre) }}" required>
        </div>

        <div class="form-group">
            <label for="descripcion">Descripción de la tarea</label>
            <input type="text" name="descripcion" id="descripcion" class="form-control" value="{{ old('descripcion', $tarea->descripcion) }}" required>
        </div>

        <div class="form-group">
            <label for="fecha_vencimiento">Fecha de Vencimiento</label>
            <input type="date" name="fecha_vencimiento" id="fecha_vencimiento" class="form-control" value="{{ old('fecha_vencimiento', $tarea->fecha_vencimiento) }}" required>
        </div>

        <!-- Agregar más campos de edición según tus necesidades -->

        <div class="form-group">
            <label for="porcentaje">Porcentaje de Completitud</label>
            <input type="number" name="porcentaje" id="porcentaje" class="form-control" value="{{ old('porcentaje', $tarea->porcentaje) }}" min="0" max="100" required>
        </div>
        <p>Porcentaje disponible: <span id="porcentaje-disponible">{{ 100 - $tareas->sum('porcentaje') }}</span></p>

        <div class="form-group">
            <label for="archivo">Archivo Adjunto</label>
            <input type="file" name="archivo" id="archivo" class="form-control-file">
        </div>

        <button type="submit" class="btn btn-primary">Actualizar Tarea</button>
        <a href="{{ route('materias.index', $materia) }}" class="btn btn-secondary">Cancelar</a>
    </form>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const porcentajeInput = document.getElementById('porcentaje');
            const porcentajeDisponible = document.getElementById('porcentaje-disponible');
    
            porcentajeInput.addEventListener('input', function () {
                const porcentajeIngresado = parseInt(porcentajeInput.value);
                const porcentajeOcupado = {{ $tareas->sum('porcentaje') }};
                const porcentajeRestante = 100 - porcentajeOcupado;
    
                porcentajeDisponible.textContent = porcentajeRestante;
    
                if (porcentajeIngresado > porcentajeRestante) {
                    porcentajeInput.setCustomValidity('El porcentaje excede el disponible.');
                } else {
                    porcentajeInput.setCustomValidity('');
                }
            });
        });
    </script>
</div>
@endsection
