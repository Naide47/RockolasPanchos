@extends('layout.layout')
@section('titulo')
    Agregar categoria
@endsection

@section('contenido')

    <div class="container">
        <div class="row">
            <div class="col">
                {{ HTML::ul($errors->all()) }}
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="row">
                    <div class="col mb-3 text-center">
                        <h1>Categorias</h1>
                        <h2>- Agregar categoria -</h2>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        {{ Form::open(['url' => 'categorias']) }}
                        <div class="form-group">
                            {{ Form::label('categoria', 'Categoria') }}
                            {{ Form::text('categoria', Request::old('categoria'), ['class' => 'form-control', 'placeholder' => 'Categoria', 'required']) }}
                        </div>
                        <div class="row">
                            <div class="col text-right">
                                {{ Form::submit('Agregar categoria', ['class' => 'btn btn-success']) }}
                                <a class="btn btn-secondary" href="{{ route('categorias.index') }}"
                                    role="button">Cancelar</a>
                            </div>
                        </div>
                        {{ Form::close() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
