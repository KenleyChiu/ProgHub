<html>
	<head>
		<title>Website Project</title>
		<link rel="stylesheet" type="text/css" href="css/home.css">
	</head>
	
	<?php
		session_start();
		
		//define signed in status as false (default)
		$signedInStatus = "False";
		$_SESSION['signedInStatus'] = $signedInStatus;
		
		//not yet implemented for communities.php and community.php
		//uses the session variable from login.php
		if($_SESSION['signedInLogin'] != null) {
			$_SESSION['signedInStatus'] = $_SESSION['signedInLogin'];
		}
		
		//click to go to login.php
		if(isset($_POST['loginBtn'])){
			header("Location: login.php");
		}
			
		//click to destroy session then just reload the page.
		if(isset($_POST['destroySesh'])){
			session_destroy();
		}
		//}
		
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
						//if not signed in, show login and sign up
						//if signed in, show account image and username (destroy button for now)
						if($_SESSION['signedInStatus'] == "False"){
							echo "<form class='login' method='post'>";
							echo "<input class='loginBtn' type='submit' name='loginBtn' value='Login'/>";
							echo "</form>";
							echo "<form class='signup' action='signup.php' method='post'>";
							echo "<input class='signupBtn' type='submit' name='signupBtn' value='Sign Up'/>";
							echo "</form>";
						} 
						if ($_SESSION['signedInStatus'] == "True"){
							echo "<form class='destroySesh' method='post'>";
							echo "<input class='signupBtn' type='submit' name='destroySesh' value='Destroy Sesh'/>";
							echo "</form>";
						}
						
					?>
				</div>
			</div>
			
			<!--LEFT NAVIGATION MENU-->
			<div class="menu">
				<ul class="nav">
					<li class="open"><form class="homeNav" action="home.php" method="get">
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
			
			<div class="info">
				<ul class="info">
					<li>Some: </li>
					<li>Info</li>
				</ul>
			</div>
			
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
			<?php
				$totalDiscussions = 5;
				$totalProjects = 10;
			?>
			<div class="data">
				<ul class="data">
					<li class="discussionsNum">Total Discussions: <?php echo $totalDiscussions; ?></li>
					<li class="projectsNum">Total Projects: <?php echo $totalProjects; ?></li>
				</ul>
			</div>
				
		</div>
		
	</body>
</html>