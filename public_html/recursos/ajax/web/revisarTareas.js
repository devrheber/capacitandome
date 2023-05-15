$(document).ready(function () {
    $("#select-idseccion").change(function (params) {
        if ($(this).val() != "") {
            listtareaEst($(this).val());
        }
    })

    $("#frm-notas").on("submit", function (e) {
        e.preventDefault();
        var formData = new FormData($("#frm-notas")[0]);
        var nota     = formData.get('nota');
        var archivo  = $('#archivo').name;

        if (nota   != "" && archivo != "") {
            evaluarTarea(e);
        } else {
            errorNotas('Adjunte un archivo y registre una nota.');
        }
    })
})

function listtareaEst(idseccion) {
    $.get("listtareaEst/"+idseccion, function (result) {
        result = JSON.parse(result); 
        $("#msj-info").hide();
        $('#msj-revisar').html('');
        $("#tabla-tareas").html('');//Limpiar 2 tabla
        $("#htmlEstudiante").html('');
        $("#htmlEstudiante").html('');

        if (result.data.length < 6) {
            $("#scroll-tablas").css("height", "300px");
        }

        if (result.data.length > 0) {
            size = result.data.length;
            
            $('#page').pagination({
                dataSource: result.data,
                totalNumber: 120,
                pageSize: 10,
                ajax: {
                    beforeSend: function() {
                        $('#page').html('Cargando registros...');
                    }
                },
                callback: function (data, pagination) {
                    $("#tabla-estudiantes").html('');
                    var estado = 1;
                    $.each(data, function (i, val) {
                        //estado = (val.estado == 1)? '<span style="background:#28a745;;color:white;border-radius: 5px;font-size:13px;padding:2px">Revisado</span>':'';
                        $("#tabla-estudiantes").append(
                            '<tr>'
                                +'<td>'+(i+1)+'</td>'
                                +'<td>'+val.nombre+" "+val.apellidos+'</td>'
                                //+'<td>'+estado+'</td>'
                                +'<td><a href="javascript:" onclick="tareassubidas('+val.idusuario+","+val.idseccion+","+"'"+val.nombre +"'"+","+"'"+val.apellidos+"'"+')" class="btn btn-success btn-sm"><i class="fa fa-arrow-right"></i></a></td>'
                            +'</tr>');
                    });
                }
            })
        } else {
            errorHtml("LOS ESTUDIANTES AÚN NO HAN SUBIDO SUS TAREAS EN ÉSTE MÓDULO.");
            $("#tabla-estudiantes").html('');
            $('#page').empty();
        }
    })
}

function tareassubidas(idusuario,idseccion, nombre, apellidos) {
    $.get("tareassubidas/"+idusuario+"/"+idseccion, function (result) {
        result = JSON.parse(result);
        //console.log(result);
        $("#msj-tareas").hide();
        $("#tabla-tareas").html('');
        $('#msj-tarea-e').html('');
        $("#htmlEstudiante").html('');
        if (result.data.length > 0) {
            var html   = '';
            var autoi  = 1;
            var estado = '';
            var nota = '';
            
            for (var item of result.data) {
                nota = (item.nota != null)? item.nota: 'No revisado.';
                html += '<tr>'
                            +'<td>'+(autoi++)+'</td>'
                            +'<td>'+item.nombre+'</td>'
                            +'<td>'+nota+'</td>'
                            +'<td class="text-center"><a href="../storage/archivos/'+item.archivo+'" target="_blank" class="btn btn-info btn-sm"><i class="fa fa-download"></i></a></td>'
                            +'<td class="text-center">'
                                +'<a href="javascript:" onclick="mostrarEvaluarTarea('+item.idrecurso+","+item.idusuario+","+item.idseccion+","+"'"+nombre +"'"+","+"'"+apellidos+"'"+')" class="btn btn-success btn-sm"><i class="fa fa-plus-circle"></i></a>'
                            +'</td>'
                        +'</tr>';
            }
            $("#tabla-tareas").append(html);
            $("#htmlEstudiante").html("<span class='text-success mb-3'><i class='fa fa-user'></i> </span> <span>"+nombre+" "+apellidos+"</span>");
        } else {
            errorHtml("AÚN NO EXISTEN TAREAS REGISTRADAS EN ÉSTE MÓDULO.");
        }
    })
}

function mostrarEvaluarTarea(idrecurso,idusuario,idseccion,nombre,apellidos) {
    $("#modalevaluarTarea").modal('show');
    $("#idrecurso").val(idrecurso);
    $("#idusuario").val(idusuario);
    $("#idseccion").val(idseccion);
    $("#nombre_p").val(nombre);
    $("#apellidos").val(apellidos);
    $("#nota").val('');
    $("#archivo").val('');
    //$("#frm-notas")[0].reset();
    $('#frm-revisar').html('');
}

function evaluarTarea(e) {
    e.preventDefault();
    var formData = new FormData($("#frm-notas")[0]);
    $.ajax({
        url: "/evaluarTarea",
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        success: function(datos) {
            //console.log(datos);
            datos = JSON.parse(datos);
            //$("#frm-notas")[0].reset();
            if (datos.status == true) {
                successNotas("Se ha registrado correctamente.")
                tareassubidas($("#idusuario").val(),$("#idseccion").val(),$("#nombre_p").val(),$("#apellidos").val())
                //console.log("'"+$("#nombre_p").val() +"'"+' - '+"'"+$("#apellidos").val()+"'");
                setTimeout(function(){
                    $("#modalevaluarTarea").modal('hide')
                }, 2000);
            } else {
                errorNotas("No se pudo registrar");
            }
        },
        xhr: function () {
            var xhr = new window.XMLHttpRequest();
            xhr.upload.addEventListener("progress", function (evt) {
                if (evt.lengthComputable) {
                    var percentComplete = Math.round((evt.loaded / evt.total) * 100);;
                    //console.log(Math.round(percentComplete));
                    $("#barra_progress").css({
                        "width": percentComplete + '%'
                    });
                    $("#barra_progress").text(percentComplete + "%");
                    if (percentComplete === 100) {
                        setTimeout(reniciar_barra, 600);
                    }
                }
            }, false);
            return xhr;
        },
        error: function (jqXhr) {
            //window.location.reload();
        }
    });
}

function reniciar_barra() {
    //$("#div_barra_progress").hide();
    $("#barra_progress").css({
        "width": '0%'
    });
    $("#barra_progress").text("0%");
}

function errorHtml(texto) {
    return $('#msj-revisar').html('<div style="background: #F44336;padding: 3px;border-radius: 5px;margin-bottom: 8px;text-align:center">'
                +'<p style="font-size: 13px;color:white;padding:5px">'+texto+'</p>'
            +'</div>').show();
}

function errorNotas(texto) {
    return $('#frm-revisar').html('<div style="background: #F44336;padding: 3px;border-radius: 5px;margin-bottom: 8px;text-align:center">'
                +'<p style="font-size: 13px;color:white;padding:5px">'+texto+'</p>'
            +'</div>').show();
}

function successNotas(texto) {
    return $('#frm-revisar').html('<div id="error-frm" style="background: #4CAF50;padding: 5px;border-radius: 5px;margin-bottom: 8px;">'
                +'<p style="font-size: 13px;color:white;padding:5px">'+texto+'</p>'
            +'</div>').show();
}
function reset() {
    location.reload();
}