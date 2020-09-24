<html>
	<?php require_once 'config.php'?>
	<?php require_once (ROOT_PATH .'\includes\header.php')?>
	<?php require_once (ROOT_PATH .'\includes\navigation.php')?>
	<?php require_once (ROOT_PATH .'\includes\getauthorImage.php')?>
	<head>
		<title>Website Project</title>
		<link rel="stylesheet" type="text/css" href="css/home.css">
	</head>
	<?php
		global $data;
		$userarray=$GLOBALS["userArr"];
		$userDetailsarray=$GLOBALS["specificUserArr"];
		$imagesArray=$GLOBALS["allUserImages"];
	?>
	<body>
		
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
				<?php
					
					$postsQuery = mysqli_query($data,"select * from posts order by Upload DESC");					
					
					$postArr = array();
					
					$y = 0;
					while($posts = mysqli_fetch_array($postsQuery)){
						$postsArr = array();
						$postsArr["Author"] = $posts["Author"];
						//echo $postsArr["Author"];
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
						if($y == 5) break;
					} 
					
					foreach($postArr as $post){
						if(isset($_POST[$post["Title"]])){
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
						}
						
						if(isset($_POST['del'.$post["Title"].'Btn'])){
							//delete post
							$delPostQuery = "delete from posts where community='".$post["Community"]."' and Title='".$post["Title"]."'";
							mysqli_query($data,$delPostQuery);
							
							//delete comments on post
							$delCommentsQuery = "delete from commentpost where community='".$post["Community"]."' and Title='".$post["Title"]."'";
							mysqli_query($data,$delCommentsQuery);
							header("Location:home.php");
						}
					}

					$profilePic="";
					if($signedInStatus == "True"){
						if($userarray[3] == "User"){
							foreach(array_values($postArr) as $key => $post){
								$profilePic=searchAuthor($post["Author"],$imagesArray);
								echo "<div class='singlePost'>";
								echo "<a href='users.php'><img class='userImg' src='data:image/jpeg;base64,".base64_encode($profilePic)."'></a>";
								echo "<label class='postUser'><a class='postUser' href='users.php' > ".$post["Author"]." </a></label>";
								if($post["Author"] == $userarray[0]){
									echo "<img class='delImg' src='pictures/delete.png'/>";
									echo "<form class='deleteBtnForm' method='post'>";
									echo "<input class='deleteBtn' type='submit' name='del".$post["Title"]."Btn' value=''/><br><br>";
									echo "</form>";									
								}
								echo "<form method='post'>";
								echo "<input class='postTitleBtn' type='submit' name='".$post["Title"]."' value='".$post["Title"]."'/><br><br>";
								echo "</form>";
								//echo "<label class='postTitle'><a class='postTitle' href='' name='".$$post[$key]["Title"]."'> ".$postsArr["Title"]." </a></label><br>";
								echo "<label class='stars'> ".$post["Likes"]." Stars </label>";
								echo "<label class='comments'> ".$post["Comments"]." Comments </label>";
								echo "<br>";
								echo "</div>";
							}
						} else {
							foreach(array_values($postArr) as $key => $post){
								$profilePic=searchAuthor($post["Author"],$imagesArray);
								echo "<div class='singlePost'>";
								echo "<img class='userImg' src='data:image/jpeg;base64,".base64_encode($profilePic)."'>";
								echo "<label class='postUser'><a class='postUser' href='users.php' > ".$post["Author"]." </a></label>";
								echo "<img class='delImg' src='pictures/delete.png'/>";
								echo "<form class='deleteBtnForm' method='post'>";
								echo "<input class='deleteBtn' type='submit' name='del".$post["Title"]."Btn' value=''/><br><br>";
								echo "</form>";
								echo "<form method='post'>";
								echo "<input class='postTitleBtn' type='submit' name='".$post["Title"]."' value='".$post["Title"]."'/><br><br>";
								echo "</form>";
								//echo "<label class='postTitle'><a class='postTitle' href='' name='".$$post[$key]["Title"]."'> ".$postsArr["Title"]." </a></label><br>";
								echo "<label class='stars'> ".$post["Likes"]." Stars </label>";
								echo "<label class='comments'> ".$post["Comments"]." Comments </label>";
								echo "<br>";
								echo "</div>";
							}
						}
					} else {
						foreach(array_values($postArr) as $key => $post){
							echo "<div class='singlePost'>";
							echo "<a href='users.php'><img src='pictures/user.png'></a>";
							echo "<label class='postUser'><a class='postUser' href='users.php' > ".$post["Author"]." </a></label>";
							echo "<form method='post'>";
							echo "<input class='postTitleBtn' type='submit' name='".$post["Title"]."' value='".$post["Title"]."'/><br><br>";
							echo "</form>";
							//echo "<label class='postTitle'><a class='postTitle' href='' name='".$$post[$key]["Title"]."'> ".$postsArr["Title"]." </a></label><br>";
							echo "<label class='stars'> ".$post["Likes"]." Stars </label>";
							echo "<label class='comments'> ".$post["Comments"]." Comments </label>";
							echo "<br>";
							echo "</div>";
						}
					}
				?>
			</div>
			
			<?php
				$threadQuery = mysqli_query($data,"select * from posts where PostType='Thread'");
				$threadsCount = mysqli_num_rows($threadQuery);
				$projectQuery = mysqli_query($data,"select * from posts where PostType='Project'");
				$projectsCount = mysqli_num_rows($projectQuery);
			?>
			
			<!--RIGHT SIDE-->
			<div class="data">
				<ul class="data">
					<li class="threadsNum">Total Threads: <?php echo $threadsCount; ?></li>
					<li class="projectsNum">Total Projects: <?php echo $projectsCount; ?></li>
				</ul>
			</div>
			
			<!--FOOTER-->
			<div class="footer">
				
			</div>
				
		</div>
		
	</body>
</html>