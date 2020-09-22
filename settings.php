<html>
	<?php require_once 'config.php'?>
	<?php require_once (ROOT_PATH .'\includes\header.php')?>
	<?php require_once (ROOT_PATH .'\includes\navigation.php')?>
	<head>
		<title>Website Project</title>
		<link rel="stylesheet" type="text/css" href="css/settings.css">
	</head>
	
	<?php
		global $user;
		$userarray=$GLOBALS["userArr"];


		if(isset($_POST['logoutBtn'])){
			$login = "update login set SignedInStatus='False' where Username='$userarray[0]'"; 
			$query = mysqli_query($user,$login);
			header("Location: home.php");
		}
	?>

	<body>

			
			<div class="title">
				<label class="titleLabel"> SETTINGS </label>
			</div>
			
			<div class="settings1">
				settings1
			</div>
			
			<div class="settings2">
				<form class='logout' method='post'>
					<input class='logoutBtn' type='submit' name='logoutBtn' value='Logout'/>
                </form>
			</div>
			
			<div class="data">
				<!--Data-->
			</div>
			
			<!--FOOTER-->
			<div class="footer">
				
			</div>
		</div>
		
	</body>
</html>