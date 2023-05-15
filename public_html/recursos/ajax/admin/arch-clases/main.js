var tabla;
$(document).ready(function () {
    
    $("#textClase").text("SELECCIONE: CURSO, MÓDULO Y CLASE");
    tabla = $("#tablaRecClase").DataTable();

    $("#tipo-archivo").change(function () {
        if ($(this).val() != "") {
            var op = $(this).val();
            $("#input-archivo").hide();
            $("#input-url").hide();
            switch (op) {
                case '1':
                    $("#input-archivo").show();
                    $("#url").val('');
                    break;
                case '2':
                    $("#input-url").show();
                    $("#archivo").val('');
                    break;
                default:
                    break;
            }
        }
    })
    
    $("#idcurso").change(function () {
        if ($(this).val() != "") {
            listModulos($(this).val());
        }
    })

    $("#idseccion").change(function () {
        if ($(this).val() != "") {
            listClases($(this).val());
        }
    })

    $("#idclase").change(function () {
        if ($(this).val() != "") {
            $("#textClase").text("CLASE : "+$("#idclase option:selected").text());
            listRecursosClase($("#idseccion option:selected").val(),$(this).val());
        }
    })

    $("#form-archivo").on("submit", function (e) {
        e.preventDefault();
        var idcurso   = $("#idcurso option:selected").val();
        var idseccion = $("#idseccion option:selected").val();
        var idclase   = $("#idclase option:selected").val();
        var idclase   = $("#idclase option:selected").val();
        var tarch     = $("#tipo-archivo option:selected").val();
        var titulo    = $("#titulo_archivo").val();

        if (idcurso != "" && idseccion != "" && idclase != "" && tarch != "" && titulo != "") {
            registrarArchivo(e);
        } else {
            toastr.warning('Seleccione : CURSO, MÓDULO, CLASE, TÍTULO Y TIPO DE ARCHIVO.');
        }
    })

})

function listModulos(idcurso) {
    $.get("admin/listmodulos/"+idcurso, function (response) {
        response = JSON.parse(response);
        var html = $("#idseccion").html('');
        html     += '<option value="" selected disabled>SELECCIONE..</option>';
        var autoi = 1;
        for (let data of response) {
            html += '<option value="'+data.idseccion+'">'+(autoi++)+". "+data.titulo+'</option>';
        }
        $("#idseccion").append(html).selectpicker('refresh');
    })
}

function listClases(idseccion) {
    $.get("admin/listclases/"+idseccion, function (response) {
        response = JSON.parse(response);
        var html = $("#idclase").html('');
        html     += '<option value="" selected disabled>SELECCIONE..</option>';
        var autoi = 1;
        for (let data of response) {
            html += '<option value="'+data.idclase+'">'+(autoi++)+". "+data.titulo+'</option>';
        }
        $("#idclase").append(html).selectpicker('refresh');
    })
}

function listRecursosClase(idseccion,idclase) {
    tabla = $("#tablaRecClase").DataTable({
        ajax: {
            method: 'GET',
            url: "admin/listrecursosclases/"+idseccion+"/"+idclase
        },
        responsive: true,
        destroy: true,
        /*language: {
            url: '/recursos/admin/dataTable/idioma.json'
        },*/
        columns: [
            {data: "autoi"},
            {data: "nombre"},
            {
                data: "archivo",
                render: function (archivo) {
                    return "<a href='"+archivo+"' target='_blank' class='btn btn-light-danger font-weight-bold btn-sm'><i class='fa fa-file'></i></button></a>";
                }
            },
            {
                data: "idrecurso",
                render: function (id) {
                    return "<center><a onclick='mostrarArchivo("+id+")' class='btn btn-light-info font-weight-bold btn-sm'><i class='fa fa-edit'></i></a>" +
                        " <a onclick='eliminarArchivo("+id+")' class='btn btn-light-danger font-weight-bold btn-sm'><i class='fa fa-trash'></i></a>";
                }
            }
        ]
    });
}

function registrarArchivo(e) {
    var formData = new FormData($("#form-archivo")[0]);
    $.ajax({
        url: "/nuevoarchivo",
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        success: function(datos) {
            console.log(datos);
            $("#tipo-archivo").val("");
            $("#archivo").val("");
            $("#url").val("");
            if (datos == 'true') {
                toastr.success('GUARDADO CORRECTAMENTE');
                listRecursosClase(1,$("#idclase option:selected").val());
                $("#idrecurso").val('');
                $("#titulo_archivo").val('');
                $("#input-archivo").hide();
                $("#archivo").val(''); $("#text-archivo").text('');
                $("#url").val('');
                $("#archivo_antiguo").val('');
                $("#input-url").hide();
            } else {
                toastr.error('NO SE PUDO REGISTRAR EL ARCHIVO');
                setTimeout(function(){
                    location.reload();
                }, 2000);
            }
        }
    });
}

function limpiar() {
    $("#idrecurso").val('');
    $('#idcurso').selectpicker('val', '');
    $('#idseccion').selectpicker('val', '');
    $('#idclase').selectpicker('val', '');
    $('#tipo-archivo').selectpicker('val', '');
    $("#titulo_archivo").val('');
    $("#input-archivo").hide();
    $("#archivo").val(''); $("#text-archivo").text('');
    $("#url").val('');
    $("#archivo_antiguo").val('');
    $("#input-url").hide();
    $("#textClase").text("SELECCIONE: CURSO, MÓDULO Y CLASE");
    tabla.clear().draw()
}

function mostrarArchivo(idrecurso) {
    $.get("mostrararchivo/"+idrecurso, function (response) {
        response = JSON.parse(response);
        $("#input-archivo").hide();
        $("#input-url").hide();

        $("#archivo").val(''); 
        $("#text-archivo").text('');
        $("#url").val('');
        $("#archivo_antiguo").val('');
        
        $("#idrecurso").val(response.idrecurso);
        $("#titulo_archivo").val(response.nombre);
        if (response.archivo == null || response.archivo == '') {
            $('#tipo-archivo').selectpicker('val', '2');
            $("#url").val(response.url);
            $("#input-url").show();
        } else {
            $('#tipo-archivo').selectpicker('val', '1');
            $("#text-archivo").text(response.archivo);
            $("#archivo_antiguo").val(response.archivo);
            $("#input-archivo").show();
        }
    }) 
}

function eliminarArchivo(idrecurso) {
    Swal.fire({
        title: '¿Seguro que quiere eliminar este registro?',
        text: "No se podra recuperar",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#f64e60',
        // cancelButtonColor: '#f64e60',
        confirmButtonText: 'Si, eliminar!'
    }).then((result) => {
        if (result.isConfirmed) {
            
            $.get(`elimararch/${idrecurso}`, function (data, status) {
                data = JSON.parse(data);
                listRecursosClase(1,$("#idclase option:selected").val());
                //console.log(data);
                if (data == 1) {
                    Swal.fire({
                        icon: 'success',
                        title: 'REGISTRO ELIMINADO',
                        showConfirmButton: false,
                        timer: 1500
                    })
                }else{
                    alert('Ocurrio un error, se refescara la página');
                    location.reload();
                }

            });

        }else{

        }
    });
}