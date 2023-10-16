@extends('layouts.app')
@section('title')
    Documentos Usuario - Univalle
@endsection
@section('content')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">Documentos</h3>
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
                            @can('crear-documento')
                                <a class="btn btn-warning" href="{{ route('documents.create') }}">Nuevo</a>
                            @endcan
            
                            <table class="table table-striped mt-2">
                                <thead style="background-color:#ec4b4b">                                     
                                    <th style="display: none;">ID</th>
                                    <th style="color:#fff;">Nombre</th>
                                    <th style="color:#fff;">Tipo</th>                                    
                                    <th style="color:#fff;">Estado</th>
                                    <th style="color:#fff;">Acciones</th>                                                                   
                              </thead>
                              <tbody>
                                  @foreach ($ownDocuments as $document)
                                    <tr>
                                        <td style="display: none;">{{ $document->id }}</td>                                
                                        <td>{{ $document->nombre }}</td>
                                        <td>{{ $document->tipo }}</td>
                                        <td>{{ $document->estado }}</td>
                                        <td>
                                            <form action="{{ route('documents.destroy', $document->id) }}" method="POST">                                        
                                                @can('editar-documento')                                                
                                                    <a class="btn btn-info" href="{{ route('documents.edit', $document->id) }}">Editar</a>
                                                @endcan

                                                @csrf
                                                @method('DELETE')
                                                @can('borrar-documento')
                                                    <button type="submit" class="btn btn-danger">Borrar</button>
                                                @endcan
                                                @can('descargar-documento')
                                                    <a class="btn btn-success" href="documentos/{{ $document->archivo }}" target="_blank">Descargar</a>
                                                @endcan
                                                @can('compartir-documento')
                                                    <a class="btn btn-primary" href="{{ route('documents.share', ['document' => $document->id]) }}">Compartir</a>
                                                @endcan
                                            </form>
                                        </td>
                                    </tr>
                                  @endforeach
                                  @foreach ($sharedDocuments as $sharedDocument)
                                    <tr>
                                        <td style="display: none;">{{ $sharedDocument->id }}</td>                                
                                        <td>{{ $sharedDocument->nombre }}</td>
                                        <td>{{ $sharedDocument->tipo }}</td>
                                        <td>{{ $sharedDocument->estado }}</td>
                                        <td>
                                            <form action="{{ route('documents.destroy', $sharedDocument->id) }}" method="POST">                                        
                                                @can('editar-documento')                                                
                                                    <a class="btn btn-info" href="{{ route('documents.edit', $sharedDocument->id) }}">Editar</a>
                                                @endcan

                                                @csrf
                                                @method('DELETE')
                                                @can('borrar-documento')
                                                    <button type="submit" class="btn btn-danger">Borrar</button>
                                                @endcan
                                                @can('descargar-documento')
                                                    <a class="btn btn-primary" href="documentos/{{ $sharedDocument->archivo }}" target="_blank">Descargar</a>
                                                @endcan
                                                @can('compartir-documento')
                                                    <a href="{{ route('documents.share', $document->id) }}" class="btn btn-light">
                                                        Compartir
                                                    </a> 
                                                @endcan
                                            </form>
                                        </td>
                                    </tr>
                                  @endforeach
                            </tbody>
                            </table>

                            <!-- Ubicamos la paginacion a la derecha -->
                            <div class="pagination justify-content-end">
                                {!! $ownDocuments->links() !!}
                            </div>
                            <div class="pagination justify-content-end">
                                {!! $sharedDocuments->links() !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
