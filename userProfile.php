<html>
	<?php require_once 'config.php'?>
	<?php require_once (ROOT_PATH .'\includes\header.php')?>
	<?php require_once (ROOT_PATH .'\includes\navigation.php')?>
	<head>
		<title>Website Project</title>
		<link rel="stylesheet" type="text/css" href="css/userProfile.css">
	</head>
	<?php
		global $user,$data;
		$userarray=$GLOBALS["userArr"];
		$userDetailsarray=$GLOBALS["specificUserArr"];
		
		function fillPostArray($postsQuery){
			$postArr = array();
			$y=0;
			while($posts = mysqli_fetch_array($postsQuery)){
				$postsArr = array();
				$postsArr["Author"] = $posts["Author"];
				$postsArr["Title"] = $posts["Title"];
				$postsArr["TextContent"] = $posts["TextContent"];
				$postsArr["ImageContent"] = $posts["ImageContent"];
				$postsArr["Likes"] = $posts["Likes"];
				$postsArr["Comments"] = $posts["Comments"];
				$postsArr["Community"] = $posts["Community"];
				$postsArr["PostType"] = $posts["PostType"];
				$postsArr["Upload"] = $posts["Upload"];
				array_push($postsArr,$postsArr["Author"],$postsArr["Title"],$postsArr["TextContent"],$postsArr["ImageContent"],$postsArr["Likes"],$postsArr["Comments"]
				,$postsArr["Community"],$postsArr["PostType"],$postsArr["Upload"]);
				array_push($postArr,$postsArr);
				$y++;
				if($y==3) break;
			}
			return $postArr;
		}
		
		function toPost($post){
			$_SESSION['statusPost'] = "selected";
			$_SESSION['AuthorPost'] = $post["Author"];
			$_SESSION['TitlePost'] = $post["Title"];
			$_SESSION['ImageContentPost'] = $post["ImageContent"];
			$_SESSION['TextContentPost'] = $post["TextContent"];
			$_SESSION['StarsPost'] = $post["Likes"];
			$_SESSION['CommentsPost'] = $post["Comments"];
			$_SESSION['commSelected'] = $post["Community"];
			$_SESSION['PostTypePost'] = $post["PostType"];
			header("Location:post.php");
			return;
		}
		
		function displayPosts($postArr){
			foreach(array_values($postArr) as $key => $post){
				echo "<div class='singlePost'>";
				echo "<form method='post'>";
				//echo "<input class='postTitleBtn' type='submit' name='goToPost' value='".$post["Title"]."'/>";
				//echo "<input type='hidden' name='goToPostValue' value='".$post["Title"]."'/>";
				echo "<label class='postTitleBtn'> ".$post["Title"]." </label><br><br>";
				echo "</form>";
				echo "<label class='stars'> ".$post["Likes"]." Stars </label>";
				echo "<br>";
				echo "</div>";
			}
			return;
		}
	?>
	<body>

			
			<div class="title">
				<?php 
					$username = $_SESSION['UsernameUser'];
					if($_SESSION['statusUser'] == "selected"){
						echo "<label class='titleLabel'>".$username."</label>";
					} else {
						echo "<label class='titleLabel'>".$userarray[0]."</label>";
					}
				?>
			</div>
			
			<div class="back">
				<form class="backForm" action="users.php" method="post">
					<?php 
						if($_SESSION['statusUser'] == "selected"){
							echo "<input class='backBtn' type='submit' name='backBtn' value='Back to Users' />";
						}
					?>
				</form>
			</div>
			
			<div class="profile">
				<?php
					$age = $_SESSION['AgeUser'];
					$email = $_SESSION['EmailUser'];
					$gender = $_SESSION['GenderUser'];
					$image = $_SESSION['ImageUser'];
					$bio = $_SESSION['BioUser'];
					$favorites = $_SESSION['LikesUser'];
					
					if($signedInStatus == "True"){
						$favoriteValue = "Favorite";
						$checkFavorites = "select * from userlikes where NameOfUser='".$username."' and Fans='".$userarray[0]."'";
						$likedQuery= mysqli_query($user,$checkFavorites);
						$favoriteArr = mysqli_fetch_array($likedQuery);
						
						if(!empty($favoriteArr)){
							$favoriteValue = "Unfavorite";
						} else {
							$favoriteValue = "Favorite";
						}	
							
						if(isset($_POST['favoriteAcc'])){
							if(empty($favoriteArr)){
								$favoritesCount = $_SESSION['LikesUser'] + 1;
								$favoriteAdd = "update userdetails set Likes='".$favoritesCount."' where Username='".$username."'";
								mysqli_query($user,$favoriteAdd);
								
								$favoriteAdd2 = "insert into userlikes values('".$username."','".$userarray[0]."')";
								mysqli_query($user,$favoriteAdd2);
								header("Location:users.php");
							} else {
								$favoritesCount = $_SESSION['LikesUser'] - 1;
								$favoriteMinus = "update userdetails set Likes='".$favoritesCount."' where Username='".$username."'";
								mysqli_query($user,$favoriteMinus);
								
								$favoriteMinus2 = "delete from userlikes where NameOfUser='".$username."' and Fans='".$userarray[0]."'";
								mysqli_query($user,$favoriteMinus2);
								header("Location:users.php");
							}
							
						}
						
						
						if($_SESSION['statusUser'] == "selected"){
							echo "<table class='profileFormTable'>
									<tr><td align='center'><img class='profileImg' src='data:image/jpeg;base64,".base64_encode($image)."'></td></tr>
									<tr><td ><label class='profileDetails'> Bio: ".$bio." </label></td></tr>
									<tr><td><label class='profileDetails'> Email: ".$email." </label></td></tr>
									<tr><td><label class='profileDetails'> Age: ".$age." </label></td></tr>
									<tr><td><label class='profileDetails'> Gender: ".$gender." </label></td></tr>
									<tr><td><label class='profileDetails'> Favorites: ".$favorites." </label></td></tr>
								</table>";
							
							echo "<form method='post'>
								<ul class='favorite'>
								<li><input class='favoriteAcc' type='submit' name='favoriteAcc' value='".$favoriteValue."'/></li>
								</form>
							</ul>";
						} else { 
							echo "<table class='profileFormTableUser'>
								<tr><td align='center'><img class='profileImg' src='data:image/jpeg;base64,".base64_encode($userDetailsarray[5])."'></td></tr>
								<tr><td ><label class='profileDetails'> Bio: ".$userDetailsarray[6]." </label></td></tr>
								<tr><td><label class='profileDetails'> Email: ".$userDetailsarray[3]." </label></td></tr>
								<tr><td><label class='profileDetails'> Age: ".$userDetailsarray[2]." </label></td></tr>
								<tr><td><label class='profileDetails'> Gender: ".$userDetailsarray[4]." </label></td></tr>
								<tr><td><label class='profileDetails'> Favorites: ".$userDetailsarray[7]." </label></td></tr>
							</table>";
						}
					} else {
						echo "<table class='profileFormTableUser'>
							<tr><td align='center'><img class='profileImg' src='data:image/jpeg;base64,".base64_encode($image)."'></td></tr>
							<tr><td ><label class='profileDetails'> Bio: ".$bio." </label></td></tr>
							<tr><td><label class='profileDetails'> Email: ".$email." </label></td></tr>
							<tr><td><label class='profileDetails'> Age: ".$age." </label></td></tr>
							<tr><td><label class='profileDetails'> Gender: ".$gender." </label></td></tr>
							<tr><td><label class='profileDetails'> Favorites: ".$favorites." </label></td></tr>
						</table>";
					}
					
					
				?>
				
			</div>

			<div class="data">
				<ul class="data">
					<li class="top3posts">Top 3 Posts:</li><br><br>
					<?php
						ob_start();
						if($_SESSION['statusUser'] == "selected"){
							$selectedUserQuery = "select * from posts where Author='".$username."' order by Likes DESC";
							unset($_SESSION['statusUser']);
							$_SESSION['statusUser'] = "notselected";
						} else {
							$selectedUserQuery = "select * from posts where Author='".$userarray[0]."' order by Likes DESC";
						}
						
						$postsQuery = mysqli_query($data,$selectedUserQuery);
						$postArr = fillPostArray($postsQuery);
						
						displayPosts($postArr);
						// Go to post.php	
						/*if(isset($_POST['goToPost']))
						{
							foreach($postArr as $post){
								if($post['Title']==$_POST['goToPost'])
								{
									toPost($post);
								}
							}
						}*/
						ob_end_flush();
					?>
				</ul>
			</div>	
			
			<!--FOOTER-->
			<div class="footer">
				
			</div>
		</div>
		
	</body>
</html>