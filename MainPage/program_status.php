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
    <title>Manage Programs</title>
    <link rel="stylesheet" href="../CSS/user.css">
</head>
<style>
    .status-badge {
        align-self: flex-end;
        /* Pushes the badge block to the right edge naturally */
        padding: 8px 16px;
        font-size: 16px;
        font-weight: bold;
        border-radius: 20px;
        /* Gives it a clean oval pill look */
        text-align: center;
        text-transform: capitalize;
        /* Automatically fixes 'rejected' to 'Rejected' */
        margin-top: 15px;
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
            <a href="profile.php" class="profile-btn">Profile</a>
        </div>
    </header>

    <nav class="main-nav">
        <a href="user_page.php" target="_self">Home</a>
        <a href="program.php" target="_self">Explore</a>
        <a href="program_status.php" target="_self">Join Requests</a>
    </nav>

    <div class="page-content">
        <div class="programs-section">


            <div class="program-card">
                <img src="../Images/gotong-royong.jpg" alt="https://www.mbsj.gov.my/ms/gotong-royong-0">
                <div class="card-content">
                    <h3 name="title">Program title</h3>
                    <p class="location" name="location">no , taman , city , postcode, state , country</p>
                    <p class="event_time" name="event_time">🕒 6:30 AM</p>
                    <p class="duration" name="duration">2 hours</p>
                    <p class="date" name="date">11/6/2026</p>
                    <p class="description" name="description">this program is good</p>
                    <label>joined date: </label>
                    <p class="Reg_date" name="Reg_date">11/6/2026</p>
                    <div class="status-badge">Pending approval</div>

                    <button class="join" value="cancel">cancel</button>
                </div>
            </div>



            <div class="program-card">
                <img src="../Images/gotong-royong.jpg" alt="https://www.mbsj.gov.my/ms/gotong-royong-0">
                <div class="card-content">
                    <h3 name="title">Program title</h3>
                    <p class="location" name="location">no , taman , city , postcode, state , country</p>
                    <p class="event_time" name="event_time">🕒 6:30 AM</p>
                    <p class="duration" name="duration">2 hours</p>
                    <p class="date" name="date">11/6/2026</p>
                    <p class="description" name="description">this program is good</p>
                    <label>joined date: </label>
                    <p class="Reg_date" name="Reg_date">11/6/2026</p>
                    <div class="status-badge">Approved</div>
                    <button class="join" value="cancel">cancel</button>
                </div>
            </div>



            <div class="program-card">
                <img src="../Images/gotong-royong.jpg" alt="https://www.mbsj.gov.my/ms/gotong-royong-0">
                <div class="card-content">
                    <h3 name="title">Program title</h3>
                    <p class="location" name="location">no , taman , city , postcode, state , country</p>
                    <p class="event_time" name="event_time">🕒 6:30 AM</p>
                    <p class="duration" name="duration">2 hours</p>
                    <p class="date" name="date">11/6/2026</p>
                    <p class="description" name="description">this program is good</p>
                    <label>joined date: </label>
                    <p class="Reg_date" name="Reg_date">11/6/2026</p>
                    <div class="status-badge">rejected</div>
                    <button class="join" value="cancel">cancel</button>
                </div>
            </div>


        </div>


    </div>
</body>

</html>