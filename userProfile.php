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
					$username = $_SESSION['UsernameUser'];
					if($_SESSION['statusUser'] == "selected"){
						echo "<label class='titleLabel'>".$username."</label>";
					} else {
						echo "<label class='titleLabel'>".$userarray[0]."</label>";
					}
				?>
			</div>
			
			<div class="profile">
				<?php
					/*echo "<table class='profileFormTable'>
						<tr><td><img class='profileImg' src='data:image/jpeg;base64,".base64_encode($userDetailsarray[5])."'></td></tr>
						<tr><td valign='top'><label class='profileDetails'> Bio: ".$userDetailsarray[6]." </label></td></tr>
						<tr><td><label class='profileDetails'> Email: ".$userDetailsarray[3]." </label></td></tr>
						<tr><td><label class='profileDetails'> Age: ".$userDetailsarray[2]." </label></td></tr>
						<tr><td><label class='profileDetails'> Gender: ".$userDetailsarray[4]." </label></td></tr>
						<tr><td><label class='profileDetails'> Favorites: ".$userDetailsarray[7]." </label></td></tr>
					</table>";*/
					
					
					$age = $_SESSION['AgeUser'];
					$email = $_SESSION['EmailUser'];
					$gender = $_SESSION['GenderUser'];
					$image = $_SESSION['ImageUser'];
					$bio = $_SESSION['BioUser'];
					$favorites = $_SESSION['LikesUser'];
					
					if($_SESSION['statusUser'] == "selected"){
						if(isset($_POST['favoriteAcc'])){
							$checkFavorites = "select * from userlikes where NameOfUser='".$_SESSION['userSelected']."'";
							$liked= mysqli_query($data,$checkFavorites);
							$favoriteArr = mysqli_fetch_array($liked);
							
							if(empty($favoriteArr)){
								$favoritesCount = $_SESSION['StarsPost'] + 1;
								$addLikes = "update posts set Likes='".$likesCount."' where Title='".$postTitle."'";
								mysqli_query($data,$addLikes);
								
								$addLikes2 = "insert into postlikes values('".$userarray[0]."','".$postTitle."','".$community."','".$postPostType."')";
								mysqli_query($data,$addLikes2);
							}
						
						}
						
						echo "<table class='profileFormTable'>
								<tr><td align='center'><img class='profileImg' src='data:image/jpeg;base64,".base64_encode($image)."'></td></tr>
								<tr><td ><label class='profileDetails'> Bio: ".$bio." </label></td></tr>
								<tr><td><label class='profileDetails'> Email: ".$email." </label></td></tr>
								<tr><td><label class='profileDetails'> Age: ".$age." </label></td></tr>
								<tr><td><label class='profileDetails'> Gender: ".$gender." </label></td></tr>
								<tr><td><label class='profileDetails'> Favorites: ".$favorites." </label></td></tr>
							</table>";
						
						echo "<form method='post'>
							<ul class='favorite'>
							<li><input class='favoriteAcc' type='submit' name='favoriteAcc' value='Favorite'/></li>
							</form>
						</ul>";
						unset($_SESSION['statusUser']);
						$_SESSION['statusUser'] = "notselected";
					} else { 
						echo "<table class='profileFormTableUser'>
							<tr><td align='center'><img class='profileImg' src='data:image/jpeg;base64,".base64_encode($userDetailsarray[5])."'></td></tr>
							<tr><td ><label class='profileDetails'> Bio: ".$userDetailsarray[6]." </label></td></tr>
							<tr><td><label class='profileDetails'> Email: ".$userDetailsarray[3]." </label></td></tr>
							<tr><td><label class='profileDetails'> Age: ".$userDetailsarray[2]." </label></td></tr>
							<tr><td><label class='profileDetails'> Gender: ".$userDetailsarray[4]." </label></td></tr>
							<tr><td><label class='profileDetails'> Favorites: ".$userDetailsarray[7]." </label></td></tr>
						</table>";
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