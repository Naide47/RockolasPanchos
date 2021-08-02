@extends('layout.layout')
{{-- @section('titulo')
    Editar categoria
@endsection --}}

@section('head')
    <link rel="stylesheet" href="{{ asset('css/buttons.css') }}">
@endsection

@section('contents')
    <div class="container-fluid bg-white mb-5">
        {{-- Titulo --}}
        <div class="row">
            <div class="col">
                <h1>Editar categoria</h1>
            </div>
        </div>
        <div class="row">
            <div class="col mb-3">
                {{ Form::model($mCategoria, ['route' => ['categorias.update', $mCategoria->id], 'method' => 'PUT']) }}
                <div class="row bg-light mb-2 pt-2 rounded">
                    <div class="col">
                        <div class="form-group">
                            {{ Form::label('categoria', 'Categoria') }}
                            {{ Form::text('categoria', $mCategoria->categoria, ['class' => 'form-control', 'required' => true]) }}
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        {{ Form::submit('Confirmar', ['class' => 'btn btn-primary']) }}
                        <a class="btn btn-success" href="{{ route('categorias.index') }}" role="button">Cancelar</a>
                    </div>
                </div>
                {!! Form::close() !!}
            </div>
        </div>

    </div>
@endsection

@section('contenidos')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="col mb-3 text-center">
                    <h1>Categorias</h1>
                    <h2>- Editar categoria -</h2>
                </div>
                {{ Form::model($mCategoria, ['route' => ['categorias.update', $mCategoria->id], 'method' => 'PUT']) }}
                <div class="form-group">
                    {{ Form::label('categoria', 'Categoria') }}
                    {{ Form::text('categoria', $mCategoria->categoria, ['class' => 'form-control', 'required' => true]) }}
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
