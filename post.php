<html>
	<head>
		<title>Website Project</title>
		<link rel="stylesheet" type="text/css" href="css/post.css">
	</head>
	
	<?php
		session_start();
		$signedInStatus = false;
	?>

	<body>
		<?php include 'header.php';?>

		<?php include 'navigation.php';?>
			
			<div class="title">
				<?php 
					$sqlConnection = mysqli_connect("localhost","root","");
				
					if($sqlConnection) {
						$pghDatabase = mysqli_select_db($sqlConnection,'proghub_data');
					} else {
						die("Connection was not established!".mysqli_error());
					}
					
					$communitiesListQuery = mysqli_query($sqlConnection,"select * from communitieslist");
					
					//displays chosen community as title
					if($_SESSION['status'] == "selected"){
						echo "<label class='titleLabel'>".$_SESSION['commSelected']."</label>";
					}
					
					mysqli_close($sqlConnection);
				?>
			</div>
				
			<div class ="post">
				<a href="users.php"><img src="pictures/user.png"></a>
				<label class="postUser"><a class="postUser" href="users.php" > Username </a></label><br><br>
				<label class="postTitle"> Title </label><br><br>
				<p class="postContent"> Content </p><br>
				<!--only if post has image/s
					<img src="pictures/user.png"><br>
				-->
				<label class="stars"> 0 Stars </label>
				<label class="comments"> 0 Comments </label>
			</div>
			
			<?php 
				$errorMessage = "sample error";
			?>
			
			<div class="comment">
				<label class="createComment"> Write a Comment </label>
				<table class="commentDetails">
				<tr><td><input class="commentInput" type = "text" name = "commentContent" Placeholder="Thread Discussion"/></td></tr>
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
				?>
			</div>
			
			<div class="data">
			</div>
			
			<div class="footer">
				
			</div>
				
		</div>
		
	</body>
</html>