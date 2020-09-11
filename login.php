<html>
	<head>
		<title>Website Project</title>
		<link rel="stylesheet" type="text/css" href="css/login.css">
	</head>
	
	<?php
		session_start();
		
		//gets the signed in status from home.php
		$signedInStatus = $_SESSION['signedInStatus'];
		//if log in button is pressed, create a new session variable to be used in home.php and go to home.php
		if(isset($_POST['logInAcc'])){
			$signedInStatus = "True";
			$_SESSION['signedInLogin'] = "True";
			header("Location: home.php");
		}

	?>
	
	<body>
		<div class="mainGrid">
			<!--HEADER-->
			<div class="header">
				<div class="logo">
					<a class="aLogo" href="home.php">
					<img class="logo3" src="pictures/pgh.png">
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
						if($signedInStatus == "False"){
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
			
			<!--LEFT NAVIGATION MENU-->
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
				<label class="titleLabel"> LOGIN </label>
			</div>
			
			<?php
				
			?>
			
			<div class="loginForm">
				<ul class="loginForm">
					<form method="post">
						<li><!--<label class="loginDetails"> Username: </label>-->
						<input class="loginInput" type="text" name="username" Placeholder="Username.."/></li>
						<li><!--<label class="loginDetails"> Password: </label>-->
						<input class="loginInput" type="text" name="password" Placeholder="Password.."/></li>
						<li><input class="logInAcc" type="submit" name="logInAcc" value="Log In"/></li>
					</form>
					<form action="signup.php" method="post">					
						<li><label class="loginDetails"> Don't have an account yet? </label>
						<input class="signUpAcc" type="submit" value="Sign Up Now"/></li>
					</form>
				</ul>
			</div>
			
			<div class="footer">
				
			</div>
		</div>
		
	</body>
</html>