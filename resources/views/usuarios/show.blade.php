@extends('layout.users')

@section('title')
    Detalles del usuario
@endsection

@section('head')
    <link rel="stylesheet" href="{{ asset('css/buttons.css') }}">
@endsection

@section('contents')
    <div class="container-fluid bg-white my-5 text-center">
        <div class="row">
            <div class="col text-left">
                <h1>Detalles del usuario</h1>
            </div>
        </div>
        <div class="row">
            <div class="col bg-light mb-2 rounded pt-5">
                <table class="table text-center">
                    <caption>Datos generales</caption>
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Puesto</th>
                            <th>Correo electronico</th>
                            <th>Fecha de registro</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{ $mUsuario->nombre }}</td>
                            <td>{{ $mUsuario->rol }}</td>
                            <td>{{ $mUsuario->email }}</td>
                            <td>{{ $mUsuario->created_at }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="row">
            <div class="col bg-light mb-2 rounded pt-5">
                <table class="table text-center">
                    <caption>Domicilio</caption>
                    <thead>
                        <tr>
                            <th>Colonia</th>
                            <th>Calle</th>
                            <th>Codigo Postal</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{ $mUsuario->colonia }}</td>
                            <td>{{ $mUsuario->calle }}</td>
                            <td>{{ $mUsuario->codigoPostal }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="row">
            <div class="col bg-light mb-2 rounded pt-5">
                <table class="table text-center">
                    <caption>Números de contacto</caption>
                    <thead>
                        <tr>
                            <th>Número de telefono</th>
                            <th>Número de celular</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{ $mUsuario->telefono }}</td>
                            <td>{{ $mUsuario->celular }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="row ">
            <div class="col text-left mb-3">
                <a class="btn btn-secondary" href="{{ route('usuarios.index') }}" role="button">Volver</a>
            </div>
        </div>
    </div>
@endsection
