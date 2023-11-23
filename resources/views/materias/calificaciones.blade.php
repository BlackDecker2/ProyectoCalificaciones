@extends('layouts.app')

@section('content')
<div class="container" style="margin-top: 5%">
    <div class="section-header">
        <h3 class="page__heading">Estudiantes matriculados en {{ $materia->nombre }}</h3>
    </div>

    @if ($matriculas->count() > 0)
    <form action="{{ route('materias.desmatricular-estudiantes', $materia) }}" method="POST">
        @csrf
        @method('DELETE')

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Estudiante</th>
                    <th>Email</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($matriculas as $matricula)
                <tr>
                    <td>{{ $matricula->name }}</td>
                    <td>{{ $matricula->email }}</td>
                    <!-- Agrega checkboxes para seleccionar los estudiantes que deseas desmatricular -->
                    <td><input style="background-color: red;" type="checkbox" name="estudiantes[]" value="{{ $matricula->id }}"></td>
                </tr>
                @endforeach
            </tbody>
        </table>

        @can('desmatricular-estudiantes')
        <button type="submit" class="btn btn-danger">Desmatricular Estudiantes Seleccionados</button>
        @endcan
        <a href="{{ route('tareas.index', ['materia' => $materia->id]) }}" class="btn btn-info">volver</a>
    </form>
    @else
    <p>No hay estudiantes matriculados en esta materia.</p>
    @endif
</div>
@endsection
