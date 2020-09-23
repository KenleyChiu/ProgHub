<html>
	<?php require_once 'config.php'?>
	<?php require_once (ROOT_PATH .'\includes\header.php')?>
	<?php require_once (ROOT_PATH .'\includes\navigation.php')?>
	<head>
		<title>Website Project</title>
		<link rel="stylesheet" type="text/css" href="css/users.css">
	</head>
	<?php
		global $user;
				
		$usersListQuery = mysqli_query($user,"select * from userdetails");
		
		$usersArr = array();
		//$usersImgArr = array();
		$userArr = array();
		
		//add all data into arrays
		/*while($users = mysqli_fetch_array($usersListQuery)){
			$userName = $users["Username"];
			$userImage = $users["Image"];			
			array_push($usersArr,$userName);
			array_push($usersImgArr,$userImage);
			//array_push($userArr,$usersArr);
			//array_push($usersArr,$userName);
		}
		
		//make 2-dimensional array
		foreach(array_values($usersArr) as $index => $user){
			$userArr[$index]["username"] = $user;
			$userArr[$index]["image"] = $usersImgArr[$index];
		}
		
		$_SESSION['usersArr'] = $usersArr;
		
		//identifies which button has been pressed (which community has been picked)
		foreach($usersArr as $user){
			if(isset($_POST[$user.'Btn'])){
				$_SESSION['statusUser'] = "selected";
				$_SESSION['userSelected'] = $user;
				header("Location: userProfile.php");
			}
		}*/
		
	?>
	<body>

			
			<div class="title">
				<label class="titleLabel"> USERS </label>
			</div>
			
			<div class="users">
				<ul class="users">
					<form method="post">
						<?php 							
							//use if with database - prints all communities
							/*foreach(array_values($userArr) as $key => $user){
								echo "<li><img class='userImg' src='data:image/jpeg;base64,".base64_encode($user["image"])."'>
								<label class='userLabel' name='".$user["username"]."'/>".$user["username"]."</label>
								<input class='userBtn' type='submit' name='".$user["username"]."Btn' value=''/></li>";
							}*/
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
								echo "<li><img class='userImg' src='data:image/jpeg;base64,".base64_encode($usersArr["Image"])."'>
								<label class='userLabel' name='".$usersArr["Username"]."'/>".$usersArr["Username"]."</label>
								<input class='userBtn' type='submit' name='".$usersArr["Username"]."Btn' value=''/></li>";
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
						<?php
							mysqli_close($data);
						?>
				</ul>
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