<!DOCTYPE html>
<head>
	<?php
  include_once ('../inc/head2.php');
  ?>
</head>
<body>
	<div class="container" id="yesss" data-role="page">
		<div class="topBanner" data-role="header">
			<div class="logo">
				<center>PhotoBrawler</center>
			</div>

            <?php if(isset($_SESSION['email'])){
                echo 'Logged in';
            } ?>

        </div><!-- /end header -->

        <div id="login-content" class="loginCont" data-role="content">
                       
            <form action="../inc/login/login.php" method="post" data-transition="slide">
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
   <div data-role="footer"> </div>
   <script src="js/libs/jquery.mobile-1.3.0.min.js"></script>
</div>

<body>
    </html>