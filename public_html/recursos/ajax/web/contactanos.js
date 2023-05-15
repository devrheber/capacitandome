$(document).ready(function () {

    $("#btn-mensaje").click(function () {
        var frmData = new FormData($("#contactform")[0]);
        var n = frmData.get('nombre');
        var a = frmData.get('apellido');
        var t = frmData.get('telefono');
        var c = frmData.get('correo');
        var m = frmData.get('mensaje');

        if (n != "" && a != "" && t != "") {
            enviarMensaje(n, a, t, c, m);
        } else {
            $('#error-frm').show().fadeOut(5000);
        }
    })

})

function enviarMensaje(nom_apell, correo, telefono, mensaje) {
    var _token = $("input[name='_token']").val();
    $.ajax({
        url: "/sendmensaje",
        type: 'POST',
        data: {
            _token: _token,
            nom_apell: nom_apell,
            correo: correo,
            telefono: telefono,
            mensaje: mensaje,
        },
        success: function (data) {
            $('#contactform')[0].reset();
            if (data.success == "ok") {
                $('#success-frm').show().fadeOut(5000);
            } else {
                $('#contactform')[0].reset();
            }
        }
    });
}
