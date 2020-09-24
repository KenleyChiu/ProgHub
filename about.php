<html>
	<?php require_once 'config.php'?>
	<?php require_once (ROOT_PATH .'\includes\header.php')?>
	<?php require_once (ROOT_PATH .'\includes\navigation.php')?>
	<head>
		<title>Website Project</title>
		<link rel="stylesheet" type="text/css" href="css/about.css">
	</head>
	
	<?php

		$userArray=$GLOBALS["userArr"];
						
		if($userArray[2]==FALSE)
		{
			header("Location:login.php");
			exit();
			
		}
	?>

	<body>

			
			<div class="about">
				About
			</div>
				
		</div>
		
	</body>
</html>