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
    <title>CommunityConnect - Home</title>
    <link rel="stylesheet" href="../CSS/user.css">
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
        <form class="form" style="font-size:25px;">
            <h4>Are you sure you want to delete your account?</h4>
            <br>
            <p style="font-weight:bold;">After deleting your account:</p>
            <ul>
                <li>You will not be able to access this website.</li>
                <li>This process cannot be reverted!</li>
                <li>All of your join requests will be cancelled.</li>
            </ul>
            <br>
            <input type="submit" value="Delete Account">
        </form>
    </div>