<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <title>Subir archivo</title>
</head>
<body>
    <!-- Mostrar mensajes -->
       <div class="container">
        <div class="row">
            <div class="col">
                <h1>Subir archivo</h1>
                @if(session('mensaje'))
                    <div class="mensaje-exito">
                        {{ session('mensaje') }}
                    </div>
                @endif
        
                @if(session('error'))
                    <div class="mensaje-error">
                        {{ session('error') }}
                    </div>
                @endif
        
                <!-- Formulario -->
                <form action="{{ route('subir') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="file" name="archivo" required class="form-control">
                    <button class="btn btn-primary mt-3">Subir archivo</button>
                </form>

                <hr>
                @include("listado")
            </div>
        </div>
       </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
</body>
</html>