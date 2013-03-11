$(function () {
    $('#mobileCamera').click(function (e) {
        e.preventDefault();
        $('#fileSelect').trigger('click');
    });

    $('#fileSelect').change(function () {
       // var photoName = prompt('Name your photo');
	   
        $('#photoName').val('kurre');
        //$("#mobileCameraForm")[0].submit(function(event) {
		//return false;
        /* stop form from submitting normally */
  
        event.preventDefault();
        $('#mobileCameraForm')[0].submit();
    /*clear result div*/
    //esult").html('');

    /* get some values from elements on the page:
    var values = $(this).serialize();
	console.log(values);
    /* Send the data using post and put the results in a div
    $.ajax({
      url: "/photobrawler/inc/upload_photo.php",
      type: "post",
      data: values,
      success: function(){
          alert(values);
           $("#result").html('submitted successfully');
      },
      error:function(){
          alert("failure");
          $("#result").html('there is error while submit');
      }   
    });
	*/
	 
    });
    //});
	
	/* attach a submit handler to the form */

});
