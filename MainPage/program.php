<?php
session_start();
require_once("../database.php");
global $connection;
if (!isset($_SESSION["id"])) {
    header("Location: ../UserLogin/login.php");
    exit();
}

//pagination
$limit = 6; //show limit 6 program
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1; //get now have how many page, default page 1
if ($page < 1) $page = 1;
$offset = ($page - 1) * $limit;

//search 
$search_query = $_GET['search'] ?? "";

if (!empty($search_query)) {
    $count_sql = "SELECT * FROM program WHERE title LIKE '%$search_query%' OR description	LIKE '%$search_query%";
    $count_result = mysqli_query($connection, $count_sql);
    $total_rows = mysqli_fetch_assoc($count_result)['total'];

    $sql = "SELECT * FROM program  WHERE title LIKE '%$search_query%' OR description LIKE '%$search_query%' LIMIT OFFSET $offset";
} else {
    $count_sql = "SELECT COUNT(*) AS total FROM program";
    $count_result = mysqli_query($connection, $count_sql);
    $total_rows = mysqli_fetch_assoc($count_result)['total'];

    $sql = "SELECT * FROM program LIMIT $limit OFFSET $offset";
}

$result = mysqli_query($connection, $sql);
$total_pages = ceil($total_rows / $limit); //calculate total have how many page

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
                <img src="../Images/harmony.jpg"
                    alt="https://media.licdn.com/dms/image/v2/D4E03AQELNAHJckXI1Q/profile-displayphoto-shrink_200_200/B4EZOXqLbGHkAk-/0/1733416237478?e=2147483647&v=beta&t=sjAOtOOF-mVLAh6dF3wuGAHkhmZoFFiBIWNB3DAQ30s"
                    class="logo-placeholder">
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
        <a href="program_status.php" target="_self">Join Requests</a>

    </nav>

    <div class="search-section">
        <form action="program.php" method="GET" class="search-container">
            <input type="text" name="program" placeholder="Search for programs, events, or keywords..." required>
            <input type="submit" value="Search">
        </form>
    </div>

    <div class="page-content">
        <div class="programs-section">

            <?php
            if ($result && mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
            ?>

                    <div class="program-card">
                        <img src="../Images/gotong-royong.jpg" alt="https://www.mbsj.gov.my/ms/gotong-royong-0">

                        <div class="card-content">
                            <h3><?php echo $row['id']; ?>.<?php echo htmlspecialchars($row['title']); ?></h3>
                            <p class="location">Location:<?php echo htmlspecialchars($row['location']); ?></p>
                            <p class="time">Time🕒:<?php echo htmlspecialchars($row['time']); ?></p>
                            <p class="duration">Duration:<?php echo htmlspecialchars($row['duration']); ?></p>
                            <p class="date">Date:<?php echo htmlspecialchars($row['event_date']); ?></p>
                            <p class="description">Description:<?php echo htmlspecialchars($row['description']); ?></p>

                            <a href="join_request_submitted.php?program_id=<?php echo $row['id']; ?>">
                                <button class="join">join</button>
                            </a>
                        </div>
                    </div>
            <?php
                }
            } else {
                echo "<p>No programs found.</p>";
            }
            ?>
            <div>
                <?php if ($page > 1): ?>
                    <a href="program.php?page=<?php echo $page - 1; ?>&program=<?php echo urlencode($search_query);
                                                                                //urlencode is usde to convert certain special characters(exp: space and ?)into URL Format
                                                                                ?>">Prev Page</a>
                <?php endif; ?>

                <span> | Page <?php echo $page; ?> of <?php echo $total_pages == 0 ? 1 : $total_pages; ?> | </span>

                <?php if ($page < $total_pages): ?>
                    <a href="program.php?page=<?php echo $page + 1; ?>&program=<?php echo urlencode($search_query); ?>">Next Page</a>
                <?php endif; ?>
            </div>

        </div>
    </div>

</body>

</html>