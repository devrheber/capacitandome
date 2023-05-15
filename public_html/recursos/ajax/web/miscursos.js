$(document).ready(function () {
    //console.log("ok");
    $("#frm-act-clave").on("submit", function (e) {
        e.preventDefault()
        $('#msj-frm-clave').html('');
        var frmData = new FormData($("#frm-act-clave")[0]);
        var u = frmData.get('clave_actual');
        var c = frmData.get('clave_nueva');
        var v = frmData.get('clave_confir');         

        if (u != "" && c != "" && v != "") {
            cambiarContrasenia(e);
        } else {
            errorHtml('Contraseña actual, nueva y la confirmación son requeridos.');
        }
    })
})

function errorHtml(texto) {
    return $('#msj-frm-clave').html('<div style="background: #F44336;padding: 3px;border-radius: 5px;margin-bottom: 8px;">'
                +'<p style="font-size: 13px;color:white;padding:5px">'+texto+'</p>'
            +'</div>').show();
}
function successHtml(texto) {
    return $('#msj-frm-clave').html('<div style="background: #4CAF50;padding: 5px;border-radius: 5px;margin-bottom: 8px;">'
                +'<p style="font-size: 13px;color:white;padding:5px">'+texto+'</p>'
            +'</div>').show().fadeOut(4000);
}


function cambiarContrasenia(e) {
    e.preventDefault()
    var frmData = new FormData($("#frm-act-clave")[0]);
    $.ajax({
        url: "persona/cambiarclave",
        type: 'POST',
        data: frmData,
        processData: false,
        contentType: false,
        success: function (data) {
            //console.log(data);
            data = JSON.parse(data)
            $("#msj-frm-clave").html('');
            $('#frm-act-clave')[0].reset();
            if (data.status == true) {
                successHtml(data.message);
                setTimeout(function(){
                    window.location.reload();
                }, 4000);
            } else {
                errorHtml(data.message);
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
}

function reniciar_barra() {
    //$("#div_barra_progress").hide();
    $("#barra_progress").css({
        "width": '0%'
    });
    $("#barra_progress").text("0%");
}