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
            buttonPrompt: 'Delete mode is now ' + a,
            buttons : {
                'OK': {
                    click: function () {}
                },
            }
        })
    }

})
