<?php
session_start();
require_once("../database.php");
global $connection;
if (!isset($_SESSION["id"])) {
    header("Location: ../UserLogin/login.php");
    exit();
}
$user_id = $_SESSION['id'];

//history approved join program
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>History Records</title>
    <link rel="stylesheet" href="../CSS/user.css">
    <style>
        .section-title {
            margin: 30px 20px 15px 20px;
            color: #333;
            border-bottom: 2px solid #eee;
            padding-bottom: 10px;
            font-weight: bold;
        }
    </style>
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
        <a href="program_status.php" target="_self">My Activities</a>
        <a href="history.php" target="_self">History</a>
    </nav>

    <div class="page-content">
        <h2 class="section-title">Completed Program</h2>
        <div class="programs-section">
            <?php
            $completed_sql = "SELECT up.program_id, up.status, up.Reg_date, 
                                   p.title, p.location, p.time, p.duration, p.event_date, p.description 
                            FROM user_program up 
                            INNER JOIN program p ON up.program_id = p.id 
                            WHERE up.user_id = '$user_id' 
                            AND up.status = 'Approved' 
                            AND p.event_date < CURDATE() 
                            ORDER BY p.event_date DESC";
            $completed_result = mysqli_query($connection, $completed_sql);
            if ($completed_result && mysqli_num_rows($completed_result) > 0) {
                while ($row = mysqli_fetch_assoc($completed_result)) {
            ?>
                    <div class="program-card">
                        <img src="../Images/gotong-royong.jpg" alt="https://www.mbsj.gov.my/ms/gotong-royong-0">

                        <div class="card-content">
                            <h3><?php echo ($row['title']); ?></h3>
                            <p class="location">Location:<?php echo ($row['location']); ?></p>
                            <p class="time">Time🕒:<?php echo ($row['time']); ?></p>
                            <p class="duration">Duration:<?php echo ($row['duration']); ?></p>
                            <p class="date">Date:<?php echo ($row['event_date']); ?></p>
                            <p class="description">Description:<?php echo ($row['description']); ?></p>

                            <label>joined date: </label>
                            <p class="Reg_date"><?php echo ($row['Reg_date']); ?></p>

                            <div class="status-badge" style="background-color: #6c757d; color: #fff; padding: 8px 16px; border-radius: 20px; display: inline-block; text-align: center; font-weight: bold;">
                                Complete
                            </div>
                        </div>
                    </div>
            <?php
                }
            } else {
                echo "<p style='margin-left: 20px; color: #888;'>You have no completed programs yet.</p>";
            }
            ?>
        </div>
        <h2 class="section-title">Rejected Program</h2>
        <div class="programs-section">
            <?php
            $rejected_sql = "SELECT up.program_id, up.status, up.Reg_date, 
                                   p.title, p.location, p.time, p.duration, p.event_date, p.description 
                            FROM user_program up 
                            INNER JOIN program p ON up.program_id = p.id 
                            WHERE up.user_id = '$user_id' 
                            AND up.status = 'Rejected' 
                            AND p.event_date < CURDATE() 
                            ORDER BY p.event_date DESC";
            $rejected_result = mysqli_query($connection, $rejected_sql);
            if ($rejected_result && mysqli_num_rows($rejected_result) > 0) {
                while ($row = mysqli_fetch_assoc($rejected_result)) {
            ?>
                    <div class="program-card">
                        <img src="../Images/gotong-royong.jpg" alt="https://www.mbsj.gov.my/ms/gotong-royong-0">

                        <div class="card-content">
                            <h3><?php echo ($row['title']); ?></h3>
                            <p class="location">Location:<?php echo ($row['location']); ?></p>
                            <p class="time">Time🕒:<?php echo ($row['time']); ?></p>
                            <p class="duration">Duration:<?php echo ($row['duration']); ?></p>
                            <p class="date">Date:<?php echo ($row['event_date']); ?></p>
                            <p class="description">Description:<?php echo ($row['description']); ?></p>

                            <label>joined date: </label>
                            <p class="Reg_date"><?php echo ($row['Reg_date']); ?></p>

                            <div class="status-badge" style="background-color: #dc3545; color: #fff; padding: 8px 16px; border-radius: 20px; display: inline-block; text-align: center; font-weight: bold;">
                                <?php echo ($row['status']); ?>
                            </div>
                        </div>
                    </div>
            <?php
                }
            } else {
                echo "<p style='margin-left: 20px; color: #888;'>No rejected requests.</p>";
            }
            ?>

</body>

</html>