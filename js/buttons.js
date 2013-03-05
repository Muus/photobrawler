$(function () { 
   
    $('#mobile-camera').click(function (e) {
        e.preventDefault();
        $('.ui-input-text > input[type="file"]').trigger('click');
    });

    $('.ui-input-text > input[type="file"]').change(function () {
        var photoName = prompt('Name your photo');
        $('#photo-name').val(photoName);
        $("#mobile-camera-form")[0].submit();
    });

});
