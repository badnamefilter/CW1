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
        <a href="Admin_Program.php" class="current" target="_self">Program</a>
        <a href="Admin_Request.php" target="_self">Approvals</a>
    </nav>

        <div class="create-program">
            <a href="creating_program.php" target="_self">
            <h2>Create Program</h2>
            <h1>+</h1>
            </a>
        </div>

    <hr class="randomline">

    <div class="programs">
        <div class="program-item">
            <div class="program-left">
                <div class="program-info">
                    <h3>Clean The Velocity</h3>   <!-- Program 1  -->
                    <p>Time: June 17 - June 19 (8:00A.M.)</p>
                    <p>Location: Sunway Velocity</p>
                </div>
            </div>
            <div class="program-actions">
                <span class="pamount">30/60</span>
                <span class="badge active">Active</span>
                <button class="edit-button">Edit</button>
                <button class="delete-button">Delete</button>
            </div>
        </div>

        <div class="program-item">
            <div class="program-left">
                <div class="program-info">
                    <h3>Clean The Pyramid</h3>   <!-- Program 2  -->
                    <p>Time: June 7 - June 9 (9:00A.M.)</p>
                    <p>Location: Sunway Pyramid</p>
                </div>
            </div>
            <div class="program-actions">
                <span class="pamount">30/60</span>
                <span class="badge active">Active</span>
                <button class="edit-button">Edit</button>
                <button class="delete-button">Delete</button>
            </div>
        </div>

        <div class="program-item">
            <div class="program-left">

                <div class="program-info">
                    <h3>Clean The Puchong</h3>   <!-- Program 3  -->
                    <p>Time: Nov 30 - Dec 2 (11:00 A.M.)</p>
                    <p>Location: IoI Puchong </p>
                </div>
            </div>
            <div class="program-actions">
                <span class="pamount">27/50</span>
                <span class="badge active">Active</span>
                <button class="edit-button">Edit</button>
                <button class="delete-button">Delete</button>
            </div>
        </div>
      

            <div class="program-item">
        <div class="program-left">

          <div class="program-info">
            <h3>Clean The Ipoh</h3>   <!-- Program 4  -->
            <p>Time: Jan 1 (7:00A.M.)</p>
            <p>Location: Sunway Ipoh</p>
          </div>
        </div>
        <div class="program-actions">
            <span class="pamount">67/90</span>
            <span class="badge draft">Draft</span>
            <button class="edit-button">Edit</button>
            <button class="delete-button">Delete</button>
        </div>
      </div>
      
      
       
  </div>
    </body>
</html>