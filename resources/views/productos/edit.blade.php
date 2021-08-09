@extends('layout.users')
@section('title')
    Editar producto
@endsection

@section('head')
    <link rel="stylesheet" href="{{ asset('css/buttons.css') }}">
    <script src="{{ asset('js/image_preview.js') }}"></script>
@endsection

@section('contents')
    <div class="container-fluid bg-white my-5">
        <div class="row">
            <div class="col">
                <h1>Editar producto</h1>
            </div>
        </div>
        <div class="row">
            <div class="col">
                {{ Form::model($mProducto, ['route' => ['productos.update', $mProducto->id], 'method' => 'PUT', 'enctype' => 'multipart/form-data']) }}
                <div class="row bg-light mb-2 rounded">
                    <div class="col">
                        <div class="form-group">
                            {!! Form::label('nombre', 'Nombre') !!}
                            {!! Form::text('nombre', $mProducto->nombre, ['class' => 'form-control', 'required']) !!}
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
                            <select name="categoria" id="categoria" class="form-control">
                                @foreach ($mCategorias as $categoria)
                                    @if ($categoria->id == $mProducto->id)
                                        <option value="{{ $categoria->id }}" selected>{{ $categoria->categoria }}
                                        </option>
                                    @else
                                        <option value="{{ $categoria->id }}">{{ $categoria->categoria }}</option>
                                    @endif
                                @endforeach
                                @error('categoria')
                                    <div class="alert alert-danger" role="alert">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </select>
                        </div>
                    </div>
                </div>

                <div class="row bg-light mb-2 rounded">
                    <div class="col">
                        {!! Form::label('existencias', 'Existencias') !!}
                        {!! Form::number('existencias', $mProducto->existencias, ['class' => 'form-control', 'required', 'min' => '0', 'step' => '1', 'oninput' => 'validity.valid||(value="");']) !!}
                        @error('existencias')
                            <div class="alert alert-danger" role="alert">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="col">
                        {!! Form::label('disponibles', 'Existencias disponibles') !!}
                        {!! Form::number('disponibles', $mProducto->disponibles, ['class' => 'form-control', 'required', 'min' => '0', 'step' => '1', 'oninput' => 'validity.valid||(value="");']) !!}
                        @error('disponibles')
                            <div class="alert alert-danger" role="alert">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>

                <div class="row bg-light mb-2 pb-2 rounded">
                    <div class="col">
                        {!! Form::label('precioCompra', 'Precio de compra') !!}
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">$</span>
                            </div>
                            {!! Form::number('precioCompra', $mProducto->precioCompra, ['class' => 'form-control align-self-center', 'step' => 'any', 'required', 'min' => '0', 'step' => '1', 'oninput' => 'validity.valid||(value="");']) !!}
                        </div>
                        @error('precioCompra')
                            <div class="alert alert-danger" role="alert">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="col">
                        {!! Form::label('precioUnitario', 'Precio por unidad') !!}
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">$</span>
                            </div>
                            {!! Form::number('precioUnitario', $mProducto->precioUnitario, ['class' => 'form-control align-self-center', 'step' => 'any', 'required', 'min' => '0', 'step' => '1', 'oninput' => 'validity.valid||(value="");']) !!}
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
                        @if ($mProducto->imgNombreFisico)
                            <img src="{{ asset('storage/' . $mProducto->imgNombreFisico) }}" class="img-thumbnail"
                                id="image-preview" name="image-preview" width="200px" alt="Imagen del productos">
                        @else
                            <img src="{{ asset('storage/no_imagen.jpg') }}" id="image-preview" class="img-thumbnail"
                                name="image-preview" width="200px" alt="Imagen del productos">
                        @endif
                    </div>
                    <div class="col-4 h-100 align-self-center">
                        <div class="form-group mb-0">
                            {!! Form::label('imagen', 'Imagen del producto') !!}
                            {!! Form::file('imagen', ['accept' => 'image/x-png, image/gif, image/jpeg', 'class' => 'form-control-file', 'class' => 'form-control-file', 'onchange' => "document.getElementById('image-preview').src = window.URL.createObjectURL(this.files[0])"]) !!}
                            <button type="button" class="btn btn-secondary mt-3"
                                onclick="restoreImage('{{ asset('storage/' . $mProducto->imgNombreFisico) }}')">Deshacer</button>
                        </div>
                    </div>
                </div>

                <div class="row mb-5">
                    <div class="col">
                        {{ Form::submit('Modificar producto', ['class' => 'btn btn-success']) }}
                        <a class="btn btn-secondary" href="{{ route('productos.index') }}" role="button">Cancelar</a>
                    </div>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection
