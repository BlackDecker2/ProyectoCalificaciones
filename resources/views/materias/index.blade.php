@extends('layouts.app')

@section('title')
   Materias - Univalle
@endsection

@section('content')
<section class="section">
    <div class="section-header">
        <h3 class="page__heading">Materias</h3>
    </div>
    <div class="section-body">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    @if (session('success'))
                    <div id="alert-success" class="alert alert-success">
                        {{ session('success') }}
                    </div>
                    @endif

                    @if (session('warning'))
                    <div id="alert-warning" class="alert alert-warning">
                        {{ session('warning') }}
                    </div>
                    @endif

                    <script>
                        // Ocultar la alerta de éxito después de 5 segundos
                        setTimeout(function() {
                            document.getElementById('alert-success').style.display = 'none';
                        }, 4000);

                        // Ocultar la alerta de advertencia después de 5 segundos
                        setTimeout(function() {
                            document.getElementById('alert-warning').style.display = 'none';
                        }, 4000);
                    </script>
                    <div class="card-body">
                        @can('crear-materia')
                        <a class="btn btn-warning" href="{{ route('materias.create') }}">Nueva Materia</a>
                        @endcan

                        <div class="row" style="margin-top: 20px">
                            @foreach ($materias as $materia)
                            <div class="col-lg-4 mb-3">
                                <div class="card">
                                    <div class="card-header" style="background-color: #d31717; color: white; font-size: 20px;">
                                        {{ $materia->nombre }}
                                    </div>
                                    <div class="card-body">
                                        <p style="font-weight: bold;">Profesores:</p>
                                        <ul>
                                            @foreach($materia->profesores as $profesor)
                                                <li style="color: #e74c3c">{{ $profesor->name }}</li>
                                            @endforeach
                                        </ul>
                                        <p style="font-weight: bold;">Código: {{ $materia->codigo }}</p>
                                        <!-- Agrega más información de la materia aquí si lo deseas -->
                                    </div>
                                    
                                    <div class="card-footer">
                                        <a class="btn btn-info" href="{{ route('materias.edit', $materia->id) }}">Editar</a>
                                        <a class="btn btn-details" href="{{ route('materias.show', $materia) }}">Ver detalles</a>
                                        @can('borrar-materia')
                                        {!! Form::open(['method' => 'DELETE', 'route' => ['materias.destroy', $materia->id], 'style' => 'display:inline']) !!}
                                        {!! Form::submit('Borrar', ['class' => 'btn btn-danger']) !!}
                                        {!! Form::close() !!}
                                        @endcan
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
