<?php
session_start();
require_once("../database.php");
if (!isset($_SESSION["id"])) {
    header("Location: ../UserLogin/login.php");
    exit();
}
$id = $_SESSION["id"];
$username = $_SESSION["username"];
$role = $_SESSION["role"];
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
                <img src="../Images/harmony.jpg"
                    alt="https://media.licdn.com/dms/image/v2/D4E03AQELNAHJckXI1Q/profile-displayphoto-shrink_200_200/B4EZOXqLbGHkAk-/0/1733416237478?e=2147483647&v=beta&t=sjAOtOOF-mVLAh6dF3wuGAHkhmZoFFiBIWNB3DAQ30s" class="logo-placeholder">
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
        <a href="program_status.php" target="_self">My Activities</a>
        <a href="history.php" target="_self">History</a>
    </nav>
    <?php include 'notification.php'; ?>

    <div class="hero-content">
        <h2>Welcome, <?= $username ?>!</h2>
        <p>Ready to contribute to a better cause?</p>
    </div>


    </div>

    <div class="page-content">
        <div class="our-mission">
            <h2>Our Mission</h2>
            <br>
            <p>
                At CommunityConnect, we believe that stronger communities start with people coming together.
                Our mission is to make community service simple and accessible by connecting residents with
                meaningful local activities through an easy-to-use online platform, free from the hassle
                of paper forms and lengthy procedures.
            </p>
            <br>
            <p>
                Guided by the United Nations Sustainable Development Goal 11 — Sustainable Cities and
                Communities, we are proud to be backed by the Harmony Community Association, whose
                vision drives everything we do.
            </p>
            <br>
            <p>
                Through civic responsibility, collaboration, and sustainable action, CommunityConnect
                brings people together to make a lasting difference, one community at a time.
            </p>
        </div>
    </div>

</body>

</html>