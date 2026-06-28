<?php
session_start();
require_once("../database.php");
global $connection;
if (!isset($_SESSION["id"])) {
    header("Location: ../UserLogin/login.php");
    exit();
}
$user_id = $_SESSION['id'];

//history approved join program
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>History Records</title>
    <link rel="stylesheet" href="../CSS/user.css">
    <style>
        .section-title {
            margin: 30px 20px 15px 20px;
            color: #333;
            border-bottom: 2px solid #eee;
            padding-bottom: 10px;
            font-weight: bold;
        }
    </style>
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
            <a href="profile.php" class="profile-btn">Profile</a>
        </div>
    </header>

    <nav class="main-nav">
        <a href="user_page.php" target="_self">Home</a>
        <a href="program.php" target="_self">Explore</a>
        <a href="program_status.php" target="_self">My Activities</a>
        <a href="history.php" target="_self">History</a>
    </nav>
    <?php include 'notification.php'; ?>

    <div class="page-content">
        <h2 class="section-title">Completed Programs</h2>
        <div class="programs-section">
            <?php
            $completed_sql = "SELECT up.program_id, up.status, up.Reg_date, 
                                p.title, p.location, p.start_time, p.end_time, p.event_date, p.description, p.image
                            FROM user_program up 
                            INNER JOIN program p ON up.program_id = p.id 
                            WHERE up.user_id = '$user_id' 
                            AND up.status = 'Approved' 
                            AND p.event_date < CURDATE() 
                            ORDER BY p.event_date DESC";
            $completed_result = mysqli_query($connection, $completed_sql);
            if ($completed_result && mysqli_num_rows($completed_result) > 0) {
                while ($row = mysqli_fetch_assoc($completed_result)) {
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
                            <p class="Reg_date">Registration Timestamp: <?=date("jS F Y, g:i A", strtotime($row['Reg_date']))?></p><br>

                            <div class="status-badge" style="background-color: #6c757d; color: #fff; padding: 8px 16px; border-radius: 4px; display: inline-block; text-align: center; font-weight: bold;">
                                Completed
                            </div>
                        </div>
                    </div>
            <?php
                }
            } else {
                echo "<p style='margin-left: 20px; color: #888;'>You have no completed programs yet.</p>";
            }
            ?>
        </div>
        <h2 class="section-title">Rejected Programs</h2>
        <div class="programs-section">
            <?php
            $rejected_sql = "SELECT up.program_id, up.status, up.Reg_date, 
                                   p.title, p.location, p.start_time, p.end_time, p.event_date, p.description, p.image 
                            FROM user_program up 
                            INNER JOIN program p ON up.program_id = p.id 
                            WHERE up.user_id = '$user_id' 
                            AND up.status = 'Rejected' 
                            ORDER BY p.event_date DESC";
            $rejected_result = mysqli_query($connection, $rejected_sql);
            if ($rejected_result && mysqli_num_rows($rejected_result) > 0) {
                while ($row = mysqli_fetch_assoc($rejected_result)) {
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
                            <p class="Reg_date">Registration Timestamp: <?=date("jS F Y, g:i A", strtotime($row['Reg_date']))?></p><br>


                            <div class="status-badge" style="background-color: #dc3545; color: #fff; padding: 8px 16px; border-radius: 4px; display: inline-block; text-align: center; font-weight: bold;">
                                <?php echo ($row['status']); ?>
                            </div>
                        </div>
                    </div>
            <?php
                }
            } else {
                echo "<p style='margin-left: 20px; color: #888;'>No rejected requests.</p>";
            }
            ?>
        </div>
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