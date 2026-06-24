 <?php
session_start();
require_once("../database.php");
if (!isset($_SESSION["id"]) || $_SESSION["role"] !== 'admin') {
    header("Location: ../UserLogin/login.php");
    exit();
}
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
          <div class="wtitle"><h1> Welcome Back, </h1></div> 
          <div class="small-desc"><p> Here's what's happening today. </p></div>
      </div>

    <div class="container">
        <div class="lainfo">   <!-- 1st Widget -->
            <div class="tprog">
                <div class="grey"> Total Programs </div>
                <div class="Count"> 6 </div>
                <div class="grey"> 3 active </div> 
            </div>
        </div>

        <div class="lainfo">  <!-- 2nd Widget -->
            <div class="tprog">
                <div class="grey"> Total draft programs </div>
                <div class="Count"> 2 </div>
                <div class="grey"> 2 drafts </div> 
            </div>
        </div>

        <div class="lainfo">  <!-- 3rd Widget -->
            <div class="tprog">
                <div class="grey"> Total volunteers </div>
                <div class="Count"> 192 </div>
                <div class="grey"> Across all programs </div> 
            </div>
        </div>

        <div class="lainfo">  <!-- 4th Widget -->
            <div class="tprog">
                <div class="grey"> Fill rate </div>
                <div class="Count"> 67% </div>
                <div class="grey"> Average across programs </div> 
            </div>
        </div>

        <div class="lainfo">  <!-- 5th Widget -->
            <div class="tprog">
                <div class="grey"> Pending requests </div>
                <div class="Count"> 3 </div>
                <div class="grey"> Awaiting approval </div> 
            </div>
        </div>
    </div>

    <div class="randomah">
      <div class="randomm">

        <div class="envets">
          <div class="envet"><h1>Your Events,</h1></div>
        </div>

        <div class="container2">
          <div class="envetsWg">
            <div class="envetTitle">Clean The Velocity</div>
            <div class="envetDes">
              📅Date: June 17 - June 19 <br>
              ⏱️Time: 8:00A.M. <br>
              📍Location: Sunway Velocity <br><br>
            </div>
          </div>

          <div class="envetsWg">
            <div class="envetTitle">Clean The Pyramid</div>
            <div class="envetDes">
              📅Date: June 7 - June 9 <br>
              ⏱️Time: 9:00A.M. <br>
              📍Location: Sunway Pyramid <br><br>
            </div>
          </div>

          <div class="envetsWg">
            <div class="envetTitle">Clean The Puchong</div>
            <div class="envetDes">
              📅Date: June 17 - June 19 <br>
              ⏱️Time: 8:00A.M. <br>
              📍Location: Sunway Velocity <br><br>
            </div>
          </div>
        </div>
  
        <div class="container2">
          <div class="envetsWg">
            <div class="envetTitle">Clean The Velocity</div>
            <div class="envetDes">
              📅Date: June 17 - June 19 <br>
              ⏱️Time: 8:00A.M. <br>
              📍Location: Sunway Velocity <br><br>
            </div>
          </div>

          <div class="envetsWg">
            <div class="envetTitle">Clean The Pyramid</div>
            <div class="envetDes">
              📅Date: June 7 - June 9 <br>
              ⏱️Time: 9:00A.M. <br>
              📍Location: Sunway Pyramid <br><br>
            </div>
          </div>

          <div class="envetsWg">
            <div class="envetTitle">Clean The Puchong</div>
            <div class="envetDes">
              📅Date: June 17 - June 19 <br>
              ⏱️Time: 8:00A.M. <br>
              📍Location: Sunway Velocity <br><br>
            </div>
          </div>
      </div>
    </div>

    <div class="aprove">
      <div class="requestHome">
        <div class="lalala">
          <div class="reqtitle">Approval Queue</div>

          <button onclick="window.location.href='Admin_Request.php';" class="niba"> Go Approve </button>
        </div>
        <div class="user"> 
          <div class="ud">JohnQT</div>
          <div class="ude">Request to join: <strong>Clean The Velocity</strong></div>
        </div>

        <div class="user"> 
          <div class="ud">Robin</div>
          <div class="ude">Request to join: <strong>Clean The Velocity</strong></div>
        </div>

        <div class="user"> 
          <div class="ud">Newson</div>
          <div class="ude">Request to join: <strong>Clean The Velocity</strong></div>
        </div>

        <div class="user"> 
          <div class="ud">Ray Ping</div>
          <div class="ude">Request to join: <strong>Clean The Velocity</strong></div>
        </div>


      </div>
    </div>

    </div>
  </div>
  </body>
</html>