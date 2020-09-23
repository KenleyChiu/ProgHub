<html>
	<?php require_once 'config.php'?>
	<?php require (ROOT_PATH .'\includes\header.php')?>
	<?php require_once (ROOT_PATH .'\includes\navigation.php')?>
	<head>
		<title>Website Project</title>
		<link rel="stylesheet" type="text/css" href="css/settings.css">
	</head>
	
	<?php
		global $user;
		$userarray=$GLOBALS["userArr"];


		if(isset($_POST['signoutBtn'])){
			$login = "update login set SignedInStatus='False' where Username='$userarray[0]'"; 
			$query = mysqli_query($user,$login);
			header("Location: login.php");
		}
		
		$userRegistrationError = "";
		
		if(isset($_POST['updateAcc'])){
			if(!empty($_POST['oldPassword']) && !empty($_POST['confirmPassword']) && ($_POST['oldPassword'] == $_POST['confirmPassword']) && ($_POST['oldPassword'] == $userarray[1])){
				if(!empty($_POST['username'])){
					$username = "update userdetails set Username='".$_POST['username']."' where Username='$userarray[0]'"; 
					mysqli_query($user,$username);
				}
				if(!empty($_POST['newPassword'])){
					$password = "update userdetails set Password='".$_POST['newPassword']."' where Username='$userarray[0]'"; 
					mysqli_query($user,$password);
				}
				if(!empty($_POST['age'])){
					$age = "update userdetails set Age='".$_POST['age']."' where Username='$userarray[0]'"; 
					mysqli_query($user,$age);
				}
				if(!empty($_POST['email'])){
					$email = "update userdetails set Email='".$_POST['email']."' where Username='$userarray[0]'"; 
					mysqli_query($user,$email);
				}
				if(!empty($_POST['gender'])){
					$gender = "update userdetails set Gender='".$_POST['gender']."' where Username='$userarray[0]'"; 
					mysqli_query($user,$gender);
				}
				$login = "update login set SignedInStatus='False' where Username='$userarray[0]'"; 
				mysqli_query($user,$login);
				header("Location: login.php");
			}
		}
	?>

	<body>
			
			
			<div class="title">
				<label class="titleLabel"> SETTINGS </label>
			</div>
			
			<div class="settingsForm">
				<label class="settingsHeader"> Edit your information: </label>
				<form method="post">
					<table class="settingsFormTable">
						<tr><td><label class="settingsDetails"> Username: </label></td>
						<td><input class="settingsInput" type="text" name="username" Placeholder="Username.."/></td></tr>
						<tr><td><label class="settingsDetails"> Email: </label></td>
						<td><input class="settingsInput" type="email" name="email" Placeholder="Email.."/></td></tr>
						<tr><td><label class="settingsDetails"> Age: </label></td>
						<td><input class="settingsInput" type="text" name="age" Placeholder="Age.."/></td></tr>
						<tr><td><label class="settingsDetails"> Gender: </label></td>
						<td><input class="settingsInput" type="radio" name="gender" value="M"/> M <input class="signupInput" type="radio" name="gender" value="F"/> F </td></tr>
						<tr><td><label class="settingsDetails"> Change Password: </label></td>
						<td><input class="settingsInput" type="password" name="newPassword" Placeholder="New Password.."/></td></tr>
						<tr><td><label class="settingsDetails"> Old Password: </label></td>
						<td><input class="settingsInput" type="password" name="oldPassword" Placeholder="Old Password.."/></td></tr>
						<tr><td><label class="settingsDetails"> Confirm Password: </label></td>
						<td><input class="settingsInput" type="password" name="confirmPassword" Placeholder="Confirm Password.."/></td></tr>
						<tr><td></td><td><span style="color:red"> <?php echo $userRegistrationError;?> </span></td></tr>
					</table>					
				
					<ul class="updateForm">
						<li><input class="updateAcc" type="submit" name="updateAcc" value="Update"/></li>
				</form>
				<form class="signout" method="post">					
					<li><label class="settingsDetails"> Finished browsing? </label>
					<!--<input class="signOutAcc" type="submit" value="Sign out"/></li>-->
					<input class='signoutBtn' type='submit' name='signoutBtn' value='Sign Out'/>
				</form>
				</ul>
				
				<!--<form class='logout' method='post'>
					<input class='logoutBtn' type='submit' name='logoutBtn' value='Logout'/>
				</form>-->
				
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