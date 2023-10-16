@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Compartir documento') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('documents.doShare', $document->id) }}">
                            @csrf

                            <div class="form-group row">
                                <label for="document_name" class="col-md-4 col-form-label text-md-right">{{ __('Documento a compartir') }}</label>

                                <div class="col-md-6">
                                    <input id="document_name" type="text" class="form-control" value="{{ $document->nombre }}" readonly>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="items" class="col-md-4 col-form-label text-md-right">{{ __('Seleccionar usuarios') }}</label>

                                <div class="col-md-6">
                                    <select id="items" name="items[]" class="form-control" multiple required>
                                        @foreach ($users as $user)
                                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                                        @endforeach
                                    </select>

                                    @error('items')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button id="shareBtn" type="submit" class="btn btn-primary">
                                        {{ __('Compartir') }}
                                    </button>
                                    <a href="{{ route('documents.index') }}" class="btn btn-danger">
                                        {{ __('Cancelar') }}
                                    </a> 
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Barra de progreso
        document.getElementById('shareBtn').addEventListener('click', function() {
            var progressBar = document.createElement('div');
            progressBar.className = 'progress';
            progressBar.innerHTML = '<div class="progress-bar progress-bar-striped progress-bar-animated" style="width: 0%"></div>';
            document.getElementById('shareBtn').parentNode.appendChild(progressBar);
        });

        // Alerta de documento compartido
        window.onload = function() {
            var urlParams = new URLSearchParams(window.location.search);
            if (urlParams.has('shared')) {
                alert('El documento ya ha sido compartido');
            }
        };
    </script>
@endsection
