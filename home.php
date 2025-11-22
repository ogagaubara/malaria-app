<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>MALDX - Neuro Fuzzy Malaria Diagnosis</title>
<style>
/* ----------- RESET & BASE ----------- */
body {
  margin: 0;
  font-family: "Segoe UI", Arial, sans-serif;
  background-color: #f8f9fa;
  color: #333;
  position: relative;
  overflow-x: hidden;
}

/* subtle motif overlay */
body::before {
  content: "";
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-image: url("images/motif.jpg");
  background-repeat: repeat;
  background-position: center;
  background-size: auto;
  opacity: 0.1;
  z-index: -1;
}

/* ----------- HEADER ----------- */
header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 25px 8%;
  box-shadow: 0 3px 10px rgba(0, 0, 0, 0.05);
}

.logo {
  font-size: 22px;
  font-weight: 700;
  color: #004b8d;
  letter-spacing: 1px;
}

/* ----------- NAVIGATION ----------- */
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

/* ----------- HERO IMAGE + TEXT ----------- */
.hero {
  display: flex;
  align-items: center;
  position: absolute;
  top: 110px;
  left: 60px;
  gap: 20px;
}

.hero img {
  height: 195px;
  border-radius: 8px;
  box-shadow: 0 6px 15px rgba(0,0,0,0.15);
}

.hero h1 {
  font-size: 30px;
  color: #004b8d;
  letter-spacing: 1px;
  font-weight: 700;
}

/* ----------- WELCOME TEXT ----------- */
.welcome-text {
  max-width: 900px; /* aligns with blue box width */
  margin: 250px auto 0 auto; /* centers same as blue box */
  color: #003b73;
  font-size: 22px;
  font-weight: 700;
  text-align: left;
  padding-left: 50px; /* aligns exactly with blue box’s inner padding */
  text-shadow: 1px 1px 3px rgba(0, 75, 141, 0.2);
  letter-spacing: 0.5px;
}

/* ----------- MAIN CARD ----------- */
.main-card {
  position: relative;
  overflow: hidden;
  max-width: 900px;
  margin: 20px auto 60px auto;
  background: linear-gradient(145deg, #003b73, #005fa3);
  color: white;
  padding: 60px 50px;
  border-radius: 16px;
  box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
}

.main-card h2 {
  color: #fcfbfc;
  font-size: 26px;
  margin-bottom: 15px;
}

.main-card p {
  line-height: 1.6;
  font-size: 16px;
}

/* ----------- FOOTER ----------- */
footer {
  text-align: center;
  padding: 25px 0;
  font-size: 14px;
  color: #777;
}

/* ----------- RESPONSIVE ----------- */
@media (max-width: 768px) {
  header {
    flex-direction: column;
    gap: 10px;
  }
  nav ul {
    flex-wrap: wrap;
    justify-content: center;
  }
  .hero {
    position: static;
    margin: 20px auto;
    justify-content: center;
    flex-direction: column;
  }
  .welcome-text {
    margin: 30px 15px 0 15px;
    padding-left: 20px;
    font-size: 20px;
  }
  .main-card {
    padding: 30px 20px;
    margin: 20px 15px;
  }
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

<!-- Doctor Image + Text -->
<div class="hero">
  <img src="images/doctor.jpg" alt="Doctor">
  <h1>e-Malaria Diagnosis</h1>
</div>

<div class="welcome-text">
  <?php
    session_start();
    if (isset($_SESSION['username'])) {
      echo "Welcome, " . htmlspecialchars($_SESSION['username']) . " | ";
      echo "<form action='login.php' method='POST' style='display:inline;'>
              <button type='submit' style='background:none;border:none;color:red;font-weight:900;font-size:18px;cursor:pointer;text-transform:uppercase;'>Logout</button>
            </form>";
    } else {
      echo "Welcome, Guest!";
    }
  ?>
</div>

<main>
  <div class="main-card">
    <h2>Neuro-Fuzzy Malaria Diagnosis System</h2>
    <p>
      Malaria is a serious, life-threatening blood disease caused by parasites transmitted to humans through the bite of the female Anopheles mosquito. 
      Identifying the disease accurately depends on the diagnostic approach used. A Neuro-Fuzzy Expert System for malaria diagnosis is designed 
      to assist physicians in managing uncertainties in malaria data. This intelligent model combines the adaptive learning strength of neural networks 
      with the reasoning flexibility of fuzzy logic to improve detection and classification accuracy. The WEKA software was employed to classify the parasite species efficiently.
    </p>
  </div>
</main>

<footer>
  © 2025 MALDX | Privacy Policy | Design by Oyediya O.G. Azu
</footer>

</body>
</html>
