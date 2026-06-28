<?php
session_start();
require_once("../database.php");
error_reporting(E_ALL);
ini_set('display_errors', 1);
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

$user_id = $_SESSION['id'];
//search funtion
$search_query = ($_GET['program'] ?? "");

if ($search_query !== "") {
    //LIKE use to find same word program 
    //NOT IN use to delect already join program don't show to user (First check how many program user join -> NOT IN exclude it)
    //CURDATE() means get today date data in here use to show after CURDATE hide program date before CURDATE(but time is useless only date)
    //LIMIT use to make the displayed page simple and attractive limit show program in 1 page
    //OFFSET use to create a new page and start to show after limit program(for example:limit=6,offset will show 0-5 in page 1,6-10 page 2)
        $count_sql = "SELECT COUNT(*) AS total FROM program
        WHERE title LIKE '%$search_query%'
        AND event_date >= CURDATE()
        AND id NOT IN (SELECT program_id FROM user_program WHERE user_id= '$user_id')";

    $count_result = mysqli_query($connection, $count_sql);
    $total_rows = mysqli_fetch_assoc($count_result)['total'];

    $sql = "SELECT * FROM program  
    WHERE title LIKE '%$search_query%' 
    AND event_date >= CURDATE()
    AND id NOT IN (SELECT program_id FROM user_program WHERE user_id= '$user_id')
    LIMIT $limit OFFSET $offset";
} else {
    $count_sql = "SELECT COUNT(*) AS total FROM program
    WHERE id NOT IN (SELECT program_id FROM user_program WHERE user_id= '$user_id')
    AND event_date >= CURDATE()";

    $count_result = mysqli_query($connection, $count_sql);
    $total_rows = mysqli_fetch_assoc($count_result)['total'];

    $sql = "SELECT * FROM program 
    WHERE id NOT IN (SELECT program_id FROM user_program WHERE user_id= '$user_id')
    AND event_date >= CURDATE()
    LIMIT $limit OFFSET $offset";
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
        <a href="program_status.php" target="_self">My Activities</a>
        <a href="history.php" target="_self">History</a>
    </nav>

    <div class="search-section">
        <form action="program.php" method="GET" class="search-container">
            <input type="text" name="program" placeholder="Search for programs, events, or keywords...">
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
                        <img src="../<?= htmlspecialchars($row['image']) ?>" alt="<?= htmlspecialchars($row['title']) ?>">

                        <div class="card-content">
                            <h3><?php echo ($row['title']); ?></h3>
                            <p class="location">Location: <?php echo ($row['location']); ?></p>
                            <p class="time">Time🕒: <?php echo date("g:i A", strtotime($row['start_time'])) . " - " . date("g:i A", strtotime($row['end_time'])); ?></p><br>
                            <p class="date">Date: <?php echo date("jS F Y", strtotime($row['event_date'])); ?></p><br>
                            <p class="description">Description: <?php echo ($row['description']); ?></p>
                            <button type="button" class="read-more-link" onclick="openDescModal('<?= addslashes(htmlspecialchars($row['title'])) ?>', '<?= addslashes(htmlspecialchars($row['description'])) ?>')">
                                Click to Read More...
                            </button>

                            <a href="join_request_submitted.php?program_id=<?php echo $row['id']; ?>">
                                <button class="join">Join</button>
                            </a>
                        </div>
                    </div>
            <?php
                }
            } else {
                echo "<p>No programs found.</p>";
            }
            ?>            
        </div>

        <?php if ($total_rows > 0): ?>
                <div style="text-align: center; margin: 40px 0; font-family: Arial, sans-serif; font-weight: bold;">

                    <?php if ($page > 1): ?>
                        <a href="program.php?page=<?php echo $page - 1; ?>&program=<?php echo urlencode($search_query); //urlencode is usde to convert certain special characters(exp: space and ?)into URL Format
                                                                                    ?>"
                            style="display: inline-block; padding: 8px 18px; margin: 0 10px; border: 2px solid #333; color: #333; text-decoration: none; border-radius: 4px; background-color: transparent;">
                            Prev Page
                        </a>
                    <?php endif; ?>

                    <span style="display: inline-block; margin: 0 10px; color: #666; vertical-align: middle;">
                        Page <?php echo $page; ?> of <?php echo $total_pages; ?>
                    </span>

                    <?php if ($page < $total_pages): ?>
                        <a href="program.php?page=<?php echo $page + 1; ?>&program=<?php echo urlencode($search_query); ?>"
                            style="display: inline-block; padding: 8px 18px; margin: 0 10px; border: 2px solid #333; color: #333; text-decoration: none; border-radius: 4px; background-color: transparent;">
                            Next Page
                        </a>
                    <?php endif; ?>

                </div>
            <?php endif; ?>
    </div>

    <div class="desc-modal-overlay" id="descModalOverlay" onclick="closeDescModalOnOverlay(event)">
        <div class="desc-modal-box">
            <button type="button" class="desc-modal-close" onclick="closeDescModal()">&times;</button>
            <h3 id="descModalTitle"></h3>
            <p id="descModalBody"></p>
        </div>
    </div>

    <script>
    function openDescModal(title, description) {
        document.getElementById('descModalTitle').textContent = title;
        document.getElementById('descModalBody').textContent = description;
        document.getElementById('descModalOverlay').classList.add('active');
    }

    function closeDescModal() {
        document.getElementById('descModalOverlay').classList.remove('active');
    }

    function closeDescModalOnOverlay(event) {
        if (event.target.id === 'descModalOverlay') {
            closeDescModal();
        }
    }
    </script>

</body>

</html>