$(document).ready(function () {

    $("#select-idcategoria").change(function () {
        if ($(this).val() != "") {
            location.href = '/cursos?idcategoria='+$(this).val();
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
