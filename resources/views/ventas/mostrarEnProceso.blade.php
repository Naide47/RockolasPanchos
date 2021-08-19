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
        {{-- Pestañas --}}
        <div class="row justify-content-around my-3">
            <div class="col-4">
                <a type="button" class="btn btn-outline-secondary btn-block btn-large btn-lg btn-block"
                href="{{ route('mostrar') }}" role="button">Pendientes</a>
            </div>
            <div class="col-4">
                <button class="btn btn-primary  btn-block btn-large btn-lg btn-block"
                disabled>En proceso</button>
            </div>
            <div class="col-4">
                <a class="btn btn-outline-secondary btn-block btn-large btn-lg btn-block"
                    href="{{ route('completas') }}" role="button">Completadas</a>
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
                        @forelse ($mVentas as $item)
                            @if($item->status == 2)
                            <tr>
                                <td scope="row" class="align-middle">{{ $loop->iteration }}</td>
                                <td class="align-middle">{{ $item->nombre }}</td>
                                <td class="align-middle">{{ $item->anticipoPagado }}</td>
                                <td class="align-middle">{{ $item->total }}</td>
                                <td class="align-middle">{{ $item->identificador }}</td>
                                <td class="align-middle"><a class="btn btn-secondary"
                                                    href="{{ route('ventas.show', $item->id) }}">Detalle</a></td>
                            </tr>
                            {{-- @else
                                <tr>
                                    <td colspan="6"class="align-middle">No hay ventas en proceso</td>
                                </tr> --}}
                            @endif
                        @empty
                            <tr>
                                <td colspan="6"class="align-middle">No hay ventas proceso</td>
                            </tr>
                        @endforelse              
                    </tbody>
                    <caption>Lista de ventas</caption>
                </table>
            </div>
        </div>
    </div>

@endsection
