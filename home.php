<html>
	<head>
		<title>Website Project</title>
		<link rel="stylesheet" type="text/css" href="css/home.css">
	</head>
	
	<?php
		session_start();
		
		//JUST GET SIGNED IN STATUS FROM USER DATABASE .
		//define signed in status as false (default)
		$signedInStatus = false;
		$_SESSION['signedInStatus'] = $signedInStatus;
		if(isset($_POST['loginBtn'])){
			header("Location: login.php");
		}
		
	?>

	<body>
		<?php include 'header.php';?>

		<?php include 'navigation.php';?>
			<!--LEFT SIDE-->
			<div class="info">
				<ul class="info">
					<li>Some: </li>
					<li>Info</li>
				</ul>
			</div>
			
			<!--MAIN SECTION-->
			<div class="sections">
				<label class="recent"><a href="#"> Recent </a></label>
				<span class="divider1"> </span>
				<label class="popular"><a href="#"> Popular </a></label>
			</div>
				
			<div class ="post">
				<img src="pictures/user.png">
				<label class="postUser"> Username </label><br>
				<label class="postTitle"> Title </label><br><br>
				<label class="stars"> 0 Stars </label>
				<label class="comments"> 0 Comments </label>
			</div>
			
			<?php
				$totalDiscussions = 5;
				$totalProjects = 10;
			?>
			
			<!--RIGHT SIDE-->
			<div class="data">
				<ul class="data">
					<li class="discussionsNum">Total Discussions: <?php echo $totalDiscussions; ?></li>
					<li class="projectsNum">Total Projects: <?php echo $totalProjects; ?></li>
				</ul>
			</div>
				
		</div>
		
	</body>
</html>