function makeDeleteRequest(event, id) {
    event.preventDefault();
    Swal.fire({
        title: "Are you sure?",
        text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#02a499",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, delete it!",
    }).then((result) => {
        if (result.isConfirmed) {
            if ($("#delete-form-" + id).length > 0) {
                let form_id = $("#delete-form-" + id);
                $(form_id).submit();
            } else {
                let form_id = $("#delete-form-" + id);
                $(form_id).submit();
            }
        }
    });

}
function makeRequestToWarehouse(event, id) {
    event.preventDefault();
    Swal.fire({
        title: "Are you sure want to deliver ?",
        text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#02a499",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, deliver it!",
    }).then((result) => {
        console.log(result);
        if (result.isConfirmed) {
            console.log("restore");
            if ($("#send-to-warehouse-" + id).length > 0) {
                let form_id = $("#send-to-warehouse-" + id);
                $(form_id).submit();
            } else {
                let form_id = $("#send-to-warehouse-" + id);
                $(form_id).submit();
            }
        }
    });

}