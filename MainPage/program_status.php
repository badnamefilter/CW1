<?php
session_start();
require_once("../database.php");
global $connection;
/*if (!isset($_SESSION["id"])) {
    header("Location: ../UserLogin/login.php");
    exit();
}*/

$user_id = $_SESSION["id"];

//cancel function 
if (isset($_GET['action']) && $_GET['action'] == 'cancel' && isset($_GET['req_id'])) {
    $cancel_id = $_GET['req_id'];

    $delete_sql = "DELETE FROM user_program WHERE program_id = '$cancel_id' AND user_id = '$user_id'";
    mysqli_query($connection, $delete_sql);

    //after delete refresh page
    header("Location: program_status.php");
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

    .section-title {
        margin: 30px 20px 15px 20px;
        /* 上 30px，右 20px，下 15px，左 20px */
        color: #333;
        border-bottom: 2px solid #eee;
        padding-bottom: 10px;
        font-weight: bold;
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
        <a href="program_status.php" target="_self">My Activities</a>
        <a href="history.php" target="_self">History</a>
    </nav>

    <div class="page-content">
        <h2 class="section-title">Pending Request</h2>
        <div class="programs-section">

            <?php
            //Pending function
            $pending_sql = "SELECT * FROM user_program 
                            WHERE user_id = '$user_id'
                            AND status='Pending' ORDER BY id DESC"; //DESC is highest to lowest.
            $pending_result = mysqli_query($connection, $pending_sql);

            if ($pending_result && mysqli_num_rows($pending_result) > 0) {
                while ($request_row = mysqli_fetch_assoc($pending_result)) {
                    $program_id = $request_row['program_id'];
                    $status = $request_row['status']; //status have Pending, Approved, Rejected
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

                                <div class="status-badge" style="background-color: #ffc107; color: #000;"><?php echo htmlspecialchars($status) ?></div>

                                <a href="program_status.php?action=cancel&req_id=<?php echo $program_id; ?>"
                                    class="join"
                                    style="text-decoration:none; display:inline-block; text-align:center; background-color: #dc3545;">
                                    cancel
                                </a>
                            </div>
                        </div>
            <?php
                    }
                } //while how many request event;
            } else {
                echo "<p style='margin-left: 20px; color: #888;'>You have no pending requests</p>";
            }
            ?>
        </div>
        <h2 class="section-title">Upcomming programs</h2>
        <div class="programs-section">
            <?php
            //Upcomming(Approved) function
            $upcoming_sql = "SELECT up.program_id, up.status, up.Reg_date,
                                    p.title, p.location, p.time, p.duration,p.event_date, p.description
                             FROM user_program up
                             INNER JOIN program p ON up.program_id=p.id
                             WHERE up.user_id = '$user_id'
                             AND up.status='Approved' 
                             AND p.event_date >= CURDATE()
                             ORDER BY p.event_date ASC"; //ASC is lowest to highest.
            $upcoming_result = mysqli_query($connection, $upcoming_sql);

            if ($upcoming_result && mysqli_num_rows($upcoming_result) > 0) {
                while ($request_row = mysqli_fetch_assoc($upcoming_result)) {

            ?>

                    <div class="program-card">
                        <img src="../Images/gotong-royong.jpg" alt="https://www.mbsj.gov.my/ms/gotong-royong-0">

                        <div class="card-content">
                            <h3><?php echo $request_row['program_id']; ?>.<?php echo htmlspecialchars($request_row['title']); ?></h3>
                            <p class="location">Location:<?php echo htmlspecialchars($request_row['location']); ?></p>
                            <p class="time">Time🕒:<?php echo htmlspecialchars($request_row['time']); ?></p>
                            <p class="duration">Duration:<?php echo htmlspecialchars($request_row['duration']); ?></p>
                            <p class="date">Date:<?php echo htmlspecialchars($request_row['event_date']); ?></p>
                            <p class="description">Description:<?php echo htmlspecialchars($request_row['description']); ?></p>

                            <label>joined date: </label>
                            <p class="Reg_date"><?php echo htmlspecialchars($request_row['Reg_date']); ?></p>

                            <div class="status-badge" style="background-color: #28a745; color: #fff;"><?php echo htmlspecialchars($request_row['status']) ?></div>

                            <a href="program_status.php?action=cancel&req_id=<?php echo $request_row['program_id']; ?>"
                                class="join"
                                style="text-decoration:none; display:inline-block; text-align:center; background-color: #dc3545;color: white;">
                                cancel
                            </a>
                        </div>
                    </div>
        </div>
<?php
                }
            } else {
                echo "<p style='margin-left: 20px; color: #888;'>You have no upcoming programs.</p>";
            }
?>
    </div>
</body>

</html>