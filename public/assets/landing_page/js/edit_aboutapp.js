$(document).ready(function () {
    // Buka modal dan isi data
    $('#edit-about-section').on('click', function () {
        $('#aboutTitle').val($('.editable-about-title').text().trim());
        $('#aboutDesc').val($('.editable-about-desc').text().trim());

        $('#aboutItemsForm').empty();
        $('#aboutItems li').each(function () {
            let heading = $(this).find('.editable-about-heading').html().trim();
            let desc = $(this).find('.editable-about-item-desc').text().trim();

            $('#aboutItemsForm').append(`
                <div class="about-item border rounded p-3 mb-2">
                    <div class="mb-2">
                        <label class="form-label">Heading</label>
                        <input type="text" class="form-control" name="items[][heading]" value="${heading}">
                    </div>
                    <div class="mb-2">
                        <label class="form-label">Deskripsi</label>
                        <textarea class="form-control" name="items[][desc]" rows="2">${desc}</textarea>
                    </div>
                    <button type="button" class="btn btn-sm btn-danger removeAboutItem">
                        <i class="ri-delete-bin-line"></i> Hapus
                    </button>
                </div>
            `);
        });

        $('#editAboutModal').modal('show');
    });

    // Tambah item baru
    $('#addAboutItem').on('click', function () {
        $('#aboutItemsForm').append(`
            <div class="about-item border rounded p-3 mb-2">
                <div class="mb-2">
                    <label class="form-label">Heading</label>
                    <input type="text" class="form-control" name="items[][heading]">
                </div>
                <div class="mb-2">
                    <label class="form-label">Deskripsi</label>
                    <textarea class="form-control" name="items[][desc]" rows="2"></textarea>
                </div>
                <button type="button" class="btn btn-sm btn-danger removeAboutItem">
                    <i class="ri-delete-bin-line"></i> Hapus
                </button>
            </div>
        `);
    });

    // Hapus item
    $(document).on('click', '.removeAboutItem', function () {
        $(this).closest('.about-item').remove();
    });

    // Submit form
    $('#editAboutForm').on('submit', function (e) {
        e.preventDefault();

        let formData = new FormData(this);

        $.ajax({
            url: "/admin/update-aboutapp",
            method: "POST",
            data: formData,
            processData: false,
            contentType: false,
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            success: function (res) {
                // Update UI
                $('.editable-about-title').text(res.title);
                $('.editable-about-desc').text(res.description);

                let itemsHtml = '';
                res.items.forEach(function (item) {
                    itemsHtml += `
                        <li>
                            <div class="d-flex">
                                <div class="flex-shrink-0">
                                    <i class="material-symbols-outlined fs-20 text-primary">done_outline</i>
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <h3 class="editable-about-heading">${item.heading}</h3>
                                    <p class="editable-about-item-desc">${item.desc}</p>
                                </div>
                            </div>
                        </li>`;
                });
                $('#aboutItems').html(itemsHtml);

                $('#editAboutModal').modal('hide');
            },
            error: function (xhr) {
                alert('Terjadi kesalahan: ' + xhr.responseText);
            }
        });
    });
});
