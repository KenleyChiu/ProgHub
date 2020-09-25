<html>
	<?php require_once 'config.php'?>
	<?php require_once (ROOT_PATH .'\includes\header.php')?>
	<?php require_once (ROOT_PATH .'\includes\navigation.php')?>
	<head>
		<title>Website Project</title>
		<link rel="stylesheet" type="text/css" href="css/searchUserUsers.css">
	</head>
	<?php
		global $user;
		$userarray=$GLOBALS["userArr"];		
		
		//plural = just one user because user details
		$usersArr = array();
		//singular = array of users because collection of user details
		$userArr = array();
		
		if(isset($_POST['searchUserInput'])){
		if(empty($_POST['searchUserInput'])){
			$usersListQuery = mysqli_query($user,"select * from userdetails where Username=''");
			$resultsQuery = mysqli_query($user,"select * from login where Username=''");
			$resultsCount = mysqli_num_rows($resultsQuery);
		} else {
			$usersListQuery = mysqli_query($user,"select * from userdetails where Username like '%".$_POST['searchUserInput']."%'");
			$resultsQuery = mysqli_query($user,"select * from login where Username like '%".$_POST['searchUserInput']."%'");
			$resultsCount = mysqli_num_rows($resultsQuery);
		}
		}else {
			$usersListQuery = mysqli_query($user,"select * from userdetails where Username like '%".$_POST['searchUserInput']."%'");
			$resultsQuery = mysqli_query($user,"select * from login where Username like '%".$_POST['searchUserInput']."%'");
			$resultsCount = mysqli_num_rows($resultsQuery);
		}
		
		$usersQuery = mysqli_query($user,"select * from login where Position='User'");
		$usersCount = mysqli_num_rows($usersQuery);
		$adminsQuery = mysqli_query($user,"select * from login where Position='Admin'");
		$adminsCount = mysqli_num_rows($adminsQuery);		
	?>
	<body>
			
			<div class="title">
				<label class="titleLabel"> USERS </label>
			</div>
			
			<!--LEFT SIDE-->
			<div class="back">
				<form class="backForm" action="users.php" method="post">
					<input class="backBtn" type="submit" name="backBtn" value="Back to Users" />
				</form>
			</div>
			
			<div class="headers">
				<label class="searchResults"> <?php echo $resultsCount; ?> Results found</label>
			</div>
			
			<div class="users">
				<ul class="users">
					<form method="post">
						<?php
							ob_start();
							while($users = mysqli_fetch_array($usersListQuery)){
								$usersArr["Username"] = $users["Username"];
								$usersArr["Password"] = $users["Password"];
								$usersArr["Age"] = $users["Age"];
								$usersArr["Email"] = $users["Email"];
								$usersArr["Gender"] = $users["Gender"];
								$usersArr["Image"] = $users["Image"];
								$usersArr["Bio"] = $users["Bio"];
								$usersArr["Likes"] = $users["Likes"];
								array_push($usersArr,$usersArr["Username"],$usersArr["Password"],$usersArr["Age"],$usersArr["Email"],$usersArr["Gender"],$usersArr["Image"]
								,$usersArr["Bio"],$usersArr["Likes"]);
								array_push($userArr,$usersArr);
								if($signedInStatus == "True"){
									if($usersArr["Username"] != $userarray[0]){
										echo "<div class='singleUser'>";
										echo "<li><img class='userImg' src='data:image/jpeg;base64,".base64_encode($usersArr["Image"])."'>
										<label class='userLabel' name='".$usersArr["Username"]."'/>".$usersArr["Username"]."</label>
										<input class='userBtn' type='submit' name='".$usersArr["Username"]."Btn' value=''/></li>";
										echo "</div>";
									}
								} else {
									echo "<div class='singleUser'>";
									echo "<li><img class='userImg' src='data:image/jpeg;base64,".base64_encode($usersArr["Image"])."'>
									<label class='userLabel' name='".$usersArr["Username"]."'/>".$usersArr["Username"]."</label>
									<input class='userBtn' type='submit' name='".$usersArr["Username"]."Btn' value=''/></li>";
									echo "</div>";
								}
							}
							
							foreach($userArr as $user){
								if(isset($_POST[$user["Username"].'Btn'])){
									$_SESSION['statusUser'] = "selected";
									$_SESSION['UsernameUser'] = $user["Username"];
									$_SESSION['AgeUser'] = $user["Age"];
									$_SESSION['EmailUser'] = $user["Email"];
									$_SESSION['GenderUser'] = $user["Gender"];
									$_SESSION['ImageUser'] = $user["Image"];
									$_SESSION['BioUser'] = $user["Bio"];
									$_SESSION['LikesUser'] = $user["Likes"];
									header("Location: userProfile.php");
								}
							}
							ob_end_flush();
							
						?>
					</form>
				</ul>
			</div>
			
			<!--FOOTER-->
			<?php require_once (ROOT_PATH .'\includes\footer.php')?>
		</div>
	
	</body>
</html>