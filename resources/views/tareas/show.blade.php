@extends('layouts.app')

@section('title', 'Detalles de Tarea - ' . $tarea->nombre)

@section('content')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">{{ $tarea->nombre }}</h3>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <!-- Detalles de la tarea -->
                            <h5 class="mb-4">Detalles de la Tarea</h5>
                            <p><strong>Descripción:</strong> {{ $tarea->descripcion }}</p>
                            <p><strong>Fecha de Vencimiento:</strong> {{ $tarea->fecha_vencimiento }}</p>
                            <p><strong>Porcentaje:</strong> {{ $tarea->porcentaje }}%</p>
                            <p><strong>Materia:</strong> {{ $tarea->materia->nombre }}</p>
                            
                            <!-- Agrega más información de la tarea aquí si lo deseas -->
                            
                            <!-- Botón para volver a la lista de tareas -->
                            <a href="{{ route('tareas.index', ['materia' => $materia->id]) }}">Volver a Tareas</a>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
