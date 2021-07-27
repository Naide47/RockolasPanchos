@extends('layout.layout')
@section('titulo')
    Editar categoria
@endsection

@section('contenido')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Categoria</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{ $categoria->categoria }}</td>
                        </tr>
                    </tbody>
                    <caption>Detalles de categoria</caption>
                </table>
                <div class="row">
                    <div class="col text-right">
                        <a class="btn btn-secondary" href="{{ route('categorias.index') }}" role="button">Volver</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
