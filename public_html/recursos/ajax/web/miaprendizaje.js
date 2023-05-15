$(document).ready(function () {
    //console.log("Init aprendizaje "+$("#idcurso_general").val());
    ultimaClaseVista()

    $("#frm-archivo").on("submit", function (e) {
        e.preventDefault();
        var formData = new FormData($("#frm-archivo")[0]);
        var titulo = formData.get('titulo_archivo');
        var archivo = $('#archivo')[0].files[0];
        if (titulo != "" && archivo != "") {
            registrarArchivo();
        } else {
            errorHtmlProf('Ingrese un titulo y adjunte un archivo.');
            $("#titulo_archivo").focus();
            $("#frm-archivo")[0].reset();
        }
    })

    $("#frm-archivo_t").on("submit", function (e) {
        e.preventDefault();
        var formData = new FormData($("#frm-archivo_t")[0]);
        var titulo = formData.get('titulo_archivo_t');
        var archivo = formData.get('archivo_t').name;
        //console.log(titulo+" "+archivo);
        //e.target.files[0].name;
        if (titulo != "" && archivo != "") {
            registrarTarea(e);
        } else {
            errorHtml('Ingrese un titulo y adjunte un archivo.');
            $("#titulo_archivo_t").focus();
            $("#frm-archivo_t")[0].reset();
        }
    })

    $("#tipo-archivo").change(function () {
        if ($(this).val() != "") {
            var op = $(this).val();
            $("#form-archivo").hide();
            $("#form-url").hide();
            switch (op) {
                case '1':
                    $("#form-archivo").show();
                    $("#url").val('');
                    break;
                case '2':
                    $("#form-url").show();
                    $("#archivo").val('');
                    break;
                default:
                    break;
            }
        }
    })
})

function getRecursosSeccion( idcurso, idsession ) {
    $("#htmlDetCurso").html('');
    $.ajax({
        url: "/recursoseccion/"+idcurso+"/"+idsession,
        type: 'GET',
        beforeSend: function( xhr ) {
            $('#cargando').show();
        },
        success: function (data) {
            $("#html-clase-novista").hide();
            $("#htmlDetCurso").html(data);
            $('#cargando').hide();
        }
    });
}

//htmlPregRest 
function getRespuestasPreg( idcomentario ) {
    //console.log(idcomentario);
    $("#htmlRespuestasPreg").html('');
    var html = '';
    $.ajax({
        url: "/respuestapreg/"+idcomentario,
        type: 'GET',
        success: function (data) {
            $("#htmlRespuestasPreg").html(data);
        }
    });
}

function nuevaPregunta( idcurso, idclase ) {
    var formData = new FormData($("#frm-new-pregunta")[0]);
    var newpregunta = formData.get('newpregunta');
    if (newpregunta != "") {
        $.ajax({
            url: "/nuevoComentario",
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,
            success: function(datos) {
                $("#frm-new-pregunta")[0].reset();
                if (datos == 'true') {
                    $(".modal-comentario").modal('show')
                    setTimeout(function(){
                        getRecursosSeccion( idcurso, idclase );
                        $(".modal-comentario").modal('hide')
                    }, 4000);
                }
            }
        });
    } else {
        $("#newpregunta").focus();
    }
}

function nuevaRespuesta( idcomentario) {
    var formData = new FormData($("#frm-new-respuesta")[0]);
    var newrespuesta = formData.get('nuevarespuesta');
    if (newrespuesta != "") {
        $.ajax({
            url: "/nuevarespuesta",
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,
            success: function(datos) {
                $("#frm-new-respuesta")[0].reset();
                if (datos == 'true') {
                    getRespuestasPreg( idcomentario );
                    $(".modal-respuesta").modal('show')
                    setTimeout(function(){
                        $(".modal-respuesta").modal('hide')
                    }, 3000);
                }
            }
        });
    } else {
        $("#nuevarespuesta").focus();
    }
}

