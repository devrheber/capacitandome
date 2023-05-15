var tabla;
$(document).ready(function () {
    //listar();
    listarPaginate();

    $("#buscarpersona").on('keyup', function () {
        listarPaginate(page = 1);
    });

    $(document).on("click", '.paginate-go', function(e) {
        e.preventDefault();
        listarPaginate($(this).attr('href').split('page=')[1]);
    });

    $("#fdep").change(function(){
        listarPaginate(page = 1);
    })
    $("#est").change(function(){
        listarPaginate(page = 1);
    })
})
var card = new KTCard('cardPersonas');
function listarPaginate(page=1) {
    $.ajax({
        url: `/admin/personas/paginate?page=${page}&dni=${$("#buscarpersona").val()}&fdep=${$("#fdep").val()}&est=${$("#est").val()}`,
            beforeSend: function( xhr ) {  
                KTApp.block(card.getSelf(), {
                    overlayColor: '#F3F6F9',type: 'loader',state: 'primary',opacity: 0.8,size: 'lg',message: 'Cargando. Espere por favor...'
                });
        }
    })
    .done(function( data ) {
        $("#paginatePersonas").html(data);
        KTApp.unblock(card.getSelf());
    });
}

function listar() {
    tabla = $("#tablaPersonas").DataTable({
        ajax: {
            method: 'GET',
            url: 'admin/personas/list'
        },
        responsive: true,
        aProcessing: true,
        /*language: {
            url: '/recursos/admin/dataTable/idioma.json'
        },*/
        columns: [
            {data: "autoi"},
            {data: "nombre"},
            {data: "dni"},
            {data: "telefono"},
            {data: "rol"},
            {data: "usuario"},
            {
                data: "idpersona",
                render: function (id) {
                    return "<center><a href='admin/personas/edit/"+id+"' class='btn btn-light-info font-weight-bold btn-sm'><i class='fa fa-edit'></i></a>" +
                        " <a onclick='desactivar("+id+")' class='btn btn-light-danger font-weight-bold btn-sm'><i class='fa fa-trash'></i></button></a>";
                }
            }
        ]
    });
}

function desactivar(idpersona) {
    Swal.fire({
        title: '¿Seguro que quiere eliminar este registro?',
        text: "No se podra recuperar",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#f64e60',
        // cancelButtonColor: '#f64e60',
        confirmButtonText: 'Si, eliminar!'
    }).then((result) => {
        if (result.isConfirmed) {
            
            $.get(`admin/personas/delete/${idpersona}`, function (data, status) {
                data = JSON.parse(data);
                tabla.ajax.reload();
                if (data.status == true) {
                    Swal.fire('Eliminado', '', 'success');
                    var rowCount = $('#table_secciones tr').length;

                    if (rowCount <= 1) {
                        $('#table_secciones').append('tr><td class="text-center" colspan="3">Aún no hay cursos registrados...</td></tr>');
                    }

                }else{
                    alert('Ocurrio un error, se refescara la página');
                    location.reload();
                }

            });

        }else{

        }
    });
}