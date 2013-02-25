$(function () {
    $('#mobile-camera').click(function () {
        $('.mobile-camera > input[type="file"]').trigger('click');
    });

    $('.mobile-camera > input[type="file"]').change(function () {
        $("#mobile-form")[0].submit();
    });
});
