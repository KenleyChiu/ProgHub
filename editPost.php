<?php require_once 'config.php'?>
<?php require_once (ROOT_PATH .'\includes\header.php')?>
<?php require_once (ROOT_PATH .'\includes\navigation.php')?>
<html>
	<head>
		<title>Website Project</title>
		<link rel="stylesheet" type="text/css" href="css/createPost.css">
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
		
		<!-- DIVIDER BEWTEEN THREAD AND PROJECT
		<div class="headers">
			<label class="threads"><a href="#"> Threads </a></label>
			<span class="divider1"> </span>
			<label class="projects"><a href="#"> Projects </a></label>
		</div> -->
			
		<!-- EDIT POSTS -->
		<div class="create">
		<?php
			global $data;
			$userarray=$GLOBALS["userArr"];
            $errorMessage="";
            $firstTitle=$_SESSION['TitlePost'];
            $firstContent=$_SESSION['TextPost'];
            $firstImage=$_SESSION['ImagePost'];
            $author= $_SESSION['AuthorPost'];
			
			if(isset($_POST["editBtn"]))
			{
				if($signedInStatus == "True"){
					if ($_SERVER["REQUEST_METHOD"] == "POST")
					{
						$title=$content=$statement=" ";
						if(empty($_POST["editTitle"])||empty($_POST["editContent"])){
							$errorMessage = "Fill up Title and Content";
						}
						else{
							$title=$_POST["editTitle"];
							$content=$_POST["editContent"];
							$community=$_SESSION['commSelected'];
							if(empty($_FILES["editImage"]["name"]))
							{	
                                $titleUpdate="Update posts set Title = '$title' Where Author = '$author' and Title = '$firstTitle'";
                                $result=mysqli_query($data,$titleUpdate);
                                $titlelikesUpdate= "Update posts set Title = '$title' Where Username = '$author' and Title = '$firstTitle'";
                                $result=mysqli_query($data,$titlelikesUpdate);
                                $titlecommentUpdate= "Update commentpost set Title = '$title' Where Username = '$author' and Title = '$firstTitle'";
                                $result=mysqli_query($data,$titlecommentUpdate);
                                $contentUpdate="update posts set TextContent = '$content' Where Author = '$author' and Title = '$title'";
                                mysqli_query($data,$contentUpdate);
								header("Location:community.php");
								exit();
							}
							else{
								//get file info
								$fileName = $_FILES["editImage"]["name"];
								$fileError= $_FILES["editImage"]["error"];
								$filetmp = $_FILES["editImage"]["tmp_name"];
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
										$titleUpdate="Update posts set Title = '$title' Where Author = '$author' and Title = '$firstTitle'";
                                        $result=mysqli_query($data,$titleUpdate);
                                        $titlelikesUpdate= "Update posts set Title = '$title' Where Username = '$author' and Title = '$firstTitle'";
                                        $result=mysqli_query($data,$titlelikesUpdate);
                                        $titlecommentUpdate= "Update commentpost set Title = '$title' Where Username = '$author' and Title = '$firstTitle'";
                                        $result=mysqli_query($data,$titlecommentUpdate);
                                        $contentUpdate="update posts set TextContent = '$content' Where Author = '$author' and Title = '$title'";
                                        mysqli_query($data,$contentUpdate);
                                        $FileUpdate="update posts set ImageContent = '$fileDestination' Where Author = '$author' and Title = '$title'";
                                        mysqli_query($data,$FileUpdate);
										header("Location:community.php");
										exit();
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
				} else {
					$errorMessage = "You have to be logged in to do that!";
				}
			}
			?>
			<form method ="post" enctype="multipart/form-data" action="<?php echo $_SERVER["PHP_SELF"];?>" >
				<label class="createPost"> Edit Post </label>
				<table class="createDetails">
					<tr><td><input class="titleInput" type = "text" name = "editTitle" Placeholder="Title" value = "<?php echo $firstTitle;?>"/></td></tr>
					<!--<tr><td><input class="contentInput" type = "text" name = "createContent" Placeholder="Thread Discussion"/></td></tr>-->
					<tr><td><textarea class="contentInput" rows='15' cols='35' name='editContent'><?php echo $firstContent;?></textarea></td></tr>
                    <tr><td><img class='postImg' src='<?php echo $firstImage;?>'/></td></tr>
					<tr><td><input class="imageInput" type = "file" name = "editImage"></td></tr>
					<tr><td><span style="color:red"> <?php echo $errorMessage;?> </span></td></tr>
					<tr><td><input class="createBtn" type = "submit" name = "editBtn" value="Edit Post"/></td></tr>
				</table>
			</form>
		</div>
			
		<div class="footer">
				
		</div>
		
	</body>
</html>