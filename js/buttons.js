$(function () { 
   
    $('#mobileCamera').click(function (e) {
        e.preventDefault();
        $('#fileSelect').trigger('click');
    });

    $('#fileSelect').change(function () {
        var photoName = prompt('Name your photo');
        $('#photoName').val(photoName);
        $("#mobileCameraForm")[0].submit();
    });

});
