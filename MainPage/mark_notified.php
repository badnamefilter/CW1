<?php
session_start();
require_once("../database.php");
global $connection;

if (!isset($_SESSION["id"])) {
    exit();
}

$user_id = $_SESSION['id'];
$up_id = isset($_POST['up_id']) ? intval($_POST['up_id']) : 0;

if ($up_id > 0) {
    $sql = "UPDATE user_program SET notified = 1 WHERE id = $up_id AND user_id = '$user_id'";
    mysqli_query($connection, $sql);
}
?>