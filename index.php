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
                 <div style="float:right;"><a href="#nav"><button id="llls" data-icon="gear" value="Tools"></button></a>
                    </div>
        </div>
	    <div id="11" data-role="content">
            <form id="mobile-camera-form" action="inc/upload_photo.php" method="post" enctype="multipart/form-data">
                <button id="mobile-camera">Capture photo</button>
                <div class="mobile-camera">
                    <div style="display:none;">
                        <input type="file" name="photo" accept="image/*" capture="camera" />
                        <input type="text" id="photo-name" name="photo-name" />
                    </div>
                </div>
            </form>
            <div id="photoGrid" class="photoGrid">	        
        
            </div>
	    </div>
        <div data-role="panel" data-display="push" id="nav" data-position="right">
            <ul>
                <li>QWERTY</li>
                <li>ASDFGH</li>
            </ul>
            <?php
                if (isset($_SESSION['email'])) {
                    echo'<div style="float:right;"><button id="lll" data-icon="delete" value="NO MODE"></button>
                    </div>';
                }
                ?>
        </div>
    	<div data-role="footer"></div>
    
        </div>
    </div>
	<!-- Included JS Files (Uncompressed) -->
	<script src="js/libs/jquery-1.7.js"></script>
	<script src="js/libs/underscore.js"></script>
	<script src="js/libs/backbone.js"></script>
    <script src="js/back.js"></script>
    <script src="js/libs/jquery.mobile-1.3.0.min.js"></script>

    <script src="js/buttons.js"></script>

</body>
</html>
