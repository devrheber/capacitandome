var tabla;
$(document).ready(function () {
    listar();
})

function listar() {
    tabla = $("#tablaComents").DataTable({
        ajax: {
            method: 'GET',
            url: 'admin/listcoment'
        },
        responsive: true,
        aProcessing: true,
        /*language: {
            url: '/recursos/admin/dataTable/idioma.json'
        },*/
        columns: [
            {data: "autoi"},
            {data: "fecha"},
            {data: "nombre_apellido"},
            {data: "correo"},
            {data: "telefono"},
            {data: "mensaje"},
            {
                data: "estado", render:function (estado) {
                    if (estado == 1) {
                        return '<span class="label font-weight-bold label-lg  label-light-warning label-inline">NO LEIDO</span>';
                    } else if (estado == 2) {
                        return '<span class="label font-weight-bold label-lg  label-light-success label-inline">LEIDO</span>';
                    }
                }
            },
            {
                data: "idmensajes",
                render: function (id, type, row) {
                    if (row['estado'] == 1) {
                        return "<center><a onclick='mensajeLeido("+id+")' class='btn btn-light-info font-weight-bold btn-sm'><i class='fa fa-plus-circle'></i></a>";
                    } else {
                        return '';
                    }
                }
            }
        ]
    });
}

function mensajeLeido(idmensaje) {
    Swal.fire({
        title: '¿Seguro que marcar como leído este registro?',
        text: "",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#f64e60',
        // cancelButtonColor: '#f64e60',
        confirmButtonText: 'Si, marcar!'
    }).then((result) => {
        if (result.isConfirmed) {
            $.get(`admin/msjleido/${idmensaje}`, function (data, status) {
                data = JSON.parse(data);
                tabla.ajax.reload();
                if (data.status == true) {
                    Swal.fire('Mensaje leido.', '', 'success');
                }else{
                    alert('Ocurrio un error, se refescara la página');
                    location.reload();
                }
            });
        }
    });
}