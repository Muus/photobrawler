<?php
$dat_link = $_GET['phid'];
$photo_name = $_GET['name'];
?>

<?php
echo "<script> 


</script>"

?>

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
