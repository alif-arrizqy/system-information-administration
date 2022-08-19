// success alert
const swal = $('.swal').data('swal');
if (swal) {
    Swal.fire({
        title: 'Success!',
        text: swal,
        icon: 'success',
    });
}

// error alert
const swalError = $('.swal').data('swal-error');
if (swalError) {
    Swal.fire({
        title: 'Error!',
        text: swalError,
        icon: 'error',
    });
}
