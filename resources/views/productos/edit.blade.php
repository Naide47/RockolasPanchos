@extends('layout.layout')
{{-- @section('titulo')
    Editar producto
@endsection --}}

@section('head')
    <link rel="stylesheet" href="{{ asset('css/buttons.css') }}">
    <script src="{{ asset('js/image_preview.js') }}"></script>
@endsection

@section('contents')
    <div class="container-fluid bg-white mb-5">
        <div class="row">
            <div class="col">
                <h1>Editar producto</h1>
            </div>
        </div>
        <div class="row">
            <div class="col">
                {{ Form::model($producto, ['route' => ['productos.update', $producto->id], 'method' => 'PUT', 'enctype' => 'multipart/form-data']) }}
                <div class="row bg-light mb-2 rounded">
                    <div class="col">
                        <div class="form-group">
                            {!! Form::label('nombre', 'Nombre') !!}
                            {!! Form::text('nombre', $producto->nombre, ['class' => 'form-control', 'required']) !!}
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
                                @foreach ($categorias as $categoria)
                                    @if ($categoria->id == $producto->id)
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
                        {!! Form::number('existencias', $producto->existencias, ['class' => 'form-control', 'required']) !!}
                    </div>
                    <div class="col">
                        {!! Form::label('disponibles', 'Existencias disponibles') !!}
                        {!! Form::number('disponibles', $producto->disponibles, ['class' => 'form-control', 'required']) !!}
                    </div>
                </div>

                <div class="row bg-light mb-2 rounded">
                    <div class="col">
                        {!! Form::label('precioCompra', 'Precio de compra') !!}
                        {!! Form::number('precioCompra', $producto->precioCompra, ['class' => 'form-control', 'step' => 'any', 'required']) !!}
                    </div>
                    <div class="col">
                        {!! Form::label('precioUnitario', 'Precio por unidad') !!}
                        {!! Form::number('precioUnitario', $producto->precioUnitario, ['class' => 'form-control', 'step' => 'any', 'required']) !!}
                    </div>
                </div>

                <div class="row bg-light mb-4 rounded">
                    <div class="col-8 p-2 text-center">
                        @if ($producto->imgNombreFisico)
                            <img src="{{ asset('storage/' . $producto->imgNombreFisico) }}" class="img-thumbnail"
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
                                onclick="restoreImage('{{ asset('storage/' . $producto->imgNombreFisico) }}')">Deshacer</button>
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