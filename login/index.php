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

        <div id="login-content" class="loginCont">
            <!--<form action="../inc/login/login.php" method="post" >
                <fieldset id="inputs">
                    <input id="email" type="email" name="email" placeholder="Your Email" required>
                    <input id="password" type="password" name="password" placeholder="Password" required>
                </fieldset>
                <fieldset id="actions">
                    <input type="submit" id="submit" value="Log in">
                </fieldset>
            </form>-->
            
            <form class="form-horizontal" action="../inc/login/login.php" method="post">
            	<div class="control-group">
                	<label class="control-label" for="inputEmail">Email</label>
                	<div class="controls">
                  		<input type="text" id="email" placeholder="Email" name="email" required>
                	</div>
              	</div>
              	<div class="control-group">
                	<label class="control-label" for="inputPassword">Password</label>
                	<div class="controls">
                  		<input type="password" id="password" name="password" placeholder="Password" required>
                	</div>
              	</div>
              	<div class="control-group">
              		<div class="controls" id="actions">
                  		<button type="submit" class="btn" id="submit">Sign in</button>
                	</div>
            	</div>
            </form>
        </div>
	</div>
<body>
</html>