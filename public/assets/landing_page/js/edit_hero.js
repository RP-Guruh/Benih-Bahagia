$(document).ready(function () {
    $.ajaxSetup({
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
    });

    // Buka modal hero
    $('#edit-hero').on('click', function () {
        $('#heroTitle').val($('.editable-hero-title').text());
        $('#heroSubtitle').val($('.editable-hero-subtitle').text());
        $('#heroButtonText').val($('.editable-hero-button-text').text());
        $('#heroImagePreview').attr('src', $('.editable-hero-image').attr('src'));
        $('#heroEditModal').modal('show');
    });

    // Preview gambar saat pilih file
    $('#heroImage').on('change', function(e){
        let reader = new FileReader();
        reader.onload = function(e){
            $('#heroImagePreview').attr('src', e.target.result);
        }
        reader.readAsDataURL(this.files[0]);
    });

    // Submit form via AJAX
    $('#heroEditForm').on('submit', function(e){
        e.preventDefault();
        let formData = new FormData(this);

        $.ajax({
            url: "/admin/update-hero",
            type: "POST",
            data: formData,
            processData: false,
            contentType: false,
            success: function(res){
                if(res.hero_title) $('.editable-hero-title').text(res.hero_title);
                if(res.hero_subtitle) $('.editable-hero-subtitle').text(res.hero_subtitle);
                if(res.hero_button_text) $('.editable-hero-button-text').text(res.hero_button_text);
                if(res.hero_image_url) {
                    // Tambahkan timestamp supaya gambar langsung update tanpa cache
                    $('.editable-hero-image').attr('src', res.hero_image_url + '?t=' + new Date().getTime());
                }
                if(res.hero_image_url) {
                    window.location.reload();
                }
                $('#heroEditModal').modal('hide');

            },
            error: function(xhr){
                console.error(xhr.responseText);
                alert("Gagal update hero section!");
            }
        });
    });
});
