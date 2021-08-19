@extends('layout.users')

@section('head')
    <link rel="stylesheet" href="{{ asset('css/buttons.css') }}">
@endsection

@section('contents')

    <div class="container-fluid bg-white mb-5 text-center">
        {{-- Titulo --}}
        <div class="row">
            <div class="col text-left">
                <h1>Rentas</h1>
            </div>
        </div>
        {{-- Barra de busqueda y boton de agregar --}}
        <div class="row justify-content-center mb-3">
            <div class="col-10">
                @include('layout.searchbar')
            </div>
            <div class="col-2">
                <a name="btnAgregarCategoria" id="btnAgregarCategoria" class="btn btn-success"
                    href="{{ route('renta.create') }}" role="button">Agregar Renta</a>
            </div>
        </div>
        {{-- Notificaciones --}}
        @if (Session::has('message'))
            <div class="row bg-{{ Session::get('alert-class') }}">
                <div class="col">
                    {{ Session::get('message') }}
                </div>
            </div>
        @endif
        {{-- Tabla --}}
        <div class="row">
            <div class="col bg-light mb-5 rounded pt-5">
                <table class="table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Total</th>
                            <th>Fecha Inicio</th>
                            <th>Fecha Termino</th>
                            <th>Fecha Registro</th>
                            <th>Estatus</th>
                            <th colspan="2">Acciones</th>
                            {{-- <th colspan="3">Acciones</th> --}}
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($table as $row)
                            <tr>
                                <td scope="row" class="align-middle">{{ $loop->iteration }}</td>

                                <td class="align-middle">${{ $row->total }}</td>
                                <td class="align-middle">{{ $row->fechaInicio }}</td>
                                <td class="align-middle">{{ $row->fechaTermino }}</td>
                                <td class="align-middle">{{ $row->fechaRegistro }}</td>
                                @if ($row->estatus == 1 )
                                    <td class="align-middle">Registrado</td>
                                @elseif ($row->estatus == 2)
                                    <td class="align-middle"><a>En proceso</a></td>
                                @elseif ($row->estatus == 3)
                                    <td class="align-middle"><a>Finalizado</a></td>
                                @elseif ($row->estatus == 4)
                                    <td class="align-middle"><a>Cancelado</a></td>
                                @endif

                                <td class="align-middle"><a class="btn btn-secondary"
                                        href="{{ route('rentaUsuario.show', $row->id) }}">Detalle</td>
                                <td class="align-middle"><a class="btn btn-info"
                                        href="{{ route('rentaUsuario.edit', $row->id) }}" role="button">Editar</a>
                                </td>

                            </tr>
                        @empty
                            <tr>
                                <td colspan="7">No hay registros</td>
                            </tr>
                        @endforelse
                    </tbody>
                    <caption>Lista de rentas</caption>
                </table>
            </div>
        </div>
    </div>
@endsection
