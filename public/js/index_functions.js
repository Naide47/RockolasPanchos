// $(document).click("#btnDelete", function () {

//     var usuario_id = $(this).data('destroy');
//     var usuario_id2 = $(this).attr('data-destroy');
//     var buton = $(this);

//     console.log(usuario_id);
//     console.log(usuario_id2);
//     console.log(buton);
// })

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

function setActiveLink(active) {
    console.log(active)
    // var element = document.getElementById('nav' + active);
    // element.classList.add('active');
}