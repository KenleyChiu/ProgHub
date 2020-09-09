<html>
	<head>
		<title>Website Project</title>
		<link rel="stylesheet" type="text/css" href="css/home.css">
	</head>
	
	<?php
		$signedInStatus = false;
	?>

	<body>
		<div class="mainGrid">
			<!--HEADER-->
			<div class="header">
				<div class="logo">
					<a class="aLogo" href="home.php">
					<img src="pictures/logo3.png">
					<label class ="siteName">SiteName</label>
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
							echo "<input class='loginBtn' type='submit' value='Log In'/>";
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
					<li class="open"><form class="homeNav" action="home2nd.php" method="get">
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
			
			<!--<div class="longDiv">
				<span class="longDivider"> </span>
			</div>-->
			
			<div class="sections">
				<label class="recent"><a href="#"> Recent </a></label>
				<span class="divider1"> </span>
				<label class="popular"><a href="#"> Popular </a></label>
			</div>
				
			<div class ="post">
				<img src="pictures/user.png">
				<label class="postUser"> Username </label><br>
				<p class="postTitle"> Title </p><br>
				<label class="stars"> 0 Stars </label>
				<label class="comments"> 0 Comments </label>
			</div>
			
			<div class="data">
				Data
			</div>
				
		</div>
		
	</body>
</html>