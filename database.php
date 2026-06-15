<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "community_connect";

$connection = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$connection) {
  die("Connection failed: " . mysqli_connect_error());
}
