@extends('layout.layout')
@section('titulo')
    Detalle del producto
@endsection

@section('contenido')
    <div class="container">
        <div class="row mb-3">
            <div class="col text-center">
                <h1>Producto</h1>
                <h2>- Detalles del producto -</h2>
            </div>
        </div>
        <div class="row mb-4">
            <div class="col-4">
                {{-- <img src="{{ asset('storage/' . $producto->imgNombreFisico) }}"
                    alt="Imagen del producto {{ $producto->nombre }}" width="100%" class="img-thumbnail"> --}}
                @if ($producto->imgNombreFisico)
                    <img src="{{ asset('storage/' . $producto->imgNombreFisico) }}"
                        alt="Imagen del producto {{ $producto->nombre }}" width="100%" class="img-thumbnail">
                @else
                    <img src="{{ asset('storage/no_imagen.jpg') }}" alt="Imagen del producto {{ $producto->nombre }}"
                        width="100%" class="img-thumbnail">
                @endif
            </div>
            <div class="col-8 text-center">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Categoria</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{ $producto->nombre }}</td>
                            <td>{{ $categoria->categoria }}</td>
                        </tr>
                    </tbody>
                </table>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Existencias</th>
                            <th>Disponibles</th>
                            <th>Precio de compra</th>
                            <th>Precio unitario</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{ $producto->existencias }}</td>
                            <td>{{ $producto->disponibles }}</td>
                            <td>${{ $producto->precioCompra }}</td>
                            <td>${{ $producto->precioUnitario }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="row">
            <div class="col text-right">
                <a class="btn btn-secondary" href="{{ route('productos.index') }}" role="button">Volver</a>
            </div>
        </div>
    </div>


@endsection
