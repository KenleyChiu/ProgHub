<html>
	<?php require_once 'config.php'?>
	<?php require (ROOT_PATH .'\includes\header.php')?>
	<?php require_once (ROOT_PATH .'\includes\navigation.php')?>
	<head>
		<title>Website Project</title>
		<link rel="stylesheet" type="text/css" href="css/settings.css">
	</head>
	
	<?php
		global $user,$data;
		$userarray=$GLOBALS["userArr"];
		$userDetailsarray=$GLOBALS["specificUserArr"];
		

		if(isset($_POST['signoutBtn'])){
			$login = "update login set SignedInStatus='False' where Username='$userarray[0]'"; 
			$query = mysqli_query($user,$login);
			header("Location: login.php");
		}
		
		$userRegistrationError = "";
		
		
		if(isset($_POST['updateAcc'])){
			$update = 2;
			$changeUsername = FALSE;
			$changePassword = FALSE;
			$changeEmail = FALSE;
			$changeAge = FALSE;
			$changeImage = FALSE;
			$changeBio = FALSE;
			$changeGender = FALSE;
			$error = FALSE;
			// Error Checking
			if(!empty($_FILES["displayPicture"]["name"])){

				//get file info
				$fileName = basename($_FILES["displayPicture"]["name"]); 
				$fileType = pathinfo($fileName, PATHINFO_EXTENSION);
				// Allow certain file formats 
				$allowTypes = array('jpg','png','jpeg','gif'); 
				if(in_array($fileType, $allowTypes)){ 
					$changeImage= TRUE;
				}else{
					$userRegistrationError= "Sorry, only JPG, JPEG, PNG, & GIF files are allowed to upload.";
					$error = TRUE;
				}
			}
			if(!empty($_POST['oldPassword'])){
				if($_POST['oldPassword'] == $userarray[1])
				{
					if(!empty($_POST['newPassword']) && !empty($_POST['confirmPassword']) && $_POST['confirmPassword'] == $_POST['newPassword']){
						$changePassword = TRUE;
					}else {
						$userRegistrationError = "New Password and Confirm Password do not match";
						$error = TRUE;
					}
					
				}else {
					$userRegistrationError = "Incorrect Old Password";
					$error = TRUE;
				}
			}
			if(!empty($_POST['username'])){
				$statement = "select * from login where Username='".$_POST['username']."'";
				$result = mysqli_query($user,$statement);
				$userTaken = mysqli_fetch_array($result);
				if(empty($userTaken))
				{
					$changeUsername = TRUE;
				}
				else{
					$userRegistrationError = "Username is Taken";
					$error = TRUE;
				}
			}
			if(!empty($_POST['age'])){
				$changeAge = TRUE;
			}
			if(!empty($_POST['email'])){
				$changeEmail = TRUE;
			}
			if(!empty($_POST['gender'])){
				$changeGender = TRUE;
			}
			
			if(!empty($_POST['bio'])){
				$changeBio = TRUE;
			}

			//Store to Database if no error message
			if($error == FALSE){
				
				if($changeAge == TRUE){
					$age = "update userdetails set Age='".$_POST['age']."' where Username='$userarray[0]'"; 
					mysqli_query($user,$age);
					$update = 1;
				}
				if($changeEmail == TRUE){
					$email = "update userdetails set Email='".$_POST['email']."' where Username='$userarray[0]'"; 
					mysqli_query($user,$email);
					$update = 1;
				}
				if($changeGender == TRUE){
					$gender = "update userdetails set Gender='".$_POST['gender']."' where Username='$userarray[0]'"; 
					mysqli_query($user,$gender);
					$update = 1;
				}
				if($changeBio == TRUE){
					$bio = "update userdetails set Bio='".$_POST['bio']."' where Username='$userarray[0]'"; 
					mysqli_query($user,$bio);
					$update = 1;
				}
				if($changeImage == TRUE){
					$image = $_FILES['displayPicture']['tmp_name']; 
					$imgContent = addslashes(file_get_contents($image));
					$statement= "update userdetails set Image = '$imgContent' where Username= '$userarray[0]'";
					mysqli_query($user,$statement);
					$update = 1;
				}
				if($changePassword == TRUE){
					$password = "update userdetails set Password='".$_POST['newPassword']."' where Username='$userarray[0]'"; 
					mysqli_query($user,$password);
					$loginpassword = "update login set Password='".$_POST['newPassword']."' where Username='$userarray[0]'";
					mysqli_query($user,$loginpassword);
					$update = 0;
				}
				if($changeUsername == TRUE){
					$username = "update userdetails set Username='".$_POST['username']."' where Username='$userarray[0]'"; 
					mysqli_query($user,$username);
					$loginusername = "update login set Username='".$_POST['username']."' where Username='$userarray[0]'";
					mysqli_query($user,$loginusername);
					$userlikes = "update userlikes set Fans='".$_POST['username']."' where Fans='$userarray[0]'";
					mysqli_query($user,$userlikes);
					$postlikes= "update postlikes set Username='".$_POST['username']."' where Username='$userarray[0]'";
					mysqli_query($data,$postlikes);
					$posts= "update posts set Author='".$_POST['username']."' where Author='$userarray[0]'";
					mysqli_query($data,$posts);
					$posts= "update commentpost set Username='".$_POST['username']."' where Username='$userarray[0]'";
					mysqli_query($data,$posts);
					$userarray[0]=$_POST['username'];
					$update = 0;
				}
				
			}
				

			if($update == 0 )
			{
				$login = "update login set SignedInStatus='False' where Username='$userarray[0]'"; 
				mysqli_query($user,$login);
				header("Location: login.php");
				exit();
			}
			else if($update == 1) 
			{
				header("Location: userProfile.php");
				exit();
			}
			else{
				if(empty($userRegistrationError)){
					$userRegistrationError = "Fill up data to edit";
				}
				
			}
		}
	?>

	<body>
			
			
			<div class="title">
				<label class="titleLabel"> SETTINGS </label>
			</div>
			
			<div class="settingsForm">
				<label class="settingsHeader"> Edit your information: </label>
				<form method="post" enctype="multipart/form-data">
					<table class="settingsFormTable">
						<tr><td><img class="profileImg" src='data:image/jpeg;base64,<?php echo base64_encode($userDetailsarray[5]); ?>'></td>
						<td><input class="imageInput" type="file" name="displayPicture" /></td></tr>
						<tr><td valign="top"><label class="settingsDetails"> Bio: </label></td>
						<td><textarea class="settingsInputBio"rows='7' cols='34' name='bio' Placeholder="Enter your bio.."></textarea></td></tr>
						<tr><td><label class="settingsDetails"> Username: </label></td>
						<td><input class="settingsInput" type="text" name="username" minlength="5" size='35' Placeholder="Username.."/></td></tr>
						<tr><td><label class="settingsDetails"> Email: </label></td>
						<td><input class="settingsInput" type="email" name="email" size='35' Placeholder="Email.."/></td></tr>
						<tr><td><label class="settingsDetails"> Age: </label></td>
						<td><input class="settingsInput" type="text" name="age" size='35' Placeholder="Age.."/></td></tr>
						<tr><td><label class="settingsDetails"> Gender: </label></td>
						<td><input class="radioInput" type="radio" name="gender" value="M"/> M <input class="radioInput" type="radio" name="gender" value="F"/> F </td></tr>
						<tr><td><label class="settingsDetails"> Change Password: </label></td>
						<td><input class="settingsInput" type="password" name="newPassword" minlength="5" size='35' Placeholder="New Password.."/></td></tr>
						<tr><td><label class="settingsDetails"> Old Password: </label></td>
						<td><input class="settingsInput" type="password" name="oldPassword" minlength="5" size='35' Placeholder="Old Password.."/></td></tr>
						<tr><td><label class="settingsDetails"> Confirm Password: </label></td>
						<td><input class="settingsInput" type="password" name="confirmPassword" minlength="5" size='35' Placeholder="Confirm Change Password.."/></td></tr>
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
			
			<!--FOOTER-->
			<div class="footer">
				
			</div>
		</div>
		
	</body>
</html>