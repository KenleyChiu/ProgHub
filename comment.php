<html>
	<?php require_once 'config.php'?>
	<?php require_once (ROOT_PATH .'\includes\header.php')?>
	<?php require_once (ROOT_PATH .'\includes\navigation.php')?>
	<?php require_once (ROOT_PATH .'\includes\getauthorImage.php')?>
	<head>
		<title>Website Project</title>
		<link rel="stylesheet" type="text/css" href="css/comment.css">
	</head>
	
	<body>
			
			<div class="title">
				<?php 
					global $data;
					$userarray=$GLOBALS["userArr"];
					
					$community = $_SESSION['commSelected'];
					$imagesArray= $GLOBALS["allUserImages"];
					
					//displays chosen community as title
					if($_SESSION['status'] == "selected"){
						echo "<label class='titleLabel'>".$community."</label>";
					}
				?>
			</div>
			
			<div class="back">
				<form class="backForm" action="post.php" method="post">
					<input class="backBtn" type="submit" name="backBtn" value="Back to Post" />
				</form>
			</div>
				
			<div class ="comment">
				
				<?php
					$likesCount = $_SESSION['StarsPost'];
					$postAuthor = $_SESSION['AuthorPost'];
					$postTitle = $_SESSION['TitlePost'];
					$postTextContent = $_SESSION['TextContentPost'];
					$postImageContent = $_SESSION['ImageContentPost'];
					$postPostType = $_SESSION['PostTypePost'];
					$commentsCount = $_SESSION['CommentsPost'];
					$errorMessage = " ";
					if(isset($_POST['editComment'])){
						//use this for new session
						$_SESSION['AuthorPost'] = $postAuthor;
						$_SESSION['TitlePost'] = $postTitle;
						$_SESSION['ImagePost'] = $postImageContent;
						$_SESSION['TextPost'] = $postTextContent;
						
						/* //or try this (using previous session)
						$_SESSION['AuthorPost'];
						$_SESSION['TitlePost'];
						$_SESSION['TextContentPost'];
						$_SESSION['ImageContentPost'];*/
						
						header("Location: editComment.php");
					}

					if(isset($_POST['deleteComment']))
					{
						$delPostQuery = "delete from commentPost where community='$community' and Title='$postTitle'";
						mysqli_query($data,$delPostQuery);
						header("Location:post.php");
					}
					$profilePic= searchAuthor($postAuthor,$imagesArray);
					echo "<a href='users.php'><img class='userImg' src='data:image/jpeg;base64,".base64_encode($profilePic)."'></a>";
					if(isset($_POST['likeBtn'])){
						if($signedInStatus == "True"){
							$checkLikes = "select * from postlikes where Username='".$userarray[0]."' and Title='".$postTitle."'";
							$liked = mysqli_query($data,$checkLikes);
							$likeArr = mysqli_fetch_array($liked);
							
							if(empty($likeArr)){
								$likesCount = $_SESSION['StarsPost'] + 1;
								$addLikes = "update posts set Likes='".$likesCount."' where Title='".$postTitle."'";
								mysqli_query($data,$addLikes);
								$_SESSION['StarsPost']=$likesCount;
								
								$addLikes2 = "insert into postlikes values('".$userarray[0]."','".$postTitle."','".$community."','".$postPostType."')";
								mysqli_query($data,$addLikes2);
							}
						} else {
							$errorMessage = "You have to be logged in to do that!";
						}
					}
					
					
					
					if($_SESSION['statusPost'] == "selected"){
						echo "<label class='postUser'><a class='postUser' href='users.php' > ".$postAuthor." </a></label>";
						if($postAuthor == $userarray[0] || $userarray[3]== "Admin")
						{
							echo "<img class='delImg' src='pictures/delete.png'/>";
							echo "<form class='deleteBtnForm' method='post'>";
							echo "<input class='deleteBtn' type='submit' name='deleteComment' value =''/><br><br>";
							echo "</form>";
							echo "<form class='editBtnForm' method='post'>";
							echo "<input class='editBtn' type='submit' name='editComment' value='Edit Post'/><br>";
							echo "</form>";
						}						
						echo "<br><br><label class='postTitle'>".$postTitle."</label><br><br>";
						echo "<br><p class='postContent'>".$postTextContent."</p><br>";
						echo "<img class='postImg' src='".$postImageContent."'/><br>" ;
						echo "<form class='starsForm' action='".$_SERVER['PHP_SELF']."' method='post'>";
						echo "<input class='likeBtn' type='submit' name='likeBtn' value='Star'></form>";
						echo "<label class='stars'>" .$likesCount." Stars </label>";
						echo "<label class='comments'>" .$commentsCount." Comments </label>";
					}

					
				?>				
			</div>
			
			<div class="data">
			</div>
			
			<div class="footer">
				
			</div>
				
		</div>
		
	</body>
</html>