@extends('layout.users')

@section('title')
    Detalle del paquete
@endsection

@section('head')
    <link rel="stylesheet" href="{{ asset('css/buttons.css') }}">
@endsection

@section('contents')
    <div class="container-fluid bg-white my-5 py-3 text-center">
        {{-- Titulo --}}
        <div class="row">
            <div class="col text-left">
                <h1>Dellates del paquete</h1>
            </div>
        </div>
        <div class="row align-items-center">
            <div class="col-4">
                @if ($mPaquete->imgNombreFisico)
                    <img src="{{ asset('storage/' . $mPaquete->imgNombreFisico) }}"
                        alt="Imagen del producto {{ $mPaquete->nombre }}" width="100%" class="img-thumbnail">
                @else
                    <img src="{{ asset('storage/no_imagen.jpg') }}" alt="Imagen del paquete {{ $mPaquete->nombre }}"
                        width="100%" class="img-thumbnail">
                @endif
            </div>
            <div class="col-8">
                <div class="row bg-light mb-2 rounded pt-5">
                    <div class="col">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Nombre</th>
                                    <th>Precio</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>{{ $mPaquete->nombre }}</td>
                                    <td>${{ $mPaquete->precio }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="row bg-light mb-2 rounded pt-5">
                    <div class="col">

                        <table class="table">
                            <thead>
                                <th>Producto</th>
                                <th>Cantidad</th>
                                <th>Precio unitario</th>
                                <th>Precio total</th>
                            </thead>
                            <tbody>
                                @foreach ($mDetallesPaquete as $detallePaquete)
                                    <tr>
                                        <td>{{ $detallePaquete->nombre }}</td>
                                        <td>{{ $detallePaquete->cantidad }}</td>
                                        <td>${{ $detallePaquete->precioUnitario }}</td>
                                        <td>${{ $precios->precio[$loop->index] }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>

            </div>
        </div>
        <div class="row mt-4">
            <div class="col text-left">
                <a class="btn btn-secondary" href="{{ route('paquetes.index') }}" role="button">Volver</a>
            </div>
        </div>
    </div>

@endsection
