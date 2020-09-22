<html>
	<?php require_once 'config.php'?>
	<?php require_once (ROOT_PATH .'\includes\header.php')?>
	<?php require_once (ROOT_PATH .'\includes\navigation.php')?>
	<head>
		<title>Website Project</title>
		<link rel="stylesheet" type="text/css" href="css/login.css">
	</head>
	
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
							search($user,$_POST["username"],$_POST["password"]);
							errorCheck($user,$_POST["username"],$_POST["password"]);
							//$loginRegistrationError=search($user,$_POST["username"],$_POST["password"]);
							if(!$userExists){
								$loginRegistrationError = "No account found!";
							}
							else if(!$passwordIsCorrect){
								$loginRegistrationError = "Username and Password do not match!";
							}
						}
					}
				}
				
				function errorCheck($database,$name,$password){
					global $userExists,$passwordIsCorrect;
					$results = mysqli_query ($database,"select * from login");
					$userExists = false;
					$passwordIsCorrect = false;
					
					while($data=mysqli_fetch_array($results)){
						$username = $data["Username"];
						$loginPassword = $data["Password"];
						
						if($name == $username){
							$userExists = true;
							if($password == $loginPassword){
								$passwordIsCorrect = true;
								header("Location: home.php");
							}
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
						return;
					}
					else
					{
						$loginstatus = "update login set SignedInStatus='True' where Username='$name'";
						mysqli_query($database,$loginstatus);
						return;
					}
					return;
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
						<li><span style="color:red"> <?php echo $loginRegistrationError;?> </span></li>
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