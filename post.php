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
					
					function fillUserArray($usersListQuery){
						$userArr = array();
						while($users = mysqli_fetch_array($usersListQuery)){
							$usersArr = array();
							$usersArr["Username"] = $users["Username"];
							$usersArr["Password"] = $users["Password"];
							$usersArr["Age"] = $users["Age"];
							$usersArr["Email"] = $users["Email"];
							$usersArr["Gender"] = $users["Gender"];
							$usersArr["Image"] = $users["Image"];
							$usersArr["Bio"] = $users["Bio"];
							$usersArr["Likes"] = $users["Likes"];
							array_push($usersArr,$usersArr["Username"],$usersArr["Password"],$usersArr["Age"],$usersArr["Email"],$usersArr["Gender"],$usersArr["Image"]
							,$usersArr["Bio"],$usersArr["Likes"]);
							array_push($userArr,$usersArr);
						}
						return $userArr;
					}
					
					function toUserProfile($user){
						$_SESSION['statusUser'] = "selected";
						$_SESSION['UsernameUser'] = $user["Username"];
						$_SESSION['AgeUser'] = $user["Age"];
						$_SESSION['EmailUser'] = $user["Email"];
						$_SESSION['GenderUser'] = $user["Gender"];
						$_SESSION['ImageUser'] = $user["Image"];
						$_SESSION['BioUser'] = $user["Bio"];
						$_SESSION['LikesUser'] = $user["Likes"];
						header("Location:userProfile.php");
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
					$postTextContent = $_SESSION['TextContentPost'];
					$postImageContent = $_SESSION['ImageContentPost'];
					$postPostType = $_SESSION['PostTypePost'];
					$commentsCount = $_SESSION['CommentsPost'];
					$errorMessage = " ";
					$allCommentArray = array();
					
					$usersListQuery = mysqli_query($user,"select * from userdetails");
							
					$userArr=fillUserArray($usersListQuery);
					
					// go to user.php
					if(isset($_POST['userBtn'])){
						foreach($userArr as $user){
							if($_POST['userBtn'] == $user["Username"]){
								toUserProfile($user);
							}
						}
					 }
					
					if(isset($_POST['editPost'])){
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
						
						header("Location: editPost.php");
					}

					if(isset($_POST['deletePost']))
					{
						$delPostQuery = "delete from posts where community='$community' and Title='$postTitle'";
						mysqli_query($data,$delPostQuery);
						$delLikesQuery = "delete from postlikes where community='$community' and Title='$postTitle'";
						mysqli_query($data,$delLikesQuery);
						$delCommentsQuery = "delete from commentpost where community='$community' and Title='$postTitle'";
						mysqli_query($data,$delCommentsQuery);
						header("Location:community.php");
					}

					if(isset($_POST['commentEditInfo']))
					{
						$_SESSION['id'] = $_POST['commentEditInfo'];
						header("Location:editComment.php");
					}

					if(isset($_POST['commentDeleteInfo']))
					{
						$_SESSION['id'] = $_POST['commentDeleteInfo'];
						header("Location:deleteComment.php");
					}
					$likeValue = "Star";
					$newLikes = "0";
					$profilePic= searchAuthor($postAuthor,$imagesArray);
					
						$checkLikes = "select * from postlikes where Community='".$community."' and Title='".$postTitle."'";
						$liked = mysqli_query($data,$checkLikes);
						$likeArr = mysqli_fetch_array($liked);
						$newLikes = $likesCount;
							
						
						
					if(isset($_POST['likeBtn'])){			
						if($signedInStatus == "True"){
							if(!empty($likeArr)){
								$likeValue = "Unstar";
							} else {
								$likeValue = "Star";
							}	
							if(empty($likeArr)){
								$newLikes = $likesCount + 1;
								$addLikes = "update posts set Likes='".$newLikes."' where Title='".$postTitle."'";
								mysqli_query($data,$addLikes);
								//session_unset($_SESSION['StarsPost']);
								$_SESSION['StarsPost']=$newLikes;
								$likesCount = $newLikes;
								
								$addLikes2 = "insert into postlikes values('".$userarray[0]."','".$postTitle."','".$community."','".$postPostType."')";
								mysqli_query($data,$addLikes2);
								$likeValue = "Unstar";
							} else {
								//$likeValue = "Unstar";
								$newLikes = $likesCount - 1;
								$minusLikes = "update posts set Likes='".$newLikes."' where Title='".$postTitle."'";
								mysqli_query($data,$minusLikes);
								
								$minusLikes2 = "delete from postlikes where Username='".$userarray[0]."' and Title='".$postTitle."'";
								mysqli_query($data,$minusLikes2);
								//session_unset($_SESSION['StarsPost']);
								$_SESSION['StarsPost']=$newLikes;
								$likesCount = $newLikes;
								$likeValue = "Star";
							}
						}else {
							$errorMessage = "You have to be logged in to Like!";
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
										$statement="Insert into commentpost (Username,Title,TextComment,ImageComment,Likes,Community,PostType,Upload) values ('$userarray[0]','$postTitle','$comment','','0','$community','Thread',NOW())";
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
												$statement = "Insert into commentPost (Username,Title,TextComment,ImageComment,Likes,Community,PostType,Upload) values ('$userarray[0]','$postTitle','$comment','$fileDestination','0','$community','Thread',NOW())";
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
							$errorMessage = "You have to be logged in to Comment!";
						}
					} 
					
					
					
					if($_SESSION['statusPost'] == "selected"){
						echo "<img class='userImg' src='data:image/jpeg;base64,".base64_encode($profilePic)."'>";
						echo "<form class='userBtnForm' method='post'>";
						echo "<input class='userBtn' type='submit' name='".$postAuthor."Btn' value=''/>";
						echo "</form>";
						echo "<form class='postBtnForm' method='post'>";
						echo "<input class='postUserBtn' type='submit' name= 'userBtn'value='".$postAuthor."'/>";
						echo "</form>";
						if ($signedInStatus == "True"){
							if($postAuthor == $userarray[0] || $userarray[3]== "Admin")
							{
								echo "<img class='delImg' src='pictures/delete.png'/>";
								echo "<form class='deleteBtnForm' method='post'>";
								echo "<input class='deleteBtn' type='submit' name='deletePost' value =''/><br><br>";
								echo "</form>";
								echo "<form class='editBtnForm' method='post'>";
								echo "<input class='editBtn' type='submit' name='editPost' value='Edit Post'/><br>";
								echo "</form>";
							}		
						}						
						echo "<br><br><label class='postTitle'>".$postTitle."</label><br><br>";
						echo "<br><p class='postContent'>".$postTextContent."</p><br>";
						echo "<img class='postImg' src='".$postImageContent."'/><br>" ;
						echo "<form class='starsForm' action='".$_SERVER['PHP_SELF']."' method='post'>";
						echo "<input class='likeBtn' type='submit' name='likeBtn' value='".$likeValue."'></form>";
						echo "<label class='stars'>" .$newLikes." Stars </label>";
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
					<tr><td><input class="commentBtn" type = "submit" name = "commentBtn" value="Post Comment"/></td></tr>
				</table>
				</form>
			</div>
			
			<div class ="postComments">
				<?php 
				
					$commentsQuery = "select * from commentPost where Community='$community' and Title = '$postTitle'";
					$commentsArr = mysqli_query($data,$commentsQuery);
					
					while($comments = mysqli_fetch_array($commentsArr)){
						$profilePic=searchAuthor($comments['Username'],$imagesArray);
						echo "<div class='singleComment'>";
						echo "<a href='users.php'><img class='userImg' src='data:image/jpeg;base64,".base64_encode($profilePic)."'></a>";
						if ($signedInStatus == "True"){
							if($comments['Username'] == $userarray[0] || $userarray[3]== "Admin")
							{
								echo "<img class='delImg' src='pictures/delete.png'/>";
								echo "<form class='deleteBtnForm' method='post'>";
								echo "<input type='hidden' name='commentDeleteInfo' value='".$comments['id']."'/><br>";
								echo "<input class='deleteBtn' type='submit' value =''/><br><br>";
								echo "</form>";
								echo "<form class='editBtnFormComment' method='post'>";
								echo "<input type='hidden' name='commentEditInfo' value='".$comments['id']."'/><br>";
								echo "<input class='editBtn'type='submit' value='Edit Comment'/><br>";
								echo "</form>";
							}
						}
						echo "<label class='postUser'><a class='postUser' href='users.php' > ".$comments['Username']." </a></label><br><br>";
						echo "<p class='postContent'>".$comments['TextComment']." </p><br>";
						echo "<img class='commentImg' src='".$comments['ImageComment']."'/>" ;
						echo "</div>";
					 	//<label class='stars'> 0 Stars </label> //THIS IS EXTRA, IF THERE IS TIME
					}
					mysqli_close($data);
				?>
			</div>
			
			<div class="data">
			</div>
			
			<!--FOOTER-->
			<?php require_once (ROOT_PATH .'\includes\footer.php')?>
				
		</div>
		
	</body>
</html>