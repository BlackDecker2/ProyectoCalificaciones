@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="section-header" style="margin-top: 40px">
            <h3 class="page__heading">Matricular Estudiantes en {{ $materia->nombre }}</h3>
        </div>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('materias.matricularEstudiantes', $materia) }}" method="post">
            @csrf
            <div class="form-group">
                <label for="search">Buscar Estudiantes por Email:</label>
                <input type="text" name="search" id="search" class="form-control" placeholder="Ingrese el correo electrónico del estudiante">
            </div>
            <div id="suggestions"></div> <!-- Div para mostrar las sugerencias -->
            <div class="form-group">
                <label for="estudiantes">Estudiantes Seleccionados:</label>
                <select name="estudiantes[]" multiple class="form-control">
                    @foreach ($estudiantes as $estudiante)
                        <option value="{{ $estudiante->id }}">{{ $estudiante->name }} ({{ $estudiante->email }})</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-details">Matricular Estudiantes</button>
            <a href="{{ route('tareas.index', ['materia' => $materia->id]) }}" class="btn btn-info">Cancelar</a>

        </form>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script>
            $(document).ready(function () {
                $('#search').on('input', function () {
                    var query = $(this).val();
        
                    $.ajax({
                        url: "{{ route('materias.searchEstudiantes', $materia) }}", // Reemplaza 'estudiantes.search' con la ruta correcta
                        method: 'GET', // Cambia a GET
                        data: {
                            query: query
                        },
                        success: function (data) {
                            $('#suggestions').html(data);
                        }
                    });
                });
            });
        </script>
        

    </div>
@endsection
