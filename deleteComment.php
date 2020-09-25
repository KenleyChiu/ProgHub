<?php require_once 'config.php'?>
<?php
    global $data;
    $CommentDelete = $_SESSION['id'];
    $title = $_SESSION['TitlePost'];
    $community = $_SESSION['commSelected'];
    $commentNumSelect= "select * from posts where Community ='$community' and Title = '$title";
    $result=mysqli_query($data,$commentNumSelect);
    $numofComments=mysqli_fetch_array($result);
    $newNumofComments=$numofComments['Comments']-1;
    $minusCommentsQuery = "Update posts Set Comments='$newNumofComments' Community ='$community' and Title = '$title'";
    mysqli_query($data,$minusCommentsQuery);
    $delCommentsQuery = "delete from commentpost where id='$CommentDelete'";
    mysqli_query($data,$delCommentsQuery);
    header("Location:community.php");
?>