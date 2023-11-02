@extends('layouts.app')

@section('title', 'Editar Tarea')

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

        <form action="{{ route('tareas-estudiante.update', $tarea) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <!-- Agrega los campos para editar la tarea -->
            <!-- Ejemplo: nombre, descripción, fecha de vencimiento, archivo adjunto, etc. -->
            <!-- Los campos deben estar prellenados con los datos actuales de la tarea -->

            <button type="submit" class="btn btn-primary">Actualizar Tarea</button>
            <a href="{{ route('home') }}" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
@endsection
