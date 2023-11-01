@extends('layouts.app')

@section('content')
<div class="container" style="margin-top: 5%">
    <div class="section-header">
        <h3 class="page__heading">Estudiantes matriculados en {{ $materia->nombre }}</h3>
    </div>

    @if ($matriculas->count() > 0)
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Estudiante</th>
                <th>Email</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($matriculas as $matricula)
            <tr>
                <td>{{ $matricula->name }}</td>
                <td>{{ $matricula->email }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @else
    <p>No hay estudiantes matriculados en esta materia.</p>
    @endif
</div>
@endsection
