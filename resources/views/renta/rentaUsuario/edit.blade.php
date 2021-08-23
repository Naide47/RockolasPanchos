@extends('layout.users')

@section('head')
    <link rel="stylesheet" href="{{ asset('css/buttons.css') }}">
    <script src="{{ asset('js/image_preview.js') }}"></script>
@endsection

@section('contents')
    <div class="container-fluid bg-white mb-5">
        <div class="row">
            <div class="col">
                <h1>Editar renta</h1>
            </div>
        </div>
        <div class="row">
            <div class="col">
                {{ Form::model($renta, ['route' => ['rentaUsuario.update', $renta->id], 'method' => 'PUT']) }}
                <h3>Información Personal</h3>
                <div class="row">
                    <div class="form-group col-md-4">
                        {{ Form::label('nombre', 'Nombre Cliente') }}
                        {{ Form::text('nombre', $mRenta->nombre, ['class' => 'form-control', 'disabled']) }}
                        {{ Form::hidden('cliente', $renta->cliente_id, ['class' => 'form-control', 'disabled']) }}
                    </div>

                    <div class="form-group col-md-4">
                        {{ Form::label('celular', 'Número celular') }}
                        {{ Form::text('celular', $mRenta->celular, ['class' => 'form-control', 'disabled']) }}
                    </div>

                    <div class="form-group col-md-4">
                        {{ Form::label('telefono', 'Número Teléfono') }}
                        {{ Form::text('telefono', $mRenta->telefono, ['class' => 'form-control', 'disabled']) }}
                    </div>
                </div>

                <h3>Dirección de la renta</h3>
                <div class="form-row">

                    <div class="form-group col-md-4">
                        {{ Form::label('calle', 'Calle y Número') }}
                        {{ Form::text('calle', $mRenta->calle, ['class' => 'form-control', 'disabled']) }}
                    </div>
                    <div class="form-group col-md-4">
                        {{ Form::label('colonia', 'Colonia') }}
                        {{ Form::text('colonia', $mRenta->colonia, ['class' => 'form-control', 'disabled']) }}
                    </div>
                    <div class="form-group col-md-2">
                        {{ Form::label('codigoPostal', 'Codigo Postal') }}
                        {{ Form::text('codigoPostal', $mRenta->codigopostal, ['class' => 'form-control', 'disabled']) }}
                    </div>
                </div>

                <h3>Detalle de la renta</h3>

                <div style="padding: 30px; margin-bottom: 30px; background: #ffffff;">
                    <div class="col-md-12">
                        @if ($mRenta->imgNombreFisico)
                            <div class="align-middle">
                                <img src="{{ asset('storage/' . $mRenta->imgNombreFisico) }}"
                                    alt="Imagen del producto {{ $mRenta->nombre }}" width="300px" class="img-thumbnail">
                            </div>
                        @else
                            <div class="align-middle">
                                <img src="{{ asset('storage/no_imagen.jpg') }}"
                                    alt="Imagen del producto {{ $mRenta->nombre }}" width="300px" class="img-thumbnail">
                            </div>
                        @endif
                    </div>
                </div>

                <h3>Productos</h3>

                <div class="col-md-12">
                    <div class="row">
                        @foreach ($mPaquetes as $mPaquete)
                            <div class="col-md-8">
                                {{ Form::text('producto' . $loop->index, $paquete->nombre, ['class' => 'form-control', 'disabled']) }}
                            </div>
                            <div class="col-md-2">
                                {{ Form::text('cantidad' . $loop->index, $mPaquete->cantidad, ['class' => 'form-control', 'disabled']) }}
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="row">
                        @foreach ($paquete as $paquetes)
                            @if ($paquetes->id == $mRenta->id)
                                <div class="form-group col-md-4">
                                    {{ Form::label('nombre_producto', 'Nombre Paquete') }}
                                    {{ Form::text('rnombre_producto', $paquetes->nombre, ['class' => 'form-control', 'disabled']) }}
                                </div>
                            @endif
                        @endforeach
                        <div class="form-group col-md-4">
                            {{ Form::label('precio', 'Precio') }}
                            {{ Form::hidden('rprecio', $mRenta->total, ['class' => 'form-control', 'id' => 'rprecio']) }}
                            <input type="text" value="{{ $mRenta->total }}" class="form-control" disabled>
                        </div>
                        <div class="form-group col-md-4">
                            {{ Form::label('ranticipoView', 'Anticipo') }}
                            {{ Form::hidden('anticipo', $anticipo = $mRenta->total * 0.1, ['class' => 'form-control', 'placeholder' => 'Anticipo', 'id' => 'ranticipoView']) }}
                            <input type="number" id="ranticipoView" value="{{ $anticipo = $mRenta->total * 0.1 }}"
                                class="form-control" placeholder="Anticipo" disabled>
                        </div>
                        <div class="form-group col-md-4">
                            {{ Form::label('rtotalView', 'Total') }}
                            {{ Form::text('total', $renta->total, ['class' => 'form-control', 'require' => true, 'disabled']) }}
                        </div>
                    </div>
                </div>

                <h3>Fecha de renta</h3>
                <div class="col-md-12">
                    <div class="row">
                        <div class="form-group col-md-6">
                            <div class="form-outline">
                                <label class="control-label">Fecha de entrega: </label>
                                {{ Form::date('fechaInicio', $renta->fechaInicio, ['class' => 'form-control', 'disabled']) }}
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <div class="form-outline">
                                <label class="control-label">Fecha de recogida: </label>
                                {{ Form::date('fechaTermino', $mRenta->fechaTermino, ['class' => 'form-control', 'disabled']) }}
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <div class="form-outline">
                                {!! Form::label('estatus', 'Estatus') !!}
                                {{-- @if ($renta->estatus == 1)
                                    {!! Form::select('estatus', [$renta->estatus => 'Registrado', ($renta->estatus = 2) => 'En proceso', ($renta->estatus = 3) => 'Finalizado']) !!}
                                @endif --}}
                                <select name="estatus" id="estatus" class="form-control">
                                    <option value="{{ $mRenta->id }}" selected>Registrado</option>
                                    <option value="{{ $mRenta->id = 2 }}">En Proceso</option>
                                    <option value="{{ $mRenta->id = 3 }}">Finalizado</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row mb-5">
                    <div class="col">
                        {{ Form::submit('Modificar renta', ['class' => 'btn btn-success']) }}
                        <a class="btn btn-secondary" href="{{ route('rentaUsuario.index') }}" role="button">Cancelar</a>
                    </div>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>

@endsection
