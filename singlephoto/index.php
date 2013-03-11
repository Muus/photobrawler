<!DOCTYPE html>
<head>
	<?php
//include_once ('../inc/head2.php');
	$dat_link = $_GET['phid'];
    $photo_name = $_GET['name'];
	 //<?php echo $photo_name; ?>
	?>
	<?php 
echo "<script> 

</script>"

?>
</head>
<body>

	<div id="yesss" data-role="page" class="container" data-add-back-btn="true">
		<div data-role="header" class="topBanner">
		</div><!-- /header -->
		<div data-role="content">

			<div class="photoFrame">
				<div class="photoSingel thumbnail">
					<img id="dude" src="<?php echo '../'.$dat_link;?>" alt=" " />

                    <p>Name:</p><h3 class="photoTitle" style="border-style:solid;"></h3>
					<p>Description:</p><article class="photoDescription" id="photoDesc" style="border-style:solid;"></article>
				</div>
			</div>

		</div><!-- /content -->
		<div data-role="footer" style="display:none;">
			<h4>Page Footer</h4>
		</div><!-- /header -->
	</div>

	<body>
		</html>
