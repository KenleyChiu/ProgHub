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
                if(!$signedInStatus){
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