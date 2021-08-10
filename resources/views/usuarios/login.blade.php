<!doctype html>
<html lang="es-MX">

<head>
    <title>Iniciar sesión</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <style>
        html,
        body {
            height: 100vh;
        }

    </style>
</head>

<body>
    <div class="container vh-100">
        <div class="row vh-100 align-items-center justify-content-center">
            <div class="col-xl-4 ">
                <h1>Iniciar sesión</h1>
                {!! Form::open(['url' => 'login']) !!}
                <div class="row">
                    <div class="col">
                        @error('auth_error')
                            <div class="alert alert-danger" role="alert">
                                {{ $message }}
                            </div>
                        @enderror
                        <div class="form-group">
                            {!! Form::label('email', 'Correo electronico') !!}
                            {!! Form::email('email', old('email'), ['class' => 'form-control']) !!}
                            @error('email')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            {!! Form::label('password', 'Contraseña') !!}
                            {!! Form::password('password', ['class' => 'form-control']) !!}
                            @error('password')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            {!! Form::submit('Iniciar sesión', ['class' => 'btn btn-primary btn-block']) !!}
                        </div>
                    </div>
                </div>
                {!! Form::close() !!}
            </div>

        </div>

    </div>
</body>

</html>