function registrarArchivo() {
    var formData = new FormData($("#frm-archivo")[0]);
    var archivo = formData.get('archivo');
    formData.append('idclase',$("#idclase_actual").val())

    //if (archivo != "") {
        $.ajax({
            url: "/nuevoarchivo",
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,
            success: function(datos) {
                //console.log(datos);
                $("#frm-archivo")[0].reset();
                if (datos == 'true') {
                    successHtmlProf("Se ha registrado correctamente.")
                    setTimeout(function(){
                        getRecursosSeccion( $("#idcurso_actual").val(), $("#idclase_actual").val() );
                        $(".upload-photo-modal-form").modal('hide')
                    }, 2000);
                } else {
                    errorHtmlProf("No se pudo registrar");
                }
            },
            xhr: function () {
                var xhr = new window.XMLHttpRequest();
                xhr.upload.addEventListener("progress", function (evt) {
                    if (evt.lengthComputable) {
                        var percentComplete = (evt.loaded / evt.total) * 100;
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
                window.location.reload();
            }
        });
    //} else {
       // $("#titulo_archivo").focus();
    //}
}

function elimarArchivo( idrecurso, idclase ) {
    $.ajax({
        url: "/elimarArchivo/"+idrecurso+"/"+idclase,
        type: "GET",
        contentType: false,
        processData: false,
        success: function(datos) {
            getRecursosSeccion($("#idcurso_actual").val(), $("#idclase_actual").val());
        }
    }); 
}

function cancelar() {
    $("#frm-archivo")[0].reset();
    $('#error-frm').html('');
    $('#success-frm').html('');
}
function errorHtmlProf(texto) {
    return $('#error-frm').html('<div id="error-frm" style="background: #F44336;padding: 5px;border-radius: 5px;margin-bottom: 8px;">'
                +'<p style="font-size: 13px;color:white;padding:5px">'+texto+'</p>'
            +'</div>').show().fadeOut(3000);
}

function successHtmlProf(texto) {
    return $('#success-frm').html('<div id="error-frm" style="background: #4CAF50;padding: 5px;border-radius: 5px;margin-bottom: 8px;">'
                +'<p style="font-size: 13px;color:white;padding:5px">'+texto+'</p>'
            +'</div>').show().fadeOut(3000);
}

function checkSesionVista(idclase) {
    var formData = new FormData();
    formData.append('idclase', idclase);
    formData.append('_token', $("meta[name='csrf-token']").attr("content"));
    $.ajax({
        url: "/checkSesionVista",
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        success: function(datos) {
            if (datos == 'true') {
                console.log('visto');
            } else {
                console.log('Ya registrado.');
            }
        }
    });
}

function ultimaClaseVista() {
    $.ajax({
        url: "/ultimaClaseVista/"+$("#idcurso_general").val(),
        type: "GET",
        contentType: false,
        processData: false,
        success: function(datos) {
            datos = JSON.parse(datos);
            var idcurso_general = $("#idcurso_general").val()
            console.log(datos);

            if (datos.visto) {
                getRecursosSeccion( idcurso_general, datos.visto.idclase );
            }

            if (datos.estado == "true") {
                if (idcurso_general != "") {
                    getRecursosSeccion( idcurso_general, datos.idclase );
                }  
            } else if(datos.estado == "false") {
                $(".clase-no-vista-modal").modal('show');
                $("#texto_clase_no_vista").text(datos.texto);
            }
        }
    }); 
}

function elimarTarea( idrecurso, idseccion ) {
    $.ajax({
        url: "/elimarTarea/"+idrecurso+"/"+idseccion,
        type: "GET",
        contentType: false,
        processData: false,
        success: function(datos) {
            datos = JSON.parse(datos);
            if (datos == 1) {
                tareassubidas(idseccion)
            } else {
                alert("HA OCURRIDO UN ERROR, RECARGUE LA PÁGINA Y VUELVE A ELIMINAR");
            }
            
        }
    }); 
}
function getIdSeccion(idseccion) {
    $("#idseccion_t").val(idseccion);
    tareassubidas(idseccion)
}

/* REGISTRAR TAREAS Y LISTAR POR CADA ESTUDIANTE */

function registrarTarea(e) {
    e.preventDefault();
    var formData = new FormData($("#frm-archivo_t")[0]);
    var titulo = formData.get('titulo_archivo_t');
    var arch = formData.get('archivo_t').name;
    if (titulo != "" && arch != "") {
        $.ajax({
            url: "/registrarTarea",
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,
            success: function(datos) {
                console.log(datos);
                $('#error-frm_t').hide();
                $("#frm-archivo_t")[0].reset();
                if (datos == 'true') {
                    successHtml("Se ha registrado correctamente.")
                    tareassubidas($("#idseccion_t").val());
                    console.log($("#idus").val()+" - "+$("#idseccion_t").val());
                    /*setTimeout(function(){
                        window.location.reload();
                    }, 2000);*/
                } else {
                    errorHtml("No se pudo registrar");
                }
            },
            xhr: function () {
                var xhr = new window.XMLHttpRequest();
                xhr.upload.addEventListener("progress", function (evt) {
                    if (evt.lengthComputable) {
                        var percentComplete = (evt.loaded / evt.total) * 100;
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
                window.location.reload();
            }
        });
    } else {
        errorHtml('Ingrese un titulo y adjunte un archivo.');
        $("#titulo_archivo_t").focus();
        $("#frm-archivo_t")[0].reset();
    }
}

function tareassubidas(idseccion) {
    $.get("mistareas/"+idseccion, function (result) {
        result = JSON.parse(result);
        
        $("#tablaMisTareas").html('');
        if (result.data.length > 0) {
            var html   = '';
            var autoi  = 1;
            var nota = '';
            $("#tablaTareasVacia").hide();
            for (var item of result.data) {
                nota = (item.nota != null)? item.nota: 'No revisado.';
                html += '<tr>'
                            +'<td>'+(autoi++)+'</td>'
                            +'<td style="font-size:13px">'+item.nombre+'</td>'
                            +'<td class="text-center">'+nota+'</td>'
                            +'<td class="text-center"><a href="../storage/archivos/'+item.archivo+'" target="_blank" class="btn btn-info btn-sm"><i class="fa fa-download"></i></a></td>'
                            +'<td class="text-center">'
                                +'<a href="javascript:" onclick="elimarTarea('+item.idrecurso+','+idseccion+')" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>'
                            +'</td>'
                        +'</tr>';
            }
            $("#tablaMisTareas").append(html);
        } else {
            $("#tablaTareasVacia").show();
        }
    })
}





function reniciar_barra() {
    //$("#div_barra_progress").hide();
    $("#barra_progress").css({
        "width": '0%'
    });
    $("#barra_progress").text("0%");
}
function cancelar_t() {
    $("#frm-archivo_t")[0].reset();
    $('#error-frm_t').html('');
    $('#success-frm_t').html('');
}
function errorHtml(texto) {
    return $('#error-frm_t').html('<div id="error-frm" style="background: #F44336;padding: 5px;border-radius: 5px;margin-bottom: 8px;">'
                +'<p style="font-size: 13px;color:white;padding:5px">'+texto+'</p>'
            +'</div>').show().fadeOut(3000);;
}
function successHtml(texto) {
    return $('#success-frm_t').html('<div id="error-frm" style="background: #4CAF50;padding: 5px;border-radius: 5px;margin-bottom: 8px;">'
                +'<p style="font-size: 13px;color:white;padding:5px">'+texto+'</p>'
            +'</div>').show().fadeOut(3000);;
}