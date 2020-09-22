<html>
	<?php require_once 'config.php'?>
	<?php require_once (ROOT_PATH .'\includes\header.php')?>
	<?php require_once (ROOT_PATH .'\includes\navigation.php')?>
	<head>
		<title>Website Project</title>
		<link rel="stylesheet" type="text/css" href="css/login.css">
	</head>
	
	<?php

		
		//gets the signed in status from home.php
		$signedInStatus = $_SESSION['signedInStatus'];
		//if log in button is pressed, create a new session variable to be used in home.php and go to home.php
		if(isset($_POST['logInAcc'])){
			$_SESSION['signedInLogin'] = true;
			header("Location: home.php");
		}

	?>
	
	<body>
			
			<div class="title">
				<label class="titleLabel"> LOGIN </label>
			</div>
			
			<?php
				
			?>
			
			<!--LOGIN FORM-->
			<div class="loginForm">
				<ul class="loginForm">
					<form method="post">
						<li><!--<label class="loginDetails"> Username: </label>-->
						<input class="loginInput" type="text" name="username" Placeholder="Username.."/></li>
						<li><!--<label class="loginDetails"> Password: </label>-->
						<input class="loginInput" type="text" name="password" Placeholder="Password.."/></li>
						<li><input class="logInAcc" type="submit" name="logInAcc" value="Log In"/></li>
					</form>
					<form action="signup.php" method="post">					
						<li><label class="loginDetails"> Don't have an account yet? </label>
						<input class="signUpAcc" type="submit" value="Sign Up Now"/></li>
					</form>
				</ul>
			</div>
			
			<!--FOOTER-->
			<div class="footer">
				
			</div>
		</div>
		
	</body>
</html>