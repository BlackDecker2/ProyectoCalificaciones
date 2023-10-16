@extends('layouts.app')

@section('title', 'Crear Nueva Tarea')

@section('content')
    <div class="container" style="margin-top: 40px">
        <h1 class="my-4">Crear Nueva Tarea</h1>

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

        <form action="{{ route('tareas.store', ['materia' => $materia]) }}" method="post" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
                <label for="nombre">Nombre de la tarea</label>
                <input type="text" name="nombre" id="nombre" class="form-control" value="{{ old('nombre') }}" required>
            </div>

            <div class="form-group">
                <label for="descripcion">Descripción de la tarea</label>
                <input type="text" name = "descripcion" id="descripcion" class="form-control" value="{{ old('descripcion') }}" required>
            </div>

            <div class="form-group">
                <label for="fecha_vencimiento">Fecha de Vencimiento</label>
                <input type="date" name="fecha_vencimiento" id="fecha_vencimiento" class="form-control" value="{{ old('fecha_vencimiento') }}" required>
            </div>

            <div class="form-group">
                <label for="porcentaje">Porcentaje de Completitud</label>
                <input type="number" name="porcentaje" id="porcentaje" class="form-control" value="{{ old('porcentaje', 0) }}" min="0" max="100" required>
            </div>
            <p>Porcentaje disponible: <span id="porcentaje-disponible">{{ 100 - $tareas->sum('porcentaje') }}</span></p>

            <div class="form-group">
                <label for="archivo">Archivo Adjunto</label>
                <input type="file" name="archivo" id="archivo" class="form-control-file">
            </div>

            <button type="submit" class="btn btn-primary">Crear Tarea</button>
            <a href="{{ route('tareas.index', ['materia' => $materia->id]) }}" class="btn btn-secondary">Cancelar</a>
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
