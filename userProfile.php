<html>
	
	<?php require_once 'config.php'?>
	<?php require_once (ROOT_PATH .'\includes\header.php')?>
	<?php require_once (ROOT_PATH .'\includes\navigation.php')?>
	<head>
		<title>Website Project</title>
		<link rel="stylesheet" type="text/css" href="css/userProfile.css">
	</head>
	
	<?php
		global $user;
		$userarray=$GLOBALS["userArr"];
		$userDetailsarray=$GLOBALS["specificUserArr"];
		
		
	?>

	<body>

			
			<div class="title">
				<?php 
					if($_SESSION['statusUser'] == "selected"){
						echo "<label class='titleLabel'>".$_SESSION['userSelected']."</label>";
						unset($_SESSION['statusUser']);
						$_SESSION['statusUser'] = "notselected";
					} else {
						echo "<label class='titleLabel'>".$userarray[0]."</label>";
					}
				?>
			</div>
			
			<div class="profile">
				<?php
					echo "<table class='profileFormTable'>
						<tr><td><img class='profileImg' src='data:image/jpeg;base64,".base64_encode($userDetailsarray[5])."'></td></tr>
						<tr><td valign='top'><label class='profileDetails'> Bio: ".$userDetailsarray[6]." </label></td></tr>
						<tr><td><label class='profileDetails'> Email: ".$userDetailsarray[3]." </label></td></tr>
						<tr><td><label class='profileDetails'> Age: ".$userDetailsarray[2]." </label></td></tr>
						<tr><td><label class='profileDetails'> Gender: ".$userDetailsarray[4]." </label></td></tr>
					</table>";
					
					
					if($_SESSION['statusUser'] == "selected"){
						//echo "FAVORITE BUTTON";
						unset($_SESSION['statusUser']);
						$_SESSION['statusUser'] = "notselected";
					} else { 
						//echo "DO NOT ECHOFAVORITE BUTTON";
					}
				?>
				
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