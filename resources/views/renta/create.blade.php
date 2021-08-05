@extends('layout.layout')

<link rel="stylesheet" href="{{ asset('css/buttons.css') }}">

@section('Breadcrumb')
<div class="breadcrumb-wrap">
    <div class="container-fluid">
        <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Inicio</a></li>
            <li class="breadcrumb-item"><a href="#">Rentas</a></li>
            <li class="breadcrumb-item active">Rentar</li>
        </ul>
    </div>
</div>
@endsection

@section('contents')

{{HTML::ul($errors->all())}}
{{Form::open(["url"=>"renta"])}}

<div style="padding: 30px; margin-bottom: 30px; background: #ffffff;">

    <h3>Información Personal</h3>

    <div class="row">
        <div class="form-group col-md-6">
            {{Form::label('nombre','Nombre')}}
            {{Form::text('nombre', Request::old('nombre'), ["class"=>"form-control", "required" => true, "placeholder" => "Nombre"] )}}
        </div>

        <div class="form-group col-md-4">
            {{Form::label('numero','Número celular')}}
            {{Form::number('numero', Request::old('numero'), ["class"=>"form-control", "required" => true, "placeholder" => "Numero"] )}}
        </div>
    </div>

    <div class="form-row">
        <!-- 
        <div class="form-group col-md-7">
            {!! Form::label('clientes', 'Clientes') !!}
            <select class="form-control" id="cliente" name="cliente" required>
                <option value="" selected disabled>SELECCIONAR</option>
                @foreach ($clientes as $cliente)
                @foreach ($personas as $persona)
                @if ($persona->id == $cliente->persona_id)
                <option value="{{ $cliente->id }}">{{ $persona->nombre }}</option>
                @endif
                @endforeach
                @endforeach
            </select>
            @error('cliente')
            <div class="alert alert-danger" role="alert">
                {{ $message }}
            </div>
            @enderror
        </div>
        -->

        <div class="form-group col-md-4">
            {{Form::label('calle','Calle')}}
            {{Form::text('rcalle', Request::old('calle'), ["class"=>"form-control", "required" => true, "placeholder" => "Calle"] )}}
        </div>
        <div class="form-group col-md-4">
            {{Form::label('colonia','Colonia')}}
            {{Form::text('rcolonia', Request::old('colonia'), ["class"=>"form-control", "required" => true, "placeholder" => "Colonia"] )}}
        </div>
        <div class="form-group col-md-4">
            {{Form::label('noexterior','No. Exterior')}}
            {{Form::text('rnoexterior', Request::old('noexterior'), ["class"=>"form-control", "required" => true, "placeholder" => "No. Exterior"] )}}
        </div>
    </div>

    <h3>Detalle de la renta</h3>

    <div style="padding: 30px; margin-bottom: 30px; background: #ffffff;">
        <div class="col-md-12">
            @if ($modelo->imgNombreFisico)
            <div class="align-middle">
                <img src="{{ asset('storage/' . $modelo->imgNombreFisico) }}" alt="Imagen del producto {{ $modelo->nombre }}" width="300px" class="img-thumbnail">
            </div>
            @else
            <div class="align-middle">
                <img src="{{ asset('storage/no_imagen.jpg') }}" alt="Imagen del producto {{ $modelo->nombre }}" width="300px" class="img-thumbnail">
            </div>
            @endif
        </div>
    </div>

    <div class="col-md-12">
        <div class="row">
            <!-- {{Form::hidden('id', $value = ($modelo->id), ["class"=>"form-control", "disabled"] )}} -->
            <input type="hidden" name="id" value="{{$modelo->id}}" class="form-control">
            <input type="hidden" name="existencias" value="{{$modelo->existencias}}">
            <input type="hidden" name="disponibles" value="{{$modelo->disponibles}}">
            <div class="form-group col-md-4">
                {{Form::label('cantidad','Cantidad')}}
                <div class="input-group mb-3">
                    <select class="custom-select" id="rcantidad" name="rcantidad" required="true" onchange="calcularTotal()">
                        <option selected value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                    </select>
                </div>
            </div>
            <div class="form-group col-md-4">
                {{Form::label('nombre_producto','Nombre producto')}}
                {{Form::hidden('rnombre_producto', ($modelo->nombre), ["class"=>"form-control"] )}}
                <input type="text" value="{{$modelo->nombre}}" class="form-control" disabled>
            </div>
            <div class="form-group col-md-4">
                {{Form::label('precio','Precio')}}
                {{Form::hidden('rprecio', ($modelo->precioUnitario), ["class"=>"form-control", "id"=>"rprecio"] )}}
                <input type="text" value="{{$modelo->precioUnitario}}" class="form-control" disabled>
            </div>
            <div class="form-group col-md-4">
                {{Form::label('anticipo','Anticipo')}}
                {{Form::hidden('ranticipo', ($anticipo=$modelo->precioUnitario*0.10), ["class"=>"form-control", "placeholder" => "Anticipo", "id"=>"ranticipo"] )}}
                <input type="number" id="ranticipoView" value="{{$anticipo=$modelo->precioUnitario*0.10}}" class="form-control" placeholder="Anticipo" disabled>
            </div>
            <div class="form-group col-md-4">
                {{Form::label('total','Total')}}
                {{Form::hidden('rtotal', ($modelo->precioUnitario - $anticipo), ["class"=>"form-control", "id"=>"rtotal"] )}}
                <input type="text" id="rtotalView" value="{{$modelo->precioUnitario - $anticipo}}" class="form-control" disabled>
            </div>
            <div class="form-group col-md-7">
                <div class="form-outline">
                    <label class="control-label">Fecha de entrega: </label>
                    {{Form::date('fechaInicio', Request::old('fechaInicio'),  ["id"=>"fechaInicio"])}}
                </div>
            </div>
            <div class="form-group col-md-4">
                <div class="form-outline">
                    <label class="control-label">Fecha de recogida: </label>
                    {{Form::date('fechaTermino', Request::old('fechaTermino'), ["id"=>"fechaTermino"])}}
                </div>
            </div>

        </div>
    </div>
    <!-- Forma de pago -->
    <h3>Forma de pago</h3>
    <div class="col-md-12">
        <div class="form-check">
            <input class="form-check-input" type="radio" name="pago" id="rentaPago1" value="1" checked>
            <label class="form-check-label" for="rentaPago1">
                Efectivo
            </label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="pago" id="rentaPago2" value="2">
            <label class="form-check-label" for="rentaPago2">
                Tarjeta
            </label>
        </div>
    </div>
    <div style="display: none;" id="rdatos">
        <h3 id="rtituloTarjeta" style="visibility:hidden;">Informacion de la tarjeta</h3>
        <div class="col-md-12">
            <div class="row">
                <div class="form-group col-md-4">
                    <label style="visibility:hidden" id="rlabelnumTarjeta"> Numero de tarjeta </label>
                    {{Form::hidden('rnumTarjeta', '0', ["class"=>"form-control", "required" => true, "placeholder" => "Numero de tarjeta", "id"=>"rnumTarjeta"] )}}
                </div>
                <div class="form-group col-md-4">
                    {{Form::label('rtipoTarjeta','Tipo de tarjeta', ["style"=>"visibility:hidden", "id"=>"rlabeltipoTarjeta"])}}
                    <div class="input-group mb-3">
                        <select class="custom-select" id="rtipoTarjeta" name="rtipoTarjeta" required="true" style="visibility:hidden">
                            <option selected value="0">Eliga un tipo</option>
                            <option value="1">Debito</option>
                            <option value="2">Credito</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br><br>

</div>
{{Form::submit('Rentar', ["class"=>"btn btn-success"])}}
{{Form::close()}}


@endsection