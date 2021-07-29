@extends('layout.layout')
@section('titulo')
    Editar categoria
@endsection

@section('contenido')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="col mb-3 text-center">
                    <h1>Categorias</h1>
                    <h2>- Editar categoria -</h2>
                </div>
                {{ Form::model($categoria, ['route' => ['categorias.update', $categoria->idCategoria], 'method' => 'PUT']) }}

                <div class="form-group">
                    {{ Form::label('categoria', 'Categoria') }}
                    {{ Form::text('categoria', $categoria->categoria, ['class' => 'form-control', 'required' => true]) }}
                </div>
                <div class="row">
                    <div class="col text-right">
                        {{ Form::submit('Confirmar', ['class' => 'btn btn-primary']) }}
                        <a class="btn btn-secondary" href="{{ route('categorias.index') }}" role="button">Cancelar</a>
                    </div>
                </div>
                {{ Form::close() }}
            </div>
        </div>
    </div>

@endsection
