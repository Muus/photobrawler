<!DOCTYPE html>
<head>
	<?php
		include_once ('../inc/head2.php');
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
       
		<div class="photoFrame">
       		<div class="photoSingel thumbnail">
            	<img src="../inc/photos/glasses.jpg" alt=" " />

                <h3 class="photoTitle">Lorem ipsum dolor sit amet</h3>
                <article class="photoDescription">consectetur adipiscing elit. Donec mattis eros magna, sit amet tempus dui. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Fusce felis elit, accumsan quis blandit eu, tristique nec erat. Pellentesque laoreet, arcu ut mollis tempor, ante risus varius odio, vitae dignissim arcu urna rhoncus neque. Morbi lacus tellus, malesuada eget aliquam in, rhoncus vel felis. Donec sollicitudin leo ut est pretium pellentesque. Aenean nisi magna, lobortis ut laoreet eu, commodo sit amet elit. Nullam augue libero, pellentesque non interdum vel, luctus vel risus. In et dolor et ante cursus ornare.</article>
            </div>
       	</div>
        
	</div>
<body>
</html>