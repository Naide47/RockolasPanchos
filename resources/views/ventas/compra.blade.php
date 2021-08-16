@extends('layout.layout')

@section('head')
    <link rel="stylesheet" href="{{ asset('css/buttons.css') }}">
@endsection

@section('Breadcrumb')
<div class="breadcrumb-wrap">
    <div class="container-fluid">
        <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('ventas.index') }}">Inicio</a></li>
            <li class="breadcrumb-item"><a href="{{ route('ventas.index') }}">Venta</a></li>
            <li class="breadcrumb-item active">Compra</li>
        </ul>
    </div>
</div>
@endsection

@section('contents')

    @php
        $carrito = session()->get('nuevoCarrito');
    @endphp

    {{HTML::ul($errors->all())}}
    {{ Form::open(['route' => ['guardarCompra'], 'method' => 'POST']) }}
   <div style="padding: 30px; background: #ffffff;">
        <h3>Datos personales</h3>
        <div class="col-md-12">
            <div class="row">
                <div class="form-group col-md-4">
                    {{Form::label('nombre','Nombre')}}
                    {{Form::text('nombre', Request::old('nombre'), ["class"=>"form-control", "required" => true, "placeholder" => "Nombre"] )}} 
                </div>
                <div class="form-group col-md-4">
                    {{Form::label('apellido','Apellido')}}
                    {{Form::text('apellido', Request::old('apellido'), ["class"=>"form-control", "required" => true, "placeholder" => "Apellido"] )}} 
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="row">
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
                    {{Form::number('codigoPostal', Request::old('codigoPostal'), ["class"=>"form-control", "required" => true, "placeholder" => "Codigo Postal"] )}}     
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="row">
                <div class="form-group col-md-4">
                    {{Form::label('telefono','Telefono')}}
                    {{Form::text('telefono', Request::old('telefono'), ["class"=>"form-control", "required" => true, "placeholder" => "Telefono"] )}}     
                </div>
                <div class="form-group col-md-4">
                    {{Form::label('celular','Celular')}}
                    {{Form::text('celular', Request::old('celular'), ["class"=>"form-control", "required" => true, "placeholder" => "Celular"] )}}     
                </div>
            </div>
        </div>
    </div>
    <div style="padding: 30px; margin-bottom: 30px; background: #ffffff;">
        <h3>Detalle de la compra</h3>
        <div class="cart-page">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-8">
                    <div class="cart-page-inner">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>Producto</th>
                                        <th>Precio</th>
                                        <th>Cantidad</th>
                                    </tr>
                                </thead>
                                <tbody class="align-middle">
                                    @if(is_array($carrito) || is_object($carrito))
                                        @foreach($carrito as $row)
                                        {{ Form::hidden('idPCompra'.($loop->iteration), $row['IdProducto']) }}
                                            <tr>
                                                <td>
                                                    <div class="img">
                                                        <a href="#">
                                                            @if ($row['imagen'])
                                                                <img src="{{ asset('storage/' . $row['imagen']) }}"
                                                                    alt="Imagen del producto {{ $row['nombre'] }}"
                                                                    class="img-thumbnail">
                                                            @else
                                                                <img src="{{ asset('storage/no_imagen.jpg') }}"
                                                                    alt="Imagen del producto {{ $row['nombre'] }}"
                                                                    class="img-thumbnail">
                                                            @endif
                                                        </a>
                                                        <p>{{ $row['nombre'] }}</p>
                                                    </div>
                                                </td>
                                                <td>
                                                    <input type="text" name="precioCompra{{$loop->iteration}}" value="{{ $row['precio'] }}" readonly>
                                                </td>
                                                <td>
                                                    <input type="text" name="cantidadCompra{{$loop->iteration}}" value="{{ $row['cantidad'] }}" readonly>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="cart-page-inner">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="cart-summary">
                                    <div class="cart-content">
                                        <h1>Cart Summary</h1>
                                        {{Form::label('anticipoCompra','Anticipo')}}
                                        {{ Form::text('anticipoCompra', ($anticipo), ['class'=>'form-control', 'readonly']) }}
                                        

                                        {{Form::label('totalCompra','Total')}}
                                        {{ Form::text('totalCompra', ($total), ['class'=>'form-control', 'readonly']) }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
        {{Form::submit('Comprar', ["class"=>"btn btn-success"])}}
        {{Form::close()}}
    </div>
@endsection
