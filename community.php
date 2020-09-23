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
		
		<!-- DIVIDER BEWTEEN THREAD AND PROJECT -->
		<div class="headers">
			<label class="threads"><a href="#"> Threads </a></label>
			<span class="divider1"> </span>
			<label class="projects"><a href="#"> Projects </a></label>
		</div>
			
		<!-- CREATE POSTS -->
		<div class="create">
		<?php
			global $data;
			$userarray=$GLOBALS["userArr"];
			$errorMessage=" ";
			
			if(isset($_POST["createBtn"]))
			{
				if ($_SERVER["REQUEST_METHOD"] == "POST")
				{
					$title=$content=" ";
					if(empty($_POST["createTitle"])||empty($_POST["createContent"])){
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
						else{
							//get file info
							$fileName = $_FILES["createImage"]["name"];
							$fileError= $_FILES["createImage"]["error"];
							$filetmp = $_FILES["createImage"]["tmp_name"];
							$fileExt = explode('.',$fileName);
							$fileActualExt = strtolower(end($fileExt));
							// Allow certain file formats 
							$allowTypes = array('jpg','png','jpeg','gif'); 
							if(in_array($fileActualExt, $allowTypes)){ 
								if($fileError === 0)
								{
									$fileNameNew = $fileExt[0].".".$fileActualExt;
									$fileDestination ='upload/'.$fileNameNew;
									move_uploaded_file($filetmp,$fileDestination);
									$statement="insert into posts(Author,Title,TextContent,ImageContent,Likes,Comments,Community,PostType,Upload) values('$userarray[0]','$title','$content','$fileDestination','0','0','$community','Thread',NOW())";
									mysqli_query($data,$statement);
									$errorMessage="File Upload Sucess";
								}else{
									$errorMessage="File Upload Failed";
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
					
					foreach($postArr as $post){
						if(isset($_POST[$post["Title"]])){
							$_SESSION['statusPost'] = "selected";
							$_SESSION['AuthorPost'] = $post["Author"];
							$_SESSION['TitlePost'] = $post["Title"];
							$_SESSION['ImageContentPost'] = $postsArr["ImageContent"];
							$_SESSION['TextContentPost'] = $post["TextContent"];
							$_SESSION['StarsPost'] = $post["Likes"];
							$_SESSION['CommentsPost'] = $post["Comments"];
							$_SESSION['PostTypePost'] = $post["PostType"];
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
		
	</body>
</html>