<html>
	<?php require_once 'config.php'?>
	<?php require_once (ROOT_PATH .'\includes\header.php')?>
	<?php require_once (ROOT_PATH .'\includes\navigation.php')?>
	<head>
		<title>Website Project</title>
		<link rel="stylesheet" type="text/css" href="css/about.css">
	</head>
	
	<?php

	
	?>

	<body>
			<div class="title">
				<label class="titleLabel"> Programming Hub </label>
			</div>
	
			<div class="about">
				<img class='aboutImg' src='pictures/aboutImage2.jpeg'>
				<!--<img class='aboutImg' src='pictures/aboutImage3.png'>-->
				
				<p class='text'>
				Programming Hub is a website that is designed to provide a platform for programmers to collaborate and exhange information.
				The site allows individuals of all skill levels to interact through inquiries or feedbacks.</p>
				<br>
				<h2> Website Functionalities: </h2><br>
				<ol>
					<li>Communities
						<ul>
							<li>View</li>
						</ul>
					</li>
					<li>Posts
						<ul>
							<li>Create (text and image)</li>
							<li>Edit</li>
							<li>Like</li>
							<li>Delete</li>
							<li>Search</li>
						</ul>
					</li>
					<li>Comments
						<ul>
							<li>Create (text and image)</li>
							<li>Edit</li>
							<!--<li>Like</li>-->
							<li>Delete</li>
						</ul>
					</li>
					<li>Users
						<ul>
							<li>View</li>
							<li>Search</li>
							<li>Favorite</li>
						</ul>
					</li>
					<li>Account
						<ul>
							<li>Login</li>
							<li>Sign Up</li>
							<li>Edit Information</li>
							<li>User and Admin access</li>
						</ul>
					</li>
				  <li>Sections
						<ul>
							<li>Recent</li>
							<li>Popular</li>
							<li>Threads</li>
							<li>Projects</li>
						</ul>
					</li>
				</ol>
				
			</div>
			
			<!--FOOTER-->
			<?php require_once (ROOT_PATH .'\includes\footer.php')?>
			
		</div>
	</body>
</html>