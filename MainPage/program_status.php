<?php
session_start();
require_once("../database.php");
global $connection;
if (!isset($_SESSION["id"])) {
    header("Location: ../UserLogin/login.php");
    exit();
}

$user_id = $_SESSION["id"];

$request_sql = "SELECT * FROM user_program WHERE user_id = '$user_id' ORDER BY id DESC";
$request_result = mysqli_query($connection, $request_sql);
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

            <?php
            if ($request_result && mysqli_num_rows($request_result) > 0) {
                while ($request_row = mysqli_fetch_assoc($request_result)) {
                    $program_id = $request_row['program_id'];
                    $status = $request_row['status']; //have Pending, Approved, Rejected
                    $reg_date = $request_row['Reg_date']; //user Register date

                    //use program id go program take all data for the program
                    $program_sql = "SELECT * FROM program WHERE id = '$program_id'";
                    $program_result = mysqli_query($connection, $program_sql);
                    $program_row = mysqli_fetch_assoc($program_result);


                    if ($program_row) {
            ?>

                        <div class="program-card">
                            <img src="../Images/gotong-royong.jpg" alt="https://www.mbsj.gov.my/ms/gotong-royong-0">

                            <div class="card-content">
                                <h3><?php echo $program_row['id']; ?>.<?php echo htmlspecialchars($program_row['title']); ?></h3>
                                <p class="location">Location:<?php echo htmlspecialchars($program_row['location']); ?></p>
                                <p class="time">Time🕒:<?php echo htmlspecialchars($program_row['time']); ?></p>
                                <p class="duration">Duration:<?php echo htmlspecialchars($program_row['duration']); ?></p>
                                <p class="date">Date:<?php echo htmlspecialchars($program_row['event_date']); ?></p>
                                <p class="description">Description:<?php echo htmlspecialchars($program_row['description']); ?></p>

                                <label>joined date: </label>
                                <p class="Reg_date"><?php echo htmlspecialchars($reg_date); ?></p>

                                <div class="status-badge"><?php echo htmlspecialchars($status) ?></div>

                                <button class="join" value="cancel">cancel</button>
                            </div>
                        </div>

            <?php
                    }
                } //while how many request event;
            } else {
                echo "<p>You haven't joined any programs yet.</p>";
            }
            ?>

        </div>
    </div>
</body>

</html>