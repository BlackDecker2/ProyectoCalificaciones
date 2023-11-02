@extends('layouts.app')

@section('title', 'Eliminar Tarea')

@section('content')
    <div class="container" style="margin-top: 40px">
        <h1 class="my-4">Eliminar Tarea</h1>

        <p>¿Estás seguro de que deseas eliminar esta tarea?</p>

        <form action="{{ route('tareas-estudiante.destroy', $tarea) }}" method="post">
            @csrf
            @method('DELETE')

            <button type="submit" class="btn btn-danger">Eliminar Tarea</button>
            <a href="{{ route('home') }}" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
@endsection
