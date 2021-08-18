@extends('layout.users')

@section('title')
    Ventas
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
                <h1>Ventas</h1>
            </div>
        </div>
        {{-- Barra de busqueda y boton de agregar --}}
        <div class="row justify-content-center mb-3">
            <div class="col-10">
                @include('layout.searchbar')
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
                            <th>Cliente</th>
                            <th>Anticipo</th>
                            <th>Total</th>
                            <th>Identificador</th>
                            <th colspan="2">Acciones</th>
                            {{-- <th colspan="3">Acciones</th> --}}
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($mVentas as $rowVenta)
                            @foreach($mClientes as $rowCliente)
                                @foreach($mPersonas as $rowPersona)
                                    @if($rowVenta->cliente_id == $rowCliente->id)
                                        @if($rowCliente->persona_id == $rowPersona->id)
                                            <tr>
                                                <td scope="row" class="align-middle">{{ $loop->iteration }}</td>
                                                <td class="align-middle">{{ $rowPersona->nombre }}</td>
                                                <td class="align-middle">{{ $rowVenta->anticipoPagado }}</td>
                                                <td class="align-middle">{{ $rowVenta->total }}</td>
                                                <td class="align-middle">{{ $rowVenta->identificador }}</td>
                                                <td class="align-middle"><a class="btn btn-secondary"
                                                    href="{{ route('ventas.show', $rowVenta->id) }}">Detalle</a></td>
                                            </tr>
                                        @endif                        
                                    @endif    
                                @endforeach                                
                            @endforeach
                        @endforeach
                    </tbody>
                    <caption>Lista de ventas</caption>
                </table>
            </div>
        </div>
    </div>

@endsection
