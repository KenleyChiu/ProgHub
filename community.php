<?php require_once 'config.php'?>
<?php require_once (ROOT_PATH .'\includes\header.php')?>
<?php require_once (ROOT_PATH .'\includes\navigation.php')?>
<html>
	<head>
		<title>Website Project</title>
		<link rel="stylesheet" type="text/css" href="css/community.css">
	</head>
	<body>
		<!-- TITLE -->
		<div class="title">
			<?php
				//displays chosen community as title
				if($_SESSION['status'] == "selected"){
					echo "<label class='titleLabel'>".$_SESSION['commSelected']."</label>";
				}
				
			?>		
		</div>
		
		<!--LEFT SIDE-->
		<div class="searchPosts">
			<ul class="searchPost">
				<li><label class="searchPosts"> Search Posts </label></li>
				<li><form class="searchForm" action="search.php" method="get">
					<input class="searchPostInput" type="text" name="searchPostInput" Placeholder="Search" /></li>
		</div>
		
		<div class="searchPosts2">
			<li><input class="searchPostBtn" type="submit" name="searchPostBtn" value="Search" /></li>
				</form>
			</ul>
		</div>
		
		<!-- DIVIDER BEWTEEN THREAD AND PROJECT -->
		<div class="headers">
			<label class="threads"><a href="#"> Threads </a></label>
			<span class="divider1"> </span>
			<label class="projects"><a href="#"> Projects </a></label>
			<form class="createBtnForm" method ="post" action="createPost.php">
				<input class="createBtn" type = "submit" name = "goTocreate" value="Create Post"/>
			</form>
		</div>
				
		<div class ="post">
			<?php	
				$postsArr = array();
				$community=$_SESSION['commSelected'];
				$postsQuery = mysqli_query($data,"select * from posts where community = '$community'");
				
				$postArr = array();
				
				while($posts = mysqli_fetch_array($postsQuery)){
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
						$_SESSION['PostTypePost'] = $post["PostType"];
						header("Location:post.php");
					}
				}
				
				foreach(array_values($postArr) as $key => $post){
					echo "<div class='singlePost'>";
					echo "<a href='users.php'><img src='pictures/user.png'></a>";
					echo "<label class='postUser'><a class='postUser' href='users.php' > ".$post["Author"]." </a></label><br>";
					echo "<form method='post'>";
					echo "<input class='postTitleBtn' type='submit' name='".$post["Title"]."' value='".$post["Title"]."'/><br><br>";
					echo "</form>";
					//echo "<label class='postTitle'><a class='postTitle' href='' name='".$$post[$key]["Title"]."'> ".$postsArr["Title"]." </a></label><br>";
					echo "<label class='stars'> ".$post["Likes"]." Stars </label>";
					echo "<label class='comments'> ".$post["Comments"]." Comments </label>";
					echo "<br>";
					echo "</div>";
				}
				
				
			?>
		
		</div>
		
		<?php
			$threadQuery = mysqli_query($data,"select * from posts where Community='$community' and PostType='Thread'");
			$threadsCount = mysqli_num_rows($threadQuery);
			$projectQuery = mysqli_query($data,"select * from posts where Community='$community' and PostType='Project'");
			$projectsCount = mysqli_num_rows($projectQuery);
			
			mysqli_close($data);
		?>
			
		<div class="data">
			<ul class="data">
				<li class="threadsNum">Total Threads: <?php echo $threadsCount; ?></li>
				<li class="projectsNum">Total Projects: <?php echo $projectsCount; ?></li>
			</ul>
		</div>
			
		<div class="footer">
				
		</div>
		
	</body>
</html>