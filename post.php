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
					
					//displays chosen community as title
					if($_SESSION['status'] == "selected"){
						echo "<label class='titleLabel'>".$_SESSION['commSelected']."</label>";
					}
					
					
				?>
			</div>
				
			<div class ="post">
				<a href="users.php"><img src="pictures/user.png"></a>
				<label class="postUser"><a class="postUser" href="users.php" > Username </a></label><br><br>
				<?php
					if(isset($_POST['likeBtn'])){
						$likesCount = $_SESSION['StarsPost'] + 1;
						$addLikes = "update posts set Likes='".$likesCount."' where Title='".$_SESSION['TitlePost']."'";
						mysqli_query($data,$addLikes);
					}
				
					if($_SESSION['statusPost'] == "selected"){
						echo "<label class='postTitle'>".$_SESSION['TitlePost']."</label><br><br>";
						echo "<p class='postContent'>".$_SESSION['TextContentPost']."</p><br>";
						echo "<input class='likeBtn' type='submit' name='likeBtn' value='Star'>";
						echo "<label class='stars'>" .$_SESSION['StarsPost']." Stars </label>";
						echo "<label class='comments'>" .$_SESSION['CommentsPost']." Comments </label>";
					}
				?>
				<!--only if post has image/s
					<img src="pictures/user.png"><br>
				-->
				
			</div>
			
			<?php 
				$errorMessage = "sample error";
			?>
			
			<div class="comment">
				<label class="createComment"> Write a Comment </label>
				<table class="commentDetails">
				<tr><td><input class="commentInput" type = "text" name = "commentContent" Placeholder="Write a comment.."/></td></tr>
				<tr><td><input class="imageInput" type = "file" name = "commentImage" Placeholder="Image Filepath"/></td></tr>
				<tr><td><span style="color:red"> <?php echo $errorMessage;?> </span></td></tr>
				<tr><td><input class="commentBtn" type = "submit" name = "commentBtn" value="Post Comment"/></td></tr>
			</table>
			</div>
			
			<div class ="postComments">
				<?php 
					for($x=0;$x<1;$x++){
						echo "<a href='users.php'><img src='pictures/user.png'></a>
						<label class='postUser'><a class='postUser' href='users.php' > Username </a></label><br><br>
						<p class='postComment'> Comment </p><br>
						<label class='stars'> 0 Stars </label>";
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