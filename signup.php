<html>
	<head>
		<title>Website Project</title>
		<link rel="stylesheet" type="text/css" href="css/signup.css">
	</head>
	
	<?php
		session_start();
		//gets the signed in status from home.php
		$signedInStatus = $_SESSION['signedInStatus'];
	?>
	
	<body>
		<div class="mainGrid">
			<!--HEADER-->
			<div class="header">
				<div class="logo">
					<a class="aLogo" href="home.php">
					<img class="logoPgh" src="pictures/pgh.png">
					<img class ="proghub" src="pictures/proghub2.png">
					</a>
				</div>
				
				<div class="search">
					<!--search-->
					<form class="searchForm" action="search.php" method="get">
						<input class="searchInput" type="text" name="search" Placeholder="Search" />
					</form>
				</div>
				
				<div class="account">
					<!--<img src="user.png">-->
					<!--<ul class="users">
						<li><a href="#">Sign Up</a></li>
						<li><a href="#">Log In</a></li>
					</ul>-->
					<?php 
						if(!$signedInStatus){
							echo "<form class='login' action='login.php' method='post'>";
							echo "<input class='loginBtn' type='submit' value='Login'/>";
							echo "</form>";
							echo "<form class='signup' action='signup.php' method='post'>";
							echo "<input class='signupBtn' type='submit' value='Sign Up'/>";
							echo "</form>";
						}
					?>
				</div>
			</div>
			
			<!--NAVIGATION MENU-->
			<div class="menu">
				<ul class="nav">
					<li><form class="homeNav" action="home.php" method="get">
						<input class="homeBtn" type="submit" value="Home"/></li>
					</form></li>
					<li><form class="communityNav" action="communities.php" method="get">
						<input class="communityBtn" type="submit" value="Communities"/>
					</form></li>
					<li><form class="usersNav" action="users.php" method="get">
						<input class="usersBtn" type="submit" value="Users"/>
					</form></li>
					<li><form class="tagsNav" action="tags.php" method="get">
						<input class="tagsBtn" type="submit" value="Tags"/>
					</form></li>
					<li><form class="aboutNav" action="about.php" method="get">
						<input class="aboutBtn" type="submit" value="About"/>
					</form></li>
				</ul>
			</div>
			
			<div class="title">
				<label class="titleLabel"> SIGNUP </label>
			</div>
			
			<?php
				
			?>
			
			<!--SIGNUP FORM-->
			<div class="signupForm">
				<form action="login.php" method="post">
					<table class="signupFormTable">
						<tr><td><label class="signupDetails"> Username: </label></td>
						<td><input class="signupInput" type="text" name="username" Placeholder="Username.."/></td></tr>
						<tr><td><label class="signupDetails"> Password: </label></td>
						<td><input class="signupInput" type="text" name="password" Placeholder="Password.."/></td></tr>
						<tr><td><label class="signupDetails"> Confirm Password: </label></td>
						<td><input class="signupInput" type="text" name="confirmPassword" Placeholder="Confirm Password.."/></td></tr>
					</table>
				
					<ul class="signupForm">
						<li><input class="signUpAcc" type="submit" name="signUpAcc" value="Register"/></li>
				</form>
				<form action="login.php" method="post">					
					<li><label class="signupDetails"> Already have an account? </label>
					<input class="loginAcc" type="submit" value="Login Here"/></li>
				</form>
				</ul>
				
				
			</div>
			
			<!--FOOTER-->
			<div class="footer">
				
			</div>
		</div>
		
	</body>
</html>