@extends('layout.layout')
@section('titulo')
    Editar producto
@endsection

@section('contenido')
    <div class="container">
        <div class="row  mb-3">
            <div class="col-12 text-center">
                <h1>Productos</h1>
                <h2>- Editar producto -</h2>
            </div>
        </div>
        @if (!$errors->isEmpty())
            <div class="row">
                <div class="col">
                    {{ HTML::ul($errors->all()) }}
                </div>
            </div>
        @else

        @endif
        {{ Form::model($producto, ['route' => ['productos.update', $producto->idProducto], 'method' => 'PUT', 'enctype' => 'multipart/form-data']) }}
        <div class="row  mb-3">
            <div class="col">
                <div class="form-group">
                    {!! Form::label('nombre', 'Nombre') !!}
                    {!! Form::text('nombre', $producto->nombre, ['class' => 'form-control', 'required']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('categoria', 'Categoria') !!}
                    <select name="categoria" id="categoria" class="form-control">
                        @foreach ($categorias as $categoria)
                            @if ($categoria->idCategoria == $producto->idCategoria)
                                <option value="{{ $categoria->idCategoria }}" selected>{{ $categoria->categoria }}
                                </option>
                            @else
                                <option value="{{ $categoria->idCategoria }}">{{ $categoria->categoria }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        <div class="row  mb-3">
            <div class="col">
                {!! Form::label('existencias', 'Existencias') !!}
                {!! Form::number('existencias', $producto->existencias, ['class' => 'form-control', 'required']) !!}
            </div>
            <div class="col">
                {!! Form::label('disponibles', 'Existencias disponibles') !!}
                {!! Form::number('disponibles', $producto->disponibles, ['class' => 'form-control', 'required']) !!}
            </div>
        </div>
        <div class="row  mb-3">
            <div class="col">
                {!! Form::label('precioCompra', 'Precio de compra') !!}
                {!! Form::number('precioCompra', $producto->precioCompra, ['class' => 'form-control', 'step'=>'any', 'required']) !!}
            </div>
            <div class="col">
                {!! Form::label('precioUnitario', 'Precio por unidad') !!}
                {!! Form::number('precioUnitario', $producto->precioUnitario, ['class' => 'form-control', 'step'=>'any', 'required']) !!}
            </div>
        </div>
        <div class="row  mb-3">
            <div class="col">
                <div class="form-group">
                    {!! Form::label('foto', 'Foto del producto') !!}
                    {!! Form::file('foto', ['accept' => 'image/x-png, image/gif, image/jpeg', 'placeholder' => 'Elegir foto', 'class' => 'form-control-file']) !!}
                </div>
            </div>
        </div>
        <div class="row  mb-3">
            <div class="col text-right">
                {{ Form::submit('Editar producto', ['class' => 'btn btn-success']) }}
                <a class="btn btn-secondary" href="{{ route('productos.index') }}" role="button">Cancelar</a>
            </div>
        </div>
        {{ Form::close() }}

    </div>

@endsection
