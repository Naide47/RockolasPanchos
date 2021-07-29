@extends('layout.layout')
@section('titulo')
    Categorias de productos
@endsection

@section('contents')
    <div class="container text-center">
        {{-- Titulo --}}
        <div class="row mb-5">
            <div class="col">
                <h1>Categorias de productos</h1>
            </div>
        </div>
        {{-- Barra de busqueda y botón de agregar --}}
        <div class="row mb-3">
            <div class="col-10">
                @include('layout.searchbar')
            </div>
            <div class="col">
                <a name="btnCreate" id="btnCreate" class="btn btn-success" href="{{ route('categorias.create') }}"
                    role="button">Agregar categoria</a>
            </div>
        </div>
        @if (Session::has('message'))
            <div class="alert alert-{{Session::get('alert-class')}}" role="alert">
                {{Session::get('message')}}
            </div>
        @endif

        {{-- Tabla --}}
        <div class="row">
            <div class="col">
                <table class="table">
                    <caption>Categorias de los productos</caption>
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Categoria</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($mCategorias as $categoria)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $categoria->categoria }}</td>
                                <td>
                                    <a name="btnEdit" id="btnEdit" class="btn btn-info"
                                        href="{{ route('categorias.edit', $categoria->id) }}" role="button">Editar</a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3">Sin registros</td>
                            </tr>
                        @endforelse

                    </tbody>
                </table>
            </div>

        </div>
    </div>
@endsection
