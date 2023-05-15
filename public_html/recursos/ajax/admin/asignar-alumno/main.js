var tabla;
$(document).ready(function (params) {
    listar();
    $("#form-asig-alumno").on("submit",function (e) {
        e.preventDefault();
        var idcurso   = $("#idcurso option:selected").val();
        var idpersona = $("#idpersona option:selected").val();
        if (idcurso != "" && idpersona != "") {
            console.log(idcurso+" "+idpersona);
            guardarAsignarAlumno(e);
        } else {
            toastr.warning('SELECCIONE : CURSO Y PERSONA')
        }
    })
})

function guardarAsignarAlumno(e) {
    e.preventDefault();
    var formData = new FormData($("#form-asig-alumno")[0]);
    $.ajax({
        url: "/admin/guardarasigalumno",
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        success: function(datos) {
            console.log(datos);
            datos = JSON.parse(datos)
            $("#idventa").val('');
            $('#idcurso').selectpicker('val', '');
            $('#idpersona').selectpicker('val', '');
            listar();
            if (datos.status == true) {
                toastr.success(datos.message);
            } else {
                Swal.fire(datos.message)
            }
        }
    });
}

function listar() {
    tabla = $("#tablaAsigAlumno").DataTable({
        ajax: {
            method: 'GET',
            url: "/admin/listasigalumno"
        },
        responsive: true,
        destroy: true,
        /*language: {
            url: '/recursos/admin/dataTable/idioma.json'
        },*/
        columns: [
            {data: "autoi"},
            {data: "fecha_venta"},
            {data: "alumno"},
            {data: "curso"},
            {data: "precio"},
            {
                data: "idventa",
                render: function (id) {
                    return "<center><a onclick='mostrar("+id+")' class='btn btn-light-info font-weight-bold btn-sm'><i class='fa fa-edit'></i></a>";
                }
            }
        ]
    });
}

function mostrar(id) {
    $.get("/admin/mostrarasigalumno/"+id, function (response) {
        response = JSON.parse(response);
        $("#idventa").val(response.idventa);
        $('#idcurso').selectpicker('val', response.idcurso);
        $('#idpersona').selectpicker('val', response.idpersona);
    })
}

function eliminar(id) {
    
}

function limpiar() {
    $("#idventa").val('');
    $('#idcurso').selectpicker('val', '');
    $('#idpersona').selectpicker('val', '');
    toastr.info('FILTRADOR RESETEADO.')
}