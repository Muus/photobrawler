<!DOCTYPE html>
<?php 
session_start();
if (isset($_SESSION['email'])) {
	echo '
<script>
	var logged_in_user = '.$_SESSION["userid"].';
	
</script>
    <a href="logout/"><button>LOGOUT</button></a>
	';

	echo 'user is logged in';
	
}
else{
	//<a href="login/"><button>LOGIN</button></a>
    echo '
    
<script>
    var logged_in_user = false;
</script>
	';

}
include('inc/dbClass.php');
$db = new Db();
$db->connector();
?>

<!--[if IE 8]> <html class="no-js lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en"> <!--<![endif]-->
<head>
	<?php
		include_once ('inc/head.php');
	?>
</head>
<body>
	
	
	<div id="yez" class="container" data-role="page">

		<div class="topBanner" data-role="header">
			PhotoBrawler

            
		<div style="float:right;"><button id="lll" data-icon="delete" value="Delete mode is OFF"></button>
	    </div>
	    

	</div>
	    <div id="11" data-role="content">
	    
	    <div id="photoGrid" class="photoGrid">
		        
	    </div>

		<!--<form id="mobile-camera-form" action="inc/upload_photo.php" method="post" enctype="multipart/form-data">
            <button id="mobile-camera" class="btn btn-large btn-primary" >Capture photo</button>
            <div class="mobile-camera">
                <input type="file" name="photo" accept="image/*" capture="camera" />
                <div style="display:none;"><input type="text" id="photo-name" name="photo-name" /></div>
            </div>
        </form>-->

	</div>
	<div data-role="footer"></div>
	</div>
	<!-- Included JS Files (Uncompressed) -->
	<script src="js/libs/jquery-1.7.js"></script>
	<script src="js/jqtouch.js"></script>
	<script src="js/jqtouch-jquery.js"></script>
	<script src="js/libs/underscore.js"></script>
	<script src="js/libs/backbone.js"></script>
    <script src="js/back.js"></script>
    <script src="js/buttons.js"></script>
    <script src="js/jquery.mobile-1.3.0.min.js"></script>


</body>
</html>
