@extends('layout.layout')
@section('titulo')
    Agregar producto
@endsection

@section('contenido')
    <div class="container">
        <div class="col">
            {{ HTML::ul($errors->all()) }}
        </div>
        <div class="row">
            <div class="col">
                <div class="row">
                    <div class="col mb-3 text-center">
                        <h1>Productos</h1>
                        <h2>- Agregar producto -</h2>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        {{ Form::open(['url' => 'productos', 'files' => 'true']) }}
                        @csrf
                        <div class="form-group">
                            {!! Form::label('nombre', 'Nombre') !!}
                            {!! Form::text('nombre', Request::old('nombre'), ['class' => 'form-control', 'placeholder' => 'Nombre del producto', 'required']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('categoria', 'Categoria') !!}
                            <select class="form-control" id="categoria" name="categoria" required>
                                <option value="" selected disabled>SELECCIONAR</option>
                                @foreach ($categorias as $categoria)
                                    <option value="{{ $categoria->idCategoria }}">{{ $categoria->categoria }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            {!! Form::label('existencias', 'Existencias') !!}
                            {!! Form::number('existencias', Request::old('existencias'), ['class' => 'form-control', 'placeholder' => 'Existencias', 'required']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('precioCompra', 'Precio de compra') !!}
                            {!! Form::number('precioCompra', Request::old('precioCompra'), ['class' => 'form-control', 'placeholder' => 'Precio de compra', 'required']) !!}
                        </div>
                        {{-- <div class="form-group">
                          <label for=""></label>
                          <input type="file" class="form-control-file" name="" id="" placeholder="" aria-describedby="fileHelpId">
                          <small id="fileHelpId" class="form-text text-muted">Help text</small>
                        </div> --}}
                        <div class="form-group">
                            {!! Form::label('foto', 'Foto del producto') !!}
                            {!! Form::file('foto', ['accept' => 'image/x-png, image/gif, image/jpeg', 'placeholder' => 'Elegir foto', 'class' => 'form-control-file']) !!}
                        </div>
                        <div class="row">
                            <div class="col text-right">
                                {{ Form::submit('Agregar producto', ['class' => 'btn btn-success']) }}
                                <a class="btn btn-secondary" href="{{ route('productos.index') }}"
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
