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

$notification_sql = "SELECT p.title, p.event_date 
                     FROM user_program up 
                     INNER JOIN program p ON up.program_id = p.id 
                     WHERE up.user_id = '$user_id' 
                     AND up.status = 'Approved' 
                     AND p.event_date >= CURDATE() 
                     AND p.event_date <= CURDATE() + INTERVAL 10 DAY
                     ORDER BY p.event_date ASC";

$notification_result = mysqli_query($connection, $notification_sql);

if ($notification_result && mysqli_num_rows($notification_result) > 0) {
    while ($notify_row = mysqli_fetch_assoc($notification_result)) {
?>
        <!DOCTYPE html>
        <html lang="en">

        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
        </body>

        </html>