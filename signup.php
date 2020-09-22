<html>
	<?php require_once 'config.php'?>
	<?php require_once (ROOT_PATH .'\includes\header.php')?>
	<?php require_once (ROOT_PATH .'\includes\navigation.php')?>
	<head>
		<title>Website Project</title>
		<link rel="stylesheet" type="text/css" href="css/signup.css">
	</head>
	
	<?php

		//gets the signed in status from home.php
		$signedInStatus = $_SESSION['signedInStatus'];
	?>
	
	<body>

			
			<div class="title">
				<label class="titleLabel"> SIGNUP </label>
			</div>
			
			<?php
				
			?>
			
			<!--SIGNUP FORM-->
			<div class="signupForm">
				<form action="login.php" method="post">
					<table class="signupFormTable">
						<tr><td><label class="signupDetails"> Username: </label></td>
						<td><input class="signupInput" type="text" name="username" Placeholder="Username.."/></td></tr>
						<tr><td><label class="signupDetails"> Password: </label></td>
						<td><input class="signupInput" type="text" name="password" Placeholder="Password.."/></td></tr>
						<tr><td><label class="signupDetails"> Confirm Password: </label></td>
						<td><input class="signupInput" type="text" name="confirmPassword" Placeholder="Confirm Password.."/></td></tr>
					</table>
				
					<ul class="signupForm">
						<li><input class="signUpAcc" type="submit" name="signUpAcc" value="Register"/></li>
				</form>
				<form action="login.php" method="post">					
					<li><label class="signupDetails"> Already have an account? </label>
					<input class="loginAcc" type="submit" value="Login Here"/></li>
				</form>
				</ul>
				
				
			</div>
			
			<!--FOOTER-->
			<div class="footer">
				
			</div>
		</div>
		
	</body>
</html>