<?php
session_start();
require_once("../database.php");
global $connection;
if (!isset($_SESSION["id"])) {
    header("Location: ../UserLogin/login.php");
    exit();
}

$user_id = $_SESSION['id'];
$program_id = $_GET['program_id'] ?? 0;


error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($program_id > 0) {
    //check user alredy request this event before or not
    $check_sql = "SELECT * FROM user_program WHERE user_id = $user_id AND program_id = $program_id;";
    $check_result = mysqli_query($connection, $check_sql);

    if ($check_result && mysqli_num_rows($check_result) == 0) {
        //if haven't request,it will add a new record and status show pending
        $insert_sql = "INSERT INTO user_program (user_id, program_id, status, Reg_date) VALUES ($user_id , $program_id , 'Pending',NOW());";
        mysqli_query($connection, $insert_sql);
    }
} else {
    header("Location: program.php");
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
    h4,
    p {
        font-size: 25px;
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

        </div>
    </header>

    <nav class="main-nav">
        <a href="user_page.php" target="_self">Home</a>
        <a href="program.php" target="_self">Explore</a>
        <a href="program_status.php" target="_self">My Activities</a>
        <a href="history.php" target="_self">History</a>
    </nav>

    <div class="form-body">
        <form class="form">
            <h4>Thank you for submitting a request!</h4>
            <br>
            <p>Please be patient, we will update your request status within 2 days. </p><br>
            <p>You can check your request status in the "My Activities" page!</p>
            <br>
            <a href="program_status.php" class="join" style="background-color:green; color:white;">Check Status</a>

        </form>
    </div>


</body>

</html>