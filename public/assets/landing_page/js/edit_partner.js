$(document).ready(function () {
    $('#edit-partners-section').on('click', function(){
        // isi judul-subjudul-deskripsi
        $('#partnerTitle').val($('.editable-partner-title').text().trim());
        $('#partnerSubtitle').val($('.editable-partner-subtitle').text().trim());
        $('#partnerDescription').val($('.editable-partner-description').text().trim());

        // isi logo lama + input file ganti
        let html = '';
        $('.editable-partner-logo').each(function(i){
            let src = $(this).attr('src');
            html += `
                <div class="col-12 col-md-6">
                    <div class="border rounded p-2">
                        <label>Logo Partner ${i+1}</label>
                        <input type="hidden" name="old_logos[${i}]" value="${src.replace(window.location.origin + '/', '')}">
                        <input type="file" name="logos[${i}]" class="form-control mb-2 preview-input">
                        <img src="${src}" class="img-fluid border rounded preview-img" style="max-height:80px;">
                    </div>
                </div>
            `;
        });
        // tambahan: slot upload logo baru
        html += `
            <div class="col-12">
                <label>Tambah Logo Baru</label>
                <input type="file" name="new_logos[]" class="form-control mb-2 preview-input" multiple>
                <div id="newLogosPreview" class="d-flex gap-2 flex-wrap"></div>
            </div>
        `;

        $('#partnerLogosForm').html(html);

        $('#partnerSectionModal').modal('show');
    });

    // live preview saat pilih file
    $(document).on('change', '.preview-input', function(e){
        let input = this;
        let img = $(this).siblings('.preview-img');
        if (input.files && input.files[0]) {
            let reader = new FileReader();
            reader.onload = function(e){
                if (img.length) {
                    img.attr('src', e.target.result);
                } else {
                    // untuk multiple new logos
                    $('#newLogosPreview').append(
                        `<img src="${e.target.result}" class="img-fluid border rounded" style="max-height:80px;">`
                    );
                }
            }
            reader.readAsDataURL(input.files[0]);
        }
    });

    // tombol reset
    $('#resetPartnerLogos').on('click', function(){
        if (confirm('Yakin reset ke default?')) {
            $('#resetFlag').val('1');
            $('#partnerLogosForm').html('<p class="text-muted">Akan kembali ke gambar default.</p>');
        }
    });

    // submit form
    $('#partnerSectionForm').on('submit', function(e){
        e.preventDefault();
        let formData = new FormData(this);

        $.ajax({
            url: '/admin/update-partners-section',
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(res){
                $('.editable-partner-title').text(res.title ?? '');
                $('.editable-partner-subtitle').text(res.subtitle ?? '');
                $('.editable-partner-description').text(res.description ?? '');

                let html = '';
                if (res.logos && Array.isArray(res.logos)) {
                    res.logos.forEach(path => {
                        html += `
                            <div class="col-6 col-md-3 text-center partner-logo">
                                <img src="${path}" class="img-fluid partner-img editable-partner-logo">
                            </div>`;
                    });
                }
                $('#partnerLogos').html(html);
                $('#partnerSectionModal').modal('hide');
            },
            error: function(){
                alert("Gagal update asosiasi!");
            }
        });
    });
});
