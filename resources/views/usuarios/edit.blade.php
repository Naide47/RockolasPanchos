@extends('layout.layout')
{{-- @section('titulo')
    Editar usuario
@endsection --}}

@section('head')
    <link rel="stylesheet" href="{{ asset('css/buttons.css') }}">
@endsection

@section('contents')
    <div class="container-fluid bg-white mb-5">
        <div class="row">
            <div class="col">
                <h1>Editar usuario</h1>
            </div>
        </div>
        <div class="row">
            <div class="col mb-2">
                @error('no_changes')
                    <div class="alert alert-warning" role="alert">
                        {{ $message }}
                    </div>
                @enderror

                {!! Form::open(['route' => ['usuarios.update', $mUsuario->usuario_id], 'method' => 'PUT']) !!}
                {{-- Nombre del usuario --}}
                <div class="row bg-light mb-2 pt-2 rounded">
                    <div class="col">
                        <div class="form-group">
                            {!! Form::label('nombre', 'Nombre completo') !!}
                            {!! Form::text('nombre', $mUsuario->nombre, ['class' => 'form-control', 'required']) !!}
                            @error('nombre')
                                <div class="alert alert-danger" role="alert">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                </div>
                {{-- Direccion del empleado --}}
                <div class="row bg-light mb-2 pt-2 rounded">
                    <div class="col">
                        <div class="form-group">
                            {!! Form::label('colonia', 'Dirección: colonia') !!}
                            {!! Form::text('colonia', $mUsuario->colonia, ['class' => 'form-control', 'required']) !!}
                            @error('colonia')
                                <div class="alert alert-danger" role="alert">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            {!! Form::label('calle', 'Dirección: calle') !!}
                            {!! Form::text('calle', $mUsuario->colonia, ['class' => 'form-control', 'required']) !!}
                            @error('calle')
                                <div class="alert alert-danger" role="alert">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            {!! Form::label('codigoPostal', 'Codigo Postal') !!}
                            {!! Form::text('codigoPostal', $mUsuario->codigoPostal, ['class' => 'form-control', 'required']) !!}
                            @error('codigoPostal')
                                <div class="alert alert-danger" role="alert">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                </div>
                {{-- Números de contacto --}}
                <div class="row bg-light mb-2 pt-2 rounded">
                    <div class="col">
                        <div class="form-group">
                            {!! Form::label('telefono', 'Telefono') !!}
                            {!! Form::text('telefono', $mUsuario->telefono, ['class' => 'form-control', 'required']) !!}
                            @error('telefono')
                                <div class="alert alert-danger" role="alert">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            {!! Form::label('celular', 'Celular') !!}
                            {!! Form::text('celular', $mUsuario->celular, ['class' => 'form-control', 'required']) !!}
                            @error('celular')
                                <div class="alert alert-danger" role="alert">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                </div>
                {{-- Datos del usuario --}}
                <div class="row bg-light mb-2 pt-2 rounded">
                    <div class="col">
                        <div class="form-group">
                            {!! Form::label('correo', 'Correo Electronico') !!}
                            {!! Form::email('correo', $mUsuario->email, ['class' => 'form-control', 'required']) !!}
                            @error('correo')
                                <div class="alert alert-danger" role="alert">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            {!! Form::label('contrasenia', 'Actualizar contraseña (min: 8; max: 12)') !!}
                            {!! Form::password('contrasenia', ['class' => 'form-control']) !!}
                            @error('contrasenia')
                                <div class="alert alert-danger" role="alert">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col">
                        <div class="form group">
                            {!! Form::label('confContrasenia', 'Confirmar nueva contraseña') !!}
                            {!! Form::password('confContrasenia', ['class' => 'form-control']) !!}
                            @error('confContrasenia')
                                <div class="alert alert-danger" role="alert">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                </div>
                {{-- Rol --}}
                <div class="row bg-light mb-2 pt-2 rounded">
                    <div class="col">
                        <div class="form-group">
                            {!! Form::label('rol', 'Rol') !!}
                            <select name="rol" id="rol" class="form-control" required>
                                <option value="" selected disabled>Selecciona un rol</option>
                                @foreach ($mRoles as $rol)
                                    @if ($rol->rol == $mUsuario->rol)
                                        <option value="{{ $rol->id }}" selected>{{ $rol->rol }}</option>
                                    @else
                                        <option value="{{ $rol->id }}">{{ $rol->rol }}</option>
                                    @endif
                                @endforeach
                            </select>
                            @error('rol')
                                <div class="alert alert-danger" role="alert">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        {!! Form::submit('Modificar usuario', ['class' => 'btn btn-success']) !!}
                        <a name="btnBack" id="btnBack" class="btn btn-secondary" href="{{ route('usuarios.index') }}"
                            role="button">Cancelar</a>
                    </div>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection
