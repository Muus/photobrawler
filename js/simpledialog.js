$(document).delegate('#delMode', 'click', function() {

    if (masterMode == 2) {
        dialogMsg('on');
    } else if (masterMode == 0) {
        dialogMsg('off'); 
    }

    function dialogMsg (a) {
        $('<div>').simpledialog2({
            mode: 'button',
            zindex: '9999',
            buttonPrompt: 'Delete mode is now ' + a +'</br><a id="qweasd" href="#" class="btn btn-primary" style="color:#fff;"><i class="icon-ok icon-white"></i> Confirm</a>',
            buttons : {
                'OK': {
                    click: function () {}
                },
            }
        });
        cssFixClick();
    }

    function cssFixClick () {
        $('.ui-simpledialog-controls').remove();
        $('#qweasd').click(function () {
            $('.ui-simpledialog-screen').fadeOut(400);
            $('.ui-simpledialog-container').remove();
            $('.ui-dialog').fadeOut(400);
            setTimeout(function () {
                $('.ui-simpledialog-screen').remove();
                $('.ui-dialog').remove();
            },400);
        });
    }

})
