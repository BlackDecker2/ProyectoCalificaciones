@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">Crear Materia</h3>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            {!! Form::open(['route' => 'materias.store', 'method' => 'POST']) !!}
                            <div class="form-group">
                                <label for="nombre">Nombre de la Materia:</label>
                                {!! Form::text('nombre', null, ['class' => 'form-control']) !!}
                            </div>
                            <div class="form-group">
                                <label for="codigo">Código de la Materia:</label>
                                {!! Form::text('codigo', null, ['class' => 'form-control']) !!}
                            </div>
                            <label for="profesores">Profesores:</label>
                            <select name="profesores[]" multiple>
                                @foreach ($profesores as $profesor)
                                    <option value="{{ $profesor->id }}">{{ $profesor->name }}</option>
                                @endforeach
                            </select>

                            <!-- Puedes agregar más campos según tus necesidades -->

                            <button type="submit" class="btn btn-primary">Guardar</button>
                            <a href="{{ route('materias.index') }}" class="btn btn-secondary">Cancelar</a>
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
