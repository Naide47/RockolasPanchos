@extends('layout.users')
@section('title')
    Editar paquete
@endsection

@section('head')
    <link rel="stylesheet" href="{{ asset('css/buttons.css') }}">
    <script src="{{ asset('js/paquetes.js') }}"></script>
    <script>
        @php
        echo 'var precios = JSON.stringify(' . $mPreciosUnitarios . ');';
        @endphp
        localStorage.setItem("precios", precios);
    </script>
@endsection

@section('contents')
    <div class="container-fluid bg-white my-5">
        <div class="row">
            <div class="col">
                <h1>Editar paquete</h1>
            </div>
        </div>
        <div class="row">
            <div class="col">
                {{ Form::model($mPaquete, ['route' => ['paquetes.update', $mPaquete->id], 'method' => 'PUT', 'enctype' => 'multipart/form-data']) }}
                <div class="row bg-light mb-2 pt-2 rounded">
                    <div class="col">
                        <div class="form-group">
                            {!! Form::label('nombre', 'Nombre del paquete') !!}
                            {!! Form::text('nombre', $mPaquete->nombre, ['class' => 'form-control', 'required' => true]) !!}
                            @error('nombre')
                                <div class="alert alert-danger" role="alert">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            {!! Form::label('imagen', 'Imagen del paquete') !!}
                            {!! Form::file('imagen', [
    'accept' => 'image/png, image/jpeg',
    'class' => 'form-control-file'
]) !!}
                            @error('imagen')
                                <div class="alert alert-danger" role="alert">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                </div>
                @php
                    $totalFinal = 0;
                @endphp
                @foreach ($mCategorias as $categoria)
                    @php
                        $label = strtolower($categoria->categoria);
                        $producto_id = -1;
                        $precio = 0;
                        $cantidad = null;
                        $total = 0;
                        
                        foreach ($mDetallesPaquete as $detallePaquete) {
                            if ($categoria->categoria == $detallePaquete->categoria) {
                                $producto_id = $detallePaquete->producto_id;
                            }
                        }
                        
                        // foreach ($mProductos as $producto) {
                        //     foreach ($mDetallesPaquete as $detallePaquete) {
                        //         if ($producto->id == $detallePaquete->producto_id) {
                        //             $producto_id = $producto->id;
                        //         }
                        //     }
                        // }
                        
                        if ($producto_id != -1) {
                            foreach ($mDetallesPaquete as $detallePaquete) {
                                if ($detallePaquete->producto_id = $producto_id) {
                                    $precio = (float) $detallePaquete->precioUnitario;
                                    $cantidad = (float) $detallePaquete->cantidad;
                                    $total = $precio * $cantidad;
                                    break;
                                }
                            }
                        }
                        $totalFinal += $total;
                        // echo $producto_id;
                    @endphp
                    <div class="row bg-light mb-2 pt-2 rounded">
                        {{-- Productos --}}
                        <div class="col-4">
                            {!! Form::label($label, ucfirst($label)) !!}
                            @if ($loop->iteration <= 2)
                                <select name="{{ $label }}" id="{{ $label }}" class="form-control" required>
                                @else
                                    <select name="{{ $label }}" id="{{ $label }}" class="form-control">
                            @endif
                            @if ($producto_id == -1)
                                <option value="" selected disabled>SELECCIONAR</option>
                            @endif
                            @foreach ($mProductos as $producto)
                                @if ($producto->categoria_id == $categoria->id)
                                    @if ($producto->id == $producto_id)
                                        <option value="{{ $producto->id }}" selected>{{ $producto->nombre }}</option>
                                    @else
                                        <option value="{{ $producto->id }}">{{ $producto->nombre }}</option>
                                    @endif
                                @endif
                            @endforeach
                            </select>
                            @error($label)
                                <div class="alert alert-danger" role="alert">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        {{-- Precios --}}
                        <div class="col-2">
                            <div class="form-group">
                                {!! Form::label($label . 'Precio', 'Precio') !!}
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">$</span>
                                    </div>
                                    @if ($loop->iteration <= 2)
                                        {!! Form::number($label . 'Precio', $precio, ['class' => 'form-control align-self-center precio', 'required', 'disabled']) !!}
                                    @else
                                        {!! Form::number($label . 'Precio', $precio, ['class' => 'form-control align-self-center precio', 'disabled']) !!}
                                    @endif
                                </div>
                                @error($label . 'Precio')
                                    <div class="alert alert-danger" role="alert">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        {{-- Cantidades --}}
                        <div class="col-2">
                            <div class="form-group">
                                {!! Form::label($label . 'Cantidad', 'Cantidad') !!}
                                @if ($loop->iteration <= 2)
                                    {!! Form::number($label . 'Cantidad', $cantidad, ['class' => 'form-control cantidad', 'placeholder' => 0, 'required', 'min' => '0', 'step' => '1', 'oninput' => 'validity.valid||(value="");']) !!}
                                @else
                                    {!! Form::number($label . 'Cantidad', $cantidad, ['class' => 'form-control cantidad', 'placeholder' => 0, 'min' => '0', 'step' => '1', 'oninput' => 'validity.valid||(value="");']) !!}
                                @endif
                                @error($label . 'Cantidad')
                                    <div class="alert alert-danger" role="alert">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        {{-- Totales --}}
                        <div class="col-4">
                            <div class="form-group">
                                {!! Form::label($label . 'Total', 'Total') !!}
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">$</span>
                                    </div>
                                    {!! Form::number($label . 'Total', $total, ['class' => 'form-control total align-self-center', 'disabled']) !!}
                                </div>
                                @error($label . 'Total')
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
                            {!! Form::number('totalFinal', $totalFinal, ['class' => 'form-control align-self-center', 'readonly' => true]) !!}
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
                        {{ Form::submit('Modificar paquete', ['class' => 'btn btn-success']) }}
                        <a class="btn btn-secondary" href="{{ route('paquetes.index') }}" role="button">Cancelar</a>
                    </div>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection
