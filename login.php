<html>
	<?php require_once 'config.php'?>
	<?php require_once (ROOT_PATH .'\includes\header.php')?>
	<?php require_once (ROOT_PATH .'\includes\navigation.php')?>
	<head>
		<title>Website Project</title>
		<link rel="stylesheet" type="text/css" href="css/login.css">
	</head>
	
	<?php
		
		
		if(isset($_POST['logInAcc'])){
			
			header("Location: home.php");
		}

	?>
	
	<body>
			
			<div class="title">
				<label class="titleLabel"> LOGIN </label>
			</div>
			
			<?php
				global $user;
				
				
				$loginRegistrationError = "";
				
				if(isset($_POST['logInAcc'])){
					$username=$password="";
					if ($_SERVER["REQUEST_METHOD"] == "POST")
					{
						if(empty($_POST["username"])||empty($_POST["password"]))
						{
							$loginRegistrationError = "Fill up username and password";
						}
						else{
							$loginRegistrationError=search($user,$_POST["username"],$_POST["password"]);
						}
					}


				}
				
				
				function search($database,$name,$password)
				{
					$statement = "select * from login Where Username='$name' AND Password ='$password'";
					$results= mysqli_query($database,$statement);
					if(!$results)
					{
						die();
					}
					$data=mysqli_fetch_array($results);
					if(empty($data))
					{
						return "Invalid username or password";
					}
					else
					{
						$loginstatus = "update login set SignedInStatus='True' where Username='$name'";
						mysqli_query($database,$loginstatus);
						header("Location: home.php");
					}
					return "There is something wrong";
				}
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