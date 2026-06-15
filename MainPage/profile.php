<?php

require_once("../database.php");

session_start();
if (!isset($_SESSION["id"])) {
    header("Location: ../UserLogin/login.php");
    exit();
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>CommunityConnect - Home</title>
    <link rel="stylesheet" href="../CSS/style.css">
</head>

<body>

    <header class="top-header">
        <div class="header-left">
            <h1 class="brand-title">CommunityConnect</h1>
            <span class="divider">|</span>
            <div class="org-host">
                <img src="../Images/harmony.jpg" alt="https://media.licdn.com/dms/image/v2/D4E03AQELNAHJckXI1Q/profile-displayphoto-shrink_200_200/B4EZOXqLbGHkAk-/0/1733416237478?e=2147483647&v=beta&t=sjAOtOOF-mVLAh6dF3wuGAHkhmZoFFiBIWNB3DAQ30s" class="logo-placeholder">
                <span>By Harmony Community Association</span>
            </div>
        </div>
        <div class="header-right">
            <a href="profile.php" class="profile-btn">Profile</a>
        </div>
    </header>

    <nav class="main-nav">
        <a href="user_page.php" target="_self">Home</a>
        <a href="program.php" target="_self">Explore</a>
        <a href="program_status.php" target="_self">Join Requests</a>
    </nav>

    <div class="form-body">
        <form class="form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <h1>Profile</h1>
            <br>

            <label for="username">Username:</label>
            <p><?= $_SESSION["username"] ?></p> 
            <br>
            <input type="text" name="username" id="username" placeholder="Enter a new username to change it!">
            <input type="submit" value="Change">
    
            <br>
            <br>

            <label for="email">Email:</label>
            <p><?= $_SESSION["email"] ?></p>
            <br>
            <input type="email" name="email" id="email" placeholder="Enter a new email to change it!" not require>
            <input type="submit" value="Change">

            <br>
            <br>

            <label for="password">Password:</label><br><br>
            <input type="text" name="password" id="password" placeholder="Enter a new password to change it!">
            <input type="submit" value="Change">
            <br>
            <br>
            <br>
            <br>
            <a href="delete_account_confirm.php" class="join" style="background-color:red; color:white; text-decoration: none;">Delete Account</a>


        </form>
    </div>


</body>

</html>