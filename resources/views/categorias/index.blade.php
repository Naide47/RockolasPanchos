@extends('layout.layout')
@section('titulo')
    Categorias de productos
@endsection

@section('contenido')
    <div class="container">
        @if (Session::has('mensage'))
            <div class="row">
                <div class="col-xs-12">

                    {{ Session::get('mensage') }}

                </div>
            </div>
        @endif
        <div class="row justify-content-center">
            <div class="col-12 text-center">
                <div class="row">
                    <div class="col-12">
                        <div class="row">
                            <div class="col mb-3">
                                <h1>Categorias</h1>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-10">
                                @include('layout.searchbar')
                            </div>
                            <div class="col-2">
                                <a name="btnAgregarCategoria" id="btnAgregarCategoria" class="btn btn-success"
                                    href="{{ route('categorias.create') }}" role="button">Agregar categoria</a>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <table class="table">
                            <caption>Lista de categorias</caption>
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Categoria</th>
                                    <th colspan="2">Acciones</th>
                                    {{-- <th colspan="3">Acciones</th> --}}
                                </tr>
                            </thead>
                            @forelse($categorias as $row)
                                <tbody>
                                    <tr>
                                        <td scope="row">{{ $loop->iteration }}</td>
                                        <td>{{ $row->categoria }}</td>
                                        {{-- <td><a class="btn btn-primary"
                                                href="{{ route('categorias.show', $row->idCategoria) }}">Ver
                                                detalles</td> --}}
                                        <td><a class="btn btn-info"
                                                href="{{ route('categorias.edit', $row->idCategoria) }}"
                                                role="button">Editar</a>
                                        </td>
                                        <td>
                                            {{Form::open(['url'=>route('categorias.destroy', $row->idCategoria)])}}
                                            {{Form::hidden('_method', 'DELETE')}}
                                            {{Form::submit('Borrar', ["class"=>"btn btn-danger"])}}
                                        </td>
                                    </tr>
                                </tbody>
                            @empty
                                <tbody>
                                    <tr>
                                        <td colspan="3">No hay registros</td>
                                    </tr>
                                </tbody>
                            @endforelse
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
