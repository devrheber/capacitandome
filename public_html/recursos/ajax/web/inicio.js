$(document).ready(function () {

    $("#btn-mensaje").click(function () {
        var frmData = new FormData($("#frm-mensaje")[0]);
        var n_p = frmData.get('nombre_apellido');
        var t = frmData.get('telefono');
        var c = frmData.get('correo');
        var m = frmData.get('mensaje');

        if (n_p != "" && t != "" && m != "") {
            enviarMensaje(n_p, c, t, m);
        } else {
            $('#error-frm').show().fadeOut(3000);
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
            $('#frm-mensaje')[0].reset();
            if (data.success == "ok") {
                $('#success-frm').show().fadeOut(3000);
            } else {
                $('#frm-mensaje')[0].reset();
            }
        }
    });
}
