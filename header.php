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
            <!--search-->
            <form class="searchForm" action="search.php" method="get">
                <input class="searchInput" type="text" name="search" Placeholder="Search" />
            </form>
        </div>
        
        <div class="account">
            <!--<img src="user.png">-->
            <!--<ul class="users">
                <li><a href="#">Sign Up</a></li>
                <li><a href="#">Log In</a></li>
            </ul>-->
            <?php 
				global $user;
				
				$usersQuery = mysqli_query($user,"select * from login");
				$usersArr = array();
				
				while($users = mysqli_fetch_array($usersQuery)){
					$username = $users["Username"];
					$password = $users["Password"];
					$signedInStatus = $users["SignedInStatus"];
					$position = $users["Position"];
					array_push($usersArr,$username,$password,$signedInStatus,$position);
				}
				
				$_SESSION['signedInStatus'] = $usersArr[2];
				
				
			
                if($_SESSION['signedInStatus'] == "False"){
                    echo "<form class='login' action='login.php' method='post'>";
                    echo "<input class='loginBtn' type='submit' value='Login'/>";
                    echo "</form>";
                    echo "<form class='signup' action='signup.php' method='post'>";
                    echo "<input class='signupBtn' type='submit' value='Sign Up'/>";
                    echo "</form>";
                }
            ?>
        </div>
    </div>