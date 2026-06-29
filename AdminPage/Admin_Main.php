 <?php
session_start();
require_once("../database.php");
global $connection;
if (!isset($_SESSION["id"]) || $_SESSION["role"] !== 'admin') {
  header("Location: ../UserLogin/login.php");
  exit();
}

$total_programs = mysqli_fetch_assoc(mysqli_query($connection, "SELECT COUNT(*) as count FROM program"))['count'];

$total_active_programs = mysqli_fetch_assoc(mysqli_query($connection, "SELECT COUNT(*) as count FROM program WHERE CURDATE() < event_date"))['count'];

$total_pending = mysqli_fetch_assoc(mysqli_query($connection, "SELECT COUNT(*) as count FROM user_program WHERE status = 'Pending'"))['count'];

$total_volunteers = mysqli_fetch_assoc(mysqli_query($connection, "SELECT COUNT(DISTINCT user_id) as count FROM user_program WHERE status != 'cancelled'"))['count'];

$total_registered = mysqli_fetch_assoc(mysqli_query($connection, "SELECT COUNT(*) as count FROM user_program WHERE status != 'cancelled'"))['count'];
$fill_rate = $total_programs > 0 ? round(($total_registered / ($total_programs * 10)) * 100) : 0;

$leaderboard_sql = "SELECT a.username, COUNT(*) AS completed_count
                     FROM user_program up
                     INNER JOIN account a ON up.user_id = a.id
                     WHERE up.status = 'Approved'
                     GROUP BY up.user_id, a.username
                     ORDER BY completed_count DESC
                     LIMIT 3";

$leaderboard_result = mysqli_query($connection, $leaderboard_sql);
$leaders = [];
while ($row = mysqli_fetch_assoc($leaderboard_result)) {
  $leaders[] = $row;
}

$events_result = mysqli_query($connection, "
  SELECT title, event_date, start_time, location 
  FROM program 
  WHERE event_date >= CURDATE() 
  ORDER BY event_date ASC 
  LIMIT 6
");

$approvals_result = mysqli_query($connection, "
  SELECT a.username, p.title
  FROM user_program up, account a, program p 
  WHERE up.user_id = a.id
  AND up.program_id = p.id
  AND up.status = 'Pending'
  ORDER BY up.Reg_date ASC
  LIMIT 5
");

?>

<!DOCTYPE html>
<meta charset="UTF-8">
<html>

<head>
  <link rel="stylesheet" href="../CSS/admin.css">
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
    <a href="Admin_Main.php" class="current" target="_self">Dashboard</a>
    <a href="Admin_Program.php" target="_self">Program</a>
    <a href="Admin_Request.php" target="_self">Approvals</a>
  </nav>
  <div class="welcome">
    <div class="wtitle">
      <h1> Welcome Back, </h1>
    </div>
    <div class="small-desc">
      <p> Here's what's happening today. </p>
    </div>
  </div>

  <div class="container">
    <div class="lainfo"> <!-- 1st Widget -->
      <div class="tprog">
        <div class="grey"> Total Programs </div>
        <div class="Count"><?= $total_programs ?></div>
        <div class="grey"> <?= $total_active_programs ?> active </div>
      </div>
    </div>

    <div class="lainfo"> <!-- 3rd Widget -->
      <div class="tprog">
        <div class="grey"> Total volunteers </div>
        <div class="Count"><?= $total_volunteers ?></div>
        <div class="grey"> Across all programs </div>
      </div>
    </div>

    <div class="lainfo"> <!-- 4th Widget -->
      <div class="tprog">
        <div class="grey"> Fill rate </div>
        <div class="Count"><?= $fill_rate ?>%</div>
        <div class="grey"> Average across programs </div>
      </div>
    </div>

    <div class="lainfo"> <!-- 5th Widget -->
      <div class="tprog">
        <div class="grey"> Pending requests </div>
        <div class="Count"><?= $total_pending ?></div>
        <div class="grey"> Awaiting approval </div>
      </div>
    </div>
  </div>

  <div class="leaderboard-section">
    <h2 class="leaderboard-title">🏆 Top Volunteers</h2>
    <div class="podium">
        <?php
        // Assume $leaders is an array of up to 3 rows, ordered 1st->3rd
        // Reorder for visual podium: [2nd, 1st, 3rd]
        $podium_order = [1, 0, 2]; // indexes into $leaders
        $medals = ['🥈', '🥇', '🥉'];
        $heights = ['podium-2nd', 'podium-1st', 'podium-3rd'];
        
        foreach ($podium_order as $i => $leaderIndex):
            if (!isset($leaders[$leaderIndex])) continue;
            $leader = $leaders[$leaderIndex];
        ?>
            <div class="podium-spot <?= $heights[$i] ?>">
                <div class="podium-medal"><?= $medals[$i] ?></div>
                <div class="podium-name"><?= htmlspecialchars($leader['username']) ?></div>
                <div class="podium-count"><?= $leader['completed_count'] ?> programs</div>
            </div>
        <?php endforeach; ?>
    </div>
    <?php if (empty($leaders)): ?>
        <p style="text-align:center; color:#888;">Not enough activity yet.</p>
    <?php endif; ?>
</div>

  <div class="randomah">
    <div class="randomm">

      <div class="envets">
        <div class="envet" style="display: flex; align-items: center; gap: 30px;">
          <h1>Your Events,</h1>
          <button onclick="window.location.href='Admin_Program.php';" class="niba">Show All</button>
        </div>
      </div>

      <?php
      $count = 0;
      while ($row = mysqli_fetch_assoc($events_result)):
        if ($count % 3 === 0):
          if ($count > 0) echo '</div>';
          echo '<div class="container2">';
        endif;
        $count++;
        $date = date("M j, Y", strtotime($row['event_date']));
        $time = date("g:i A", strtotime($row['start_time']));
      ?>
        <div class="envetsWg">
          <div class="envetTitle"><?= htmlspecialchars($row['title']) ?></div>
          <div class="envetDes">
            📅Date: <?= $date ?><br>
            ⏱️Time: <?= $time ?><br>
            📍Location: <?= htmlspecialchars($row['location']) ?><br><br>
          </div>
        </div>
        <?php endwhile; ?>
      <?php if ($count > 0) echo '</div>';?>
      <?php if ($count === 0): ?>
        <p style="color: grey; padding: 10px;">No upcoming events.</p>
      <?php endif; ?>
      </div>

    <div class="aprove">
      <div class="requestHome">
        <div class="lalala">
          <div class="reqtitle">Approval Queue</div>
          <button onclick="window.location.href='Admin_Request.php';" class="niba">Click to See All</button>
        </div>
        
        <?php if (mysqli_num_rows($approvals_result) === 0): ?>
          <p style="color: grey; padding: 10px;">No pending requests.</p>
        <?php else: ?>
          <?php while ($req = mysqli_fetch_assoc($approvals_result)): ?>
            <div class="user">
              <div class="ud"><?= htmlspecialchars($req['username']) ?></div>
              <div class="ude">Request to join: <strong><?= htmlspecialchars($req['title']) ?></strong></div>
          </div>
        <?php endwhile; ?>
        <?php endif; ?>
      </div>
    </div>
  </div>

</body>
</html>

