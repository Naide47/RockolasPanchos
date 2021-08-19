@extends('layout.layout')

@section('head')
    <link rel="stylesheet" href="{{ asset('css/buttons.css') }}">
@endsection

@section('Breadcrumb')
    <div class="breadcrumb-wrap">
        <div class="container-fluid">
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Inicio</a></li>
                <li class="breadcrumb-item"><a href="#">Productos</a></li>
                <li class="breadcrumb-item"><a href="#">Venta</a></li>
                <li class="breadcrumb-item active">Compra</li>
            </ul>
        </div>
    </div>
@endsection

@section('contents')
    {{ HTML::ul($errors->all()) }}
    {{ Form::open(['route'=>["ventas.store2"]]) }}
    <div style="padding: 30px; background: #ffffff;">
        <h3>Datos personales</h3>
        <div class="col-md-12">
            <div class="row">
                <div class="form-group col-md-4">
                    {{ Form::label('nombre', 'Nombre') }}
                    {{ Form::text('nombre', Request::old('nombre'), ['class' => 'form-control', 'required' => true, 'placeholder' => 'Nombre']) }}
                </div>
                <div class="form-group col-md-4">
                    {{ Form::label('apellido', 'Apellido') }}
                    {{ Form::text('apellido', Request::old('apellido'), ['class' => 'form-control', 'required' => true, 'placeholder' => 'Apellido']) }}
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="row">
                <div class="form-group col-md-4">
                    {{ Form::label('calle', 'Calle') }}
                    {{ Form::text('calle', Request::old('calle'), ['class' => 'form-control', 'required' => true, 'placeholder' => 'Calle']) }}
                </div>
                <div class="form-group col-md-4">
                    {{ Form::label('colonia', 'Colonia') }}
                    {{ Form::text('colonia', Request::old('colonia'), ['class' => 'form-control', 'required' => true, 'placeholder' => 'Colonia']) }}
                </div>
                <div class="form-group col-md-4">
                    {{ Form::label('codigoPostal', 'Codigo Postal') }}
                    {{ Form::number('codigoPostal', Request::old('codigoPostal'), ['class' => 'form-control', 'required' => true, 'placeholder' => 'Codigo Postal']) }}
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="row">
                <div class="form-group col-md-4">
                    {{ Form::label('telefono', 'Telefono') }}
                    {{ Form::text('telefono', Request::old('telefono'), ['class' => 'form-control', 'required' => true, 'placeholder' => 'Telefono']) }}
                </div>
                <div class="form-group col-md-4">
                    {{ Form::label('celular', 'Celular') }}
                    {{ Form::text('celular', Request::old('celular'), ['class' => 'form-control', 'required' => true, 'placeholder' => 'Celular']) }}
                </div>
            </div>
        </div>
    </div>
    <div style="padding: 30px; margin-bottom: 30px; background: #ffffff;">
        <h3>Detalle de la compra</h3>
        <div class="col-md-12">
            @if ($modelo->imgNombreFisico)
                <div class="align-middle">
                    <img src="{{ asset('storage/' . $modelo->imgNombreFisico) }}"
                        alt="Imagen del producto {{ $modelo->nombre }}" width="300px" class="img-thumbnail">
                </div>
            @else
                <div class="align-middle">
                    <img src="{{ asset('storage/no_imagen.jpg') }}" alt="Imagen del producto {{ $modelo->nombre }}"
                        width="300px" class="img-thumbnail">
                </div>
            @endif
        </div>
        <div class="col-md-12">
            <div class="row">
                <!-- {{ Form::hidden('id', $value = $modelo->id, ['class' => 'form-control', 'disabled']) }} -->
                <input type="hidden" name="id" value="{{ $modelo->id }}" class="form-control">
                <input type="hidden" name="existencias" value="{{ $modelo->existencias }}">
                <input type="hidden" name="disponibles" value="{{ $modelo->disponibles }}">
                <div class="form-group col-md-4">
                    {{ Form::label('cantidad', 'Cantidad') }}
                    <div class="input-group mb-3">
                        <select class="custom-select" id="cantidad" name="cantidad" required="true"
                            onchange="calcularTotalSinAnticipo()">
                            <option selected value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                        </select>
                    </div>
                </div>
                <div class="form-group col-md-4">
                    {{ Form::label('nombre_producto', 'Nombre producto') }}
                    {{ Form::hidden('nombre_producto', $modelo->nombre, ['class' => 'form-control']) }}
                    <input type="text" value="{{ $modelo->nombre }}" class="form-control" disabled>
                </div>
                <div class="form-group col-md-4">
                    {{ Form::label('precio', 'Precio') }}
                    {{ Form::hidden('precio', $modelo->precioUnitario, ['class' => 'form-control', 'id' => 'precio']) }}
                    <input type="text" value="{{ $modelo->precioUnitario }}" class="form-control" disabled>
                </div>
                <div class="form-group col-md-4">
                    {{ Form::label('anticipo', 'Anticipo') }}
                    {{ Form::hidden('anticipo', $anticipo = $modelo->precioUnitario * 0.1, ['class' => 'form-control', 'placeholder' => 'Anticipo', 'id' => 'anticipo']) }}
                    <input type="number" id="anticipoView" value="{{ $anticipo = $modelo->precioUnitario * 0.1 }}"
                        class="form-control" placeholder="Anticipo" disabled>
                </div>
                <div class="form-group col-md-4">
                    {{ Form::label('total', 'Total (Sin Anticipo)') }}
                    {{ Form::hidden('total', $modelo->precioUnitario, ['class' => 'form-control', 'id' => 'total']) }}
                    <input type="text" id="totalView" value="{{ $modelo->precioUnitario }}"
                        class="form-control" disabled>
                </div>
            </div>
        </div>
        {{ Form::submit('Comprar', ['class' => 'btn btn-success']) }}
        {{ Form::close() }}
    </div>
@endsection
