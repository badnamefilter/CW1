<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once("../database.php");

$errorMessage = "";
$successMessage = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = isset($_POST["username"]) && !empty($_POST["username"]) ? $_POST["username"] : "";
    $email = isset($_POST["email"]) && !empty($_POST["email"]) ? $_POST["email"] : "";
    $password = isset($_POST["password"]) && !empty($_POST["password"]) ? $_POST["password"] : "";
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    $role = isset($_POST["role"]) && !empty($_POST["role"]) ? $_POST["role"] : "";

    $sql = "SELECT * 
        FROM account
        WHERE username='$username'";

    $result = mysqli_query($connection, $sql);

    if (mysqli_num_rows($result) > 0) {
        $errorMessage = "Error: Sorry, that username has already been taken!<br> <a href='register.php'>Re-create account</a><br><br>";
    } else {
        $sql = "INSERT INTO account (username, email, password,role, Reg_date)
            VALUES ('$username','$email','$hashedPassword','$role',NOW());";

        mysqli_query($connection, $sql);

        $successMessage = "Account successfully created! <a href='login.php'>Return to login page</a>";
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
        <form id="myForm" class="form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
            <?php if (!empty($errorMessage)) { ?>
                <p style="color: red; text-align: center; font-weight: bold;">
                    <?php echo $errorMessage; ?>
                </p>
            <?php } ?>

            <?php if (!empty($successMessage)) { ?>
                <p style="color: green; text-align: center; font-weight: bold;">
                    <?php echo $successMessage; ?>
                </p>
            <?php } ?>
            <h2>Sign up for our community!</h2><br>
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required><br><br>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required><br><br>

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required><br><br>

            <label for="confirm_password">Confirm Password:</label>
            <input type="password" id="ConfirmPassword" name="confirm_password" required><br><br>

            <label for="role">Select role:</label>
            <select name="role" id="role">
                <option value="user">User</option>
                <option value="admin">Admin</option>
            </select>

            <br>
            <input type="submit" value="Sign Up"><br><br>
            <p>Already have an account? <a href="login.php">Log in here</a>.</p>
        </form>

        <script>
            const form = document.getElementById("myForm");
            form.addEventListener('submit', function(event) {
                let pwd1 = document.getElementById("password").value;
                let pwd2 = document.getElementById("ConfirmPassword").value;

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