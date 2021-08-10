@extends('layout.users')
@section('title')
    Agregar paquete
@endsection

@section('head')
    <link rel="stylesheet" href="{{ asset('css/buttons.css') }}">
    <script src="{{ asset('js/index_functions.js') }}"></script>
    <script>
        @php
        echo 'var precios = JSON.stringify(' . $mPreciosUnitarios . ');';
        @endphp
        localStorage.setItem("precios", precios);
    </script>
@endsection

@section('contents')
    {{-- {{print_r($mPreciosUnitarios)}} --}}
    <div class="container-fluid bg-white my-5">
        <div class="row">
            <div class="col">
                <h1>Agregar paquete</h1>
            </div>
        </div>
        <div class="row">
            <div class="col">
                {!! Form::open(['url' => 'paquetes', 'files' => 'true']) !!}
                <div class="row bg-light mb-2 pt-2 rounded">
                    <div class="col">
                        <div class="form-group">
                            {!! Form::label('nombre', 'Nombre del paquete') !!}
                            {!! Form::text('nombre', old('nombre'), ['class' => 'form-control', 'required' => true]) !!}
                            @error('nombre')
                                <div class="alert alert-danger" role="alert">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            {!! Form::label('imagen', 'Imagen') !!}
                            {!! Form::file('imagen', ['accept' => 'image/x-png, image/gif, image/jpeg', 'class' => 'form-control-file', 'required' => true]) !!}
                            @error('imagen')
                                <div class="alert alert-danger" role="alert">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                </div>

                @foreach ($mCategorias as $categoria)
                    <div class="row bg-light mb-2 pt-2 rounded">
                        {{-- Productos --}}
                        <div class="col-4">
                            <div class="form-group">
                                {!! Form::label(strtolower($categoria->categoria), ucwords($categoria->categoria)) !!}
                                @if ($loop->iteration <= 2)
                                    <select name="{{ strtolower($categoria->categoria) }}"
                                        id="{{ strtolower($categoria->categoria) }}" class="form-control" required>
                                    @else
                                        <select name="{{ strtolower($categoria->categoria) }}"
                                            id="{{ strtolower($categoria->categoria) }}" class="form-control">
                                @endif
                                <option value="" selected disabled>SELECCIONAR</option>
                                @foreach ($mProductos as $producto)
                                    @if ($producto->categoria_id == $categoria->id)
                                        <option value="{{ $producto->id }}">{{ $producto->nombre }}</option>
                                    @endif
                                @endforeach
                                </select>
                                @error(strtolower($categoria->categoria))
                                    <div class="alert alert-danger" role="alert">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        {{-- Precios --}}
                        <div class="col-2">
                            <div class="form-group">
                                {!! Form::label(strtolower($categoria->categoria) . 'Precio', 'Precio') !!}
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">$</span>
                                    </div>
                                    @if ($loop->iteration <= 2)
                                        {!! Form::number(strtolower($categoria->categoria) . 'Precio', null, ['class' => 'form-control align-self-center precio', 'required', 'disabled']) !!}
                                    @else
                                        {!! Form::number(strtolower($categoria->categoria) . 'Precio', null, ['class' => 'form-control align-self-center precio', 'disabled']) !!}
                                    @endif
                                </div>
                                @error(strtolower($categoria->categoria) . 'Precio')
                                    <div class="alert alert-danger" role="alert">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        {{-- Cantidades --}}
                        <div class="col-2">
                            <div class="form-group">
                                {!! Form::label(strtolower($categoria->categoria) . 'Cantidad', 'Cantidad') !!}
                                @if ($loop->iteration <= 2)
                                    {!! Form::number(strtolower($categoria->categoria) . 'Cantidad', null, ['class' => 'form-control cantidad', 'placeholder' => 0, 'required', 'min' => '0', 'step' => '1', 'oninput' => 'validity.valid||(value="");']) !!}
                                @else
                                    {!! Form::number(strtolower($categoria->categoria) . 'Cantidad', null, ['class' => 'form-control cantidad', 'placeholder' => 0, 'min' => '0', 'step' => '1', 'oninput' => 'validity.valid||(value="");']) !!}
                                @endif
                                @error(strtolower($categoria->categoria) . 'Cantidad')
                                    <div class="alert alert-danger" role="alert">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        {{-- Totales --}}
                        <div class="col-4">
                            <div class="form-group">
                                {!! Form::label(strtolower($categoria->categoria) . 'Total', 'Total') !!}
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">$</span>
                                    </div>
                                    {!! Form::number(strtolower($categoria->categoria) . 'Total', null, ['class' => 'form-control total align-self-center', 'disabled']) !!}
                                </div>
                                @error(strtolower($categoria->categoria) . 'Total')
                                    <div class="alert alert-danger" role="alert">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                @endforeach

                {{-- Total final --}}
                <div class="row justify-content-end">
                    <div class="col-4 bg-light mb-2 py-3 rounded">
                        {!! Form::label('totalFinal', 'Total final') !!}
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">$</span>
                            </div>
                            {!! Form::number('totalFinal', old('totalFinal'), ['class' => 'form-control align-self-center', 'readonly' => true]) !!}
                        </div>
                        @error('totalFinal')
                            <div class="alert alert-danger" role="alert">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>

                <div class="row mb-5">
                    <div class="col">
                        {{ Form::submit('Agregar paquete', ['class' => 'btn btn-success']) }}
                        <a class="btn btn-secondary" href="{{ route('paquetes.index') }}" role="button">Cancelar</a>
                    </div>
                </div>

                {!! Form::close() !!}
            </div>
        </div>
    </div>

@endsection
