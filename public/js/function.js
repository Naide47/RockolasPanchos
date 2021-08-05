function calcularTotal() {
    var cantidad = document.getElementById("rcantidad").value;
    //console.log(cantidad);
    var precio = document.getElementById("rprecio").value;
    //console.log(precio);
    var totalF = cantidad * precio;
    //console.log(totalF);
    var anticipo = totalF * 0.10;
    document.getElementById("ranticipo").value = anticipo;
    document.getElementById("rtotal").value = totalF - anticipo;

    document.getElementById("ranticipoView").value = anticipo;
    document.getElementById("rtotalView").value = totalF - anticipo;
}



$(document).ready(function () {

    $("input[name='pago']").change(function () {
        $("#rdatos").slideToggle();
    });

    const rPago1 = document.getElementById("rentaPago1");
    rPago1.addEventListener('change', formaPago1);

    function formaPago1() {
        document.getElementById("rnumTarjeta").type = "hidden";
        document.getElementById("rtipoTarjeta").style.visibility = "hidden";
        document.getElementById("rtituloTarjeta").style.visibility = "hidden";
        document.getElementById("rlabelnumTarjeta").style.visibility = "hidden";
        document.getElementById("rlabeltipoTarjeta").style.visibility = "hidden";
        document.getElementById("rnumTarjeta").value = "";
        document.getElementById("rtipoTarjeta").value = "0";
    }

    const rPago2 = document.getElementById("rentaPago2");
    rPago2.addEventListener('change', formaPago2);

    function formaPago2() {
        document.getElementById("rnumTarjeta").type = "text";
        document.getElementById("rtipoTarjeta").style.visibility = "visible";
        document.getElementById("rtituloTarjeta").style.visibility = "visible";
        document.getElementById("rlabelnumTarjeta").style.visibility = "visible";
        document.getElementById("rlabeltipoTarjeta").style.visibility = "visible";
        document.getElementById("rnumTarjeta").value = "";
        document.getElementById("rtipoTarjeta").value = "1";
    }



    const fInicio = document.getElementById("fechaInicio");
    console.log("Fecha inicio ", fInicio);

});
