var dataErrores;
$(document).ready(function () {

    $("#btn-pagar").click(function () {
        var op = $('input[name="metodo_pago"]:checked').val();
        switch (op) {
            case 'tb':
                //TRANSFERENCIA - DEPOSITO
                transfDeposito();
                $("#msj-error-frm").css('display', 'none');
                break;

            case 'tc':
                //TRANSFERENCIA - DEPOSITO
                targCredito();
                $("#msj-error-frm-bp").css('display', 'none');
                break;

            default:
                break;
        }
    })

    $("#btn-valid-login").click(function () {
      var u = $("input[name='usuario']").val();
      var c = $("input[name='clave']").val();
      $("#error-login").html('');
      if (u != "" && c != "") {
        validarLogin(u, c);
      } else {
        showErrorHtml('Usuario y contraseña son requeridos');
      }
    })
})

function targCredito() {
  var _token = $("input[name='_token']").val();
  var num_targeta = $("input[name='num_targeta']").val();
  var mes_ven = $("input[name='mes_ven']").val();
  var anio_ven = $("input[name='anio_ven']").val();
  var cvv = $("input[name='cvv']").val();
  var idcurso = $("input[name='idcurso']").val();
  var precio = $("input[name='precio']").val();
  var idu = $("input[name='idu']").val();/*-----*/
  var nombre = $("input[name='nombre_fac']").val();
  var apellido = $("input[name='apellido_fac']").val();
  var direccion = $("input[name='direccion_fac']").val();
  var dni = $("input[name='dni_fac']").val();

  $.ajax({
      url: "/registrarpago",
      type: 'POST',
      data: {
        _token:_token, 
        num_targeta:num_targeta, 
        mes_ven:mes_ven, 
        anio_ven:anio_ven, 
        cvv:cvv,
        idcurso:idcurso,
        precio:precio,
        idu:idu,
        nombre:nombre,
        apellido:apellido,
        direccion:direccion,
        dni:dni
      },
      success: function (data) {
        console.log(data);
          clearMsgErrorFrm();
          if ($.isEmptyObject(data.error)) {
              console.log(data.success);
              dataErrores = '';
              //SE ABRIRÁ UNA MODAL CUANDO EL PAGO SE REGISTRE CORRECTAMENTE
              $("#modal-login").modal('show');
              $("#btn-pagar").prop('disabled', true);
              $("#msj-error-frm").css('display', 'none');
              /*setTimeout(function(){
                window.location.href = '/';
              }, 6000);*/
          } else {
              msgErrorFrm(data.error);
          }
      }
  });
}


function msgErrorFrm(msg) {
  $("#msj-error-frm").css('display', 'block');
  $.each(msg, function (key, value) {
    $("input[name='"+key+"']").addClass("error");
  });
  dataErrores = msg;
}

function clearMsgErrorFrm() {
  $.each( dataErrores , function( key, value ) {
    $("input[name='"+key+"']").removeClass("error");
  });

}

function transfDeposito() {

  var boucher = $('#boucher_pago')[0].files[0];
  var idcurso = $("input[name='idcurso']").val();
  var precio = $("input[name='precio']").val();
  var nombre = $("input[name='nombre_fac']").val();
  var apellido = $("input[name='apellido_fac']").val();
  var direccion = $("input[name='direccion_fac']").val();
  var dni = $("input[name='dni_fac']").val();
  var idu = $("input[name='idu']").val();/*-----*/
  var _token = $("input[name='_token']").val();

  var formData = new FormData();
  formData.append('boucher_pago', boucher);
  formData.append('idcurso', idcurso);
  formData.append('precio', precio);
  formData.append('nombre', nombre);
  formData.append('apellido', apellido);
  formData.append('dni', dni);
  formData.append('direccion', direccion);
  formData.append('idusuario', idu);
  formData.append('_token',_token);
  $.ajax({
      url: "/registrarboucher",
      type: 'POST',
      data: formData,
      contentType: false,
      processData: false,
      success: function (data) {
        console.log(data);
        if ($.isEmptyObject(data.error)) {
          $("#msj-error-frm-bp").css('display', 'none');
          console.log(data.success);
          $("#modal-success-pago").modal('show');
          $("#btn-pagar").prop('disabled', true);
          setTimeout(function(){
            window.location.href = '/';
            $('#boucher_pago').val('');
          }, 6000);
        } else {
          $("#msj-error-frm-bp").css('display', 'block');
          $('#boucher_pago').val('');
        }
      }
  });
}


function validarLogin(u, c) {
  var _token = $("input[name='_token']").val();

  $.ajax({
      url: "/login",
      type: 'POST',
      data: {
          _token: _token,
          usuario: u,
          password: c,
      },
      success: function (data) {
          //$("#alert-btn-fact").html('');
          $("#error-login").html('');
          $("#error-cuenta").hide();
          if (data.response == 'ok') {
            $("#usuario_v").prop('readonly', true);
            $("#clave_v").prop('readonly', true);
            $("#btn-valid-login").prop('disabled', true);
            $("#e_u").hide();
            $("#e_c").hide();
            $("#usuario_v").removeClass('error-frm');
            $("#clave_v").removeClass('error-frm');
            //$("#alert-btn-fact").html('');
          } else {
            $("#error-cuenta").show();
          }
      }
  });
}

function showErrorHtml(texto) {
  return $("#error-login").html('<p style="font-size: 14px;color:white;text-align: center"><i class="la la-info"></i> '+texto+'</p>').show().fadeOut(3000);
}
