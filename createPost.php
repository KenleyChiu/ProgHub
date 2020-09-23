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
				//header("Location:community.php");
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
			
		<div class="footer">
				
		</div>
		
	</body>
</html>