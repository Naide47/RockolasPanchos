@extends('layout.users')
@section('title')
    Editar categoria
@endsection

@section('head')
    <link rel="stylesheet" href="{{ asset('css/buttons.css') }}">
@endsection

@section('contents')
    <div class="container-fluid bg-white my-5">
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
                        @error('categoria')
                            <div class="alert alert-danger" role="alert">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        {{ Form::submit('Confirmar', ['class' => 'btn btn-success']) }}
                        <a class="btn btn-secondary" href="{{ route('categorias.index') }}" role="button">Cancelar</a>
                    </div>
                </div>
                {!! Form::close() !!}
            </div>
        </div>

    </div>
@endsection
