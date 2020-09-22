<html>
	<?php require_once 'config.php'?>
	<?php require_once (ROOT_PATH .'\includes\header.php')?>
	<?php require_once (ROOT_PATH .'\includes\navigation.php')?>
	
	<head>
		<title>Website Project</title>
		<link rel="stylesheet" type="text/css" href="css/communities.css">
	</head>
	
	

	<?php

		$signedInStatus = false;
	?>

	<body>
			<div class="title">
				<label class="titleLabel"> COMMUNITIES </label>
			</div>
			
			<div class="headers">
				headers
			</div>
			
			<?php
				//use if no database
				/*$communitiesArr = array();
				$imgArr = array();
				array_push($communitiesArr,"Java","C","Javascript","C++","C#","Php","Ruby","Python");
				foreach(array_values($communitiesArr) as $key => $name){
					array_push($imgArr,$name.".png");
					//echo $imgArr[$key];
				}
				$_SESSION['communitiesArr'] = $communitiesArr;
				$communityCount = sizeof($communitiesArr);*/
				
				//use if with database
				$sqlConnection = mysqli_connect("localhost","root","");
				
				if($sqlConnection) {
					$pghDatabase = mysqli_select_db($sqlConnection,'proghub_data');
				} else {
					die("Connection was not established!".mysqli_error());
				}
				
				$communitiesListQuery = mysqli_query($sqlConnection,"select * from communitieslist");
				
				$communitiesArr = array();
				$imgArr = array();
				$communityArr = array(array());
				
				//add all data into arrays
				while($communities = mysqli_fetch_array($communitiesListQuery)){
					$commName = $communities["Name"];
					$commImage = $communities["Image"];
					array_push($communitiesArr,$commName);
					array_push($imgArr,$commImage);
				}
				
				//make 2-dimensional array
				foreach(array_values($communitiesArr) as $index => $community){
					$communityArr[$index]["name"] = $community;
					$communityArr[$index]["image"] = $imgArr[$index];
				}
				
				$_SESSION['communitiesArr'] = $communitiesArr;
				
				//identifies which button has been pressed (which community has been picked)
				foreach($communitiesArr as $community){
					if(isset($_POST[$community.'Btn'])){
						$_SESSION['status'] = "selected";
						$_SESSION['commSelected'] = $community;
						header("Location: community.php");
					}
				}
			?>
			
			<div class="communities">
				<ul class="communities">
					<form method="post">
						<?php 
							//use if no database
							/*for($commsPos=0;$commsPos<$communityCount;$commsPos++){
								echo "<li><img class='commsImg' src='pictures/".$imgArr[$commsPos]."'>
								<label class='commsLabel'/>".$_SESSION['communitiesArr'][$commsPos]."</label>
								<input class='commsBtn' type='submit' value=''/></li>";
							}*/
							
							//use if with database - prints all communities
							foreach(array_values($communityArr) as $key => $community){
								echo "<li><img class='commsImg' src='data:image/jpeg;base64,".base64_encode($community["image"])."'>
								<label class='commsLabel' name='".$community["name"]."'/>".$community["name"]."</label>
								<input class='commsBtn' type='submit' name='".$community["name"]."Btn' value=''/></li>";
							}
						?>
					</form>
						<?php
							mysqli_close($sqlConnection);
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