@extends('layout.layout')

@section('head')
    <link rel="stylesheet" href="{{ asset('css/buttons.css') }}">
@endsection

@section('Breadcrumb')
    <div class="breadcrumb-wrap">
        <div class="container-fluid">
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Inicio</a></li>
                <li class="breadcrumb-item active">Devolucion</li>
            </ul>
        </div>
    </div>
@endsection

@section('contents')
    <div class="row">
        <div class="col bg-white">
            {{HTML::ul($errors->all())}}
            @if (Session::has('message'))
                <div class="alert alert-danger" role="alert">
                    <h3>{{ Session::get('message') }}</h3>
                </div>
            @endif
        </div>
    </div>
    {{ Form::open(['route'=>["devoluciones.store"]]) }}
    <div style="padding: 30px; margin-bottom: 30px; background: #ffffff;">
        <h3>Datos de la compra</h3>
        <div class="col-md-12">
            <div class="row">
                <div class="form-group col-md-4">
                    {{ Form::label('identificador', 'Identificador') }}
                    {{ Form::text('identificador', Request::old('identificador'), ['class' => 'form-control', 'required' => true, 'placeholder' => 'Identificador']) }}
                </div>
            </div>
        </div>
        <h3>Datos de la persona</h3>
        <div class="col-md-12">
            <div class="row">
                <div class="form-group col-md-4">
                    {{ Form::label('nombre', 'Nombre Completo') }}
                    {{ Form::text('nombre', Request::old('nombre'), ['class' => 'form-control', 'required' => true, 'placeholder' => 'Nombre']) }}
                </div>
                <div class="form-group col-md-4">
                    {{ Form::label('celular', 'Celular') }}
                    {{ Form::text('celular', Request::old('celular'), ['class' => 'form-control', 'required' => true, 'placeholder' => 'Celular']) }}
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="row">
                <div class="form-group col-md-4">
                    {{ Form::label('producto', 'Producto') }}
                    <select class="custom-select" name="producto" required="true">
                            @foreach ($table as $item)
                                <option value="{{ $item->nombre }}">{{ $item->nombre }}</option>
                            @endforeach 
                    </select>
                </div>
                <div class="form-group col-md-4">
                    {{ Form::label('cantidad', 'Cantidad') }}
                    <select class="custom-select" name="cantidad" required="true">
                        <option selected value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                </select>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="row">
                <div class="form-group col-md-4">
                    {{ Form::label('descripcion', 'Descripcion') }}
                    {{ Form::textarea('descripcion', Request::old('descripcion'), ['class' => 'form-control', 'required' => true, 'placeholder' => 'Descripcion', 'style' => 'resize: none;']) }}
                </div>
            </div>
        </div>
        {{ Form::submit('Comprar', ['class' => 'btn btn-success']) }}
        {{ Form::close() }}
    </div>
        
    </div>
@endsection
