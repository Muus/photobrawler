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
        	<div style="float:left;"><a href="#nav"><button id="llls" data-icon="info" value="Info"></button></a></div>
                    PhotoBrawler
                    <!--<div style="float:right;"><a href=""><button id="llls" data-icon="gear" value="Tools"></button></a>
                    </div>-->

                    <?php if (isset($_SESSION['email'])) { ?>
                    <div id="lko" class="btn-group" style="float:right; margin-right:100px;">
                    	<a class="btn btn-primary dropdown-toggle" data-toggle="dropdown" href="#">
                    		Tools
                    		<span class="caret"></span>
                    	</a>
                    	<ul class="dropdown-menu">
                            <!-- dropdown menu links -->
                            <li id="mobileCamera"><a href="#">Capture photo</a></li>
                    		<li id="fees"><a id="delMode" href="#">Deletemode OFF</a></li>
                    		<li><a id="pubMode" href="#">Public/Unpublic OFF</a></li>

                    	</ul>
                    </div>
                    <?php } else {} ?>

                    <a style="position:absolute; left:-9988px;" id="deleteMode" href="delete-dialog.php" data-rel="dialog">Delete Mode</a>
        </div>
	    <div id="11" data-role="content">
            <form id="mobileCameraForm" action="/photobrawler/inc/upload_photo.php" method="post" enctype="multipart/form-data">
                <div class="mobile-camera">
                    <div style="position:absolute; left:-9999px;"> 
                        <input id="fileSelect" type="file" name="photo" accept="image/*" capture="camera" />
                        <input id="photoName" type="text" name="photo-name" />
                    </div>
                </div>
            </form>
            <div id="photoGrid" class="photoGrid">	        
        
            </div>
        </div>
         
        <?php 
        include('inc/info_panel.php');
        ?>
    	<div data-role="footer" style="display:none;"></div>
    
        </div>
    </div>
	<!-- Included JS Files (Uncompressed) -->
	<script src="js/libs/jquery-1.7.js"></script>
	<script src="js/libs/underscore.js"></script>
	<script src="js/libs/backbone.js"></script>
	<script src="js/libs/bootstrap.js"></script>
    <script src="js/back.js"></script>
    <script src="js/libs/jquery.mobile-1.3.0.min.js"></script>

    <script src="js/buttons.js"></script>

</body>
</html>
