<!DOCTYPE html>
<?php 
session_start();
if (isset($_SESSION['email'])) {
	echo '<script> var logged_in_user = '.$_SESSION["userid"].'; </script>';
}
else{
    echo '<script> var logged_in_user = false; </script>';
}
?>

<!--[if IE 8]> <html class="no-js lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en"> <!--<![endif]-->
<head>
	<?php
		include_once ('inc/head.php');
    ?>
    <link rel="stylesheet" type="text/css" href="css/jquery.mobile.simpledialog.min.css" /> 
</head>
<body>
    <div id="yez" class="container" data-role="page">
        <div class="topBanner" data-role="header">
        	<div style="float:left;"><a href="#nav"><button id="llls" data-icon="info" value="Info"></button></a></div>
                    PhotoBrawler

                    <!--<div style="float:right;"><a href=""><button id="llls" data-icon="gear" value="Tools"></button></a>
                    </div>-->

                    <?php if (isset($_SESSION['email'])) { ?>
                    <div id="lko" class="btn-group" style="float:right;">
                    	<a class="btn btn-primary dropdown-toggle" data-toggle="dropdown" href="#">
                    		Tools
                    		<span class="caret"></span>
                    	</a>
                    	<ul class="dropdown-menu" style="right: 0; left: auto;">
                            <!-- dropdown menu links -->
                            <li id="mobileCamera"><a href="#">Capture photo</a></li>
                    		<li id="fees"><a id="delMode" href="#">Deletemode OFF</a></li>
                    		<li><a id="pubMode" href="#">Public/Unpublic OFF</a></li>
                            <li class="divider"></li>
							<li><a href="logout">Logout</a></li>
                    	</ul>
                    </div>
                    <?php } else {} ?>

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
    <script src="js/libs/jquery.mobile-1.3.0.min.js"></script>
    <script src="js/libs/jquery.mobile.simpledialog2.min.js"></script>
    <script src="js/back.js"></script>
    <script src="js/simpledialog.js"></script>
    
    <script src="js/imgload.js"></script>
    <script src="js/jqform.js"></script>
    <script src="js/buttons.js"></script>

</body>
</html>
