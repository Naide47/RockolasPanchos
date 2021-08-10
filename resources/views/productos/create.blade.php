@extends('layout.users')
@section('title')
    Agregar producto
@endsection

@section('head')
    <link rel="stylesheet" href="{{ asset('css/buttons.css') }}">
@endsection

@section('contents')
    <div class="container-fluid bg-white my-5">
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
                                @foreach ($mCategorias as $categoria)
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
                            {!! Form::label('cantidad', 'Cantidad') !!}
                            {!! Form::number('cantidad', Request::old('cantidad'), ['class' => 'form-control', 'required', 'min' => '0', 'step' => '1', 'oninput' => 'validity.valid||(value="");']) !!}
                            @error('cantidad')
                                <div class="alert alert-danger" role="alert">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            {!! Form::label('precioCompra', 'Precio de compra') !!}
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">$</span>
                                </div>
                                {!! Form::number('precioCompra', Request::old('precioCompra'), ['class' => 'form-control align-self-center', 'required', 'min' => '0', 'step' => '1', 'oninput' => 'validity.valid||(value="");']) !!}
                            </div>
                            @error('precioCompra')
                                <div class="alert alert-danger" role="alert">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col">
                        {!! Form::label('precioUnitario', 'Precio unitario') !!}
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">$</span>
                            </div>
                            {!! Form::number('precioUnitario', Request::old('´precioUnitario'), ['class' => 'form-control align-self-center', 'required', 'min' => '0', 'step' => '1', 'oninput' => 'validity.valid||(value="");']) !!}
                        </div>
                        @error('precioUnitario')
                            <div class="alert alert-danger" role="alert">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>

                <div class="row bg-light mb-4 rounded">
                    <div class="col-8 p-2 text-center">
                        <img src="{{ asset('storage/no_imagen.jpg') }}" name="image-preview" id="image-preview"
                            class="img-thumbnail" width="200px" alt="Imagen a subir del producto">
                    </div>
                    <div class="col-4 h-100 align-self-center">
                        <div class="form-group">
                            {!! Form::label('imagen', 'Imagen del producto') !!}
                            {!! Form::file('imagen', [
    'accept' => 'image/png, image/jpeg',
    'class' => 'form-control-file',
    'onchange' => "document.getElementById('image-preview').src = window.URL.createObjectURL(this.files[0])",
]) !!}
                        </div>
                    </div>

                </div>
                @error('imagen')
                    <div class="alert alert-danger" role="alert">
                        {{ $message }}
                    </div>
                @enderror


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
