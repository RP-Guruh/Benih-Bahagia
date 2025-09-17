$(document).ready(function () {
    // Setup CSRF token
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    // Buka modal
    $('#edit-header').on('click', function () {
        $('#headerEditModal').modal('show');
    });

    // Submit form via AJAX
    $('#headerEditForm').on('submit', function (e) {
        e.preventDefault();

        let formData = new FormData(this);

        $.ajax({
            url: "/admin/update-header", // langsung pakai URL hardcode
            type: "POST",
            data: formData,
            processData: false,
            contentType: false,
            success: function (res) {
                if (res.title) {
                    $('.editable-title').text(res.title);
                }
                if (res.logo_url) {
                    $('.editable-logo').attr('src', res.logo_url);
                }
                $('#headerEditModal').modal('hide');
            },
            error: function (xhr) {
                console.error(xhr.responseText);
                alert("Gagal update! Status: " + xhr.status);
            }
        });
    });
});
