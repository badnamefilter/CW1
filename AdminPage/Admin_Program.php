<?php
session_start();
require_once("../database.php");
if (!isset($_SESSION["id"]) || $_SESSION["role"] !== 'admin') {
    header("Location: ../UserLogin/login.php");
    exit();
}

$limit = 5;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
if ($page < 1) $page = 1;
$offset = ($page - 1) * $limit;

$allowed_sorts = ['event_date', 'title', 'location'];
$sort = in_array($_GET['sort'] ?? '', $allowed_sorts) ? $_GET['sort'] : 'event_date';

$allowed_orders=['asc', 'desc'];
$order = in_array(strtolower($_GET['order'] ?? ''), $allowed_orders) ? strtolower($_GET['order']) : 'asc';

$allowed_filters = ['all', 'upcoming', 'past'];
$filter = in_array($_GET['filter'] ?? '', $allowed_filters) ? $_GET['filter'] : 'all';

$filter_condition = "";
if ($filter === 'upcoming') {
    $filter_condition = "AND event_date >= CURDATE()";
} elseif ($filter === 'past') {
    $filter_condition = "AND event_date < CURDATE()";
}

$search = isset($_GET['search']) && !empty($_GET['search']) ? $_GET['search'] : "";

if ($search !== "") {
    $safe = mysqli_real_escape_string($connection, $search);

    $count_sql = "SELECT COUNT(*) AS total FROM program WHERE title LIKE '%$safe%' $filter_condition";
    $count_result = mysqli_query($connection, $count_sql);
    $total_rows = mysqli_fetch_assoc($count_result)['total'];


    $sql = "SELECT id, title, event_date, start_time, end_time, location, description
            FROM program 
            WHERE title LIKE '%$safe%'
            $filter_condition 
            ORDER BY $sort $order
            LIMIT $limit OFFSET $offset";

} else {

    $count_sql = "SELECT COUNT(*) AS total FROM program WHERE 1=1 $filter_condition";
    $count_result = mysqli_query($connection, $count_sql);
    $total_rows = mysqli_fetch_assoc($count_result)['total'];

    $sql = "SELECT id, title, event_date, start_time, end_time, location, description
            FROM program 
            WHERE 1=1
            $filter_condition
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
        <a href="Admin_Program.php" class="current" target="_self">Program</a>
        <a href="Admin_Request.php" target="_self">Approvals</a>
    </nav>

        <div class="create-program">
            <a href="creating_program.php" target="_self">
            <h2>Create Program</h2>
            <h1>+</h1>
            </a>
        </div>

    <hr class="randomline">

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
            <a href="?sort=location&order=<?= ($sort === 'location' && $order === 'asc') ? 'desc' : 'asc' ?>&search=<?= urlencode($search) ?>"
            class="sort-link <?= $sort === 'location' ? 'active' : '' ?>">
                Location <?= $sort === 'location' ? ($order === 'asc' ? '▲' : '▼') : '' ?>
            </a>
        </div>

        <form method="GET" action="" class="filter-form">
            <input type="hidden" name="search" value="<?= htmlspecialchars($search) ?>">
            <input type="hidden" name="sort" value="<?= htmlspecialchars($sort) ?>">
            <input type="hidden" name="order" value="<?= htmlspecialchars($order) ?>">
            <label for="filter" class="filter-label">Show:</label>
            <select name="filter" id="filter" class="filter-select" onchange="this.form.submit()">
                <option value="all" <?= $filter === 'all' ? 'selected' : '' ?>>All</option>
                <option value="upcoming" <?= $filter === 'upcoming' ? 'selected' : '' ?>>Upcoming</option>
                <option value="past" <?= $filter === 'past' ? 'selected' : '' ?>>Past</option>
            </select>
        </form>


    <div class="programs">
        <?php if (mysqli_num_rows($result) > 0): ?>
            <?php while ($row = mysqli_fetch_assoc($result)): ?>
                <div class="program-item">
                    <div class="program-left">
                        <div class="program-info">
                            <h3><?=  htmlspecialchars($row['title']) ?></h3>
                            <p>Time: <?= date('M j, Y', strtotime($row['event_date'])) ?>
                                    (<?= date('g:i A', strtotime($row['start_time'])) ?> - 
                                    <?= date('g:i A', strtotime($row['end_time'])) ?>)
                            </p>
                            <p>Location: <?= htmlspecialchars($row['location']) ?> </p>
                            <p>Description: <?= htmlspecialchars($row['description']) ?> </p>
                        </div>
                    </div>
                    <div class="program-actions">
                        <a href="Admin_Program_edit.php?id=<?= $row['id'] ?>" class="edit-button">Edit</a>
                    </div>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <p class="nothing">No programs found.</p>
        <?php endif; ?>
    </div>

    <?php if ($total_rows > 0): ?>
    <div style="text-align: center; margin: 40px 0; font-family: Arial, sans-serif; font-weight: bold;">

        <?php if ($page > 1): ?>
            <a href="Admin_Program.php?page=<?php echo $page - 1; ?>&search=<?php echo urlencode($search); ?>"
                style="display: inline-block; padding: 8px 18px; margin: 0 10px; border: 2px solid #333; color: #333; text-decoration: none; border-radius: 4px; background-color: transparent;">
                Prev Page
            </a>
        <?php endif; ?>

        <span style="display: inline-block; margin: 0 10px; color: #666; vertical-align: middle;">
            Page <?php echo $page; ?> of <?php echo $total_pages; ?>
        </span>

        <?php if ($page < $total_pages): ?>
            <a href="Admin_Program.php?page=<?php echo $page + 1; ?>&search=<?php echo urlencode($search); ?>"
                style="display: inline-block; padding: 8px 18px; margin: 0 10px; border: 2px solid #333; color: #333; text-decoration: none; border-radius: 4px; background-color: transparent;">
                Next Page
            </a>
        <?php endif; ?>

    </div>
    <?php endif; ?>
      

    </body>
</html>