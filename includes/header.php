<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Health Diagnosis App</title>
  <link rel="stylesheet" href="styles.css"> <!-- Optional CSS -->
</head>
<body>
  <header>
    <h1>🩺 Health Diagnosis App</h1>
    <?php if (isset($_SESSION['username'])): ?>
      <p>Welcome, <?= htmlspecialchars($_SESSION['username']) ?> | <a href="logout.php">Logout</a></p>
    <?php endif; ?>
    <nav>
      <a href="home.php">Home</a>
      <a href="diagnose.php">Diagnose</a>
      <a href="profile.php">Profile</a>
    </nav>
    <hr>
  </header>