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
            
            <form action="../inc/login/login.php" method="post">
            	<fieldset>
                
                    <label>Email</label>
                    <div class="input-prepend">
                    	<span class="add-on"><i class="icon-user"></i></span>
                		<input class="span3 control-label" type="text" id="email" placeholder="Email" name="email" required>
                    </div>
                    
                    <label>Password</label>
                    <div class="input-prepend">
                    	<span class="add-on"><i class="icon-lock"></i></span>
						<input class="span3 control-label" type="password" id="password" name="password" placeholder="Password" required>
					</div><br />
                  	<button type="submit" class="btn" id="submit">Sign in</button>
                	
            	</fieldset>
            </form>
        </div>
	</div>
<body>
</html>