import toastr from 'toastr';
window.$(document).ready(function () {
    toastr.options = {
        "positionClass": "toast-top-right",
        "progressBar": true
    };
    window.addEventListener('added', function (event) {
        toastr.success(event.detail[0].message, 'Validation');
        $('#formInscriptionModal').modal('hide');
        $('#newReinscription').modal('hide');
        $('#newPayment').modal('hide');
        $('#formDepenseModal').modal('hide');
        $('#newLatePayment').modal('hide');
        $('#formTarifModal').modal('hide');
    });
    window.addEventListener('added-inscription', function (event) {
        toastr.success(event.detail[0].message, 'Validation');
    });
    window.addEventListener('updated', function (event) {
        toastr.info(event.detail[0].message, 'Validation');
        $('#editClasseAnInscription').modal('hide');
        $('#formEditInscriptionModal').modal('hide');
        $('#editFamillyModal').modal('hide');
        $('#editPayment').modal('hide');
        $('#formDepenseModal').modal('hide');
        $('#newLatePayment').modal('hide');
        $('#formTarifModal').modal('hide');

    });
    window.addEventListener('error', function (event) {
        toastr.error(event.detail[0].message, 'Alert !');
        $('#newReinscription').modal('hide');
        $('#newPayment').modal('hide');
    });


});
$("input[data-bootstrap-switch]").each(function(){
    $(this).bootstrapSwitch('state', $(this).prop('checked'));
  });

