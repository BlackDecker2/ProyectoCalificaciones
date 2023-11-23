@extends('layouts.app')

@section('content')
    <section class="section" style="margin-top: 50px">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6 col-md-8">
                    <div class="card">
                        <div class="card-body" >
                            <h3 class="card-title">Editar Usuario</h3>

                            @if ($errors->any())
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <strong>¡Revise los campos!</strong>
                                    @foreach ($errors->all() as $error)
                                        <span>{{ $error }}</span>
                                    @endforeach
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif

                            {!! Form::model($user, ['method' => 'PATCH','route' => ['usuarios.update', $user->id]]) !!}
                            <div class="form-group">
                                {!! Form::label('name', 'Nombre') !!}
                                {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Nombre']) !!}
                            </div>

                            <div class="form-group">
                                {!! Form::label('email', 'E-mail') !!}
                                {!! Form::email('email', null, ['class' => 'form-control', 'placeholder' => 'E-mail']) !!}
                            </div>

                            <div class="form-group">
                                {!! Form::label('password', 'Password') !!}
                                {!! Form::password('password', ['class' => 'form-control', 'placeholder' => 'Password']) !!}
                            </div>

                            <div class="form-group">
                                {!! Form::label('password_confirmation', 'Confirmar Password') !!}
                                {!! Form::password('password_confirmation', ['class' => 'form-control', 'placeholder' => 'Confirmar Password']) !!}
                            </div>

                            <div class="form-group">
                                {!! Form::label('roles', 'Roles') !!}
                                {!! Form::select('roles[]', $roles, $userRole, ['class' => 'form-control', 'multiple']) !!}
                            </div>

                            <button type="submit" class="btn btn-details btn-block">Guardar</button>
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
