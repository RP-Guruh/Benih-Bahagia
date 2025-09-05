
$(document).ready(function() {

    $(document).on('click', '.add-row', function() {
        var newRow = $(this).closest('.permission-row').clone();
        newRow.find('select').val('');
        newRow.find('.add-row')
              .removeClass('btn-success add-row')
              .addClass('btn-danger remove-row')
              .text('−');
        $('#permission-rows').append(newRow);
    });

    // Remove row
    $(document).on('click', '.remove-row', function() {
        $(this).closest('.permission-row').remove();
    });
});
