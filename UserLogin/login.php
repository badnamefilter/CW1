<?php
session_start();

error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once("../database.php");

$errorMessage = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = isset($_POST["username"]) && !empty($_POST["username"]) ? $_POST["username"] : "";
    $password = isset($_POST["password"]) && !empty($_POST["password"]) ? $_POST["password"] : "";

    $sql = "SELECT id,username,password,role,email
        FROM account
        WHERE username = '$username';";

    $result = mysqli_query($connection, $sql);

    $row = mysqli_fetch_array($result);

    if ($row) {
        if (password_verify($password, $row['password'])) {

            $_SESSION["id"] = $row['id'];
            $_SESSION["username"] = $row['username'];
            $_SESSION["role"] = $row['role'];
            $_SESSION["email"] = $row['email'];

            if ($_SESSION["role"] === 'admin') {
                header("Location: ../AdminPanel/admin_page.php");
            } else {
                header("Location: ../MainPage/user_page.php");
            }
            exit();
        } else {
            $errorMessage = "Invalid! Please try again!<br>";
        }
    } else {
        $errorMessage = "Invalid! Please try again!<br>";
    }

}
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Community Services</title>
    <link rel="stylesheet" href="../CSS/style.css">
</head>
<style>

</style>

<body>

    <header class="top-header">
        <div class="header-left">
            <h1 class="brand-title">CommunityConnect</h1>
            <span class="divider">|</span>
            <div class="org-host">
                <img src="../Images/harmony.jpg" alt="Logo" class="logo-placeholder">
                <span>By Harmony Community Association</span>
            </div>
        </div>
        <div class="header-right">

        </div>
    </header>
    <div class="form-body">
        <form class="form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
            <?php if (!empty($errorMessage)) { ?>
                <p style="color: red; text-align: center; font-weight: bold;">
                    <?php echo $errorMessage; ?>
                </p>
            <?php } ?>

            <h2>Log in to join our community!</h2>
            <br><br>
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required><br><br>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required><br><br>
            <p><a href="forgotPassword.php">Forgot your password?</a></p>
            <br>
            <input type="submit" value="Log In">
            <br><br>
            <p>Don't have an account? <a href="register.php">Sign up here</a>.</p>
        </form>
    </div>


</body>

</html>

<?php
if (isset($connection)) {
    mysqli_close($connection);
}
?>