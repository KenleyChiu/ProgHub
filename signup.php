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
				global $user;
				
				$userRegistrationError = "";
				
				if(isset($_POST['signUpAcc'])){
					global $username,$email,$age,$gender,$password,$confirmPassword;
					$username = $email = $age = $gender = $password = $confirmPassword = "";
					
					if ($_SERVER["REQUEST_METHOD"] == "POST") {
						if(!empty($_POST["username"])) $username = $_POST["username"];
						if(!empty($_POST["email"])) $email = $_POST["email"];
						if(!empty($_POST["age"])) $age = $_POST["age"];
						if(!empty($_POST["gender"])) $gender = $_POST["gender"];
						if(!empty($_POST["password"])) $password = $_POST["password"];
						if(!empty($_POST["confirmPassword"])) $confirmPassword = $_POST["confirmPassword"];
					}
					
					/*if(empty($_POST["username"]) || empty($_POST["email"]) || empty($_POST["age"]) || empty($_POST["gender"]) ||
						empty($_POST["password"]) || empty($_POST["confirmPassword"])){
						$userRegistrationError = "Complete all fields!";
					}*/
					
					if(!empty($_POST["username"]) && !empty($_POST["email"]) && !empty($_POST["age"]) && !empty($_POST["gender"]) &&
						!empty($confirmPassword)){
						if(!empty($password) && ($confirmPassword == $password)){
							//add to userdetails
							$userdetailsQuery = "insert into userdetails values('".$username."','".$password."','".$age."','".$email."','".$password."',LOAD_FILE('pictures/user.png'),
							'','0')";
							mysqli_query($user,$userdetailsQuery);
							
							//add to login
							$loginQuery = "insert into login values('".$username."','".$password."','False','User')";
							mysqli_query($user,$loginQuery);
							header("Location: login.php");
						} else {
							$userRegistrationError = "Passwords do not match!";
						}
					} else {
						$userRegistrationError = "Complete all fields!";
					}
				}
			?>
			
			<!--SIGNUP FORM-->
			<div class="signupForm">
				<form method="post">
					<table class="signupFormTable">
						<tr><td><label class="signupDetails"> Username: </label></td>
						<td><input class="signupInput" type="text" name="username" Placeholder="Username.."/></td></tr>
						<tr><td><label class="signupDetails"> Email: </label></td>
						<td><input class="signupInput" type="text" name="email" Placeholder="Email.."/></td></tr>
						<tr><td><label class="signupDetails"> Age: </label></td>
						<td><input class="signupInput" type="text" name="age" Placeholder="Age.."/></td></tr>
						<tr><td><label class="signupDetails"> Gender: </label></td>
						<td><input class="signupInput" type="radio" name="gender" value="M"/> M <input class="signupInput" type="radio" name="gender" value="F"/> F </td></tr>
						<tr><td><label class="signupDetails"> Password: </label></td>
						<td><input class="signupInput" type="text" name="password" Placeholder="Password.."/></td></tr>
						<tr><td><label class="signupDetails"> Confirm Password: </label></td>
						<td><input class="signupInput" type="text" name="confirmPassword" Placeholder="Confirm Password.."/></td></tr>
						<tr><td></td><td><span style="color:red"> <?php echo $userRegistrationError;?> </span></td></tr>
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