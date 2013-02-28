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

	echo 'user is kinda logged in';
	
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
	<meta charset="utf-8" />

	<!-- Set the viewport width to device width for mobile -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

	<title>Welcome to PhotoBrawler!</title>

	<!-- Included CSS Files -->
	<link rel="stylesheet" href="css/app.css">
	
	<meta name="HandheldFriendly" content="True">
	<meta name="MobileOptimized" content="320">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	
	<script>document.cookie='resolution='+Math.max(screen.width,screen.height)+'; path=/';</script>
	
	<!-- eCSSential stylesheets -->
	<script src="js/libs/ecssential.min.js"></script>
	<script>
		eCSSential({
			"all": "css/all.css",
			"(min-width: 200px)": "css/480px.css",
			"(min-width: 600px)": "css/600px.css",
			"(min-width: 768px)": "css/768px.css",
			"(min-width: 992px)": "css/992px.css"
		},{ oldIE: true } );
	</script>
	
	<!-- fallback -->
	<noscript>
		<link rel="stylesheet" href="css/all.css">
		<link rel="stylesheet" href="css/480px.css">
		<link rel="stylesheet" href="css/600px.css">
		<link rel="stylesheet" href="css/768px.css">
		<link rel="stylesheet" href="css/992px.css">
		<!--[if IE 7]><link rel="stylesheet" href="assets/css/font-awesome-ie7.css"><![endif]-->
	</noscript>

</head>
<body>

	<div class="container">
		<div class="topBanner">
			PhotoBrawler
		<?php if(isset($_SESSION['email'])){
			echo 'Logged in';
		}
			?>

	    </div>
	    
	    <div id="lozz" class="photoGrid">
		    <!--<img src="inc/photos/glasses.jpg">-->
		    
	    </div>

 <form id="mobile-camera-form" action="inc/upload_photo.php" method="post" enctype="multipart/form-data">
                        <p id="mobile-camera" class="large button">Capture photo</p>
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
