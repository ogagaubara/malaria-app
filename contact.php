<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $name = trim($_POST['name']);
  $email = trim($_POST['email']);
  $message = trim($_POST['message']);

  if (!$name || !$email || !$message) {
    $feedback = "All fields are required.";
  } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $feedback = "Please enter a valid email address.";
  } else {
    $to = "maldxsupport@example.com"; // Replace with actual support email
    $subject = "Contact Form Submission from $name";
    $body = "Name: $name\nEmail: $email\n\nMessage:\n$message";
    $headers = "From: $email";

    if (mail($to, $subject, $body, $headers)) {
      $feedback = "Thank you for contacting us. We'll get back to you soon!";
    } else {
      $feedback = "Sorry, your message could not be sent.";
    }
  }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>MALDX - Contact Us</title>
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
      max-width: 700px;
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
    input[type="email"],
    textarea {
      padding: 12px;
      border-radius: 6px;
      border: none;
      font-size: 16px;
      resize: vertical;
    }

    textarea {
      min-height: 120px;
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

    .feedback {
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
      <li><a href="register.php">Register</a></li>
      <li><a href="contact.php">Contact Us</a></li>
    </ul>
  </nav>
</header>

<main>
  <div class="motif"></div>
  <h2>Contact Us</h2>

  <form method="POST">
    <input type="text" name="name" placeholder="Your Name" required>
    <input type="email" name="email" placeholder="Your Email" required>
    <textarea name="message" placeholder="Your Message" required></textarea>
    <button type="submit">Send Message</button>
    <?php if (isset($feedback)) echo "<div class='feedback'>$feedback</div>"; ?>
  </form>
</main>

<footer>
  © 2025 MALDX | Privacy Policy | Design by Oyediya O.G. Azu
</footer>
</body>
</html>