@extends('layout.layout')
@section('titulo')
    Detalles del usuario
@endsection

@section('contenido')
    <div class="container text-center">
        <div class="row mb-5">
            <div class="col text-center">
                <h1>Usuarios</h1>
                <h2>Detalles del usuario</h2>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col">
                <table class="table text-center">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Puesto</th>
                            <th>Correo electronico</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td scope="row">{{ $mPersona->nombre }}</td>
                            @switch($mUsuario->idRol)
                                @case(1)
                                    <td>Vendedor</td>
                                @break
                                @case(2)
                                    <td>Encargado</td>
                                @break
                                @case(3)
                                    <td>Gerente</td>
                                @break
                            @endswitch
                            <td>{{ $mUsuario->email }}</td>
                        </tr>
                    </tbody>
                    <caption>Nombre y puesto</caption>
                </table>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col">
                <table class="table text-center">
                    <thead>
                        <tr>
                            <th>Colonia</th>
                            <th>Calle</th>
                            <th>Codigo Postal</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td scope="row">{{ $mPersona->colonia }}</td>
                            <td>{{ $mPersona->calle }}</td>
                            <td>{{ $mPersona->codigoPostal }}</td>
                        </tr>
                        <caption>Domicilio</caption>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <table class="table ">
                    <thead>
                        <tr>
                            <th>Número de telefono</th>
                            <th>Número de celular</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td scope="row">{{$mPersona->telefono}}</td>
                            <td>{{$mPersona->celular}}</td>
                        </tr>
                    </tbody>
                    <caption>Números de contacto</caption>
                </table>
            </div>
        </div>
        <div class="row">
            <div class="col text-right">
                <a class="btn btn-secondary" href="{{ route('usuarios.index') }}" role="button">Volver</a>
            </div>
        </div>
    </div>

@endsection
