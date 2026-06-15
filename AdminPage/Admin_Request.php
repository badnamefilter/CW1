<?php
session_start();
require_once("../database.php");
if (!isset($_SESSION["id"]) || $_SESSION["role"] !== 'admin') {
    header("Location: ../UserLogin/login.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="../CSS/admin.css">  
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
            <a href="Admin_Profile.php" class="profile-btn">Profile</a>
        </div>
    </header>

    <nav class="main-nav">
        <a href="Admin_Main.php" target="_self">Dashboard</a>
        <a href="Admin_Program.php" target="_self">Program</a>
        <a href="Admin_Request.php" class="current" target="_self">Approvals</a>
    </nav>

    <div class="rtitle">
        <h1>Programs Requests:</h1>
    </div>

    <div class="requests">
        <div class="requests-info">
            <div class="requests-person"> <!-- Person 1-->
                <h3> JohnQT </h3>
                <p> Request to join <strong>Clean The Velocity</strong> </p>
            </div>

            <div class="requests-actions">
                <button class="accept-button">Accept</button>
                <button class="reject-button">Reject</button>
            </div>
        </div>  

        <div class="requests-info">
            <div class="requests-person"> <!-- Person 2-->
                <h3> Robin </h3>
                <p> Request to join <strong>Clean The Velocity</strong> </p>
            </div>

            <div class="requests-actions">
                <button class="accept-button">Accept</button>
                <button class="reject-button">Reject</button>
            </div>
        </div>  

        <div class="requests-info">
            <div class="requests-person"> <!-- Person 3-->
                <h3> Newson </h3>
                <p> Request to join <strong>Clean The Velocity</strong> </p>
            </div>

            <div class="requests-actions">
                <button class="accept-button">Accept</button>
                <button class="reject-button">Reject</button>
            </div>
        </div>  

        <div class="requests-info">
            <div class="requests-person"> <!-- Person 4-->
                <h3> Ray Ping </h3>
                <p> Request to join <strong>Clean The Velocity</strong> </p>
            </div>

            <div class="requests-actions">
                <button class="accept-button">Accept</button>
                <button class="reject-button">Reject</button>
            </div>
        </div>  
    </div>
</div>
    </body>
</html>