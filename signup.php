<html>
	<?php require_once 'config.php'?>
	<?php require_once (ROOT_PATH .'\includes\header.php')?>
	<?php require_once (ROOT_PATH .'\includes\navigation.php')?>
	<head>
		<title>Website Project</title>
		<link rel="stylesheet" type="text/css" href="css/signup.css">
	</head>
	
	<body>

			
			<div class="title">
				<label class="titleLabel"> SIGNUP </label>
			</div>
			
			<?php
				global $user;
				
				$userRegistrationError = "";
				
				if(isset($_POST['signUpAcc'])){
					$username = $email = $age = $gender = $password = $confirmPassword = "";
					
					if ($_SERVER["REQUEST_METHOD"] == "POST") {
						if(!empty($_POST["username"])) $username = $_POST["username"];
						if(!empty($_POST["email"])) $email = $_POST["email"];
						if(!empty($_POST["age"])) $age = $_POST["age"];
						if(!empty($_POST["gender"])) $gender = $_POST["gender"];
						if(!empty($_POST["password"])) $password = $_POST["password"];
						if(!empty($_POST["confirmPassword"])) $confirmPassword = $_POST["confirmPassword"];
					}
					
					if(!empty($username) && !empty($email) && !empty($age) && !empty($gender)){
						$statement = "select * from userdetails where Username = '$username'";
						$result = mysqli_query($user,$statement);
						$usernameQuery = mysqli_fetch_array($result);
						if(!empty($usernameQuery))
						{
							$userRegistrationError = "Username is taken";
						}
						else if(!empty($confirmPassword) && !empty($password) && ($confirmPassword == $password)){
							register($user,$username,$email,$age,$gender,$password,$confirmPassword);
						} else {
							$userRegistrationError = "Passwords do not match!";
						}
					} else {
						$userRegistrationError = "Complete all fields!";
					}
				}
				
				function register($user,$username,$email,$age,$gender,$password,$confirmPassword){
					//add to userdetails
					$userdetailsQuery = "insert into userdetails values('".$username."','".$password."','".$age."','".$email."','".$gender."',LOAD_FILE('C:/xampp/htdocs/ProgHub/pictures/user.png'),'','0')";
					//$userdetailsQuery = "insert into userdetails values('".$username."','".$password."','".$age."','".$email."','".$gender."','/pictures/user.png','','0')";
					mysqli_query($user,$userdetailsQuery);
					
					//add to login
					$loginQuery = "insert into login values('".$username."','".$password."','False','User')";
					mysqli_query($user,$loginQuery);
					header("Location: login.php");
				}
			?>
			
			<!--SIGNUP FORM-->
			<div class="signupForm">
				<form method="post">
					<table class="signupFormTable">
						<tr><td><label class="signupDetails"> Username: </label></td>
						<td><input class="signupInput" type="text" name="username" size='30' Placeholder="Username.."/></td></tr>
						<tr><td><label class="signupDetails"> Email: </label></td>
						<td><input class="signupInput" type="email" name="email" size='30' Placeholder="Email.."/></td></tr>
						<tr><td><label class="signupDetails"> Age: </label></td>
						<td><input class="signupInput" type="text" name="age" size='30' Placeholder="Age.."/></td></tr>
						<tr><td><label class="signupDetails"> Gender: </label></td>
						<td><input class="radioInput" type="radio" name="gender" value="M"/> M <input class="radioInput" type="radio" name="gender" value="F"/> F </td></tr>
						<tr><td><label class="signupDetails"> Password: </label></td>
						<td><input class="signupInput" type="password" name="password" size='30' Placeholder="Password.."/></td></tr>
						<tr><td><label class="signupDetails"> Confirm Password: </label></td>
						<td><input class="signupInput" type="password" name="confirmPassword" size='30' Placeholder="Confirm Password.."/></td></tr>
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