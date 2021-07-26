@extends('layout.layout')
@section('titulo')
    Agregar usuario
@endsection

@section('contenido')
    <div class="container">
        <div class="row mb-3 text-center">
            <div class="col">
                <h1>Usuarios</h1>
                <h2>Agregar usuario</h2>
            </div>
        </div>
        @if (!$errors->isEmpty())
            <div class="row">
                <div class="col">
                    {{ HTML::ul($errors->all()) }}
                </div>
            </div>
        @endif
        <div class="row">
            <div class="col">
                {{ Form::open(['url' => 'usuarios']) }}
                <div class="form-group">
                    {!! Form::label('nombre', 'Nombre completo') !!}
                    {!! Form::text('nombre', Request::old('nombre'), ['class' => 'form-control', 'required']) !!}
                </div>
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            {!! Form::label('colonia', 'Dirección: colonia') !!}
                            {!! Form::text('colonia', Request::old('colonia'), ['class' => 'form-control', 'required']) !!}
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            {!! Form::label('calle', 'Dirección: calle') !!}
                            {!! Form::text('calle', Request::old('calle'), ['class' => 'form-control', 'required']) !!}
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            {!! Form::label('codigoPostal', 'Codigo Postal') !!}
                            {!! Form::text('codigoPostal', Request::old('codigoPostal'), ['class' => 'form-control', 'required']) !!}
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            {!! Form::label('telefono', 'Telefono') !!}
                            {!! Form::text('telefono', Request::old('telefono'), ['class' => 'form-control', 'required']) !!}
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            {!! Form::label('celular', 'Celular') !!}
                            {!! Form::text('celular', Request::old('celular'), ['class' => 'form-control', 'required']) !!}
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::label('correo', 'Correo Electronico') !!}
                    {!! Form::email('correo', Request::old('correo'), ['class' => 'form-control', 'required']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('contrasenia', 'Contraseña') !!}
                    {!! Form::password('contrasenia', ['class' => 'form-control', 'required']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('rol', 'Rol') !!}
                    <select name="rol" id="rol" class="form-control" required>
                        <option value="" selected disabled>Selecciona un rol</option>
                        @foreach ($mRoles as $rol)
                            <option value="{{ $rol->idRol }}">{{ $rol->rol }}</option>
                        @endforeach

                    </select>
                </div>
                <div class="row">
                    <div class="col text-right">
                        {{ Form::submit('Agregar usuario', ['class' => 'btn btn-success']) }}
                        <a class="btn btn-secondary" href="{{ route('usuarios.index') }}" role="button">Cancelar</a>
                    </div>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection
