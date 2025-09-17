
$(document).ready(function () {


    $('#edit-features-section').on('click', function(){
        $('#featureSubtitle').val($('.editable-feature-subtitle').text().trim());
        $('#featureTitle').val($('.editable-feature-title').text().trim());

        let html = '';
        $('#featureItems .feature-item').each(function(i){
            let icon = $(this).find('.editable-feature-icon').text().trim();
            let heading = $(this).find('.editable-feature-heading').text().trim();
            let desc = $(this).find('.editable-feature-desc').text().trim();

            html += `
                <div class="feature-item-form border rounded p-3 mb-3">
                    <div class="mb-2">
                        <label>Icon</label>
                        <input type="text" name="items[${i}][icon]" class="form-control" value="${icon}">
                    </div>
                    <div class="mb-2">
                        <label>Heading</label>
                        <input type="text" name="items[${i}][heading]" class="form-control" value="${heading}">
                    </div>
                    <div class="mb-2">
                        <label>Description</label>
                        <textarea name="items[${i}][desc]" class="form-control" rows="2">${desc}</textarea>
                    </div>
                    <button type="button" class="btn btn-sm btn-danger remove-feature">Hapus</button>
                </div>
            `;
        });

        $('#featureItemsForm').html(html);
        $('#editFeaturesModal').modal('show');
    });

    // Tambah item baru
    $('#addFeatureItem').on('click', function(){
        let i = $('#featureItemsForm .feature-item-form').length;
        let html = `
            <div class="feature-item-form border rounded p-3 mb-3">
                <div class="mb-2">
                    <label>Icon</label>
                    <input type="text" name="items[${i}][icon]" class="form-control" value="">
                </div>
                <div class="mb-2">
                    <label>Heading</label>
                    <input type="text" name="items[${i}][heading]" class="form-control" value="">
                </div>
                <div class="mb-2">
                    <label>Description</label>
                    <textarea name="items[${i}][desc]" class="form-control" rows="2"></textarea>
                </div>
                <button type="button" class="btn btn-sm btn-danger remove-feature">Hapus</button>
            </div>
        `;
        $('#featureItemsForm').append(html);
    });

    // Hapus item
    $(document).on('click', '.remove-feature', function(){
        $(this).closest('.feature-item-form').remove();
    });

    // Submit form
    $('#editFeaturesForm').on('submit', function(e){
        e.preventDefault();
        let formData = new FormData(this);

        $.ajax({
            url: '/admin/update-features',
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(res){
                // Update judul section
                $('.editable-feature-subtitle').text(res.subtitle ?? '');
                $('.editable-feature-title').text(res.title ?? '');

                // Update items
                let html = '';
                if (res.items && Array.isArray(res.items)) {
                    res.items.forEach(item => {
                        html += `
                            <div class="col-lg-4 col-md-6 feature-item">
                                <div class="key-features-single-item">
                                    <i class="material-symbols-outlined wh-87 bg-primary bg-opacity-25 d-inline-block text-primary editable-feature-icon">
                                        ${item.icon}
                                    </i>
                                    <h3 class="editable-feature-heading">${item.heading}</h3>
                                    <p class="editable-feature-desc" style="font-size:16px;">${item.desc}</p>
                                </div>
                            </div>`;
                    });
                }
                $('#featureItems').html(html);

                $('#editFeaturesModal').modal('hide');
            },
            error: function(xhr){
                alert("Gagal update features!");
            }
        });
    });
});