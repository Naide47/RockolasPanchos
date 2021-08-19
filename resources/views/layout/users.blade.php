<!DOCTYPE html>
<html lang="es-MX">

<head>
    <meta charset="utf-8">
    <title>Rockols Panchos | @yield('title')</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="eCommerce HTML Template Free Download" name="keywords">
    <meta content="eCommerce HTML Template Free Download" name="description">

    {{-- Favicon --}}
    <link rel="icon" type="image/png" href="{{ asset('img/logos/rockola (1).png') }}" />

    {{-- Google Fonts --}}
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400|Source+Code+Pro:700,900&display=swap"
        rel="stylesheet">

    {{-- CSS Libraries --}}
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="{{ asset('lib/slick/slick.css') }}" rel="stylesheet">
    <link href="{{ asset('lib/slick/slick-theme.css') }}" rel="stylesheet">

    {{-- JavaScript Libraries --}}
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('lib/easing/easing.min.js') }}"></script>
    <script src="{{ asset('lib/slick/slick.min.js') }}"></script>

    {{-- Template Javascript --}}
    <script src="{{ asset('js/main.js') }}"></script>

    {{-- Template Stylesheet --}}
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('css/img.css') }}" rel="stylesheet">
    @yield('head')
</head>

{{-- Nav Bar Start --}}
<div class="nav">
    <div class="container-fluid">
        <nav class="navbar navbar-expand-md bg-dark navbar-dark">

            <button type="button" title="Menu" class="navbar-toggler" data-toggle="collapse"
                data-target="#navbarCollapse">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
                <div class="navbar-nav mr-auto">
                    @if (Auth::user()->rol_id == 1)
                        <a id="navUsuarios" href="{{route('usuarios.index')}}" class="nav-item nav-link">Usuarios</a>
                    @endif

                    <a id="navProductos" href="{{route('productos.index')}}" class="nav-item nav-link">Productos</a>
                    <a id="navRentas" href="product-list.html" class="nav-item nav-link">Rentas</a>
                    <a id="navVentas" href="{{ route('mostrar') }}" class="nav-item nav-link">Ventas</a>
                </div>
            </div>

            <div class="navbar-nav">
                <div class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">{{Auth::user()->name}}</a>
                    {{-- <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">Nombre de usuario.docx</a> --}}
                    <div class="dropdown-menu text-center">
                        {{-- <a href="#" class="dropdown-item">Inicio de sesión</a>
                        <a href="#" class="dropdown-item">Registrarse</a> --}}
                        {!! Form::open(['route' => 'logout']) !!}
                        {!! Form::submit('Cerrar sesión', ['class' => 'btn btn-danger']) !!}
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </nav>
    </div>
</div>
{{-- Nav Bar End --}}



{{-- Lista de produtos inicio --}}
@yield('contents')



{{-- Footer Bottom Start --}}
<div class="footer-bottom">
    <div class="container">
        <div class="row">
            <div class="col-md-6 copyright">
                <p>Copyright &copy; <a href="https://htmlcodex.com">HTML Codex</a>. All Rights Reserved</p>
            </div>

            <div class="col-md-6 template-by">
                <p>Template By <a href="https://htmlcodex.com">HTML Codex</a></p>
            </div>
        </div>
    </div>
</div>
{{-- Footer Bottom End --}}

{{-- Back to Top --}}
{{-- <a href="#" class="back-to-top"><i class="fa fa-chevron-up"></i></a> --}}

</body>

</html>
