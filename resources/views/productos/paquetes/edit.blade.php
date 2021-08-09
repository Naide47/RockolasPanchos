@extends('layout.users')
@section('title')
    Editar paquete
@endsection

@section('head')
    <link rel="stylesheet" href="{{ asset('css/buttons.css') }}">
    <script src="{{ asset('js/image_preview.js') }}"></script>
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
                            {!! Form::file('imagen', ['accept' => 'image/x-png, image/gif, image/jpeg', 'class' => 'form-control-file', 'required' => true]) !!}
                            @error('imagen')
                                <div class="alert alert-danger" role="alert">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                </div>

                

                
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection
