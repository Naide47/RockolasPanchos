@extends('layout.users')

@section('title')
    Paquetes
@endsection

@section('head')
    <link rel="stylesheet" href="{{ asset('css/buttons.css') }}">
    <script src="{{ asset('js/index_functions.js') }}"></script>
@endsection


@section('contents')
@section('contents')
    <div class="container-fluid bg-white my-5 text-center">
        {{-- Titulo --}}
        <div class="row">
            <div class="col text-left">
                <h1>Paquetes</h1>
            </div>
        </div>
        {{-- Barra de busqueda y boton de agregar --}}
        <div class="row justify-content-center mb-3">
            <div class="col-10">
                @include('layout.searchbar')
            </div>
            <div class="col-2">
                <a name="btnAgregar" id="btnAgregar" class="btn btn-success" href="{{ route('paquetes.create') }}"
                    role="button">Agregar paquete</a>
            </div>
        </div>
        {{-- Pestañas --}}
        {{-- <div class="row justify-content-around my-3">
            <div class="col-4">
                <button type="button" class="btn btn-primary btn-block btn-large btn-lg btn-block"
                    disabled>Productos</button>
            </div>
            <div class="col-4">
                <a class="btn btn-outline-secondary btn-block btn-large btn-lg btn-block"
                    href="{{ route('categorias.index') }}" role="button">Categorias</a>
            </div>
        </div> --}}
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
                            <th>Paquete</th>
                            <th>Imagen</th>
                            <th>Precio</th>
                            <th colspan="2">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($mPaquetes as $paquete)
                            <tr>
                                <td scope="row" class="align-middle">{{ $loop->iteration }}</td>
                                <td class="align-middle">{{ $paquete->nombre }}</td>
                                @if ($paquete->imgNombreFisico)
                                    <td class="align-middle"><img
                                            src="{{ asset('storage/' . $paquete->imgNombreFisico) }}"
                                            alt="Imagen del producto {{ $paquete->nombre }}" width="75px"
                                            class="img-thumbnail"></td>
                                @else
                                    <td class="align-middle"><img src="{{ asset('storage/no_imagen.jpg') }}"
                                            alt="Imagen del producto {{ $paquete->nombre }}" width="75px"
                                            class="img-thumbnail"></td>
                                @endif
                                <td class="align-middle">${{ $paquete->precio }}</td>
                                <td class="align-middle"><a class="btn btn-secondary"
                                        href="{{ route('productos.show', $paquete->id) }}">Detalle</td>
                                <td class="align-middle"><a class="btn btn-info"
                                        href="{{ route('productos.edit', $paquete->id) }}" role="button">Editar</a>
                                </td>
                                {{-- <td>
                                    {{ Form::open(['url' => route('categorias.destroy', $paquete->idCategoria)]) }}
                                    {{ Form::hidden('_method', 'DELETE') }}
                                    {{ Form::submit('Borrar', ['class' => 'btn btn-danger']) }}
                                </td> --}}
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6">No hay registros</td>
                            </tr>
                        @endforelse
                    </tbody>
                    <caption>Lista de paquetes</caption>
                </table>
            </div>
        </div>
    </div>

@endsection
@endsection
