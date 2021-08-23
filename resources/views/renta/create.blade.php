@extends('layout.users')

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

    {{ HTML::ul($errors->all()) }}
    {{ Form::open(['url' => 'renta']) }}
    {!! Form::hidden('paquete_id', $modelo->id) !!} 
    <div style="padding: 30px; margin-bottom: 30px; background: #ffffff;">

        <h3>Información Personal</h3>

        <div class="row">
            <div class="form-group col-md-4">
                {{ Form::label('nombre', 'Nombre') }}
                {{ Form::text('nombre', Request::old('nombre'), ['class' => 'form-control', 'required' => true, 'placeholder' => 'Nombre']) }}
            </div>

            <div class="form-group col-md-4">
                {{ Form::label('celular', 'Número celular') }}
                {{ Form::number('celular', Request::old('celular'), ['class' => 'form-control', 'required' => true, 'placeholder' => 'Celular']) }}
            </div>

            <div class="form-group col-md-4">
                {{ Form::label('telefono', 'Número Teléfono') }}
                {{ Form::number('telefono', Request::old('telefono'), ['class' => 'form-control', 'required' => true, 'placeholder' => 'Teléfono']) }}
            </div>
        </div>
        <h3>Dirección de la renta</h3>
        <div class="form-row">

            <div class="form-group col-md-4">
                {{ Form::label('calle', 'Calle y Número') }}
                {{ Form::text('calle', Request::old('calle'), ['class' => 'form-control', 'required' => true, 'placeholder' => 'Calle y Número']) }}
            </div>
            <div class="form-group col-md-4">
                {{ Form::label('colonia', 'Colonia') }}
                {{ Form::text('colonia', Request::old('colonia'), ['class' => 'form-control', 'required' => true, 'placeholder' => 'Colonia']) }}
            </div>
            <div class="form-group col-md-2">
                {{ Form::label('codigoPostal', 'Codigo Postal') }}
                {{ Form::text('codigoPostal', Request::old('codigoPostal'), ['class' => 'form-control', 'required' => true, 'placeholder' => 'Codigo Postal']) }}
            </div>
        </div>

        <h3>Detalle de la renta</h3>

        <div style="padding: 30px; margin-bottom: 30px; background: #ffffff;">
            <div class="col-md-12">
                @if ($modelo->imgNombreFisico)
                    <div class="align-middle">
                        <img src="{{ asset('storage/' . $modelo->imgNombreFisico) }}"
                            alt="Imagen del producto {{ $modelo->nombre }}" width="300px" class="img-thumbnail">
                    </div>
                @else
                    <div class="align-middle">
                        <img src="{{ asset('storage/no_imagen.jpg') }}"
                            alt="Imagen del producto {{ $modelo->nombre }}" width="300px" class="img-thumbnail">
                    </div>
                @endif
            </div>
        </div>

        <h3>Productos</h3>

        <div class="col-md-12">
            <div class="row">                
                @foreach ($mPaquetes as $mPaquete)
                    <div class="col-md-8">                                            
                        {{ Form::text('producto'.$loop->index, $mPaquete->nombre, ['class' => 'form-control', 'disabled']) }}
                    </div>
                    <div class="col-md-2">
                        {{ Form::text('cantidad'.$loop->index, $mPaquete->cantidad, ['class' => 'form-control', 'disabled']) }}
                    </div>
                @endforeach
            </div>
        </div>
        <div class="col-md-12">
            <div class="row">
                <div class="form-group col-md-4">
                    {{ Form::label('nombre_producto', 'Nombre Paquete') }}
                    {{ Form::hidden('rnombre_producto', $modelo->nombre, ['class' => 'form-control', 'disabled']) }}
                    <input type="text" value="{{ $modelo->nombre }}" class="form-control" disabled>
                </div>
                <div class="form-group col-md-4">
                    {{ Form::label('precio', 'Precio') }}
                    {{ Form::hidden('rprecio', $modelo->precio, ['class' => 'form-control', 'id' => 'rprecio']) }}
                    <input type="text" value="{{ $modelo->precio }}" class="form-control" disabled>
                </div>
                <div class="form-group col-md-4">
                    {{ Form::label('ranticipoView', 'Anticipo') }}
                    {{ Form::hidden('anticipo', $anticipo = $modelo->precio * 0.1, ['class' => 'form-control', 'placeholder' => 'Anticipo', 'id' => 'ranticipoView']) }}
                    <input type="number" id="ranticipoView" value="{{ $anticipo = $modelo->precio * 0.1 }}"
                        class="form-control" placeholder="Anticipo" disabled>
                </div>
                <div class="form-group col-md-4">
                    {{ Form::label('rtotalView', 'Total') }}
                    {{ Form::hidden('rtotal', $modelo->precio, ['class' => 'form-control', 'id' => 'rtotal']) }}
                    <input type="text" id="rtotalView" value="{{ $modelo->precio }}" class="form-control" disabled>
                </div>
            </div>
        </div>
        <h3>Fecha de renta</h3>
        <div class="col-md-12">
            <div class="row">
                <div class="form-group col-md-6">
                    <div class="form-outline">
                        <label class="control-label">Fecha de entrega: </label>
                        {{ Form::date('fechaInicio', Request::old('fechaInicio'), ['id' => 'fechaInicio', 'name' => 'fechaInicio', 'class' => 'form-control']) }}
                    </div>
                </div>
                <div class="form-group col-md-6">
                    <div class="form-outline">
                        <label class="control-label">Fecha de recogida: </label>
                        {{ Form::date('fechaTermino', Request::old('fechaTermino'), ['id' => 'fechaTermino', 'name' => 'fechaTermino', 'class' => 'form-control']) }}
                    </div>                  
                </div>
                <script type="text/javascript">
                    fechaInicio.min = new Date().toISOString().split("T")[0];
                    fechaTermino.min = new Date().toISOString().split("T")[0];
                </script>
            </div>
        </div>

        <br><br>        
        {{ Form::submit('Rentar', ['class' => 'btn btn-success']) }}
        {{ Form::close() }}
    </div>

@endsection
