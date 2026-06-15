<?php
require_once("../database.php");

$successMessage = "";
$errorMessage = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = isset($_POST["username"]) && !empty($_POST["username"]) ? $_POST["username"] : "";
    $new_password = isset($_POST["password"]) && !empty($_POST["password"]) ? $_POST["password"] : "";
    $hashedpword = password_hash($new_password, PASSWORD_DEFAULT);
    $role = isset($_POST["role"]) && !empty($_POST["role"]) ? $_POST["role"] : "";

    $sql = "SELECT *
        FROM account
        WHERE username = '$username';";

    $result = mysqli_query($connection, $sql);

    if (mysqli_num_rows($result) == 0) {
        $errorMessage = "Error: Sorry, we couldn't find your username.<br><br>";
    } else {
        $sql_update = "UPDATE account
        SET password = '$hashedpword'
        WHERE username = '$username';";
        if (mysqli_query($connection, $sql_update)) {
            $successMessage = "Password has been changed! <br> <a href='login.php'>Return to login page</a>";
        }
    }
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
                <img src="../Images/harmony.jpg" alt="Logo" class="logo-placeholder">
                <span>By Harmony Community Association</span>
            </div>
        </div>
        <div class="header-right">

        </div>
    </header>
    <div class="form-body">
        <form class="form" id="myForm" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
            <?php if (!empty($errorMessage)) { ?>
                <p style="color: red; text-align: center; font-weight: bold;">
                    <?php echo $errorMessage . "<br>"; ?>
                </p>
            <?php } ?>

            <?php if (!empty($successMessage)) { ?>
                <p style="color: green; text-align: center; font-weight: bold;">
                    <?php echo $successMessage . "<br>"; ?>
                </p>
            <?php } ?>
            <h2>Reset your password</h2><br>
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required><br>
            <label for="password">New Password:</label>
            <input type="password" id="password" name="password" required><br>
            <label for="confirm-password">Confirm Password:</label>
            <input type="password" id="confirm-password" name="confirm-password" required><br>
            <br>
            <input type="submit" value="Reset Password"><br><br>
            <p>Return to Login <a href="login.php">here</a>.</p>
        </form>
        <script>
            const form = document.getElementById("myForm");
            form.addEventListener('submit', function(event) {
                let pwd1 = document.getElementById("password").value;
                let pwd2 = document.getElementById("confirm-password").value;

                if (pwd1 !== pwd2) {
                    event.preventDefault();
                    alert("Passwords do not match! Please re-enter.");
                    location.reload();
                }
            })
        </script>
    </div>
</body>

</html>
<?php
if (isset($connection)) {
    mysqli_close($connection);
}
?>