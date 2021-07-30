@extends('layout.layout')

@section('contents')

    <a href="{{route('renta.create')}}">Registro Nuevo</a>

    @if(Session::has('message'))
        {{Session::get('message')}}<br><br>
    @endif

    <table class="table table-hover" border="1">
        <thead>
            <tr class="table-success">
                <th>ID</th>
                <th>Total</th>
                <th>Fecha Inicio</th>
                <th>Fecha Registro</th>
                <th>Fecha Termino</th>
            </tr>
        </thead>   
    @forelse($table as $row)
        <tbody>
            <tr class="table-warning">
                <td>{{$row->id}}</td>
                <td>{{$row->total}}</td>
                <td>{{$row->fechaInicio}}</td>
                <td>{{$row->fechaRegistro}}</td>
                <td>{{$row->fechaTermino}}</td>
                <td><td><a href="{{route('renta.show', $row->id)}}"> Ver detalle </a></td>
            </tr>
    @empty
            <tr>
                <td colspan="2"> No hay rentas registradas </td>
            </tr>
    @endforelse
        </tbody>
    </table>
@endsection
