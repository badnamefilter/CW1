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
            <a href="Admin_Request.php" target="_self">Approvals</a>
        </nav>
    <body>
</html>