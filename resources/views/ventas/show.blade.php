@extends('layout.users')

@section('title')
    Detalle de la Venta
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
                <h1>Detalle de la Venta</h1>
            </div>
        </div>
        {{-- Barra de busqueda y boton de agregar --}}
        <div class="d-flex flex-row-reverse">
            <div class="col-3">
                {{ Form::open(['route'=>['tomar']]) }}
                @method('GET')
                {{ Form::hidden('id', $mVenta->id) }}
                {{ Form::hidden('idUsuario', Auth::user()->id)}}
                    <button class="btn btn-success" type="sumbit">Tomar orden</button>
                {{ Form::close() }}
            </div>
            <div class="col-3">
                {{ Form::open(['route'=>['completar']]) }}
                @method('GET')
                {{ Form::hidden('id', $mVenta->id) }}
                {{ Form::hidden('idUsuario', Auth::user()->id)}}
                    <button class="btn btn-danger" type="sumbit">Completar</button>
                {{ Form::close() }}
            </div>
        </div>
        {{-- Tabla --}}
        <div class="row">
            <div class="col bg-light mb-5 rounded pt-5">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Cliente</th>
                            <th>Celular</th>
                            <th>Telefono</th>
                            <th colspan="2">Direccion</th>
                            {{-- <th colspan="3">Acciones</th> --}}
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="align-middle">{{ $mPersona->nombre }}</td>
                            <td class="align-middle">{{ $mPersona->celular }}</td>
                            <td class="align-middle">{{ $mPersona->telefono }}</td>
                            <td class="align-middle">{{ $mPersona->calle }}</td>
                            <td class="align-middle">{{ $mPersona->colonia }}</td>
                        </tr>
                                        
                    </tbody>
                </table>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Usuario</th>
                            <th>Anticipo</th>
                            <th>Total</th>
                            <th>Fecha de Registro</th>
                            <th>Identificador</th>
                            <th>Estatus</th>
                            {{-- <th colspan="3">Acciones</th> --}}
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            @if($mVenta->users_id == 0)
                                <td class="align-middle">Aun no se le asigna usuario</td>
                            @else
                                <td class="align-middle">{{ $mUsuario->name }}</td>
                            @endif
                            <td class="align-middle">{{ $mVenta->anticipoPagado }}</td>
                            <td class="align-middle">{{ $mVenta->total }}</td>
                            <td class="align-middle">{{ $mVenta->fechaRegistro }}</td>
                            <td class="align-middle">{{ $mVenta->identificador }}</td>
                            @if($mVenta->status == 1)
                                <td class="align-middle">Pendiente</td>
                            @elseif($mVenta->status == 2)
                                <td class="align-middle">En proceso</td>
                            @elseif($mVenta->status == 3)
                                <td class="align-middle">Completado</td>
                            @endif
                        </tr>
                                        
                    </tbody>
                </table>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Producto</th>
                            <th>Imagen</th>
                            <th>Cantidad</th>
                            <th>Precio</th>
                            {{-- <th colspan="3">Acciones</th> --}}
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($mDetalle as $rowDetalle)
                            <tr>
                                <td class="align-middle">{{ $rowDetalle->nombre }}</td>
                                @if ($rowDetalle->imgNombreFisico)
                                    <td class="align-middle"><img
                                            src="{{ asset('storage/' . $rowDetalle->imgNombreFisico) }}"
                                            alt="Imagen del producto {{ $rowDetalle->nombre }}" width="75px"
                                            class="img-thumbnail"></td>
                                @else
                                    <td class="align-middle"><img src="{{ asset('storage/no_imagen.jpg') }}"
                                            alt="Imagen del producto {{ $rowDetalle->nombre }}" width="75px"
                                            class="img-thumbnail"></td>
                                @endif
                                <td class="align-middle">{{ $rowDetalle->cantidad }}</td>
                                <td class="align-middle">{{ $rowDetalle->precioUnitario }}</td>
                            </tr>  
                        @endforeach      
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    {{-- Tabla --}}
    <div class="row">
        <div class="col bg-light mb-5 rounded pt-5">
            
        </div>
    </div>
</div>

@endsection
