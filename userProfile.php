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
					$age = $_SESSION['AgeUser'];
					$email = $_SESSION['EmailUser'];
					$gender = $_SESSION['GenderUser'];
					$image = $_SESSION['ImageUser'];
					$bio = $_SESSION['BioUser'];
					$favorites = $_SESSION['LikesUser'];
					
					if($signedInStatus == "True"){
						$favoriteValue = "Favorite";
						$checkFavorites = "select * from userlikes where NameOfUser='".$username."' and Fans='".$userarray[0]."'";
						$likedQuery= mysqli_query($user,$checkFavorites);
						$favoriteArr = mysqli_fetch_array($likedQuery);
						
						if(!empty($favoriteArr)){
							$favoriteValue = "Unfavorite";
						} else {
							$favoriteValue = "Favorite";
						}	
							
						if(isset($_POST['favoriteAcc'])){
							if(empty($favoriteArr)){
								$favoritesCount = $_SESSION['LikesUser'] + 1;
								$favoriteAdd = "update userdetails set Likes='".$favoritesCount."' where Username='".$username."'";
								mysqli_query($user,$favoriteAdd);
								
								$favoriteAdd2 = "insert into userlikes values('".$username."','".$userarray[0]."')";
								mysqli_query($user,$favoriteAdd2);
								header("Location:users.php");
							} else {
								$favoritesCount = $_SESSION['LikesUser'] - 1;
								$favoriteMinus = "update userdetails set Likes='".$favoritesCount."' where Username='".$username."'";
								mysqli_query($user,$favoriteMinus);
								
								$favoriteMinus2 = "delete from userlikes where NameOfUser='".$username."' and Fans='".$userarray[0]."'";
								mysqli_query($user,$favoriteMinus2);
								header("Location:users.php");
							}
							
						}
						
						
						if($_SESSION['statusUser'] == "selected"){
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
								<li><input class='favoriteAcc' type='submit' name='favoriteAcc' value='".$favoriteValue."'/></li>
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
					} else {
						echo "<table class='profileFormTableUser'>
							<tr><td align='center'><img class='profileImg' src='data:image/jpeg;base64,".base64_encode($image)."'></td></tr>
							<tr><td ><label class='profileDetails'> Bio: ".$bio." </label></td></tr>
							<tr><td><label class='profileDetails'> Email: ".$email." </label></td></tr>
							<tr><td><label class='profileDetails'> Age: ".$age." </label></td></tr>
							<tr><td><label class='profileDetails'> Gender: ".$gender." </label></td></tr>
							<tr><td><label class='profileDetails'> Favorites: ".$favorites." </label></td></tr>
						</table>";
					}
					
					
				?>
				
			</div>
			
			<!--FOOTER-->
			<div class="footer">
				
			</div>
		</div>
		
	</body>
</html>