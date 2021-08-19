@extends('layout.users')

@section('title')
    Productos
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
                <h1>Productos</h1>
            </div>
        </div>
        {{-- Barra de busqueda y boton de agregar --}}
        <div class="row justify-content-center mb-3">
            <div class="col-10">
                @include('layout.searchbar')
            </div>
            <div class="col-2">
                <a name="btnAgregarCategoria" id="btnAgregarCategoria" class="btn btn-success"
                    href="{{ route('productos.create') }}" role="button">Agregar producto</a>
            </div>
        </div>
        {{-- Pestañas --}}
        <div class="row justify-content-around my-3">
            <div class="col-4">
                <button type="button" class="btn btn-primary btn-block btn-large btn-lg btn-block"
                    disabled>Productos</button>
            </div>
            <div class="col-4">
                <a class="btn btn-outline-secondary btn-block btn-large btn-lg btn-block"
                    href="{{ route('categorias.index') }}" role="button">Categorias</a>
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
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Producto</th>
                            <th>Imagen</th>
                            <th>Precio unitario</th>
                            <th>Disponibles</th>
                            @if (Auth::user()->rol_id > 1)
                                <th colspan="2">Acciones</th>
                            @else
                                <th>Acciones</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($mProductos as $producto)
                            <tr>
                                <td scope="row" class="align-middle">{{ $loop->iteration }}</td>
                                <td class="align-middle">{{ $producto->nombre }}</td>
                                @if ($producto->imgNombreFisico)
                                    <td class="align-middle"><img
                                            src="{{ asset('storage/' . $producto->imgNombreFisico) }}"
                                            alt="Imagen del producto {{ $producto->nombre }}" width="75px"
                                            class="img-thumbnail"></td>
                                @else
                                    <td class="align-middle"><img src="{{ asset('storage/no_imagen.jpg') }}"
                                            alt="Imagen del producto {{ $producto->nombre }}" width="75px"
                                            class="img-thumbnail"></td>
                                @endif
                                <td class="align-middle">${{ $producto->precioUnitario }}</td>
                                <td class="align-middle">{{ $producto->disponibles }}</td>
                                <td class="align-middle">
                                    <a class="btn btn-secondary" href="{{ route('productos.show', $producto->id) }}">
                                        Detalle
                                    </a>
                                </td>
                                @if (Auth::user()->rol_id > 1)
                                    <td class="align-middle"><a class="btn btn-info"
                                            href="{{ route('productos.edit', $producto->id) }}" role="button">
                                            Editar
                                        </a>
                                    </td>
                                @endif
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7">No hay registros</td>
                            </tr>
                        @endforelse
                    </tbody>
                    <caption>Lista de productos</caption>
                </table>
                <div class="mb-3 text-right">
                    <a target="_blank" name="btnAgregarCategoria" id="btnAgregarCategoria" class="btn btn-success"
                        href="{{ route('productos.generarReporte') }}" role="button">Generar reporte</a>
                </div>
            </div>
        </div>
    </div>

@endsection
