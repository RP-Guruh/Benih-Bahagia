$(document).ready(function () {
    $(".form_edit").on("submit", function (e) {
        e.preventDefault(); 

        let form = this;

        Swal.fire({
            title: "Are you sure?",
            text: "Do you want to edit this data?",
            icon: "question",
            showCancelButton: true,
            confirmButtonText: "Yes, save it",
            cancelButtonText: "Cancel",
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit();
            }
        });
    });
});