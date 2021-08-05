@extends('layout.users')
@section('titulo')
    Agregar paquete
@endsection

@section('head')
    <link rel="stylesheet" href="{{ asset('css/buttons.css') }}">
    <script src="{{ asset('js/index_functions.js') }}"></script>
@endsection

@section('contents')
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
                            {!! Form::label('nombre', 'Nombre') !!}
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

                {{-- Sillas --}}
                <div class="row bg-light mb-2 pt-2 rounded">
                    <div class="col">
                        <div class="form-group">
                            {!! Form::label('silla', 'Silla') !!}
                            <select name="silla" id="silla" class="form-control" required>
                                <option value="" selected disabled>SELECCIONAR</option>
                                @foreach ($mProductos as $producto)
                                    @if ($producto->categoria_id == 1)
                                        {{-- Silla --}}
                                        <option value="{{ $producto->id }}">{{ $producto->nombre }} -
                                            ${{ $producto->precioUnitario }}</option>
                                    @endif
                                @endforeach
                            </select>
                            @error('silla')
                                <div class="alert alert-danger" role="alert">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            {!! Form::label('sillaCantidad', 'Cantidad') !!}
                            {!! Form::number('sillaCantidad', old('sillaCantidad'), ['class' => 'form-control', 'required' => true]) !!}
                            @error('sillaCantidad')
                                <div class="alert alert-danger" role="alert">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            {!! Form::label('sillaTotal', 'Total') !!}
                            {!! Form::text('sillaTotal', old('sillaTotal'), ['class' => 'form-control total', 'readonly' => true]) !!}
                        </div>
                    </div>
                </div>
                {{-- Mesas --}}
                <div class="row bg-light mb-2 pt-2 rounded">
                    <div class="col">
                        <div class="form-group">
                            {!! Form::label('mesa', 'Mesa') !!}
                            <select name="mesa" id="mesa" class="form-control" required>
                                <option value="" selected disabled>SELECCIONAR</option>
                                @foreach ($mProductos as $producto)
                                    @if ($producto->categoria_id == 2)
                                        {{-- Mesa --}}
                                        <option value="{{ $producto->id }}">{{ $producto->nombre }} -
                                            ${{ $producto->precioUnitario }}</option>
                                    @endif
                                @endforeach
                            </select>
                            @error('mesa')
                                <div class="alert alert-danger" role="alert">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            {!! Form::label('mesaCantidad', 'Cantidad') !!}
                            {!! Form::number('mesaCantidad', old('mesaCantidad'), ['class' => 'form-control', 'required' => true]) !!}
                            @error('mesaCantidad')
                                <div class="alert alert-danger" role="alert">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            {!! Form::label('mesaTotal', 'Total') !!}
                            {!! Form::text('mesaTotal', old('mesaTotal'), ['class' => 'form-control total', 'readonly' => true]) !!}
                        </div>
                    </div>
                </div>
                {{-- Rockolas --}}
                <div class="row bg-light mb-2 pt-2 rounded">
                    <div class="col">
                        <div class="form-group">
                            {!! Form::label('rockola', 'Rockola') !!}
                            <select name="rockola" id="rockola" class="form-control">
                                <option value="" selected disabled>SELECCIONAR</option>
                                @foreach ($mProductos as $producto)
                                    @if ($producto->categoria_id == 3)
                                        {{-- Rockola --}}
                                        <option value="{{ $producto->id }}">{{ $producto->nombre }} -
                                            ${{ $producto->precioUnitario }}</option>
                                    @endif
                                @endforeach
                            </select>
                            @error('rockola')
                                <div class="alert alert-danger" role="alert">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            {!! Form::label('rockolaCantidad', 'Cantidad') !!}
                            {!! Form::number('rockolaCantidad', old('rockolaCantidad'), ['class' => 'form-control']) !!}
                            @error('rockolaCantidad')
                                <div class="alert alert-danger" role="alert">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            {!! Form::label('rockolaTotal', 'Total') !!}
                            {!! Form::text('rockolaTotal', old('rockolaTotal'), ['class' => 'form-control total', 'readonly' => true]) !!}
                        </div>
                    </div>
                </div>
                {{-- Carpas --}}
                <div class="row bg-light mb-2 pt-2 rounded">
                    <div class="col">
                        <div class="form-group">
                            {!! Form::label('carpa', 'Carpa') !!}
                            <select name="carpa" id="carpa" class="form-control">
                                <option value="" selected disabled>SELECCIONAR</option>
                                @foreach ($mProductos as $producto)
                                    @if ($producto->categoria_id == 4)
                                        {{-- Carpa --}}
                                        <option value="{{ $producto->id }}">{{ $producto->nombre }} -
                                            ${{ $producto->precioUnitario }}</option>
                                    @endif
                                @endforeach
                            </select>
                            @error('carpa')
                                <div class="alert alert-danger" role="alert">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            {!! Form::label('carpaCantidad', 'Cantidad') !!}
                            {!! Form::number('carpaCantidad', old('carpaCantidad'), ['class' => 'form-control']) !!}
                            @error('carpaCantidad')
                                <div class="alert alert-danger" role="alert">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            {!! Form::label('carpaTotal', 'Total') !!}
                            {!! Form::text('carpaTotal', old('carpaTotal'), ['class' => 'form-control total', 'readonly' => true]) !!}
                        </div>
                    </div>
                </div>
                {{-- Inflables --}}
                <div class="row bg-light mb-2 pt-2 rounded">
                    <div class="col">
                        <div class="form-group">
                            {!! Form::label('inflable', 'Inflable') !!}
                            <select name="inflable" id="inflable" class="form-control">
                                <option value="" selected disabled>SELECCIONAR</option>
                                @foreach ($mProductos as $producto)
                                    @if ($producto->categoria_id == 5)
                                        {{-- Inflable --}}
                                        <option value="{{ $producto->id }}">{{ $producto->nombre }} -
                                            ${{ $producto->precioUnitario }}</option>
                                    @endif
                                @endforeach
                            </select>
                            @error('inflable')
                                <div class="alert alert-danger" role="alert">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            {!! Form::label('inflableCantidad', 'Cantidad') !!}
                            {!! Form::number('inflableCantidad', old('inflableCantidad'), ['class' => 'form-control']) !!}
                            @error('inflableCantidad')
                                <div class="alert alert-danger" role="alert">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            {!! Form::label('inflableTotal', 'Total') !!}
                            {!! Form::text('inflableTotal', old('inflableTotal'), ['class' => 'form-control total', 'readonly' => true]) !!}
                        </div>
                    </div>
                </div>
                {{-- Total final --}}
                <div class="row justify-content-end">
                    <div class="col-4 bg-light mb-2 pt-2 rounded">
                        {!! Form::label('totalFinal', 'Total final') !!}
                        {!! Form::text('totalFinal', old('totalFinal'), ['class' => 'form-control', 'readonly' => true]) !!}
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
