$(function () {
    $('#mobile-camera').click(function () {
        $('.mobile-camera > input[type="file"]').trigger('click');
    });

    $('.mobile-camera > input[type="file"]').change(function (e) {
        var photoName = prompt('Name your photo');
        $('#photo-name').val(photoName);
        $("#mobile-camera-form")[0].submit();
    });

    $('#mobile-gallery').click(function () {
        $('.mobile-gallery > input[type="file"]').trigger('click');
    });

    $('.mobile-gallery > input[type="file"]').change(function () {
        var photoName = prompt('Name your photo');
        $('#photo-name').val(photoName);
        $("#mobile-gallery-form")[0].submit();
    });

});
