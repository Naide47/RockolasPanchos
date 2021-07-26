@extends('layout.layout')
@section('titulo')
    Productos
@endsection

@section('contenido')
    <div class="container">
        @if (Session::has('mensage'))
            <div class="row">
                <div class="col-xs-12">
                    {{ Session::get('mensage') }}
                </div>
            </div>
        @endif
        <div class="row justify-content-center">
            <div class="col-12 text-center">
                <div class="row">
                    <div class="col-12">
                        <div class="row">
                            <div class="col mb-3">
                                <h1>Productos</h1>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-10">
                                @include('layout.searchbar')
                            </div>
                            <div class="col-2">
                                <a name="btnAgregarCategoria" id="btnAgregarCategoria" class="btn btn-success"
                                    href="{{ route('productos.create') }}" role="button">Agregar producto</a>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Producto</th>
                                    <th>Imagen</th>
                                    <th>Precio unitario</th>
                                    <th>Disponibles</th>
                                    <th colspan="2">Acciones</th>
                                    {{-- <th colspan="3">Acciones</th> --}}
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($productos as $producto)
                                    <tr>
                                        <td scope="row" class="align-middle">{{ $loop->iteration }}</td>
                                        <td class="align-middle">{{ $producto->nombre }}</td>
                                        {{-- <td class="align-middle">{{$producto->nombre}}</td> --}}
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
                                        {{-- <td><a class="btn btn-primary"
                                                href="{{ route('productos.add', $producto->idProducto) }}">Agregar
                                                existencias</a></td> --}}
                                        <td class="align-middle"><a class="btn btn-secondary"
                                                href="{{ route('productos.show', $producto->idProducto) }}">Detalle</td>
                                        <td class="align-middle"><a class="btn btn-info"
                                                href="{{ route('productos.edit', $producto->idProducto) }}"
                                                role="button">Editar</a>
                                        </td>
                                        {{-- <td>
                                            {{ Form::open(['url' => route('categorias.destroy', $producto->idCategoria)]) }}
                                            {{ Form::hidden('_method', 'DELETE') }}
                                            {{ Form::submit('Borrar', ['class' => 'btn btn-danger']) }}
                                        </td> --}}
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7">No hay registros</td>
                                    </tr>
                                @endforelse
                            </tbody>
                            <caption>Lista de productos</caption>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
