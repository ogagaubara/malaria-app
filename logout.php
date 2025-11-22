<?php
session_start();
session_destroy();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Logout</title>
  <link rel="stylesheet" type="text/css" media="screen" href="css/reset.css">
  <link rel="stylesheet" type="text/css" media="screen" href="css/style.css">
  <link rel="stylesheet" href="css/colorbox.css" />
  <script src="js/jquery-1.7.min.js"></script>
  <script src="js/jquery.easing.1.3.js"></script>
  <script src="js/jquery.min.js"></script>
  <script src="js/jquery.colorbox.js"></script>
  <style>
    .logout-box {
      font-size: 16px;
      background-color: #FFFFFF;
      text-align: center;
      border-radius: 10px;
      margin-left: -160px;
      width: 900px;
      padding: 40px;
    }
    .logout-message {
      font-size: 1.2em;
      color: #2c3e50;
      margin-bottom: 20px;
    }
    .home-btn {
      display: inline-block;
      text-decoration: none;
      background: #3498db;
      color: white;
      padding: 10px 20px;
      border-radius: 5px;
      transition: background 0.3s;
    }
    .home-btn:hover {
      background: #2980b9;
    }
  </style>
</head>
<body>
<div class="bg"><center>
<div style="border:0px solid black; width:960px; background-color:#6699CC;">
<header>
<nav>
<ul class="menu">
  <li><a href="home.php">Home &nbsp;&nbsp; |</a></li>
  <li><a href="diagnosis.php">Diagnosis &nbsp;&nbsp;|</a></li>
  <li><a href="#">User Management &nbsp;&nbsp;|</a></li>
  <li><a href="#">Disease Management &nbsp;&nbsp;|</a></li>
  <li><a href="#">Report &nbsp;&nbsp;|</a></li>
  <li><a href="#">Credit &nbsp;&nbsp;|</a></li>
  <li><a href="#">Contact Us</a></li>
</ul>
<div class="clear"></div>
</nav>
<div class="main wrap">
  <center><p><span style="margin-left:5px; margin-top:22px;"><img src="images/logo5.png"></span></p></center>
</div>
</header>

<section id="content">
<div class="sub-page">
<div class="sub-page-left box-9"><br>
<div class="logout-box">
  <center><div style="font-size:25px; background-color:#CCCCFF; width:70%;"><br>Logout Successful <img class="passport" src="upload/Koala.jpg"><span style="color:#0066CC;">STUDENT</span></div></center><br>

  <div class="logout-message">
    You have been successfully logged out of the E-Malaria Diagnosis System.
  </div>

  <center><a href="home.php" class="home-btn">← Return to Home</a></center>
</div><br>
</div>
</section>

<footer>E-Malaria Diagnosis System &copy; 2017 | Privacy Policy | Design by: STUDENT</footer>
</div></center></div>
</body>
</html>