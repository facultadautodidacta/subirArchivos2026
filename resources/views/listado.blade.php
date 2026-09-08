<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <title>Title</title>
</head>
<body>
    <h2>Archivos subidos</h2>
        @if(!empty($archivos) && count($archivos) > 0)
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Ruta</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($archivos as $archivo)
                            <tr>
                                <td>{{ basename($archivo) }}</td>
                                <td>{{ $archivo }}</td>
                                <td>
                                    <a href="{{ Storage::url($archivo) }}" target="_blank" class="btn btn-sm btn-primary">
                                        Ver
                                    </a>
                                    <a href="{{ Storage::url($archivo) }}" download="{{ basename($archivo) }}" 
                                        class="btn btn-sm btn-success">
                                        Descargar
                                    </a>

                                    <!-- Formulario sencillo para eliminar -->
                                    <form action="{{ route('eliminar-archivo') }}" method="POST" 
                                        style="display:inline-block; margin-left:6px;">
                                        @csrf
                                        <input type="hidden" name="archivo" value="{{ $archivo }}">
                                        <button type="submit" class="btn btn-sm btn-danger" 
                                            onclick="return confirm('¿Eliminar este archivo?');">
                                            Eliminar
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <p>No hay archivos subidos</p>
        @endif
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
</body>
</html>
