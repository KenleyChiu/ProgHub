<html>
	<?php require_once 'config.php'?>
	<?php require_once (ROOT_PATH .'\includes\header.php')?>
	<?php require_once (ROOT_PATH .'\includes\navigation.php')?>
	<?php require_once (ROOT_PATH .'\includes\getauthorImage.php')?>
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
					$imagesArray= $GLOBALS["allUserImages"];
					//displays chosen community as title
					if($_SESSION['status'] == "selected"){
						echo "<label class='titleLabel'>".$community."</label>";
					}
					
					
				?>
			</div>
			
			<div class="back">
				<form class="backForm" action="community.php" method="post">
					<input class="backBtn" type="submit" name="backBtn" value="Back to Community" />
				</form>
			</div>
				
			<div class ="post">
				
				<?php
					$likesCount = $_SESSION['StarsPost'];
					$postAuthor = $_SESSION['AuthorPost'];
					$postTitle = $_SESSION['TitlePost'];
					$postImageContent = $_SESSION['ImageContentPost'];
					$postPostType = $_SESSION['PostTypePost'];
					$commentsCount = $_SESSION['CommentsPost'];
					$errorMessage = " ";
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
					// if create comment button is pressed
					if(isset($_POST['commentBtn'])){
						if($signedInStatus == "True"){		
							$comment="";
							if ($_SERVER["REQUEST_METHOD"] == "POST")
							{
								if(empty($_POST['commentContent']))
								{
									$errorMessage = "Fill up Comment";
								}
								else{
									$comment= $_POST["commentContent"];
									if(empty($_FILES["commentImage"]["name"]))
									{	
										$statement="Insert into comments values ('$userarray[0]','$postTitle','$comment','','0','$community','Thread',NOW())";
										mysqli_query($data,$statement);
										$commentsCount++;
										$addComment = "update posts set Comments='".$commentsCount."' where Title='".$postTitle."'";
										mysqli_query($data,$addComment);
										$_SESSION['CommentsPost']=$commentsCount;
									}else{
											//get file info
										$fileName = $_FILES["commentImage"]["name"];
										$fileError= $_FILES["commentImage"]["error"];
										$filetmp = $_FILES["commentImage"]["tmp_name"];
										$fileExt = explode('.',$fileName);
										$fileActualExt = strtolower(end($fileExt));
										// Allow certain file formats 
										$allowTypes = array('jpg','png','jpeg','gif'); 
										if(in_array($fileActualExt, $allowTypes)){ 
											if($fileError === 0){
												$fileNameNew = $fileExt[0].".".$fileActualExt;
												$fileDestination ='upload/'.$fileNameNew;
												move_uploaded_file($filetmp,$fileDestination);
												$statement = "Insert into comments values ('$userarray[0]','$postTitle','$comment','$fileDestination','0','$community','Thread',NOW())";
												$status=mysqli_query($data,$statement);
												if($status){
													$errorMessage="File sucessfully Upload";
													$commentsCount++;
													$addComment = "update posts set Comments='".$commentsCount."' where Title='".$postTitle."'";
													mysqli_query($data,$addComment);
													$_SESSION['CommentsPost']=$commentsCount;
												}else{
													$errorMessage="File upload Failed";
												}
											}else{
												$errorMessage = "Sorry, only JPG, JPEG, PNG, & GIF files are allowed to upload.";
											}
										}
									}
								}
							}
						 }else {
							$errorMessage = "You have to be logged in to do that!";
						}
					}
					
					if($_SESSION['statusPost'] == "selected"){
						echo "<label class='postUser'><a class='postUser' href='users.php' > ".$postAuthor." </a></label><br><br>";
						echo "<label class='postTitle'>".$postTitle."</label><br><br>";
						echo "<img class='postImg' src='".$postImageContent."'/><br>" ;
						echo "<br><p class='postContent'>".$_SESSION['TextContentPost']."</p><br>";
						echo "<form class='starsForm' action='".$_SERVER['PHP_SELF']."' method='post'>";
						echo "<input class='likeBtn' type='submit' name='likeBtn' value='Star'></form>";
						echo "<label class='stars'>" .$likesCount." Stars </label>";
						echo "<label class='comments'>" .$commentsCount." Comments </label>";
					}

					
				?>				
			</div>
			
			
			<div class="comment">
				<label class="createComment"> Write a Comment </label>
				<form method= "post" enctype="multipart/form-data" action="<?php echo $_SERVER["PHP_SELF"];?>">
					<table class="commentDetails">
					<tr><td><input class="commentInput" type = "text" name = "commentContent" Placeholder="Write a comment.."/></td></tr>
					<tr><td><input class="imageInput" type = "file" name = "commentImage" Placeholder="Image Filepath"/></td></tr>
					<tr><td><span style="color:red"> <?php echo $errorMessage;?> </span></td></tr>
					<tr><td><form action=" <?php echo $_SERVER['PHP_SELF']; ?>" method='post'><input class="commentBtn" type = "submit" name = "commentBtn" value="Post Comment"/></form></td></tr>
				</table>
				</form>
			</div>
			
			<div class ="postComments">
				<?php 
				
					$commentsQuery = "select * from comments where Community='$community' and Title = '$postTitle'";
					$commentsArr = mysqli_query($data,$commentsQuery);
					
					while($comments = mysqli_fetch_array($commentsArr)){
						$profilePic=searchAuthor($comments['Username'],$imagesArray);
						echo "<div class='singlePost'>";
					 	echo "<a href='users.php'><img src='pictures/user.png'></a>";
						echo "<label class='postUser'><a class='postUser' href='users.php' > ".$comments['Username']." </a></label><br><br>";
						echo "<img class='postImg' src='".$comments['ImageComment']."'/><br>" ;
						echo "<p class='postComment'>".$comments['TextComment']." </p><br>";
						echo "</div>";
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