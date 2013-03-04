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
	
}else{
    echo '
    <a href="login/"><button>LOGIN</button></a>
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
	<div class="container">
		<div class="topBanner">
			PhotoBrawler

            <?php if(isset($_SESSION['email'])){
                echo 'Logged in';
            } ?>

	    </div>
	    
	    <div id="photoGrid" class="photoGrid">
		    <img src="inc/photos/glasses.jpg">
		    <img src="inc/photos/glasses.jpg">
		    <img src="inc/photos/glasses.jpg">
		    <img src="inc/photos/glasses.jpg">
		    <img src="inc/photos/glasses.jpg">
		    <img src="inc/photos/glasses.jpg">	    
	    </div>

		<form id="mobile-camera-form" action="inc/upload_photo.php" method="post" enctype="multipart/form-data">
            <button id="mobile-camera" class="btn btn-large btn-primary" >Capture photo</button>
            <div class="mobile-camera">
                <input type="file" name="photo" accept="image/*" capture="camera" />
                <input type="text" id="photo-name" name="photo-name" />
            </div>
        </form>

	</div>
	<!-- Included JS Files (Uncompressed) -->
	<script src="js/libs/jquery-1.7.js"></script>
	<script src="js/jqtouch.js"></script>
	<script src="js/jqtouch-jquery.js"></script>
	<script src="js/libs/underscore.js"></script>
	<script src="js/libs/backbone.js"></script>
    <script src="js/back.js"></script>
    <script src="js/buttons.js"></script>
</body>
</html>
