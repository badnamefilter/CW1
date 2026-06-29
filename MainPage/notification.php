<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once("../database.php");
global $connection;

if (!isset($_SESSION["id"])) {
    exit();
}

$user_id = $_SESSION['id'];

//notify users when their programs are within 3 days of occurring 

$notification_sql = "SELECT p.title, p.event_date 
                     FROM user_program up 
                     INNER JOIN program p ON up.program_id = p.id 
                     WHERE up.user_id = '$user_id' 
                     AND up.status = 'Approved' 
                     AND p.event_date >= CURDATE() 
                     AND p.event_date <= CURDATE() + INTERVAL 3 DAY
                     ORDER BY p.event_date ASC";

$decision_sql = "SELECT up.id, up.status, p.title 
                  FROM user_program up
                  INNER JOIN program p ON up.program_id = p.id
                  WHERE up.user_id = '$user_id'
                  AND up.status IN ('Approved', 'Rejected')
                  AND up.notified = 0";

$decision_result = mysqli_query($connection, $decision_sql);
$notification_result = mysqli_query($connection, $notification_sql);

if ($notification_result && mysqli_num_rows($notification_result) > 0) {
    while ($notify_row = mysqli_fetch_assoc($notification_result)) {
?>
        <!DOCTYPE html>
        <html lang="en">

        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link rel="stylesheet" href="../CSS/user.css">
            <title>Document</title>
        </head>

        <body>

            <div class="notification-banner">
                <div class="notification-content">
                    <span class="notification-icon">🔔</span>
                    <div>
                        <strong>Reminder:</strong> Your program
                        <span class="notification-highlight">"<?php echo ($notify_row['title']); ?>"</span>
                        starts on <strong><?php echo ($notify_row['event_date']); ?></strong>!
                    </div>
                </div>
                <button onclick="this.parentElement.style.display='none';" style="color: red; border: none; background: none; cursor: pointer; font-weight: bold;">
                    Close
                </button>
            </div>
    <?php
    }
}
    ?>

    <?php
    if ($decision_result && mysqli_num_rows($decision_result) > 0) {
        while ($decision_row = mysqli_fetch_assoc($decision_result)) {
            $is_approved = $decision_row['status'] === 'Approved';
    ?>
            <div class="notification-banner" id="decision-<?= $decision_row['id'] ?>" 
                style="background-color: <?= $is_approved ? '#e8f5e9' : '#fdecea' ?>; color: <?= $is_approved ? '#2e7d32' : '#c0392b' ?>;">
                <div class="notification-content">
                    <span class="notification-icon"><?= $is_approved ? '✅' : '❌' ?></span>
                    <div>
                        Your request for
                        <span class="notification-highlight"><?= htmlspecialchars($decision_row['title']) ?></span>
                        was <strong><?= $decision_row['status'] ?></strong>.
                    </div>
                </div>
                <button onclick="dismissDecision(<?= $decision_row['id'] ?>)" style="color: red; border: none; background: none; cursor: pointer; font-weight: bold;">
                    Close
                </button>
            </div>
    <?php
        }
    }
    ?>

        </body>
        <script>
        function dismissDecision(upId) {
            // Hide the banner
            document.getElementById('decision-' + upId).style.display = 'none';

            // Tell the server this notification has been seen
            fetch('mark_notified.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                body: 'up_id=' + upId
            });
        }
        </script>

        </html>