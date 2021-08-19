@extends('layout.layout')

@section('contents')
<!-- Main Slider Start -->
<div class="header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3">
                <nav class="navbar bg-light">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('home') }}"><i class="fa fa-home"></i>Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('ventas.index') }}"><i class="fa fa-shopping-bag"></i>Venta</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#"><i class="fa fa-shopping-bag"></i>Renta</a>
                        </li>
                    </ul>
                </nav>
            </div>
            <div class="col-md-6">
                <div class="header-slider normal-slider">
                    <div class="header-slider-item imagen-venta">
                        <img src="{{ asset('storage/15_inflable_escaladora_producto.jpg') }}" alt="Slider Image" />
                        <div class="header-slider-caption">
                            <p>Los mejores inflables</p>
                        </div>
                    </div>
                    <div class="header-slider-item imagen-venta">
                        <img src="{{ asset('storage/14_inflable_castillo_producto.jpg') }}" alt="Slider Image" />
                        <div class="header-slider-caption">
                            <p>Los mejores inflables tematicos</p>
                        </div>
                    </div>
                    <div class="header-slider-item imagen-venta">
                        <img src="{{ asset('storage/13_inflable_sirena_producto.jpg') }}" alt="Slider Image" />
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="header-img">
                    <div class="img-item">
                        <img src="{{ asset('storage/12_carpa_negra_3x3_producto.jpg') }}" />
                        
                    </div>
                    <div class="img-item">
                        <img src="{{ asset('storage/11_carpa_blanca_paredes_producto.jpg') }}" />
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Main Slider End -->

        <!-- Brand Start -->
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
        <!-- Brand End -->      
        
        <!-- Feature Start-->
        <div class="feature">
            <div class="container-fluid">
                <div class="row align-items-center">
                    <div class="col-lg-3 col-md-6 feature-col">
                        <div class="feature-content">
                            <i class="fab fa-cc-mastercard"></i>
                            <h2>Pagos seguros</h2>
                            <p>
                                Contamos con la seguirdad más actual
                            </p>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 feature-col">
                        <div class="feature-content">
                            <i class="fa fa-truck"></i>
                            <h2>Recorremos todo el estado de Guanajuato</h2>
                            <p>
                               Disponibles en cualquier parte donde se necesite
                            </p>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 feature-col">
                        <div class="feature-content">
                            <i class="fa fa-sync-alt"></i>
                            <h2>Puede devolver sus productos</h2>
                            <p>
                                Si algo falla es libre de reporta a oficinas
                            </p>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 feature-col">
                        <div class="feature-content">
                            <i class="fa fa-comments"></i>
                            <h2>24/7 Soporte</h2>
                            <p>
                                Nuestros número siempre estan disponibles
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Feature End-->      
        
        <!-- Category Start-->
        <div class="category">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-3">
                        <div class="category-item ch-400">
                            <img src="{{ asset('storage/10_carpa_blanca_3x3_producto.jpg') }}" />
                            
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="category-item ch-250">
                            <img src="{{ asset('storage/5_mesa_plastico_larga_producto.jpg') }}" />
                            
                        </div>
                        <div class="category-item ch-150">
                            <img src="{{ asset('storage/13_inflable_sirena_producto.jpg') }}" />
                            
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="category-item ch-150">
                            <img src="{{ asset('storage/14_inflable_castillo_producto.jpg') }}" />
                        
                        </div>
                        <div class="category-item ch-250">
                            <img src="{{ asset('storage/6_mesa_madera_producto.jpg') }}" />
                            
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="category-item ch-400">
                            <img src="{{ asset('storage/9_rockola_azul_producto.jpg') }}" />
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Category End-->       
        
        <!-- Call to Action Start -->
        <div class="call-to-action">
            <div class="container-fluid">
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <h1>¿Tienes dudas? Llamanos</h1>
                    </div>
                    <div class="col-md-6">
                        <a href="#">+012-345-6789</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- Call to Action End -->       
@endsection