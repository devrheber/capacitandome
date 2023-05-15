var tabla;
var tablaRep;
$(document).ready(function () {
    listarPaginate();

    $("#filtro_buscar").on('keyup', function () {
        listarPaginate(page = 1,$(this).val());
    });

    $(document).on("click", '.paginate-go', function(e) {
        e.preventDefault();
        listarPaginate($(this).attr('href').split('page=')[1]);
    });

    $("#f_dep").change(function(){
        listarPaginate(page = 1,$(this).val());
    })
})

var card = new KTCard('cardAlumnos');f_dep
function listarPaginate(page=1) {
    $.ajax({
        url: `/admin/listEstPaginate?page=${page}&idcurso=${$("#idcurso").val()}&filtro_buscar=${$("#filtro_buscar").val()}&f_dep=${$("#f_dep").val()}`,
            beforeSend: function( xhr ) {  
                KTApp.block(card.getSelf(), {
                    overlayColor: '#F3F6F9',type: 'loader',state: 'primary',opacity: 0.8,size: 'lg',message: 'Espere por favor...'
                }); 
        }
    })
    .done(function( data ) {
        $("#paginateAlumnos").html(data);
        $('[data-toggle="tooltip"]').tooltip()
        KTApp.unblock(card.getSelf());
    });
}

function desactivar(idusuario) {
    Swal.fire({
        title: '¿Seguro que quiere desabilitar el acceso a  este curso?',
        text: "No podrá ver las clases del curso en la plataforma.",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#f64e60',
        // cancelButtonColor: '#f64e60',
        confirmButtonText: 'Si, desactivar!'
    }).then((result) => {
        if (result.isConfirmed) {
            
            $.get(`admin/desactivarCuenta/${idusuario}`, function (data, status) {
                data = JSON.parse(data);
                console.log(data);
                if (data.status == true) {
                    Swal.fire({
                        icon: 'success',
                        title: data.message,
                        showConfirmButton: false,
                        timer: 1500
                    })
                }else{
                    alert('Ocurrio un error, se refescará la página');
                    location.reload();
                }
                listarPaginate(page = 1);
            });

        }
    });
}

function activar(idusuario) {
    Swal.fire({
        title: '¿Seguro que quiere Habilitar el acceso a  este curso?',
        text: "El estudiante podrá ver las clases del curso en la plataforma.",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#f64e60',
        // cancelButtonColor: '#f64e60',
        confirmButtonText: 'Si, activar!'
    }).then((result) => {
        if (result.isConfirmed) {
            
            $.get(`admin/activarCuenta/${idusuario}`, function (data, status) {
                data = JSON.parse(data);
                //console.log(data);
                if (data.status == true) {
                    Swal.fire({
                        icon: 'success',
                        title: data.message,
                        showConfirmButton: false,
                        timer: 1500
                    })
                }else{
                    alert('Ocurrio un error, se refescará la página');
                    location.reload();
                }
                listarPaginate(page = 1);
            });

        }
    });
}