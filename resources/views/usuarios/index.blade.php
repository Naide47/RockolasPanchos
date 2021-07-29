@extends('layout.layout')
@section('titulo')
    Usuarios
@endsection

@section('head')
    <link rel="stylesheet" href="{{ asset('css/buttons.css') }}">
@endsection

@section('contents')
    <div class="container-fluid bg-white mb-5 text-center">
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
        {{-- Notificaciones --}}
        @if (Session::has('message'))
            <div class="row bg-{{ Session::get('alert-class') }}">
                <div class="col">
                    {{ Session::get('message') }}
                </div>
            </div>
        @endif
        <div class="row">
            <div class="col bg-light mb-5 rounded pt-5">
                <table class="table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nombre</th>
                            <th>Puesto</th>
                            <th colspan="3">Acciones</th>

                        </tr>
                    </thead>
                    <tbody>
                        {{-- @forelse (array_merge($mUsuarios, $mPersonas) as $usuario) --}}
                        @forelse ($mUsuarios as $usuario)
                            <tr>
                                <td scope="row">{{ $loop->iteration }}</td>
                                {{-- <td>
                                    {{print_r($usuario)}}
                                </td> --}}
                                <td>{{ $usuario->nombre }}</td>
                                <td>{{ $usuario->rol }}</td>
                                {{-- @switch($usuario->idRol)
                                    @case(1)
                                        <td>Vendedor</td>
                                    @break

                                    @case(2)
                                        <td>Encargado</td>
                                    @break

                                    @case(3)
                                        <td>Gerente</td>
                                    @break
                                @endswitch --}}
                                <td><a name="btnDetalle" id="btnDetalle" class="btn btn-secondary"
                                        href="{{ route('usuarios.show', $usuario->id) }}" role="button">Detalle</a>
                                </td>
                                <td><a name="btnEditar" id="btnEditar" class="btn btn-info"
                                        href="{{ route('usuarios.edit', $usuario->id) }}" role="button">Editar</a>
                                </td>
                                <td>
                                    {{ Form::open(['url' => route('usuarios.destroy', $usuario->id)]) }}
                                    {{ Form::hidden('_method', 'DELETE') }}
                                    {{ Form::submit('Eliminar', ['class' => 'btn btn-danger']) }}
                                </td>
                            </tr>

                        @empty
                            <tr>
                                <td colspan="4">No hay registros</td>
                            </tr>
                        @endforelse
                        {{-- @forelse($usuarios as $usuario)
                            <tr>


                                <td>{{  }}</td>
                                <td><a class="btn btn-info"
                                        href="{{ route('categorias.edit', $row->idCategoria) }}"
                                        role="button">Editar</a>
                                </td>
                                <td>
                                    {{ Form::open(['url' => route('categorias.destroy', $row->idCategoria)]) }}
                                    {{ Form::hidden('_method', 'DELETE') }}
                                    {{ Form::submit('Borrar', ['class' => 'btn btn-danger']) }}
                                </td>
                            </tr>
                        @empty

                        @endforelse --}}
                    </tbody>
                    <caption>Lista de usuarios</caption>
                </table>
            </div>
        </div>

    </div>
@endsection