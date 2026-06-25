<?php
session_start();
require_once("../database.php");
if (!isset($_SESSION["id"]) || $_SESSION["role"] !== 'admin') {
    header("Location: ../UserLogin/login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST["delete"])) {
        $program_id = intval($_POST["program_id"]);
        $sql = "DELETE FROM program WHERE id = $program_id";
            if (mysqli_query($connection, $sql)) {
                header("Location: Admin_Program.php?success=deleted");
                exit();
            } else {
                $error = "Delete failed: " . mysqli_error($connection);
            }
    }

    if (isset($_POST["update"])) {
    $program_id  = intval($_POST["program_id"]);
    $title       = mysqli_real_escape_string($connection, $_POST["programName"]);
    $event_date  = mysqli_real_escape_string($connection, $_POST["program_date"]);
    $start_time  = mysqli_real_escape_string($connection, $_POST["program_starttime"]);
    $end_time    = mysqli_real_escape_string($connection, $_POST["program_endtime"]);
    $location    = mysqli_real_escape_string($connection, $_POST["program_location"]);
    $description = mysqli_real_escape_string($connection, $_POST["program_description"]);

    $sql = "UPDATE program 
            SET title = '$title', event_date = '$event_date', start_time = '$start_time', end_time = '$end_time', location = '$location', description = '$description'
            WHERE id = $program_id";
        if (mysqli_query($connection, $sql)) {
            header("Location: Admin_Program.php?success=updated");
            exit();
        } else {
            $error = "Update failed: " . mysqli_error($connection);
        }
    }
}

if (!isset($_GET["id"])) {
    header("Location: Admin_Program.php");
    exit();
}

$program_id = intval($_GET["id"]);

$sql = "SELECT * FROM program WHERE id = $program_id";
$result = mysqli_query($connection, $sql);

if (mysqli_num_rows($result) === 0) {
    header("Location: Admin_Program.php");
    exit();
}

$program = mysqli_fetch_assoc($result);
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
            <h1>Edit Program:</h1>
        </div>
     
        <form class="cProgram" action="Admin_Program_edit.php?id=<?= $program_id ?>" method="POST">
        <input type="hidden" name="program_id" value="<?= $program_id ?>">

        <label class="detail" for="programName">Name:</label>
        <input class="normal" type="text" id="programName" name="programName"
        value="<?= htmlspecialchars($program['title']) ?>" required><br><br>

        <label class="detail" for="program_date">Date:</label>
        <input class="normal" type="date" id="program_date" name="program_date" 
        value="<?= htmlspecialchars($program['event_date']) ?>" min="<?=date("Y-m-d")?>" required><br><br>

        <label class="detail" for="program_starttime"> Start Time:</label>
        <input class="normal" type="time" id="program_starttime" name="program_starttime" 
        value="<?= htmlspecialchars($program['start_time']) ?>" required><br><br>

        <label class="detail" for="program_endtime"> End Time:</label>
        <input class="normal" type="time" id="program_endtime" name="program_endtime" 
        value="<?= htmlspecialchars($program['end_time']) ?>"required><br><br>

        <label class="detail" for="program_location">Location:</label>
        <input class="normal" type="text" id="program_location" name="program_location" 
        value="<?= htmlspecialchars($program['location']) ?>"required><br><br>

        <label class="detail" for="program_description">Description:</label><br>
        <textarea class="normal dd" id="program_description" name="program_description" rows="5" 
        required><?= htmlspecialchars($program['description']) ?></textarea>
        <br><br>
            <div class="form-buttons">
                <input class="backB" type="button" value="Back" onclick="window.location.href='Admin_Program.php'">
                <input class="confirmB" type="submit" name="update" value="Confirm">
                <input class="deleteB" type="submit" name="delete" value="Delete" onclick="return confirm('Are you sure you want to delete this program?')">
            </div>
        </form>
    </body>
</html>