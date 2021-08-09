@extends('layout.users')

@section('title')
    Detalle del producto
@endsection

@section('head')
    <link rel="stylesheet" href="{{ asset('css/buttons.css') }}">
@endsection

@section('contents')
    <div class="container-fluid bg-white my-5 py-3 text-center">
        {{-- Titulo --}}
        <div class="row">
            <div class="col text-left">
                <h1>Dellates del producto</h1>
            </div>
        </div>
        <div class="row align-items-center">
            <div class="col-4">
                @if ($mProducto->imgNombreFisico)
                    <img src="{{ asset('storage/' . $mProducto->imgNombreFisico) }}"
                        alt="Imagen del producto {{ $mProducto->nombre }}" width="100%" class="img-thumbnail">
                @else
                    <img src="{{ asset('storage/no_imagen.jpg') }}" alt="Imagen del producto {{ $producto->nombre }}"
                        width="100%" class="img-thumbnail">
                @endif
            </div>
            <div class="col-8 bg-light mb-2 rounded pt-5 ">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Categoria</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{ $mProducto->nombre }}</td>
                            <td>{{ $mProducto->categoria }}</td>
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
                            <td>{{$mProducto->existencias}}</td>
                            <td>{{$mProducto->disponibles}}</td>
                            <td>${{$mProducto->precioCompra}}</td>
                            <td>${{$mProducto->precioUnitario}}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col text-left">
                <a class="btn btn-secondary" href="{{ route('productos.index') }}" role="button">Volver</a>
            </div>
        </div>
    </div>

@endsection