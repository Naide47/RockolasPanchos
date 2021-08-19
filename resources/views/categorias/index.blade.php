@extends('layout.users')
@section('title')
    Categorias de productos
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
                <h1>Categorias</h1>
            </div>
        </div>
        {{-- Barra de busqueda y boton de agregar --}}
        <div class="row justify-content-center mb-3">
            <div class="col-10">
                @include('layout.searchbar')
            </div>
            <div class="col-2">
                <a name="btnAgregarCategoria" id="btnAgregarCategoria" class="btn btn-success"
                    href="{{ route('categorias.create') }}" role="button">Agregar categoria</a>
            </div>
        </div>
        {{-- Pestañas --}}
        <div class="row justify-content-around my-3">
            <div class="col-4">
                <a class="btn btn-outline-secondary btn-block btn-large btn-lg btn-block"
                    href="{{ route('productos.index') }}" role="button">Productos</a>
            </div>
            <div class="col-4">
                <button type="button" class="btn btn-primary btn-block btn-large btn-lg btn-block"
                    disabled>Categorias</button>
            </div>
            <div class="col-4">
                <a class="btn btn-outline-secondary btn-block btn-large btn-lg btn-block"
                    href="{{ route('paquetes.index') }}" role="button">Paquetes</a>
            </div>
        </div>
        {{-- Notificaciones --}}
        @if (Session::has('message'))
            <div class="alert alert-{{ Session::get('alert-class') }}" role="alert">
                {{ Session::get('message') }}
            </div>
        @endif
        {{-- Tabla --}}
        <div class="row">
            <div class="col bg-light mb-5 rounded pt-5">
                <table class="table">
                    <caption>Categorias de los productos</caption>
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nombre de la categoria</th>
                            @if (Auth::user()->rol_id > 1)
                                <th>Acciones</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($mCategorias as $categoria)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $categoria->categoria }}</td>
                                @if (Auth::user()->rol_id > 1)
                                    <td>
                                        <a name="btnEdit" id="btnEdit" class="btn btn-info"
                                            href="{{ route('categorias.edit', $categoria->id) }}" role="button">
                                            Editar
                                        </a>
                                    </td>
                                @endif
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3">Sin registros</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection
