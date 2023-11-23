@extends('layouts.app')
@section('title')
   Usuarios Crud - Univalle
@endsection
@section('content')
<section class="section">
  <div class="section-header">
      <h3 class="page__heading">Usuarios</h3>
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
                        
                            <table class="table table-striped mt-2">
                              <thead style="background-color: #c20003">                                     
                                  <th style="display: none;">ID</th>
                                  <th style="color:#fff;">Nombre</th>
                                  <th style="color:#fff;">E-mail</th>
                                  <th style="color:#fff;">Rol</th>
                                  <th style="color:#fff;">Acciones</th>                                                                
                              </thead>
                              <tbody>
                                @foreach ($usuarios as $usuario)
                                  <tr>
                                    <td style="display: none;">{{ $usuario->id }}</td>
                                    <td>{{ $usuario->name }}</td>
                                    <td>{{ $usuario->email }}</td>
                                    <td>
                                      @if(!empty($usuario->getRoleNames()))
                                        @foreach($usuario->getRoleNames() as $rolNombre)                                       
                                          <h5><span class="badge badge-dark">{{ $rolNombre }}</span></h5>
                                        @endforeach
                                      @endif
                                    </td>

                                    <td>     
                                      @can('editar-usuario')                             
                                      <a class="btn btn-details" href="{{ route('usuarios.edit',$usuario->id) }}">Editar</a>
                                      @endcan
                                      @can('borrar-usuario')
                                      {!! Form::open(['method' => 'DELETE','route' => ['usuarios.destroy', $usuario->id],'style'=>'display:inline']) !!}
                                          {!! Form::submit('Borrar', ['class' => 'btn btn-danger']) !!}
                                      {!! Form::close() !!}
                                      @endcan
                                    </td>
                                  </tr>
                                @endforeach
                              </tbody>
                            </table>
                            <!-- Centramos la paginacion a la derecha -->
                          <div class="pagination justify-content-end">
                            {!! $usuarios->links() !!}
                          </div>     
                            
                      </div>
                  </div>
              </div>
          </div>
      </div>
    </section>
@endsection