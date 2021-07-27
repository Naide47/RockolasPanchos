function calcular() 
{
    var total;
    var precio = Number(document.getElementById('precio').value);
    var cantidad = Number(document.getElementById('cantidad').value);

    total = precio * cantidad;

    var mensaje = confirm("¿Te gusta Desarrollo Geek?");
    //Detectamos si el usuario acepto el mensaje
    if (mensaje) {
        alert("¡Gracias por aceptar!" + total);
    }
    //Detectamos si el usuario denegó el mensaje
    else {
        alert("¡Haz denegado el mensaje!");
    }

}
