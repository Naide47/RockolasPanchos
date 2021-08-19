$(document).ready(function () {
    $("input[name='fechaInicio']").change(function () {

        var fInicio = document.getElementById("fechaInicio");

        console.log("Fecha ", fInicio.value)

        let date = new Date(fInicio.value);

        var fechaNum = date.getDate() + 2;
        var mes_name = date.getMonth() + 1;

        // alert(fechaNum + " de " + mes_name + " de " + date.getFullYear());

        // document.getElementById('fechaTermino').value = fechaNum + "/" + "0" + mes_name + "/" + date.getFullYear();
        if (mes_name == 12){
            document.getElementById('fechaTermino').value = date.getFullYear() + "-" + mes_name + "-" + fechaNum;
        }else{
            document.getElementById('fechaTermino').value = date.getFullYear() + "-" + "0" + mes_name + "-" + fechaNum;
        }
        
    });
});
