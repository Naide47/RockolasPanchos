@extends('layout.layout')
{{-- @section('titulo')
    Agregar usuario
@endsection --}}

@section('head')
    <link rel="stylesheet" href="{{ asset('css/buttons.css') }}">
@endsection

@section('contents')
    <div class="container-fluid bg-white mb-5">
        {{-- Titulo --}}
        <div class="row">
            <div class="col">
                <h1>Agregar usuario</h1>
            </div>
        </div>
        {{-- Formulario --}}
        <div class="row">
            <div class="col">
                {!! Form::open(['url' => 'usuarios']) !!}
                {{-- Nombre del usuarios --}}
                <div class="row bg-light mb-2 pt-2 rounded">
                    <div class="col">
                        <div class="form-group">
                            {!! Form::label('nombre', 'Nombre completo') !!}
                            {!! Form::text('nombre', old('nombre'), ['class' => 'form-control', 'required']) !!}
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
                            {!! Form::text('colonia', old('colonia'), ['class' => 'form-control', 'required']) !!}
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
                            {!! Form::text('calle', old('calle'), ['class' => 'form-control', 'required']) !!}
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
                            {!! Form::text('codigoPostal', old('codigoPostal'), ['class' => 'form-control', 'required']) !!}
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
                            {!! Form::text('telefono', old('telefono'), ['class' => 'form-control', 'required']) !!}
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
                            {!! Form::text('celular', old('celular'), ['class' => 'form-control', 'required']) !!}
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
                            {!! Form::email('correo', old('correo'), ['class' => 'form-control', 'required']) !!}
                            @error('correo')
                                <div class="alert alert-danger" role="alert">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            {!! Form::label('contrasenia', 'Contraseña') !!}
                            {!! Form::password('contrasenia', ['class' => 'form-control', 'required']) !!}
                        </div>
                    </div>
                    <div class="col">
                        <div class="form group">
                            {!! Form::label('confContrasenia', 'Confirmar contraseña') !!}
                            {!! Form::password('confContrasenia', ['class' => 'form-control', 'required']) !!}
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
                                    <option value="{{ $rol->idRol }}">{{ $rol->rol }}</option>
                                @endforeach
                            </select>
                            @error('rol')

                            @enderror
                        </div>
                    </div>
                </div>
                {{Form::submit('Agregar', ["class"=>"btn btn-success"])}}
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection

@section('contenidos')
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
                    {!! Form::text('nombre', old('nombre'), ['class' => 'form-control', 'required']) !!}
                </div>
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            {!! Form::label('colonia', 'Dirección: colonia') !!}
                            {!! Form::text('colonia', old('colonia'), ['class' => 'form-control', 'required']) !!}
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            {!! Form::label('calle', 'Dirección: calle') !!}
                            {!! Form::text('calle', old('calle'), ['class' => 'form-control', 'required']) !!}
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            {!! Form::label('codigoPostal', 'Codigo Postal') !!}
                            {!! Form::text('codigoPostal', old('codigoPostal'), ['class' => 'form-control', 'required']) !!}
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            {!! Form::label('telefono', 'Telefono') !!}
                            {!! Form::text('telefono', old('telefono'), ['class' => 'form-control', 'required']) !!}
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            {!! Form::label('celular', 'Celular') !!}
                            {!! Form::text('celular', old('celular'), ['class' => 'form-control', 'required']) !!}
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::label('correo', 'Correo Electronico') !!}
                    {!! Form::email('correo', old('correo'), ['class' => 'form-control', 'required']) !!}
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
