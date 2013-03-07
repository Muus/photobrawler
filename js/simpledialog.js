$(document).delegate('#opendialog', 'click', function() {
    // NOTE: The selector can be whatever you like, so long as it is an HTML element.
    // If you prefer, it can be a member of the current page, or an anonymous div
    // like shown.
    $('<div>').simpledialog2({
        mode: 'button',
        zindex: '9999',
        headerText: 'Click One...',
        headerClose: true,
        buttonPrompt: 'Please Choose One',
        buttons : {
            'OK': {
                click: function () { 
                    $('#buttonoutput').text('OK');
                }
            },
            'Cancel':   {
                click: function () {
                    $('#buttonoutput').text('Cancel');
                },
                icon: "delete",
                theme: "c"
            }
        }
    })
})
