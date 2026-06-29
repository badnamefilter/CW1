<?php
session_start();
require_once("../database.php");
global $connection;
if (!isset($_SESSION["id"])) {
    header("Location: ../UserLogin/login.php");
    exit();
}

$user_id = $_SESSION["id"];

//cancel function 
if (isset($_GET['action']) && $_GET['action'] == 'cancel' && isset($_GET['req_id'])) {
    $cancel_id = $_GET['req_id'];

    $delete_sql = "DELETE FROM user_program WHERE id = '$cancel_id' AND user_id = '$user_id'";
    mysqli_query($connection, $delete_sql);

    //after delete refresh page
    header("Location: program_status.php");
    exit();
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Manage Programs</title>
    <link rel="stylesheet" href="../CSS/user.css">
</head>
<style>
    .status-badge {
        align-self: flex-end;
        /* Pushes the badge block to the right edge naturally */
        padding: 8px 16px;
        font-size: 16px;
        font-weight: bold;
        border-radius: 20px;
        /* Gives it a clean oval pill look */
        text-align: center;
        text-transform: capitalize;
        /* Automatically fixes 'rejected' to 'Rejected' */
        margin-top: auto;
    }

    .section-title {
        margin: 30px 20px 15px 20px;
        color: #333;
        border-bottom: 2px solid #eee;
        padding-bottom: 10px;
        font-weight: bold;
    }
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
        <h2 class="section-title">Pending Requests</h2>
        <div class="programs-section">

            <?php
            //Pending function
            $pending_sql = "SELECT * FROM user_program 
                            WHERE user_id = '$user_id'
                            AND status='Pending' ORDER BY id DESC"; //DESC is highest to lowest.
            $pending_result = mysqli_query($connection, $pending_sql);

            if ($pending_result && mysqli_num_rows($pending_result) > 0) {
                while ($request_row = mysqli_fetch_assoc($pending_result)) {
                    $program_id = $request_row['program_id'];
                    $status = $request_row['status']; //status have Pending, Approved, Rejected
                    $reg_date = $request_row['Reg_date']; //user Register date
                    $request_id = $request_row['id'];

                    //use program id go program take all data for the program
                    $program_sql = "SELECT * FROM program WHERE id = '$program_id'";
                    $program_result = mysqli_query($connection, $program_sql);
                    $program_row = mysqli_fetch_assoc($program_result);


                    if ($program_row) {
            ?>

                        <div class="program-card">
                            <img src="../<?= htmlspecialchars($program_row['image']) ?>" alt="<?= htmlspecialchars($program_row['title']) ?>">

                            <div class="card-content">

                                <h3><?php echo htmlspecialchars($program_row['title']); ?></h3>
                                <p class="location">Location: <?php echo htmlspecialchars($program_row['location']); ?></p>
                                <p class="time">Time🕒: <?= date("g:i A", strtotime($program_row['start_time'])) . " - " . date("g:i A", strtotime($program_row['end_time'])) ?></p><br>
                                <p class="date">Date: <?= date("jS F Y", strtotime($program_row['event_date'])) ?></p><br>
                                <p class="description">Description: <?php echo htmlspecialchars($program_row['description']); ?></p>
                                <button type="button" class="read-more-link" onclick="openDescModal('<?= addslashes(htmlspecialchars($program_row['title'])) ?>', '<?= addslashes(htmlspecialchars($program_row['description'])) ?>')">
                                    Read More...
                                </button>
                                <p class="Reg_date">Registration Timestamp: <?= date("jS F Y, g:i A", strtotime($reg_date)) ?></p>

                                <div class="status-badge" style="background-color: #ffc107; color: #000;"><?= $status ?></div>

                                <a href="program_status.php?action=cancel&req_id=<?= $request_id ?>"
                                    class="join"
                                    style="text-decoration:none; display:inline-block; text-align:center; background-color: #dc3545;">
                                    Cancel
                                </a>
                            </div>
                        </div>
            <?php
                    }
                } //while how many request event;
            } else {
                echo "<p style='margin-left: 20px; color: #888;'>You have no pending requests</p>";
            }
            ?>
        </div>

        <h2 class="section-title">Upcoming Programs</h2>
        <div class="programs-section">
            <?php
            //Upcoming(Approved) function
            $upcoming_sql = "SELECT up.id,  up.program_id, up.status, up.Reg_date, p.title, p.location, p.start_time, p.end_time, p.event_date, p.description, p.image
                             FROM user_program up
                             INNER JOIN program p ON up.program_id=p.id
                             WHERE up.user_id = '$user_id'
                             AND up.status='Approved' 
                             AND p.event_date >= CURDATE()
                             ORDER BY p.event_date ASC"; //ASC is lowest to highest.
            $upcoming_result = mysqli_query($connection, $upcoming_sql);

            if ($upcoming_result && mysqli_num_rows($upcoming_result) > 0) {
                while ($request_row = mysqli_fetch_assoc($upcoming_result)) {

            ?>

                    <div class="program-card">
                        <img src="../<?= htmlspecialchars($request_row['image']) ?>" alt="<?= htmlspecialchars($request_row['title']) ?>">

                        <div class="card-content">
                            <h3><?php echo htmlspecialchars($request_row['title']); ?></h3>
                            <p class="location">Location: <?php echo htmlspecialchars($request_row['location']); ?></p>
                            <p class="time">Time🕒: <?= date("g:i A", strtotime($request_row['start_time'])) . " - " . date("g:i A", strtotime($request_row['end_time'])) ?></p><br>
                            <p class="date">Date: <?= date("jS F Y", strtotime($request_row['event_date'])) ?></p><br>
                            <p class="description">Description: <?php echo htmlspecialchars($request_row['description']); ?></p>
                            <button type="button" class="read-more-link" onclick="openDescModal('<?= addslashes(htmlspecialchars($request_row['title'])) ?>', '<?= addslashes(htmlspecialchars($request_row['description'])) ?>')">
                                Click to Read More...
                            </button>
                            <p class="Reg_date">Registration Timestamp: <?= date("jS F Y, g:i A", strtotime($request_row['Reg_date'])) ?></p>


                            <div class="status-badge" style="background-color: #28a745; color: #fff;"><?php echo htmlspecialchars($request_row['status']) ?></div>

                            <a href="program_status.php?action=cancel&req_id=<?php echo $request_row['id']; ?>" class="join" style="text-decoration:none; display:inline-block; text-align:center; background-color: #dc3545;color: white;">
                                Cancel
                            </a>
                        </div>
                    </div>

            <?php
                }
            } else {
                echo "<p style='margin-left: 20px; color: #888;'>You have no upcoming programs.</p>";
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