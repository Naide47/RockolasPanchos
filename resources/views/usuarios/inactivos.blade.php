@extends('layout.users')

@section('title')
    Usuarios inactivos
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
                <h1>Usuarios inactivos</h1>
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
                <a class="btn btn-outline-secondary btn-block btn-large btn-lg btn-block"
                    href="{{ route('usuarios.index') }}" role="button">Activos</a>
            </div>
            <div class="col-4">
                <button type="button" class="btn btn-primary btn-block btn-large btn-lg btn-block"
                    disabled>Inactivos</button>
            </div>
        </div>
        {{-- Tabla --}}
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
                                <td>{{ $usuario->nombre }}</td>
                                <td>{{ $usuario->rol }}</td>
                                <td>
                                    <a name="btnDetalle" id="btnDetalle" class="btn btn-secondary"
                                        href="{{ route('usuarios.show', $usuario->id) }}" role="button">Detalle</a>
                                </td>
                                <td>
                                    {{-- {!! Form::open([route('usuarios.reactivate', $usuario->id)]) !!} --}}
                                    {!! Form::open(['url' => route('usuarios.reactivate', $usuario->id)]) !!}
                                    {{ Form::hidden('_method', 'PUT') }}
                                    {!! Form::submit('Reactivar', ['class' => 'btn btn-primary']) !!}
                                    {!! Form::close() !!}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4">No hay registros</td>
                            </tr>
                        @endforelse
                    </tbody>
                    <caption>Lista de usuarios inactivos</caption>
                </table>
            </div>
        </div>
    </div>
@endsection
