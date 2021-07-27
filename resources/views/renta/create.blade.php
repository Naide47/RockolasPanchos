@extends('layouts.layout1')

@section('titulo')
Registro de Rentas
@endsection

@section('content')

{{Form::open(["url"=>"renta"])}}

<div class="form-group">
    {{Form::label('anticipoPagado', 'Anticipo')}}
    {{Form::number('anticipoPagado', Request::old('anticipoPagado'), 
        ["class"=> "form-control", "require" => true ] ) }}
</div>

<div class="form-group">
    {{Form::label('tipoTarjeta', 'Debito')}}
    {{Form::radio('tipoTarjeta', 'Debito', Request::old('tipoTarjeta'), 
        ["class"=> "form-control", "require" => false ] ) }}

    {{Form::label('tipoTarjeta', 'Credito')}}
    {{Form::radio('tipoTarjeta', 'Credito', Request::old('tipoTarjeta'), 
        ["class"=> "form-control", "require" => false ] ) }}

    {{Form::label('tipoTarjeta', 'Efectivo')}}
    {{Form::radio('tipoTarjeta', 'Efectivo', Request::old('tipoTarjeta'), 
        ["class"=> "form-control", "require" => false ] ) }}
</div>

<div class="form-group">
    {{Form::label('noTarjeta', 'No. Tarjeta')}}
    {{Form::number('noTarjeta', Request::old('noTarjeta'), 
        ["class"=> "form-control", "require" => true ] ) }}
</div>

<div class="form-group">
    {{Form::date('fechaInicio', Request::old('fechaInicio'))}}
</div>

<div class="form-group">
    {{Form::date('fechaTermino', Request::old('fechaTermino'))}}
</div>

<div class="form-group">
    {!! Form::label('cliente', 'Clientes') !!}
    <select name="cliente" id="cliente" class="form-control">
        @foreach ($clientes as $cliente)
            @foreach ($personas as $persona)
                @if ($cliente->idPersona == $persona->id)
                    <option value="{{ $cliente->id }}" selected>{{ $persona->nombre }}</option>
                @endif
            @endforeach
        @endforeach
    </select>
</div>

<div class="form-group">
    {!! Form::label('usuario', 'Usuarios') !!}
    <select name="usuario" id="usuario" class="form-control">
        @foreach ($usuarios as $usuario)
            @foreach ($personas as $persona)
                @if ($usuario->idPersona == $persona->id)
                    <option value="{{ $usuario->id }}" selected>{{ $persona->nombre }}</option>
                @endif
            @endforeach
        @endforeach
    </select>
</div>

<div class="form-group">
    {!! Form::label('productos', 'Productos') !!}
    <select name="producto" id="producto" class="form-control">
        @foreach ($productos as $producto)
            @foreach ($categorias as $categoria)
                @if ($producto->idCategoria == $categoria->id)
                    <option value="{{ $producto->id }}" id="precio" selected>{{ $categoria->categoria}}$ {{$producto->precioUnitario }} </option>
                @endif
            @endforeach
        @endforeach
    </select>
</div>

<div class="form-group">
    {{Form::label('cantidad', 'Cantidad')}}
    {{Form::number('cantidad', 'cantidad', Request::old('cantidad'), 
        ["class"=> "form-control", "require" => true ] ) }}
</div>

<div class="form-group">
    {{Form::label('total', 'Total')}}
    {{Form::number('total', 'total', Request::old('total'), 
        ["class"=> "form-control", "require" => true ] ) }}
</div>

<button type="button" class="btn btn-info" onclick="calcular()">Probar</button>

{{Form::submit('Registrar renta', ["class"=>"btn btn-primary"] )}}

{{Form::close()}}

@endsection