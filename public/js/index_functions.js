function filterTable() {
    search = $('#searchBar').val();
    search = search.toLowerCase().trim();
    // console.log(search);

    $("table tr").each(function (index) {
        if (!index) return;
        $(this).find("td").each(function () {
            var id = $(this).text().toLowerCase().trim();
            var not_found = (id.indexOf(search) == -1);
            $(this).closest('tr').toggle(!not_found);
            return not_found;
        });
    });
}

$(document).ready(function (e) {

    $('select').on('change', function (e) {

        var id = $(this).attr("id");
        var cantidad = $("#" + id + "Cantidad").val();
        var precio = $(this).find("option:selected").text();
        var precioUnitario = precio.substr(precio.indexOf("$") + 1);
        var total;


        if (cantidad) {
            total = cantidad * precioUnitario;
            totalFinal += total;
            total = "$" + total;
        } else {
            total = "POR FAVOR ESPECIFIQUE CANTIDAD";
        }

        $("#" + id + "Total").val(total);
        calcularTotal();
    });

    $('input[type=number]').bind("input", function (e) {

        var id = $(this).attr("id");
        id = id.substr(0, id.indexOf("C"));
        var cantidad = $(this).val();
        var precio = $("#" + id).find("option:selected").text();
        var precioUnitario = precio.substr(precio.indexOf("$") + 1);
        var total;
        if (precioUnitario != "SELECCIONAR") {
            if (cantidad) {
                total = cantidad * precioUnitario;
                totalFinal += total;
                total = "$" + total;
            } else {
                total = "POR FAVOR ESPECIFIQUE CANTIDAD";
            }

        } else {
            total = "POR FAVOR ESPECIFIQUE EL PRODUCTO";
        }

        $("#" + id + "Total").val(total);
        calcularTotal();
    });
});

function calcularTotal() {
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

    $("#totalFinal").val("$" + totalFinal);
}