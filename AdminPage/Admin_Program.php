<?php
session_start();
require_once("../database.php");
if (!isset($_SESSION["id"]) || $_SESSION["role"] !== 'admin') {
    header("Location: ../UserLogin/login.php");
    exit();
}

    $search = isset($_GET['search']) && !empty($_GET['search']) ? $_GET['search'] : "";

    $sql = "SELECT id, title, event_date, start_time, end_time, location, description
            FROM program 
            ORDER BY event_date ASC";
    if ($search !== "") {
        $safe = mysqli_real_escape_string($connection, $search);
        $sql = "SELECT id, title, event_date, start_time, end_time, location, description
                FROM program 
                WHERE title LIKE '%$safe%' 
                ORDER BY event_date ASC";
    } else {
        $sql = "SELECT id, title, event_date, start_time, end_time, location, description
                FROM program 
                ORDER BY event_date ASC";
    }
            
    $result = mysqli_query($connection, $sql);
?>

<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="../CSS/admin.css">  
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0&icon_names=search" />
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

        <form method="GET" action="">
            <div class="searchs">
                <span class="search-icon material-symbols-outlined">search</span>
                <input class="search-input" type="text" name="search" placeholder="Search programs"
                        value="<?= htmlspecialchars($_GET['search'] ?? '') ?>" autofocus>
            </div>
        </form>


    <div class="programs">
    <?php if (mysqli_num_rows($result) > 0): ?>
        <?php while ($row = mysqli_fetch_assoc($result)): ?>
            <div class="program-item">
                <div class="program-left">
                    <div class="program-info">
                        <h3><?=  htmlspecialchars($row['title']) ?></h3>
                        <p>Time: <?= date('M j, Y', strtotime($row['event_date'])) ?>
                                 (<?= date('g:i A', strtotime($row['start_time'])) ?> - 
                                  <?= date('g:i A', strtotime($row['end_time'])) ?>)
                        </p>
                        <p>Location: <?= htmlspecialchars($row['location']) ?> </p>
                        <p>Description: <?= htmlspecialchars($row['description']) ?> </p>
                    </div>
                </div>
                <div class="program-actions">
                    <a href="Admin_Program_edit.php?id=<?= $row['id'] ?>" class="edit-button">Edit</a>
                </div>
            </div>
        <?php endwhile; ?>
    <?php else: ?>
        <p class="nothing">No programs found.</p>
    <?php endif; ?>
    </div>
      

    </body>
</html>