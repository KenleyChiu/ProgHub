<?php require_once 'config.php'?>
<div class="mainGrid">
    <!--HEADER-->
    <div class="header">
        <div class="logo">
            <a class="aLogo" href="home.php">
            <img class="logoPgh" src="pictures/pgh.png">
            <img class ="proghub" src="pictures/proghub2.png">
            </a>
        </div>
        
        <div class="search">
            <!--search
            <form class="searchForm" action="search.php" method="get">
                <input class="searchInput" type="text" name="search" Placeholder="Search" />
            </form>-->
        </div>
        
        <div class="account">
            <?php 
				global $user;
				$signedInStatus="False";
				$usersQuery = mysqli_query($user,"select * from login WHERE SignedInStatus = 'True' ");
				$userArr = array();

                $users = mysqli_fetch_array($usersQuery);
                
				if(empty($users))
                {
                    $signedInStatus="False";
                }
                else{
                    echo $users["Username"];
                    $username = $users["Username"];
                    $password = $users["Password"];
                    $signedInStatus = $users["SignedInStatus"];
                    $position = $users["Position"];
                    echo "yep";
                    array_push($userArr,$username,$password,$signedInStatus,$position);
                    $signedInStatus = $userArr[2];
                }
			
                if($signedInStatus == "False"){
                    echo "<form class='login' action='login.php' method='post'>";
                    echo "<input class='loginBtn' type='submit' value='Login'/>";
                    echo "</form>";
                    echo "<form class='signup' action='signup.php' method='post'>";
                    echo "<input class='signupBtn' type='submit' value='Sign Up'/>";
                    echo "</form>";
                } else {
					echo "<a href='users.php'><img src='pictures/user.png'></a>";
					echo "<label class='username'><a class='username' href='users.php' >".$userArr[0]." </a></label>";
					echo "<form class='settings' action='settings.php' method='post'>";
                    echo "<input class='settingsBtn' type='submit' value='Settings'/>";
                    echo "</form>";
					echo "<form class='logout' action='login.php' method='post'>";
                    echo "<input class='logoutBtn' type='submit' value='Logout'/>";
                    echo "</form>";
				}
            ?>
        </div>
    </div>