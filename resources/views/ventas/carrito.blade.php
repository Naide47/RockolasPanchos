@extends('layout.layout')

@section('head')
    <link rel="stylesheet" href="{{ asset('css/buttons.css') }}">
@endsection

@section('Breadcrumb')
    <div class="breadcrumb-wrap">
        <div class="container-fluid">
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Inicio</a></li>
                <li class="breadcrumb-item"><a href="#">Venta</a></li>
                <li class="breadcrumb-item active">Carrito</li>
            </ul>
        </div>
    </div>
@endsection

@section('contents')
<!-- Cart Start -->
<div class="cart-page">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-8">
                <div class="cart-page-inner">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead class="thead-dark">
                                <tr>
                                    <th>Product</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Total</th>
                                    <th>Remove</th>
                                </tr>
                            </thead>
                            <tbody class="align-middle">
                                @forelse($carrito as $row)
                                        <tr>
                                            <td>
                                                <div class="img">
                                                    <a href="#">
                                                    @if ($row['imagen'])
                                                        <img src="{{ asset('storage/' . $row['imagen']) }}"
                                                                    alt="Imagen del producto {{ $row['nombre'] }}" class="img-thumbnail">
                                                    @else
                                                        <img src="{{ asset('storage/no_imagen.jpg') }}"
                                                                    alt="Imagen del producto {{ $row['nombre'] }}" class="img-thumbnail">
                                                    @endif
                                                    </a>
                                                    <p>{{$row['nombre']}}</p>
                                                </div>
                                            </td>
                                            <td>
                                                <input id="precio{{$loop->iteration}}" type="text" value="{{$row['precio']}}" readonly>    
                                            </td>
                                            <td>
                                                <div class="qty">
                                                    <button class="btn-minus"><i class="fa fa-minus"></i></button>
                                                    <input id="cantidadCarrito_{{$loop->iteration}}" type="text" value="1" readonly>
                                                    <button class="btn-plus"><i class="fa fa-plus"></i></button>
                                                </div>
                                            </td>
                                            <td>
                                                <input id="total{{$loop->iteration}}" class="totalCarrito" type="text" value="{{$row['precio']}}" readonly> 
                                            </td>
                                            <td>
                                                {{Form::open(['url'=>'ventas/eliminaritem'])}}
                                                    {{Form::hidden('idP',($loop->iteration))}}
                                                    <button type="sumbit"><i class="fa fa-trash"></i></button>
                                                {{Form::close()}}
                                            </td>
                                            <!-- <td><button><i class="fa fa-trash"></i></button></td> -->
                                        </tr>
                                @empty
                                <tbody>
                                    <h3>No hay productos</h3>
                                </tbody>
                                    
                                @endforelse
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
                                    <p>Sub Total<span>$99</span></p>
                                    <p>Shipping Cost<span>$1</span></p>
                                    <h2>Grand Total<span id="totalFinal"></span></h2>
                                </div>
                                <div class="cart-btn">
                                    <button>Update Cart</button>
                                    <button>Checkout</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Cart End -->
@endsection