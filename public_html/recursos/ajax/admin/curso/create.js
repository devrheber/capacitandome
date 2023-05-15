"use strict";
var tablaTema;

jQuery(document).ready(function () {
    $('#idcategoria').select2({
        placeholder: "Seleccione una categoria.",
        allowClear: true
    });
    tablaTema = $("#tableTemaDes").DataTable({
        responsive: true,
        language: {
            url: '/recursos/admin/assets/js/idioma.json'
        },
        lengthMenu: [5, 10, 25, 50],
        pageLength: 5
    });
	KTWizard1.init();
	//uploadImagen();
	new KTImageInput('kt_image_5');

    $("#btn-add-temas").click(function () {
        var txttema = $("#txttemas").val();
        if (txttema != "") {
            guardarTemasDesarrollar(txttema);
            $("#txttemas").val('');
        } else {
            toastr.warning('Debe rellenar el formulario.', 'ALERTA')
        }
    })
});

var arrayPlan = [];
// Class definition
var KTWizard1 = function () {
    // Base elements
    var _wizardEl;
    var _formEl;
    var _wizardObj;
    var _initWizard = function () {
        // Initialize form wizard
        _wizardObj = new KTWizard(_wizardEl, {
            startStep: 1, // initial active step number
            clickableSteps: false // allow step clicking
        });
        // Validation before going to next page
        _wizardObj.on('change', function (wizard) {
            if (wizard.getStep() > wizard.getNewStep()) {
                return; // Skip if stepped back
            }
        });
    }
    return {
        init: function () {
            _wizardEl = KTUtil.getById('kt_wizard');
            _formEl = KTUtil.getById('kt_form');
            _initWizard();
        }
    };
}();

var guardarTemasDesarrollar = function (txttema) {
    var _token = $("meta[name='csrf-token']").attr("content");
    var opcion = '';
    $.post("curso/tema", {
        _token: _token,
        txttema: txttema
    }, function name(resp) {
        //resp = JSON.parse(resp);
        opcion = '<center>\
					<a href="javascript:;" class="btn btn-sm btn-clean btn-icon" title="Edit details">\
						<i style="color: #ffa800;" class="la la-edit"></i>\
					</a>\
					<a href="javascript:;" class="btn btn-sm btn-clean btn-icon" title="Delete">\
						<i style="color: red;" class="la la-trash"></i>\
					</a>\
				</center>\ ';
        tablaTema.row.add([1, txttema, opcion]).draw(false);
    });
}

function uploadImagen() {
    var avatar5 = new KTImageInput('kt_image_5');

    avatar5.on('cancel', function (imageInput) {
        swal.fire({
            title: 'Image successfully changed !',
            type: 'success',
            buttonsStyling: false,
            confirmButtonText: 'Awesome!',
            confirmButtonClass: 'btn btn-primary font-weight-bold'
        });
    });

    avatar5.on('change', function (imageInput) {
        swal.fire({
            title: 'Image successfully changed !',
            type: 'success',
            buttonsStyling: false,
            confirmButtonText: 'Awesome!',
            confirmButtonClass: 'btn btn-primary font-weight-bold'
        });
    });

    avatar5.on('remove', function (imageInput) {
        swal.fire({
            title: 'Image successfully removed !',
            type: 'error',
            buttonsStyling: false,
            confirmButtonText: 'Got it!',
            confirmButtonClass: 'btn btn-primary font-weight-bold'
        });
    });
}
