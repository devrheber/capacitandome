$(document).ready(function () {

    $("#frm-login").on("submit", function (e) {
        var frmData = new FormData($("#frm-login")[0]);
        var u = frmData.get('usuario');
        var c = frmData.get('password');           
        e.preventDefault();
        if (u != "" && c != "") {
            login(e);
        } else {
            errorHtml('Usuario y clave son requeridos');
        }
    })

    $('#search').on('keyup', function() {
        var key = $(this).val();		
        //var dataString = key;
        $.ajax({
            type: "GET",
            url: "buscarCurso/",
            data: {search:key},
            success: function(data) {
                data = JSON.parse(data)
                $("#suggestions").show();
                if (data.length != 0) {
                    var html = '';
                    for (let i = 0; i < data.length; i++) {
                        html += '<div><a href="curso/'+data[i].idcurso+'" class="suggest-element">'+(i+1)+". "+data[i].curso+'</a></div>';
                    }
                    $('#suggestions').fadeIn(1000).html(html);
                    /*$('.suggest-element').on('click', function(){
                        window.location.replace('curso/');
                        return false;
                    });*/
                } else {
                    console.log("vacio");
                    $('#suggestions').fadeIn(1000).html('<div><a class="suggest-element">No existen registros</a></div>');
                }
            }
        });
    });

    //funcion para cualquier clic en el documento
    document.addEventListener("click", function(e){
        $('#suggestions').fadeOut(1000);
    }, false);

})


function login(e) {
    e.preventDefault()
    var frmData = new FormData($("#frm-login")[0]);
    $.ajax({
        url: "/login",
        type: 'POST',
        data: frmData,
        processData: false,
        contentType: false,
        success: function (data) {
            $('#frm-login')[0].reset();
            if (data.response == "ok") {
                window.location.replace(data.href);
            } else {
                errorHtml('Usuario y clave no coinciden');
            }
        }
    });
}

function errorHtml(texto) {
    return $('#error-frm-login').html('<div id="error-frm" style="background: #F44336;padding: 5px;border-radius: 5px;margin-bottom: 8px;">'
                +'<p style="font-size: 13px;color:white;padding:5px">'+texto+'</p>'
            +'</div>').show().fadeOut(3000);
}