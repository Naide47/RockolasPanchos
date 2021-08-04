@extends('layout.users')

@section('title')
    Usuarios
@endsection

@section('head')
    <link rel="stylesheet" href="{{ asset('css/buttons.css') }}">
    <script src="{{ asset('js/index_functions.js') }}"></script>
@endsection

@section('contents')
    <div class="container-fluid bg-white my-5 text-center">
        {{-- Titulo --}}
        <div class="row">
            <div class="col text-left">
                <h1>Usuarios</h1>
            </div>
        </div>
        {{-- Barra de busqueda y boton de agregar --}}
        <div class="row justify-content-center mb-3">
            <div class="col-10">
                @include('layout.searchbar')
            </div>
            <div class="col-2">
                <a name="btnAgregarCategoria" id="btnAgregarCategoria" class="btn btn-success"
                    href="{{ route('usuarios.create') }}" role="button">Agregar usuario</a>
            </div>
        </div>
        {{-- Pestañas --}}
        <div class="row justify-content-around my-3">
            <div class="col-4">
                <button type="button" class="btn btn-primary btn-block btn-large btn-lg btn-block" disabled>Activos</button>
            </div>
            <div class="col-4">
                <a class="btn btn-outline-secondary btn-block btn-large btn-lg btn-block"
                    href="{{ route('usuarios.inactivos') }}" role="button">Inactivos</a>
            </div>
        </div>
        {{-- Notificaciones --}}
        @if (Session::has('message'))
            <div class="row my-0">
                <div class="col">
                    <div class="alert alert-{{ Session::get('alert-class') }}" role="alert">
                        {{ Session::get('message') }}
                    </div>
                </div>
            </div>
        @endif
        {{-- Tabla --}}
        <div class="row">
            <div class="col bg-light mb-5 rounded pt-5">
                <table class="table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nombre</th>
                            <th>Puesto</th>
                            <th colspan="12">Acciones</th>

                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($mUsuarios as $usuario)
                            <tr>
                                <td scope="row">{{ $loop->iteration }}</td>
                                {{-- <td>
                                    {{print_r($usuario)}}
                                </td> --}}
                                <td>{{ $usuario->nombre }}</td>
                                <td>{{ $usuario->rol }}</td>
                                @if (Auth::user()->name == $usuario->nombre)
                                    <td colspan="6">
                                        <a name="btnDetalle" id="btnDetalle" class="btn btn-secondary"
                                            href="{{ route('usuarios.show', $usuario->id) }}" role="button">Detalle</a>
                                    </td>
                                    <td colspan="6">
                                        <a name="btnEditar" id="btnEditar" class="btn btn-info"
                                            href="{{ route('usuarios.edit', $usuario->id) }}" role="button">Editar</a>
                                    </td>
                                @else
                                    <td colspan="4">
                                        <a name="btnDetalle" id="btnDetalle" class="btn btn-secondary"
                                            href="{{ route('usuarios.show', $usuario->id) }}" role="button">Detalle</a>
                                    </td>
                                    <td colspan="4">
                                        <a name="btnEditar" id="btnEditar" class="btn btn-info"
                                            href="{{ route('usuarios.edit', $usuario->id) }}" role="button">Editar</a>
                                    </td>
                                    <td colspan="4">
                                        {!! Form::open(['url' => route('usuarios.destroy', $usuario->id), 'class' => 'form-inline']) !!}
                                        {!! Form::hidden('_method', 'DELETE') !!}
                                        {!! Form::submit('Eliminar', ['class' => 'btn btn-danger']) !!}
                                        {!! Form::close() !!}
                                    </td>

                                @endif
                            </tr>

                        @empty
                            <tr>
                                <td colspan="4">No hay registros</td>
                            </tr>
                        @endforelse
                    </tbody>
                    <caption>Lista de usuarios</caption>
                </table>
            </div>
        </div>
    </div>
@endsection
