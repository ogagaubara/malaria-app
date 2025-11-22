<?php
session_start();
require 'includes/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = isset($_POST['username']) ? trim($_POST['username']) : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';
    $first_name = isset($_POST['first_name']) ? trim($_POST['first_name']) : '';
    $last_name = isset($_POST['last_name']) ? trim($_POST['last_name']) : '';
    $gender = isset($_POST['gender']) ? $_POST['gender'] : '';
    $phone = isset($_POST['phone']) ? trim($_POST['phone']) : '';
    $email = isset($_POST['email']) ? trim($_POST['email']) : '';

    if (!$username || !$password || !$first_name || !$last_name || !$gender || !$phone || !$email) {
        $error = "All fields are required.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Invalid email address.";
    } else {
        $stmt = $conn->prepare("SELECT id FROM users WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            $error = "Username already taken.";
        } else {
            $hashed = password_hash($password, PASSWORD_DEFAULT);
            $stmt = $conn->prepare("INSERT INTO users (username, password, first_name, last_name, gender, phone, email) VALUES (?, ?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("sssssss", $username, $hashed, $first_name, $last_name, $gender, $phone, $email);
            $stmt->execute();
            $_SESSION['username'] = $username;
            header("Location: home.php");
            exit;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>MALDX - Register</title>
  <style>
    body {
      margin: 0;
      font-family: "Segoe UI", Arial, sans-serif;
      background: linear-gradient(to bottom right, #ffffff, #dbeeff, #b3d4ff);
      color: #333;
    }

    header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 25px 8%;
      background-color: #ffffff;
      box-shadow: 0 3px 10px rgba(0, 0, 0, 0.1);
    }

    .logo {
      font-size: 22px;
      font-weight: 700;
      color: #004b8d;
      letter-spacing: 1px;
    }

    nav ul {
      list-style: none;
      margin: 0;
      padding: 0;
      display: flex;
      gap: 25px;
    }

    nav ul li a {
      text-decoration: none;
      color: #004b8d;
      font-weight: 600;
      font-size: 15px;
      transition: color 0.3s ease;
    }

    nav ul li a:hover {
      color: #1da1f2;
    }

    main {
      position: relative;
      max-width: 600px;
      margin: 60px auto;
      background: linear-gradient(145deg, #003b73, #005fa3);
      color: white;
      padding: 50px 60px;
      border-radius: 16px;
      box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
      overflow: hidden;
    }

    .motif {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background-image: url("images/motif.jpg");
      background-repeat: repeat;
      background-position: center;
      background-size: auto;
      opacity: 0.08;
      z-index: 1;
    }

    h2 {
      color: #ffffff;
      font-size: 26px;
      margin-bottom: 25px;
      text-align: center;
      position: relative;
      z-index: 2;
    }

    form {
      position: relative;
      z-index: 2;
      display: flex;
      flex-direction: column;
      gap: 20px;
    }

    input[type="text"],
    input[type="password"],
    input[type="email"],
    select {
      padding: 12px;
      border-radius: 6px;
      border: none;
      font-size: 16px;
    }

    button[type="submit"] {
      background-color: #ffffff;
      color: #004b8d;
      font-weight: 600;
      border: none;
      border-radius: 6px;
      padding: 15px 35px;
      cursor: pointer;
      transition: 0.3s;
    }

    button[type="submit"]:hover {
      background-color: #1da1f2;
      color: white;
    }

    .error {
      color: #ffdddd;
      background-color: rgba(255,0,0,0.2);
      padding: 10px;
      border-radius: 6px;
      font-weight: bold;
    }

    footer {
      text-align: center;
      padding: 25px 0;
      font-size: 14px;
      color: #777;
      margin-top: 50px;
    }
  </style>
</head>

<body>
<header>
  <div class="logo">MALDX</div>
  <nav>
    <ul>
      <li><a href="home.php">Home</a></li>
      <li><a href="diagnosis.php">Diagnosis</a></li>
      <li><a href="#">Report</a></li>
      <li><a href="contact.php">Contact Us</a></li>
    </ul>
  </nav>
</header>

<main>
  <div class="motif"></div>
  <h2>User Registration</h2>

 <form method="POST">
  <!-- Name Fields -->
  <div style="display: flex; gap: 20px; flex-wrap: wrap;">
    <input type="text" name="first_name" placeholder="First Name" required style="flex: 1;">
    <input type="text" name="last_name" placeholder="Last Name" required style="flex: 1;">
  </div>

  <!-- Gender and Phone -->
  <div style="display: flex; gap: 20px; flex-wrap: wrap;">
    <select name="gender" required style="flex: 1;">
      <option value="">Select Gender</option>
      <option value="Male">Male</option>
      <option value="Female">Female</option>
      <option value="Other">Other</option>
    </select>
    <input type="text" name="phone" placeholder="Phone Number" required style="flex: 1;">
  </div>

  <!-- Email -->
  <input type="email" name="email" placeholder="Email Address" required>

  <!-- Username and Password -->
  <input type="text" name="username" placeholder="Username" required>
  <input type="password" name="password" placeholder="Password" required>

  <!-- Submit -->
  <button type="submit">Register</button>

  <?php if (isset($error)) echo "<div class='error'>$error</div>"; ?>
</form>
</main>

<footer>
  © 2025 MALDX | Privacy Policy | Design by Oyediya O.G Azu
</footer>
</body>
</html>