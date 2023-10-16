@extends('layouts.app')

@section('title')
   Detalles de Materia - {{ $materia->nombre }}
@endsection

@section('content')
<section class="section">
    <div class="section-header">
        <h3 class="page__heading">{{ $materia->nombre }}</h3>
    </div>
    <div class="section-body">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <!-- Detalles de la materia -->
                        <h5>Detalles de la Materia</h5>

                        <!-- Otras secciones de detalles de la materia -->
                    <div class="section">
                        <h2>Tareas relacionadas:</h2>
                        @if ($tareas->count() > 0)
                        <ul>
                            @foreach ($tareas as $tarea)
                                <li>{{ $tarea->nombre }} - Fecha de vencimiento: {{ $tarea->fecha_vencimiento }}</li>
                            @endforeach
                        </ul>
                        @else
                        <p>No hay tareas relacionadas con esta materia.</p>
                        @endif
                    </div>

                        <!-- Agrega aquí los detalles de la materia -->
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <!-- Lista de Tareas -->
                        <h5>Tareas de {{ $materia->nombre }}</h5>
                        @include('tareas.index')
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
