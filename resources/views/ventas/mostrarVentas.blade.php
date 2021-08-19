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
                            <th>Producto</th>
                            <th>Cantida</th>
                            <th>Anticipo</th>
                            <th>Total</th>
                            <th colspan="2">Acciones</th>
                            {{-- <th colspan="3">Acciones</th> --}}
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($mVentas as $venta)
                            
                                                
                                                        
                                                                <tr>
                                                                    <td scope="row" class="align-middle">{{ $loop->iteration }}</td>
                                                                    <td class="align-middle">{{ $venta->cliente_id }}</td>
                                                                    <td class="align-middle">{{ $venta->users_id }}</td>
                                                                    <td class="align-middle">{{ $venta->fechaRegistro }}</td>
                                                                    
                                                                    <td class="align-middle">{{ $venta->anticipoPagado }}</td>
                                                                    <td class="align-middle">${{ $venta->total }}</td>

                                                                </tr>
                                                        
                                            
                        @endforeach
                    </tbody>
                    <caption>Lista de productos</caption>
                </table>
            </div>
        </div>
    </div>

@endsection
