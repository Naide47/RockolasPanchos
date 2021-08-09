$(document).ready(function () {

    calcularTotalFinal();

    var precios = JSON.parse(localStorage.getItem('precios'));

    $('select').on('change', function (e) {
        var value = $(this).children(":selected").attr("value");
        var precio = 0;
        precios.forEach(function (element) {
            if (element.id == value) {
                precio = element.precioUnitario;
            }
        });
        $("#" + $(this).attr("id") + "Precio").val(precio);

        calcularTotal($(this).attr("id"));
    });

    $('input[type=number]').bind("input", function (e) {
        var id = $(this).attr("id");
        id = id.substr(0, id.indexOf("C"));

        calcularTotal(id);

    });


});

function calcularTotal(id) {
    var precio = parseFloat($('#' + id + "Precio").val());
    var cantidad = parseFloat($('#' + id + "Cantidad").val());
    var total = 0;

    precio = (isNaN(precio) ? 0 : precio)
    cantidad = (isNaN(cantidad) ? 0 : cantidad)
    
    if (precio != 0 || cantidad != 0) {
        total = precio * cantidad;
    }

    $("#" + id + "Total").val(total);
    calcularTotalFinal();
}

function calcularTotalFinal() {
    var totales = $(".total");
    var totalFinal = 0;

    for (i = 0; i < totales.length; i++) {
        var elemento = totales[i];
        var totalLocal = $("#" + elemento.id).val();
        totalLocal = totalLocal.substr(totalLocal.indexOf("$") + 1);
        totalLocal = parseFloat(totalLocal);
        if (isNaN(totalLocal))
            totalLocal = 0;
        totalFinal += totalLocal;
    }
    totalFinal = parseFloat(totalFinal);

    $("#totalFinal").val(totalFinal);
}