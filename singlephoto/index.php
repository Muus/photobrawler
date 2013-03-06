<!DOCTYPE html>
<head>
	<?php
//include_once ('../inc/head2.php');
	$dat_link = $_GET['phid'];
    $photo_name = $_GET['name'];
	?>
</head>
<body>

	<div id="yesss" data-role="page" class="container" data-add-back-btn="true">
		<div data-role="header" class="topBanner">
		</div><!-- /header -->
		<div data-role="content">

			<div class="photoFrame">
				<div class="photoSingel thumbnail">
					<img src="<?php echo '../'.$dat_link; ?>" alt=" " />

                    <h3 class="photoTitle"><?php echo $photo_name; ?></h3>
					<article class="photoDescription" id="photoDesc"></article>
				</div>
			</div>

		</div><!-- /content -->
		<div data-role="footer">
			<h4>Page Footer</h4>
		</div><!-- /header -->
	</div>

	<body>
		</html>
