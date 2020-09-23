<html>
	<?php require_once 'config.php'?>
	<?php require_once (ROOT_PATH .'\includes\header.php')?>
	<?php require_once (ROOT_PATH .'\includes\navigation.php')?>
	<head>
		<title>Website Project</title>
		<link rel="stylesheet" type="text/css" href="css/post.css">
	</head>
	
	<body>
			
			<div class="title">
				<?php 
					global $data;
					$userarray=$GLOBALS["userArr"];
					
					$community = $_SESSION['commSelected'];
					//displays chosen community as title
					if($_SESSION['status'] == "selected"){
						echo "<label class='titleLabel'>".$community."</label>";
					}
					
					
				?>
			</div>
				
			<div class ="post">
				<a href="users.php"><img class='user' src="pictures/user.png"></a>
				<?php
					$likesCount = $_SESSION['StarsPost'];
					$postAuthor = $_SESSION['AuthorPost'];
					$postTitle = $_SESSION['TitlePost'];
					$postImageContent = $_SESSION['ImageContentPost'];
					$postPostType = $_SESSION['PostTypePost'];
					$postComment = $_SESSION['CommentsPost'];
					
					$errorMessage = " ";
					
					if(isset($_POST['likeBtn'])){
						if($signedInStatus == "True"){
							$checkLikes = "select * from postlikes where Username='".$userarray[0]."' and Title='".$postTitle."'";
							$liked = mysqli_query($data,$checkLikes);
							$likeArr = mysqli_fetch_array($liked);
							
							if(empty($likeArr)){
								$likesCount = $_SESSION['StarsPost'] + 1;
								$addLikes = "update posts set Likes='".$likesCount."' where Title='".$postTitle."'";
								mysqli_query($data,$addLikes);
								
								$addLikes2 = "insert into postlikes values('".$userarray[0]."','".$postTitle."','".$community."','".$postPostType."')";
								mysqli_query($data,$addLikes2);
							}
						} else {
							$errorMessage = "You have to be logged in to do that!";
						}
					}
				
					if($_SESSION['statusPost'] == "selected"){
						echo "<label class='postUser'><a class='postUser' href='users.php' > ".$postAuthor." </a></label><br><br>";
						echo "<label class='postTitle'>".$postTitle."</label><br><br>";
						echo "<img src='".$postImageContent."'>" ;
						//echo "<img class='content' src='data:image/jpeg;base64,".base64_encode($postImageContent)."'><br>";
						echo "<p class='postContent'>".$_SESSION['TextContentPost']."</p><br>";
						echo "<form class='starsForm' action='".$_SERVER['PHP_SELF']."' method='post'>";
						echo "<input class='likeBtn' type='submit' name='likeBtn' value='Star'></form>";
						echo "<label class='stars'>" .$likesCount." Stars </label>";
						echo "<label class='comments'>" .$postComment." Comments </label>";
					}
				?>
				<!--only if post has image/s
					<img src="pictures/user.png"><br>
				-->
				
			</div>
			
			<?php 				
				if(isset($_POST['commentBtn'])){
					if($signedInStatus == "True"){					
						if(!empty($_POST['commentContent'])){
							$commentsCount = $_SESSION['CommentsPost'] + 1;
							echo $commentsCount;
							$addComment = "update posts set Comments='".$commentsCount."' where Title='".$postTitle."'";
							mysqli_query($data,$addComment);
							
							$addComment2 = "insert into comments values('".$userarray[0]."','".$postTitle."','".$_POST['commentContent']."','','0','".$community."','".$postPostType."')";
							//".$_POST['commentImage']."
							mysqli_query($data,$addComment2);
						}
					} else {
						$errorMessage = "You have to be logged in to do that!";
					}
				}
				
			?>
			
			<div class="comment">
				<label class="createComment"> Write a Comment </label>
				<table class="commentDetails">
				<tr><td><input class="commentInput" type = "text" name = "commentContent" Placeholder="Write a comment.."/></td></tr>
				<tr><td><input class="imageInput" type = "file" name = "commentImage" Placeholder="Image Filepath"/></td></tr>
				<tr><td><span style="color:red"> <?php echo $errorMessage;?> </span></td></tr>
				<tr><td><form action=" <?php echo $_SERVER['PHP_SELF']; ?>" method='post'><input class="commentBtn" type = "submit" name = "commentBtn" value="Post Comment"/></form></td></tr>
			</table>
			</div>
			
			<div class ="postComments">
				<?php 
				
					$commentsQuery = "select * from comments where Community='$community'";
					$commentsArr = mysqli_query($data,$commentsQuery);
					$comments = mysqli_fetch_array($commentsArr);
					
					
					while(!empty($comments)){
						echo "<a href='users.php'><img src='pictures/user.png'></a>";
						echo "<label class='postUser'><a class='postUser' href='users.php' > ".$comments['Username']." </a></label><br><br>";
						echo "<p class='postComment'> Comment </p><br>";
						//<label class='stars'> 0 Stars </label> //THIS IS EXTRA, IF THERE IS TIME
					}
					mysqli_close($data);
				?>
			</div>
			
			<div class="data">
			</div>
			
			<div class="footer">
				
			</div>
				
		</div>
		
	</body>
</html>