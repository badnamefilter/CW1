<?php
session_start();
require_once("../database.php");
global $connection;
if (!isset($_SESSION["id"]) || $_SESSION["role"] !== 'admin') {
    header("Location: ../UserLogin/login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $up_id = intval($_POST["up_id"] ?? 0);

    if (isset($_POST["accept"]) && $up_id > 0) {
        $sql = "UPDATE user_program 
                SET status = 'Approved' 
                WHERE id = $up_id";
        mysqli_query($connection, $sql);
    }

    if (isset($_POST["reject"]) && $up_id > 0) {
        $sql = "UPDATE user_program    
                SET status = 'Rejected' 
                WHERE id = $up_id";
        mysqli_query($connection, $sql);
    }

    header("Location: Admin_Request.php");
    exit();
}

$limit = 5;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
if ($page < 1) $page = 1;
$offset = ($page - 1) * $limit;

$allowed_sorts = ['event_date', 'title', 'username'];
$sort = in_array($_GET['sort'] ?? '', $allowed_sorts) ? $_GET['sort'] : 'event_date';

$allowed_orders = ['asc', 'desc'];
$order = in_array(strtolower($_GET['order'] ?? ''), $allowed_orders) ? strtolower($_GET['order']) : 'asc';

$search = isset($_GET['search']) && !empty($_GET['search']) ? $_GET['search'] : "";

if ($search !== "") {
    $safe = mysqli_real_escape_string($connection, $search);

    $count_sql =
        "SELECT COUNT(*) AS total
    FROM program p, user_program up
    WHERE p.id = up.program_id
    AND p.title LIKE '%$safe%'
    AND up.status LIKE 'Pending'
    ";

    $count_result = mysqli_query($connection, $count_sql);
    $total_rows = mysqli_fetch_assoc($count_result)['total'];

    $sql = "SELECT up.id, up.user_id, up.program_id, up.status, up.Reg_date, a.username, p.title
            FROM user_program up, account a, program p 
            WHERE up.user_id = a.id
            AND up.program_id = p.id
            AND p.title LIKE '%$safe%'
            AND up.status LIKE 'Pending' 
            ORDER BY $sort $order
            LIMIT $limit OFFSET $offset";
} else {
    $count_sql =
        "SELECT COUNT(*) AS total
    FROM user_program
    WHERE status LIKE 'Pending'
    ";

    $count_result = mysqli_query($connection, $count_sql);
    $total_rows = mysqli_fetch_assoc($count_result)['total'];

    $sql = "SELECT up.id, up.user_id, up.program_id, up.status, up.Reg_date, a.username, p.title
            FROM user_program up, account a, program p
            WHERE up.user_id = a.id
            AND up.program_id = p.id
            AND up.status LIKE 'Pending'
            ORDER BY $sort $order
            LIMIT $limit OFFSET $offset";
}

$result = mysqli_query($connection, $sql);
$total_pages = ceil($total_rows / $limit);
?>

<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="../CSS/admin.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0&icon_names=search" />
</head>
<style>

</style>

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
        <a href="Admin_Request.php" class="current" target="_self">Approvals</a>
    </nav>

    <div class="ctitle">
        <h1>Programs Requests:</h1>
    </div>

    <form method="GET" action="">
        <div class="searchs">
            <span class="search-icon material-symbols-outlined">search</span>
            <input class="search-input" type="text" name="search" placeholder="Search programs"
                value="<?= htmlspecialchars($_GET['search'] ?? '') ?>" autofocus>
        </div>
    </form>

    <div class="sort-controls">
        Sort by:
        <a href="?sort=event_date&order=<?= ($sort === 'event_date' && $order === 'asc') ? 'desc' : 'asc' ?>&search=<?= urlencode($search) ?>"
            class="sort-link <?= $sort === 'event_date' ? 'active' : '' ?>">
            Date <?= $sort === 'event_date' ? ($order === 'asc' ? '▲' : '▼') : '' ?>
        </a>
        <a href="?sort=title&order=<?= ($sort === 'title' && $order === 'asc') ? 'desc' : 'asc' ?>&search=<?= urlencode($search) ?>"
            class="sort-link <?= $sort === 'title' ? 'active' : '' ?>">
            Title <?= $sort === 'title' ? ($order === 'asc' ? '▲' : '▼') : '' ?>
        </a>
        <a href="?sort=username&order=<?= ($sort === 'username' && $order === 'asc') ? 'desc' : 'asc' ?>&search=<?= urlencode($search) ?>"
            class="sort-link <?= $sort === 'username' ? 'active' : '' ?>">
            Name <?= $sort === 'username' ? ($order === 'asc' ? '▲' : '▼') : '' ?>
        </a>
    </div>


    <div class="requests">
        <?php if (mysqli_num_rows($result) > 0): ?>
            <?php while ($row = mysqli_fetch_assoc($result)): ?>
                <div class="requests-info">
                    <div class="requests-person">
                        <h3 class="pName"><?= htmlspecialchars($row['username']) ?></h3>
                        <p class="idek"> Request to join <strong class="proT"><?= htmlspecialchars($row['title']) ?></strong></p>
                        <p class="idek"> Registered: <?= htmlspecialchars($row['Reg_date']) ?></p>
                    </div>

                    <div class="requests-actions">
                        <form class="decision" method="POST" action="Admin_Request.php">
                            <input type="hidden" name="up_id" value="<?= intval($row['id']) ?>">
                            <button class="acceptB" type="submit" name="accept" value="Accept">Accept</button>
                            <button class="rejectB" type="submit" name="reject" value="Reject">Reject</button>
                        </form>
                    </div>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <p class="nothing">No pending requests.</p>
        <?php endif; ?>
    </div>

    <?php if ($total_rows > 0): ?>
        <div style="text-align: center; margin: 40px 0; font-family: Arial, sans-serif; font-weight: bold;">

            <?php if ($page > 1): ?>
                <a href="Admin_Request.php?page=<?php echo $page - 1; ?>&search=<?php echo urlencode($search); ?>"
                    style="display: inline-block; padding: 8px 18px; margin: 0 10px; border: 2px solid #333; color: #333; text-decoration: none; border-radius: 4px; background-color: transparent;">
                    Prev Page
                </a>
            <?php endif; ?>

            <span style="display: inline-block; margin: 0 10px; color: #666; vertical-align: middle;">
                Page <?php echo $page; ?> of <?php echo $total_pages; ?>
            </span>

            <?php if ($page < $total_pages): ?>
                <a href="Admin_Request.php?page=<?php echo $page + 1; ?>&search=<?php echo urlencode($search); ?>"
                    style="display: inline-block; padding: 8px 18px; margin: 0 10px; border: 2px solid #333; color: #333; text-decoration: none; border-radius: 4px; background-color: transparent;">
                    Next Page
                </a>
            <?php endif; ?>

        </div>
    <?php endif; ?>

</body>

</html>