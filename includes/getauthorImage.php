<?php require_once 'config.php'?>
<?php
    global $user;
    $author=$image="";
    
    $allUserImages=array();
    $statement= "select * from userdetails";
    $results = mysqli_query($user,$statement);
    while($imageData = mysqli_fetch_array($results))
    {
        $specificUserImages=array();
        $author=$imageData["Username"];
        $image=$imageData["Image"];
        array_push($specificUserImages,$author,$image);
        array_push($allUserImages,$specificUserImages);
    }


    function searchAuthor($post,$imagesArray)
    {
        foreach($imagesArray as $arr)
        {
            if($post == $arr[0]){
                return $arr[1];
            }
        }
    }
    
?>