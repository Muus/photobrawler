<?php
$dat_link = $_GET['phid'];
$photo_name = $_GET['name'];
?>

<?php
echo "<script> 


</script>"

?>
<<<<<<< HEAD

<div id="singelphoto" data-role="page" class="container" >
	<div data-role="header" class="topBanner">
		<div class="userBtn">
			<a href="#" data-rel="back">
				<button class="btn"><i class="icon-arrow-left"></i></button>
			</a>
		</div>

		<div class="logo">
			  <center>PhotoBrawler</center>
		</div>
	</div><!-- /header -->
	<div data-role="content">

		<div class="photoFrame">
			<div class="photoSingel thumbnail">
				<img id="dude" src="<?php echo '../'.$dat_link;?>" alt=" " />

				<p>Name:</p><h3 class="photoTitle"></h3>
				<p>Description:</p><article class="photoDescription" id="photoDesc""></article>
			</div>
		</div>

	</div><!-- /content -->
</div>
=======
</head>
<body>

	<div id="singelphoto" data-role="page" class="container" >
		<div data-role="header" class="topBanner">
			<div class="userBtn"><a href="#" data-rel="back"><button class="btn"><i class="icon-circle-arrow-left"></i></button></a></div>
		</div><!-- /header -->
		<div data-role="content">

			<div class="photoFrame">
				<div class="photoSingel thumbnail">
					<img id="dude" src="<?php echo '../'.$dat_link;?>" alt=" " />

                    <p>Name:</p><h3 id="photTitle" class="photoTitle" style="border-style:solid;"></h3>
					<p>Description:</p><article class="photoDescription" id="photoDesc" style="border-style:solid;"></article>
				</div>
			</div>

		</div><!-- /content -->
		<div data-role="footer" style="display:none;">
			<h4>Page Footer</h4>
		</div><!-- /header -->
	</div>
	<script>
	
	</script>
	<body>
		</html>
>>>>>>> 81157dfa56f94a2f52519ccdb5abfc71cc66aee9
