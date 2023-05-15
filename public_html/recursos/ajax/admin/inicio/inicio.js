var tabla;

$(document).ready(function () {
    listarPaginate();

    $("#buscarPago").on('keyup', function () {
        listarPaginate(page = 1,$(this).val());
    });

    $(document).on("click", '.paginate-go', function(e) {
        e.preventDefault();
        listarPaginate($(this).attr('href').split('page=')[1]);
    });
})

var card = new KTCard('cardPagos');
function listarPaginate(page=1) {
    $.ajax({
        url: `/admin/inicio/listvoucher?page=${page}&filtro_search=${$("#buscarPago").val()}`,
            beforeSend: function( xhr ) {  
                KTApp.block(card.getSelf(), {
                    overlayColor: '#F3F6F9',type: 'loader',state: 'primary',opacity: 0.8,size: 'lg',message: 'Espere por favor...'
                }); 
        }
    })
    .done(function( data ) {
        $("#pagosPaginate").html(data);
        $('[data-toggle="tooltip"]').tooltip()
        KTApp.unblock(card.getSelf());
    });
}

function habilitarVenta(idventa) {
    Swal.fire({
        title: '¿Seguro que HABILITAR esta venta?',
        text: "El alumno tendrá acceso a sus cursos y lecciones",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#f64e60',
        confirmButtonText: 'Si, habilitar!'
    }).then((result) => {
        if (result.isConfirmed) {            
            $.get(`admin/inicio/habventa/${idventa}`, function (data, status) {
                data = JSON.parse(data);

                listarPaginate();
                
                if (data.status == true) {
                    Swal.fire({
                        icon: 'success',
                        title: data.message,
                        showConfirmButton: false,
                        timer: 1500
                    })
                }else{
                    Swal.fire({
                        icon: 'error',
                        title: data.message,
                        showConfirmButton: false,
                        timer: 1500
                    })
                }

            });

        }
    });
}

function eliminarVenta(idventa) {
    Swal.fire({
        title: '¿Seguro que desea ELIMINAR esta venta?',
        text: "",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#f64e60',
        confirmButtonText: 'Si, habilitar!'
    }).then((result) => {
        if (result.isConfirmed) {            
            $.get(`admin/inicio/elimventa/${idventa}`, function (data, status) {
                data = JSON.parse(data);
                listarPaginate();
                if (data.status == true) {
                    Swal.fire({
                        icon: 'success',
                        title: data.message,
                        showConfirmButton: false,
                        timer: 1500
                    })
                }else{
                    Swal.fire({
                        icon: 'error',
                        title: data.message,
                        showConfirmButton: false,
                        timer: 1500
                    })
                }

            });

        }
    });
}