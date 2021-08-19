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
                <h1>Devoluciones</h1>
            </div>
        </div>
        {{-- Barra de busqueda y boton de agregar --}}
        <div class="row justify-content-center mb-3">
            <div class="col-10">
                @include('layout.searchbar')
            </div>
        </div>
        {{-- Pestañas --}}
        {{-- <div class="row justify-content-around my-3">
            <div class="col-4">
                <button type="button" class="btn btn-primary btn-block btn-large btn-lg btn-block"
                    disabled>Pendientes</button>
            </div>
            <div class="col-4">
                <a class="btn btn-outline-secondary btn-block btn-large btn-lg btn-block"
                    href="{{ route('enproceso') }}" role="button">En proceso</a>
            </div>
            <div class="col-4">
                <a class="btn btn-outline-secondary btn-block btn-large btn-lg btn-block"
                    href="{{ route('completas') }}" role="button">Completadas</a>
            </div>
        </div> --}}
        {{-- Notificaciones --}}
        @if (Session::has('message'))
            <div class="alert alert-{{ Session::get('alert-class') }}" role="alert">
                {{ Session::get('message') }}
            </div>
        @endif
        {{-- Tabla Inicio--}}
        <div class="row">
            <div class="col bg-light mb-5 rounded pt-5">
                <table class="table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Cliente</th>
                            <th>Celular</th>
                            <th>Producto</th>
                            <th>Cantidad</th>
                            <th>Descripcion</th>
                            <th>Identificador</th>
                            {{-- <th colspan="2">Acciones</th> --}}
                            {{-- <th colspan="3">Acciones</th> --}}
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($mDevolucion as $item)
                            {{-- @if($item->status == 1) --}}
                            <tr>
                                <td scope="row" class="align-middle">{{ $loop->iteration }}</td>
                                <td class="align-middle">{{ $item->cliente }}</td>
                                <td class="align-middle">{{ $item->celular }}</td>
                                <td class="align-middle">{{ $item->producto }}</td>
                                <td class="align-middle">{{ $item->cantidad }}</td>
                                <td class="align-middle">{{ $item->descripcion }}</td>
                                <td class="align-middle">{{ $item->venta_identificador }}</td>
                                {{-- <td class="align-middle"><a class="btn btn-secondary"
                                                    href="{{ route('ventas.show', $item->id) }}">Detalle</a></td> --}}
                            </tr>
                            {{-- @else
                                <tr>
                                    <td colspan="6"class="align-middle">No hay ventas pendientes</td>
                                </tr> --}}
                            {{-- @endif --}}
                        @empty
                            <tr>
                                <td colspan="6"class="align-middle">No hay devoluciones</td>
                            </tr>
                        @endforelse              
                    </tbody>
                    <caption>Lista de devoluciones</caption>
                </table>
            </div>
        </div>
        {{-- Tabla Fin--}}
    </div>

@endsection
