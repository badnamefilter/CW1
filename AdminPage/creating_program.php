<?php
session_start();
require_once("../database.php");
global $connection;
if (!isset($_SESSION["id"]) || $_SESSION["role"] !== 'admin') {
    header("Location: ../UserLogin/login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $programName = isset($_POST['programName']) && !empty($_POST["programName"]) ? $_POST["programName"] : "";
    $programDate = isset($_POST['program_date']) && !empty($_POST["program_date"]) ? $_POST["program_date"] : "";
    $programStartTime = isset($_POST['program_starttime']) && !empty($_POST["program_starttime"]) ? $_POST["program_starttime"] : "";
    $programEndTime = isset($_POST['program_endtime']) && !empty($_POST["program_endtime"]) ? $_POST["program_endtime"] : "";
    $programLocation = isset($_POST['program_location']) && !empty($_POST["program_location"]) ? $_POST["program_location"] : "";
    $programDescription = isset($_POST['program_description']) && !empty($_POST["program_description"]) ? $_POST["program_description"] : "";

    $sql = "INSERT INTO program (title, description, event_date, location, start_time, end_time)
            VALUES ('$programName','$programDescription',$programDate,'$programLocation','$programStartTime','$programEndTime');";
    
     mysqli_query($connection, $sql);
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

    <div class="ctitle">
        <h1>Creating Program:</h1>
    </div>

<form class="cProgram" action="creating_program.php" method="POST">
    <label class="detail" for="programName">Name:</label>
    <input class="normal" type="text" id="programName" name="programName" required><br><br>

    <label class="detail" for="program_date">Date:</label>
    <input class="normal" type="date" id="program_date" name="program_date" required><br><br>

    <label class="detail" for="program_starttime"> Start Time:</label>
    <input class="normal" type="time" id="program_starttime" name="program_starttime" required><br><br>

    <label class="detail" for="program_endtime"> End Time:</label>
    <input class="normal" type="time" id="program_endtime" name="program_endtime" required><br><br>

    <label class="detail" for="program_location">Location:</label>
    <input class="normal" type="text" id="program_location" name="program_location" required><br><br>

    <label class="detail" for="program_description">Description:</label><br>
    <textarea class="normal dd" id="program_description" name="program_description" rows="5" required></textarea>
    <br><br>

        <div class="form-buttons">
            <input class="submit-btn" type="submit" value="Submit">
            <input class="cancel-btn" type="button" value="Cancel" onclick="window.location.href='Admin_Program.php'">
            <input class="reset-btn" type="reset" value="Reset Form">
        </div>
    </form>

<script>

    const element = document.getElementById("program_date");    
    element.textContent = element.textContent.replace(/-/g, " ");

    const element = document.getElementById("program_starttime");
    element.textContent = element.textContent.replace(/-/g, " ");

    const element = document.getElementById("program_endtime");
    element.textContent = element.textContent.replace(/-/g, " ");
</script>

</body>

</html>
