@extends('layout.layout')

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
    <div style="padding: 30px; margin-bottom: 30px; background: #ffffff;">
    {{HTML::ul($errors->all())}}
    <h3>Datos personales</h3>
    <form class="form-row">
    {{Form::open(["url"=>"perros"])}}
        <div class="form-group col-md-4">
            {{Form::label('nombre','Nombre')}}
            {{Form::text('nombre', Request::old('nombre'), ["class"=>"form-control", "required" => true, "placeholder" => "Nombre"] )}} 
        </div>
        <div class="form-group col-md-4">
            {{Form::label('apellido','Apellido')}}
            {{Form::text('apellido', Request::old('apellido'), ["class"=>"form-control", "required" => true, "placeholder" => "Apellido"] )}} 
        </div>
    </form>
    <form class="form-row">
        <div class="form-group col-md-4">
            {{Form::label('calle','Calle')}}
            {{Form::text('calle', Request::old('calle'), ["class"=>"form-control", "required" => true, "placeholder" => "Calle"] )}}     
        </div>
        <div class="form-group col-md-4">
            {{Form::label('colonia','Colonia')}}
            {{Form::text('colonia', Request::old('colonia'), ["class"=>"form-control", "required" => true, "placeholder" => "Colonia"] )}}     
        </div>
        <div class="form-group col-md-4">
            {{Form::label('codigoPostal','Codigo Postal')}}
            {{Form::text('codigoPostal', Request::old('codigoPostal'), ["class"=>"form-control", "required" => true, "placeholder" => "Codigo Postal"] )}}     
        </div>
    </form>
    <form class="form-row">
        <div class="form-group col-md-4">
            {{Form::label('telefono','Telefono')}}
            {{Form::text('telefono', Request::old('telefono'), ["class"=>"form-control", "required" => true, "placeholder" => "Telefono"] )}}     
        </div>
        <div class="form-group col-md-4">
            {{Form::label('celular','Celular')}}
            {{Form::text('celular', Request::old('celular'), ["class"=>"form-control", "required" => true, "placeholder" => "Celular"] )}}     
        </div>
    </form>
    <h3>Detalle de la compra</h3>
    <form class="form-row">
        <div class="form-group col-md-4">
            {{Form::label('nombre_producto','Nombre producto')}}
            {{Form::text('nombre_producto', $modelo->nombre, ["class"=>"form-control", "required" => true] )}}     
        </div>
        <div class="form-group col-md-4">
            {{Form::label('precio','Precio')}}
            {{Form::text('precio', Request::old('precio'), ["class"=>"form-control", "required" => true, "value" => "$modelo->precioCompra"] )}}     
        </div>
        <div class="form-group col-md-4">
            {{Form::label('anticipo','Anticipo')}}
            {{Form::text('anticipo', Request::old('anticipo'), ["class"=>"form-control", "required" => true, "placeholder" => "Anticipo"] )}}     
        </div>
        <div class="form-group col-md-4">
            {{Form::label('total','Total')}}
            {{Form::text('total', Request::old('total'), ["class"=>"form-control", "required" => true, "placeholder" => "$modelo->precioCompra"] )}}     
        </div>
    </form>
    <h3>Informacion de la tarjeta</h3>
    <form class="form-row">
        <div class="form-group col-md-4">
            {{Form::label('calle','No tarjeta')}}
            {{Form::text('calle', Request::old('calle'), ["class"=>"form-control", "required" => true, "placeholder" => "No tarjeta"] )}}     
        </div>
        <div class="form-group col-md-4">
            {{Form::label('colonia','Tipo de tarjeta')}}
            {{Form::text('colonia', Request::old('colonia'), ["class"=>"form-control", "required" => true, "placeholder" => "Tipo de tarjeta"] )}}     
        </div>
    </form>
        {{Form::submit('Registrar perro', ["class"=>"btn btn-primary"])}}
        {{Form::close()}}
    </div>
@endsection
