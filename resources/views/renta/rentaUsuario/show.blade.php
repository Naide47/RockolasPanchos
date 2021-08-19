@extends('layout.users')

@section('title')
    Detalle de la Renta
@endsection

@section('head')
    <link rel="stylesheet" href="{{ asset('css/buttons.css') }}">
@endsection

@section('contents')
    <div class="container-fluid bg-white my-5 py-3 text-center">
        {{-- Titulo --}}
        <div class="row">
            <div class="col text-left">
                <h1>Dellates de Rentas</h1>
            </div>
        </div>
        <div class="row align-items-center">
            <div class="col-4">
                @if ($mRenta->imgNombreFisico)
                    <img src="{{ asset('storage/' . $mRenta->imgNombreFisico) }}"
                        alt="Imagen del paquete {{ $mRenta->nombre }}" width="100%" class="img-thumbnail">
                @else
                    <img src="{{ asset('storage/no_imagen.jpg') }}" alt="Imagen del paquete {{ $producto->nombre }}"
                        width="100%" class="img-thumbnail">
                @endif
            </div>
            <div class="col-8 bg-light mb-2 rounded pt-5 ">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Nombre Cliente</th>
                            <th>Dirección de la rneta</th>
                            <th>Total</th>
                            <th>Anticipo</th>
                            <th>Estatus</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{ $mRenta->nombre }}</td>
                            <td>Calle.{{ $mRenta->calle }} Col.{{ $mRenta->colonia }} C.P{{ $mRenta->codigopostal }}
                            </td>
                            <td>${{ $mRenta->total }}</td>
                            <td>${{ $mRenta->anticipoPagado }}</td>
                            @if ($mRenta->estatus == 1)
                                <td class="align-middle">Registrado</td>
                            @elseif ($mRenta->estatus == 2)
                                <td class="align-middle"><a>En proceso</a></td>
                            @elseif ($mRenta->estatus == 3)
                                <td class="align-middle"><a>Finalizado</a></td>
                            @elseif ($mRenta->estatus == 4)
                                <td class="align-middle"><a>Cancelado</a></td>
                            @endif
                        </tr>
                    </tbody>
                </table>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Producto</th>
                            <th>Cantidad</th>
                            <th>Precio unitario</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($detalleRenta as $row)
                            @if ($row->renta_id == $mRenta->id)
                                @foreach ($productos as $producto)
                                    @if ($producto->id == $row->producto_id)
                                        <tr>
                                            <td class="align-middle">{{ $producto->nombre }}</td>
                                            @if ($producto->id == $row->producto_id)
                                                <td class="align-middle">{{ $row->cantidad }}</td>
                                            @endif
                                            <td class="align-middle">{{ $producto->precioUnitario }}</td>
                                        </tr>
                                    @endif
                                @endforeach
                            @endif
                        @empty
                            <tr>
                                <td colspan="7">No hay registros</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col text-left">
                <a class="btn btn-secondary" href="{{ route('rentaUsuario.index') }}" role="button">Volver</a>
            </div>
        </div>
    </div>

@endsection
