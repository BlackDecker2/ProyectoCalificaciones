  @extends('layouts.app')
@section('title')
    Roles Crud - Univalle
@endsection
@section('content')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">Roles</h3>
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
        
                        @can('crear-rol')
                        <a class="btn btn-warning" href="{{ route('roles.create') }}">Nuevo</a>                        
                        @endcan
        
                
                            <table class="table table-striped mt-2">
                                <thead style="background-color:#ec4b4b">                                                       
                                    <th style="color:#fff;">Rol</th>
                                    <th style="color:#fff;">Acciones</th>
                                </thead>  
                                <tbody>
                                @foreach ($roles as $role)
                                <tr>                           
                                    <td>{{ $role->name }}</td>
                                    <td>                                
                                        @can('editar-rol')
                                            <a class="btn btn-primary" href="{{ route('roles.edit',$role->id) }}">Editar</a>
                                        @endcan
                                        
                                        @can('borrar-rol')
                                            {!! Form::open(['method' => 'DELETE','route' => ['roles.destroy', $role->id],'style'=>'display:inline']) !!}
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
                                {!! $roles->links() !!} 
                            </div>                    
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
@endsection
