@extends('layout.layout')
{{-- @section('titulo')
    Agregar producto
@endsection --}}

@section('head')
    <link rel="stylesheet" href="{{ asset('css/buttons.css') }}">
@endsection

@section('contents')
    <div class="container-fluid bg-white mb-5">
        <div class="row">
            <div class="col">
                <h1>Agregar producto</h1>
            </div>
        </div>
        <div class="row">
            <div class="col">
                {!! Form::open(['url' => 'productos', 'files' => 'true']) !!}
                <div class="row bg-light mb-2 pt-2 rounded">
                    <div class="col">
                        <div class="form-group">
                            {!! Form::label('nombre', 'Nombre') !!}
                            {!! Form::text('nombre', Request::old('nombre'), ['class' => 'form-control', 'required']) !!}
                            @error('nombre')
                                <div class="alert alert-danger" role="alert">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            {!! Form::label('categoria', 'Categoria') !!}
                            <select class="form-control" id="categoria" name="categoria" required>
                                <option value="" selected disabled>SELECCIONAR</option>
                                @foreach ($categorias as $categoria)
                                    <option value="{{ $categoria->id }}">{{ $categoria->categoria }}</option>
                                @endforeach
                            </select>
                            @error('categoria')
                                <div class="alert alert-danger" role="alert">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row bg-light mb-2 rounded">
                    <div class="col">
                        <div class="form-group">
                            {!! Form::label('existencias', 'Existencias') !!}
                            {!! Form::number('existencias', Request::old('existencias'), ['class' => 'form-control', 'required', 'min' => '0', 'step' => '1', 'oninput' => 'validity.valid||(value="");']) !!}
                            @error('existencias')
                                <div class="alert alert-danger" role="alert">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            {!! Form::label('precioCompra', 'Precio de compra') !!}
                            {!! Form::number('precioCompra', Request::old('precioCompra'), ['class' => 'form-control', 'required', 'min' => '0', 'step' => '1', 'oninput' => 'validity.valid||(value="");']) !!}
                            @error('precioCompra')
                                <div class="alert alert-danger" role="alert">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col">
                        {!! Form::label('precioUnitario', 'Precio por unidad') !!}
                        {!! Form::number('precioUnitario', Request::old('´precioUnitario'), ['class' => 'form-control', 'required', 'min' => '0', 'step' => '1', 'oninput' => 'validity.valid||(value="");']) !!}
                    </div>
                </div>

                <div class="row bg-light mb-4 rounded">
                    <div class="col-8 p-2 text-center">
                        <img src="{{ asset('storage/no_imagen.jpg') }}" name="image-preview" id="image-preview"
                            class="img-thumbnail" width="200px" alt="Imagen a subir del productos">
                    </div>
                    <div class="col-4 h-100 align-self-center">
                        <div class="form-group">
                            {!! Form::label('imagen', 'Imagen del producto') !!}
                            {!! Form::file('imagen', ['accept' => 'image/x-png, image/gif, image/jpeg',
                            'class' => 'form-control-file',
                            'onchange'=>"document.getElementById('image-preview').src = window.URL.createObjectURL(this.files[0])"]) !!}
                        </div>
                    </div>
                </div>

                <div class="row mb-5">
                    <div class="col">
                        {{ Form::submit('Agregar producto', ['class' => 'btn btn-success']) }}
                        <a class="btn btn-secondary" href="{{ route('productos.index') }}" role="button">Cancelar</a>
                    </div>
                </div>

                {!! Form::close() !!}
            </div>
        </div>
    </div>

@endsection

{{-- @section('contents')
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
                                    <option value="{{ $categoria->id }}">{{ $categoria->categoria }}</option>
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
@endsection --}}
