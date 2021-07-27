@extends('layout.layout')

@section('Breadcrumb')
    <div class="breadcrumb-wrap">
        <div class="container-fluid">
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Inicio</a></li>
                <li class="breadcrumb-item"><a href="#">Productos</a></li>
                <li class="breadcrumb-item active">Venta</li>
            </ul>
        </div>
    </div>
@endsection

@section('contents')

    <!-- Product List Start -->
    <div class="product-view">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-8">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="product-view-top">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="product-search">
                                            <input type="email" placeholder="Busqueda">
                                            <button><i class="fa fa-search"></i></button>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="product-short">
                                            <div class="dropdown">
                                                <div class="dropdown-toggle" data-toggle="dropdown">
                                                    Productos por
                                                </div>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    <a href="#" class="dropdown-item">Nuevos</a>
                                                    <a href="#" class="dropdown-item">Popular</a>
                                                    <a href="#" class="dropdown-item">Más vendido</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="product-price-range">
                                            <div class="dropdown">
                                                <div class="dropdown-toggle" data-toggle="dropdown">
                                                    Producto por rango de precio
                                                </div>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    <a href="#" class="dropdown-item">$0 a $50</a>
                                                    <a href="#" class="dropdown-item">$51 a $100</a>
                                                    <a href="#" class="dropdown-item">$101 a $150</a>
                                                    <a href="#" class="dropdown-item">$151 a $200</a>
                                                    <a href="#" class="dropdown-item">$201 a $250</a>
                                                    <a href="#" class="dropdown-item">$251 a $300</a>
                                                    <a href="#" class="dropdown-item">$301 a $350</a>
                                                    <a href="#" class="dropdown-item">$351 a $400</a>
                                                    <a href="#" class="dropdown-item">$401 a $450</a>
                                                    <a href="#" class="dropdown-item">$451 a $500</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        @forelse($table as $row)
                            <div class="col-md-4">
                                <div class="product-item">
                                    <div class="product-title">
                                        <a href="#">{{ $row->nombre }}</a>
                                        <div class="ratting">
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                        </div>
                                    </div>
                                    <div class="product-image">
                                        <a class="imagen-venta" href="product-detail.html">
                                            @if ($row->imgNombreFisico)
                                                <img src="{{ asset('storage/' . $row->imgNombreFisico) }}"
                                                    alt="Imagen del producto {{ $row->nombre }}" class="img-thumbnail">
                                            @else
                                                <img src="{{ asset('storage/no_imagen.jpg') }}"
                                                    alt="Imagen del producto {{ $row->nombre }}" class="img-thumbnail">
                                            @endif
                                        </a>
                                        <div class="product-action">
                                            <a href="#"><i class="fa fa-cart-plus"></i></a>
                                            <a href="#"><i class="fa fa-heart"></i></a>
                                            <a href="#"><i class="fa fa-search"></i></a>
                                        </div>
                                    </div>
                                    <div class="product-price">
                                        <h3><span>$</span>{{ $row->precioCompra }}</h3>
                                        <a class="btn" href="{{ route('ventas.create', ['id' => $row->id]) }}"><i
                                                class="fa fa-shopping-cart"></i>Comprar</a>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <h3>No hay productos</h3>
                        @endforelse

                        <!-- Pagination Start -->
                        <div class="col-md-12">
                            <nav aria-label="Page navigation example">
                                <ul class="pagination justify-content-center">
                                    <li class="page-item disabled">
                                        <a class="page-link" href="#" tabindex="-1">Previous</a>
                                    </li>
                                    <li class="page-item active"><a class="page-link" href="#">1</a></li>
                                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                                    <li class="page-item">
                                        <a class="page-link" href="#">Next</a>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                        <!-- Pagination Start -->
                    </div>
                </div>

                <!-- Side Bar Start -->
                <div class="col-lg-4 sidebar">
                    <div class="sidebar-widget category">
                        <h2 class="title">Categorias</h2>
                        <nav class="navbar bg-light">
                            <ul class="navbar-nav">
                                <li class="nav-item">
                                    <a class="nav-link" href="#"><i class="fa fa-female"></i>Bodas</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#"><i class="fa fa-child"></i>Quince años</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#"><i class="fa fa-tshirt"></i>Fiestas infantiles</a>
                                </li>
                            </ul>
                        </nav>
                    </div>

                    <div class="sidebar-widget widget-slider">
                        <div class="sidebar-slider normal-slider">
                            <div class="product-item">
                                <div class="product-title">
                                    <a href="#">Carpa sencilla con ventana</a>
                                    <div class="ratting">
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                    </div>
                                </div>
                                <div class="product-image">
                                    <a href="product-detail.html">
                                        <img class="imagen-venta" src="{{ asset('img/carpa-venta.jpg') }}"
                                            alt="Product Image">
                                    </a>
                                    <div class="product-action">
                                        <a href="#"><i class="fa fa-cart-plus"></i></a>
                                        <a href="#"><i class="fa fa-heart"></i></a>
                                        <a href="#"><i class="fa fa-search"></i></a>
                                    </div>
                                </div>
                                <div class="product-price">
                                    <h3><span>$</span>99</h3>
                                    <a class="btn" href=""><i class="fa fa-shopping-cart"></i>Comprar</a>
                                </div>
                            </div>

                            <div class="product-item">
                                <div class="product-title">
                                    <a href="#">Carpa grande con ventanas</a>
                                    <div class="ratting">
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                    </div>
                                </div>
                                <div class="product-image">
                                    <a href="product-detail.html">
                                        <img class="imagen-venta" src="{{ asset('img/carpa-grande.jpg') }}"
                                            alt="Product Image">
                                    </a>
                                    <div class="product-action">
                                        <a href="#"><i class="fa fa-cart-plus"></i></a>
                                        <a href="#"><i class="fa fa-heart"></i></a>
                                        <a href="#"><i class="fa fa-search"></i></a>
                                    </div>
                                </div>
                                <div class="product-price">
                                    <h3><span>$</span>99</h3>
                                    <a class="btn" href=""><i class="fa fa-shopping-cart"></i>Comprar</a>
                                </div>
                            </div>

                            <div class="product-item">
                                <div class="product-title">
                                    <a href="#">Carpa grande con ventanas (segundo modelo)</a>
                                    <div class="ratting">
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                    </div>
                                </div>
                                <div class="product-image">
                                    <a href="product-detail.html">
                                        <img class="imagen-venta" src="{{ asset('img/carpa-grande2.jpg') }}"
                                            alt="Product Image">
                                    </a>
                                    <div class="product-action">
                                        <a href="#"><i class="fa fa-cart-plus"></i></a>
                                        <a href="#"><i class="fa fa-heart"></i></a>
                                        <a href="#"><i class="fa fa-search"></i></a>
                                    </div>
                                </div>
                                <div class="product-price">
                                    <h3><span>$</span>99</h3>
                                    <a class="btn" href=""><i class="fa fa-shopping-cart"></i>Comprar</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Product List End -->

    <div class="brand">
        <div class="container-fluid">
            <div class="brand-slider">
                <div class="brand-item">
                    <img class="brand-image-cuadrado" src="{{ asset('img/logos/apple-logo.png') }}" alt="">
                </div>
                <div class="brand-item">
                    <img class="brand-image-rectangular" src="{{ asset('img/logos/carpa-logo.png') }}" alt="">
                </div>
                <div class="brand-item">
                    <img class="brand-image-cuadrado" src="{{ asset('img/logos/inflable-logo.jpg') }}" alt="">
                </div>
                <div class="brand-item">
                    <img class="brand-image-rectangular" src="{{ asset('img/logos/mesas-logo.png') }}" alt="">
                </div>
                <div class="brand-item">
                    <img class="brand-image-cuadrado" src="{{ asset('img/logos/rockola-logo.png') }}" alt="">
                </div>
                <div class="brand-item">
                    <img class="brand-image-rectangular" src="{{ asset('img/logos/sillas-logo.png') }}" alt="">
                </div>
            </div>
        </div>
    </div>
@endsection
