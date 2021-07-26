@extends('layout.layout')
@section('titulo')
    Editar usuario
@endsection

@section('contenido')
    <div class="container">
        <div class="row mb-3 text-center">
            <div class="col">
                <h1>Usuarios</h1>
                <h2>Editar usuario</h2>
            </div>
        </div>
        @if (Session::has('flash-error'))
            <div class="row bg-danger">
                <div class="col">
                    <p class="text-light">{{ Session::get('flash-error') }}</p>
                </div>
            </div>
        @endif
        <div class="row">
            <div class="col">
                {!! Form::model($mUsuario, [$options]) !!}
            </div>
        </div>
    </div>

@endsection
