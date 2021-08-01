function calcularTotalSinAnticipo() {
    var cantidad = document.getElementById("cantidad").value;
    //console.log(cantidad);
    var precio = document.getElementById("precio").value;
    //console.log(precio);
    var totalF = cantidad * precio;
    //console.log(totalF);
    var anticipo = totalF * 0.10;
    document.getElementById("anticipo").value = anticipo;
    document.getElementById("total").value = totalF - anticipo;
    
    document.getElementById("anticipoView").value = anticipo;
    document.getElementById("totalView").value = totalF - anticipo;
}

const pago1 = document.getElementById("pago1");
pago1.addEventListener('change', formaPago1);
function formaPago1(){
    document.getElementById("numTarjeta").type = "hidden";
    document.getElementById("tipoTarjeta").style.visibility = "hidden";
    document.getElementById("tituloTarjeta").style.visibility = "hidden";
    document.getElementById("labelnumTarjeta").style.visibility = "hidden";
    document.getElementById("labeltipoTarjeta").style.visibility = "hidden";
    document.getElementById("numTarjeta").value = "";
    document.getElementById("tipoTarjeta").value = "0";
}

const pago2 = document.getElementById("pago2");
pago2.addEventListener('change', formaPago2);
function formaPago2(){
    document.getElementById("numTarjeta").type = "text";
    document.getElementById("tipoTarjeta").style.visibility = "visible";
    document.getElementById("tituloTarjeta").style.visibility = "visible";
    document.getElementById("labelnumTarjeta").style.visibility = "visible";
    document.getElementById("labeltipoTarjeta").style.visibility = "visible";
    document.getElementById("numTarjeta").value = "";
    document.getElementById("tipoTarjeta").value = "1";
}

