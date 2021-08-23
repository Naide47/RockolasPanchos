<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Rentas</title>
</head>

<body>
  <h1>Rentas</h1>

  <section>
    <div class="container" data-aos="fade-up">

      <div class="section-title">
        <h2>@yield('titulo')</h2>
      </div>

      <div class="row content">
        <div class="col-lg-6">
          <p>
            @yield('content')
          </p>

        </div>
      </div>

    </div>
  </section>


  <script type="text/javascript">
    var productos;

    function calcular() {
      var total;
      var precio = Number(document.getElementById('precio').value);
      alert("Precio " + precio);
      var cantidad = Number(document.getElementById('cantidad').value);

      total = precio * cantidad;

      var mensaje = confirm("Calculando tus productos");
      //Detectamos si el usuario acepto el mensaje
      if (mensaje) {
        alert("El total es: " + total);
      }
      //Detectamos si el usuario denegó el mensaje
      else {
        alert("¡Adios!");
      }

    }
  </script>
</body>

</html>