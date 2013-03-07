$(function () { 
  
    console.log('buttons.js');

    $('#mobileCamera').click(function (e) {
        e.preventDefault();
        $('#fileSelect').trigger('click');
    });

    $('#fileSelect').change(function () {
        var photoName = prompt('Name your photo');
        $('#photoName').val(photoName);
        $("#mobileCameraForm")[0].submit();
    });

    $('#photoGrid > div').each(function () {
        console.log(this);
    });

});
