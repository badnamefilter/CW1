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
    <link rel="stylesheet" href="../CSS/user.css">
</head>
<style>

</style>

<body>

    <header class="top-header">
        <div class="header-left">
            <h1 class="brand-title">CommunityConnect</h1>
            <span class="divider">|</span>
            <div class="org-host">
                <img src="../Images/harmony.jpg"
                    alt="https://media.licdn.com/dms/image/v2/D4E03AQELNAHJckXI1Q/profile-displayphoto-shrink_200_200/B4EZOXqLbGHkAk-/0/1733416237478?e=2147483647&v=beta&t=sjAOtOOF-mVLAh6dF3wuGAHkhmZoFFiBIWNB3DAQ30s"
                    class="logo-placeholder">
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

    <div class="search-section">
        <form action="search-results.php" method="GET" class="search-container">
            <input type="text" name="program" placeholder="Search for programs, events, or keywords..." required>
            <input type="submit" value="Search">
        </form>
    </div>

    <div class="page-content">
        <div class="programs-section">

            <div class="program-card">
                <img src="../Images/gotong-royong.jpg" alt="https://www.mbsj.gov.my/ms/gotong-royong-0">
                <div class="card-content">
                    <h3 name="title">Program title</h3>
                    <p class="location" name="location">no , taman , city , postcode, state , country</p>
                    <p class="time" name="event_time">🕒 6:30 AM</p>
                    <p class="duration" name="duration">2 hours</p>
                    <p class="date" name="date">11/6/2026</p>
                    <p class="description" name="description">this program is good</p>

                    <a href="join_request_submitted.php">
                        <button class="join">join</button>
                    </a>
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

                    <a href="join_request_submitted.php">
                        <button class="join">join</button>
                    </a>
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

                    <a href="join_request_submitted.php">
                        <button class="join">join</button>
                    </a>
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

                    <a href="join_request_submitted.php">
                        <button class="join">join</button>
                    </a>
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
                    <p class="description" name="description">this program is good.this program is good.this program is good.this program is good.this program is good.this program is good.this program is good.</p>

                    <a href="join_request_submitted.php">
                        <button class="join">join</button>
                    </a>
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

                    <a href="join_request_submitted.php">
                        <button class="join">join</button>
                    </a>
                </div>
            </div>

        </div>
    </div>

</body>

</html>