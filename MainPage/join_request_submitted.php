<?php
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
    <title>Community Services</title>
    <link rel="stylesheet" href="../CSS/style.css">
</head>
<style>
    h4,
    p {
        font-size: 25px;
    }
</style>

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

        </div>
    </header>

    <nav class="main-nav">
        <a href="user_page.php" target="_self">Home</a>
        <a href="program.php" target="_self">Explore</a>
        <a href="program_status.php" target="_self">Join Requests</a>
    </nav>

    <div class="form-body">
        <form class="form">
            <h4>your request is submitted</h4>
            <br>
            <p>we will update your request status within 2 days </p>
            <p>you can check your status in "join request" page</p>
            <br>
            <a href="program_status.php" class="join" style="background-color:green; color:white;">check your status</a>

        </form>
    </div>


</body>

</html>