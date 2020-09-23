<html>
	<?php require_once 'config.php'?>
	<?php require_once (ROOT_PATH .'\includes\header.php')?>
	<?php require_once (ROOT_PATH .'\includes\navigation.php')?>
	<head>
		<title>Website Project</title>
		<link rel="stylesheet" type="text/css" href="css/community.css">
	</head>
	

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
				$userarray=$GLOBALS["userArr"];
				$errorMessage=" ";
				
					$communitiesListQuery = mysqli_query($data,"select * from communitieslist");
					
					//displays chosen community as title
					if($_SESSION['status'] == "selected"){
						echo "<label class='titleLabel'>".$_SESSION['commSelected']."</label>";
					}
					
					if(isset($_POST["createBtn"]))
					{
						$title=$content=" ";
						if ($_SERVER["REQUEST_METHOD"] == "POST")
						{
							if(empty($_POST["createTitle"])||empty($_POST["createContent"]))
							{
								$errorMessage = "Fill up Title and Content";
							}
							else{
								$title=$_POST["createTitle"];
								$content=$_POST["createContent"];
								$community=$_SESSION['commSelected'];
								if(empty($_FILES["createImage"]["name"]))
								{	
									$statement="insert into posts(Author,Title,TextContent,Likes,Comments,Community,PostType,Upload) values('$userarray[0]','$title','$content','0','0','$community','Thread',NOW())";
									mysqli_query($data,$statement);
								}
								else
								{
									//get file info
									$fileName = basename($_FILES["createImage"]["name"]); 
									$fileType = pathinfo($fileName, PATHINFO_EXTENSION);
									// Allow certain file formats 
									$allowTypes = array('jpg','png','jpeg','gif'); 
									if(in_array($fileType, $allowTypes)){ 
										$image = $_FILES['createImage']['tmp_name']; 
										$imgContent = addslashes(file_get_contents($image));
										$statement="insert into posts(Author,Title,TextContent,ImageContent,Likes,Comments,Community,PostType,Upload) values('$userarray[0]','$title','$content','$imgContent','0','0','$community','Thread',NOW())";
										$status=mysqli_query($data,$statement);
										if($status)
										{
											$errorMessage="File sucessfully Upload";
										}else
										{
											$errorMessage="File upload Failed";

										}
									}
									else{
										$errorMessage="Sorry, only JPG, JPEG, PNG, & GIF files are allowed to upload.";
									}
								}
							}
						}
					}

					
				?>
			</div>
			
			<div class="headers">
				<label class="threads"><a href="#"> Threads </a></label>
				<span class="divider1"> </span>
				<label class="projects"><a href="#"> Projects </a></label>
			</div>
			
			
				<div class="create">
				<form method ="post" enctype="multipart/form-data">
					<label class="createPost"> Create a Post </label>
					<table class="createDetails">
					<tr><td><input class="titleInput" type = "text" name = "createTitle" Placeholder="Title"/></td></tr>
					<tr><td><input class="contentInput" type = "text" name = "createContent" Placeholder="Thread Discussion"/></td></tr>
					<tr><td><input class="imageInput" type = "file" name = "createImage"></td></tr>
					<tr><td><span style="color:red"> <?php echo $errorMessage;?> </span></td></tr>
					<tr><td><input class="createBtn" type = "submit" name = "createBtn" value="Create Post"/></td></tr>
				</table>
				</form>
				</div>
			
				
			<div class ="post">
				<?php 		
					$postsArr = array();
					$community=$_SESSION['commSelected'];
					$postsQuery = mysqli_query($data,"select * from posts where community = '$community'");
					
					$postArr = array();
					
					$titleArr = array();
					
					while($posts = mysqli_fetch_array($postsQuery)){
						/*$author = $posts["Author"];
						$title = $posts["Title"];
						$textContent = $posts["TextContent"];
						$imageContent = $posts["ImageContent"];
						$likes = $posts["Likes"];
						$comments = $posts["Comments"];
						$community = $posts["Community"];
						$postType = $posts["PostType"];
						$upload = $posts["Upload"];*/
						//array_push($postsArr,$author,$title,$textContent,$imageContent,$likes,$comments,$community,$postType,$upload);
						$postsArr["Author"] = $posts["Author"];
						$postsArr["Title"] = $posts["Title"];
						$postsArr["TextContent"] = $posts["TextContent"];
						$postsArr["ImageContent"] = $posts["ImageContent"];
						$postsArr["Likes"] = $posts["Likes"];
						$postsArr["Comments"] = $posts["Comments"];
						$postsArr["Community"] = $posts["Community"];
						$postsArr["PostType"] = $posts["PostType"];
						$postsArr["Upload"] = $posts["Upload"];
						array_push($titleArr,$posts["Title"]);
						array_push($postsArr,$postsArr["Author"],$postsArr["Title"],$postsArr["TextContent"],$postsArr["ImageContent"],$postsArr["Likes"],$postsArr["Comments"]
						,$postsArr["Community"],$postsArr["PostType"],$postsArr["Upload"]);
						array_push($postArr,$postsArr);
						
						echo "<div class='singlePost'>";
						echo "<a href='users.php'><img src='pictures/user.png'></a>";
						echo "<label class='postUser'><a class='postUser' href='users.php' > ".$postsArr["Author"]." </a></label><br><br>";
						echo "<form method='post'>";
						echo "<input class='postTitleBtn' type='submit' name='".$postsArr["Title"]."' value='".$postsArr["Title"]."'/><br><br>";
						echo "</form>";
						//echo "<label class='postTitle'><a class='postTitle' href='' name='".$postsArr["Title"]."'> ".$postsArr["Title"]." </a></label><br>";
						echo "<label class='stars'> ".$postsArr["Likes"]." Stars </label>";
						echo "<label class='comments'> ".$postsArr["Comments"]." Comments </label>";
						echo "<br>";
						echo "</div>";
					}
					
					//foreach($postArr as $post){
						//echo $post["Title"];
					//}
					
					foreach($postArr as $post){
						if(isset($_POST[$post["Title"]])){
							$_SESSION['statusPost'] = "selected";
							$_SESSION['TitlePost'] = $post["Title"];
							$_SESSION['TextContentPost'] = $post["TextContent"];
							$_SESSION['StarsPost'] = $post["Likes"];
							$_SESSION['CommentsPost'] = $post["Comments"];
							header("Location: post.php");
						}
					}
					
					mysqli_close($data);
				?>
			</div>
			
			<div class="data">
				Data
			</div>
			
			<div class="footer">
				
			</div>
				
		</div>
		
	</body>
</html>