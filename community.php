<html>
	<?php require_once 'config.php'?>
	<?php require_once (ROOT_PATH .'\includes\header.php')?>
	<?php require_once (ROOT_PATH .'\includes\navigation.php')?>
	<head>
		<title>Website Project</title>
		<link rel="stylesheet" type="text/css" href="css/community.css">
	</head>
	
	<?php
		$signedInStatus = false;
	?>

	<body>
			<!--LEFT SIDE-->
			<div class="searchPost">
				<ul class="searchPost">
					<li><label class="searchPosts"> Search Posts </label></li>
					<li><form class="searchForm" action="search.php" method="get">
						<input class="searchPostInput" type="text" name="searchPostInput" Placeholder="Search" /></li>
					<li><input class="searchPostBtn" type="submit" name="searchPostBtn" value="Search" /></li>
					</form>
				</ul>
			</div>
			
			<div class="title">
				<?php 
				global $data;
				
					$communitiesListQuery = mysqli_query($data,"select * from communitieslist");
					
					//displays chosen community as title
					if($_SESSION['status'] == "selected"){
						echo "<label class='titleLabel'>".$_SESSION['commSelected']."</label>";
					}
					
					mysqli_close($data);
				?>
			</div>
			
			<div class="headers">
				<label class="threads"><a href="#"> Threads </a></label>
				<span class="divider1"> </span>
				<label class="projects"><a href="#"> Projects </a></label>
			</div>
			
			<?php 
				$errorMessage = "sample error";
			?>
			
			<div class="create">
				<label class="createPost"> Create a Post </label>
				<table class="createDetails">
				<tr><td><input class="titleInput" type = "text" name = "createTitle" Placeholder="Title"/></td></tr>
				<tr><td><input class="contentInput" type = "text" name = "createContent" Placeholder="Thread Discussion"/></td></tr>
				<tr><td><input class="imageInput" type = "file" name = "createImage" Placeholder="Image Filepath"/></td></tr>
				<tr><td><span style="color:red"> <?php echo $errorMessage;?> </span></td></tr>
				<tr><td><input class="createBtn" type = "submit" name = "createBtn" value="Create Post"/></td></tr>
			</table>
			</div>
				
			<div class ="post">
				<a href="users.php"><img src="pictures/user.png"></a>
				<label class="postUser"><a class="postUser" href="users.php" > Username </a></label><br><br>
				<label class="postTitle"><a class="postTitle" href="post.php" > Title </a></label><br><br>
				<label class="stars"> 0 Stars </label>
				<label class="comments"> 0 Comments </label>
			</div>
			
			<div class="data">
				Data
			</div>
			
			<div class="footer">
				
			</div>
				
		</div>
		
	</body>
</html>