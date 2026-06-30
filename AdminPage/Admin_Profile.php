<?php
session_start();
require_once("../database.php");
global $connection;
if (!isset($_SESSION["id"]) || $_SESSION["role"] !== "admin") {
    header("Location: ../UserLogin/login.php");
    exit();
}

$errorMessage = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $id = $_SESSION["id"];
    $username = isset($_POST["username"]) && !empty($_POST["username"]) ? $_POST["username"] : "";
    $email = isset($_POST["email"]) && !empty($_POST["email"]) ? $_POST["email"] : "";
    $password = isset($_POST["password"]) && !empty($_POST["password"]) ? $_POST["password"] : "";
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    if (isset($_POST["changeUsername"]) && !($username == "")) {
        $sql = "UPDATE account
                SET username = '$username'
                WHERE id = '$id';";

        mysqli_query($connection, $sql);
        $_SESSION["username"] = $username;
    } else if (isset($_POST["changeUsername"]) && $username == "") {
        $errorMessage = "Please enter a valid username!";
    }

    if (isset($_POST["changeEmail"]) && !($email == "")) {
        $sql = "UPDATE account
                SET email = '$email'
                WHERE id = '$id';";

        mysqli_query($connection, $sql);
        $_SESSION["email"] = $email;
    } else if (isset($_POST["changeEmail"]) && ($email == "")) {
        $errorMessage = "Please enter a valid email!";
    }

    if (isset($_POST["changePassword"]) && !($password == "")) {
        $sql = "UPDATE account
                SET password = '$hashedPassword'
                WHERE id = '$id';";

        mysqli_query($connection, $sql);
    } else if (isset($_POST["changePassword"]) && ($password == "")) {
        $errorMessage = "Please enter a valid password!";
    }
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>CommunityConnect - Home</title>
    <link rel="stylesheet" href="../CSS/user.css">
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

    <div class="form-body">
        <form class="form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <h2 style="color: red; text-align: center; font-weight: bold;"><?= $errorMessage ?></h2><br>
            <h1>Admin Profile</h1>
            <br>

            <label for="username">Current Username:</label>
            <p><?= $_SESSION["username"] ?></p>
            <br>
            <input type="text" name="username" id="username" placeholder="Enter a new username to change it!">
            <input type="submit" value="Change" name="changeUsername">

            <br>
            <br>

            <label for="email">Current Email:</label>
            <p><?= $_SESSION["email"] ?></p>
            <br>
            <input type="email" name="email" id="email" placeholder="Enter a new email to change it!">
            <input type="submit" value="Change" name="changeEmail">

            <br>
            <br>

            <label for="password">Change Your Password (minimum 5 characters):</label><br><br>
            <input type="text" name="password" id="password" placeholder="Enter a new password to change it!" minlength="5">
            <input type="submit" value="Change" name="changePassword">
            <br>
            <br>
            <br>
            <a href="../logout.php" class="join" style="background-color:#555; color:white; text-decoration: none; display:inline-block; text-align:center; font-size:21px;">Logout</a>
            <br>
            <br>
            <br>
            <br>
            <a href="delete_account_confirm.php" class="join" style="background-color:red; color:white; text-decoration: none;">Delete Account</a>


        </form>
    </div>


</body>

</html>