@extends('layout.layout')

{{-- @section('titulo')
    Agregar categoria
@endsection --}}

@section('head')
    <link rel="stylesheet" href="{{ asset('css/buttons.css') }}">
@endsection

@section('contents')
    <div class="container-fluid bg-white mb-5">
        {{-- Titulo --}}
        <div class="row">
            <div class="col">
                <h1>Agregar categoria</h1>
            </div>
        </div>
        {{-- Formulario --}}
        <div class="row">
            <div class="col">
                {{ Form::open(['route' => 'categorias.store']) }}
                <div class="row bg-light mb-2 pt-2 rounded">
                    <div class="col">
                        <div class="form-group">
                            {{ Form::label('categoria', 'Categoria') }}
                            {{ Form::text('categoria', old('categoria'), ['class' => 'form-control', 'required']) }}
                            @error('categoria')
                                <div class="alert alert-danger" role="alert">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row mb-5">
                    <div class="col">
                        {{ Form::submit('Agregar producto', ['class' => 'btn btn-success']) }}
                        <a class="btn btn-secondary" href="{{ route('categorias.index') }}" role="button">Cancelar</a>
                    </div>
                </div>

                {!! Form::close() !!}

            </div>
        </div>
    </div>
@endsection
