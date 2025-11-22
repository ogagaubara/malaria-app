<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>MALDX - Diagnosis</title>
  <link rel="stylesheet" type="text/css" href="css/reset.css">
  <link rel="stylesheet" type="text/css" href="css/colorbox.css">

  <script src="js/jquery-1.7.min.js"></script>
  <script src="js/jquery.easing.1.3.js"></script>
  <script src="js/jquery.colorbox.js"></script>

  <style>
  /* ----------- RESET & BASE ----------- */
  body {
  margin: 0;
  font-family: "Segoe UI", Arial, sans-serif;
  background: linear-gradient(to bottom right, #ffffff, #dbeeff, #b3d4ff);
  color: #333;
}

  /* ----------- HEADER ----------- */
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

  /* ----------- PAGE CONTENT ----------- */
  main {
    position: relative; /* Needed for the motif overlay */
    max-width: 1000px;
    margin: 60px auto;
    background: linear-gradient(145deg, #003b73, #005fa3);
    color: white;
    padding: 50px 60px;
    border-radius: 16px;
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
    overflow: hidden; /* Keeps motif inside the blue area */
  }

  main h2 {
    color: #ffffff;
    font-size: 26px;
    margin-bottom: 25px;
    text-align: center;
    position: relative;
    z-index: 2;
  }

  /* ----------- MOTIF OVERLAY ----------- */
  .motif {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-image: url("images/motif.jpg"); /* 🔹 Replace with your motif image path */
    background-repeat: repeat;
    background-position: center;
    background-size: auto; /* or 'cover' if you prefer full fill */
    opacity: 0.08; /* Adjust transparency */
    z-index: 1;
  }

  /* ----------- FORM STYLING ----------- */
  table {
    width: 100%;
    border-collapse: collapse;
    color: white;
    position: relative;
    z-index: 2; /* Ensures form stays above the motif */
  }

  th, td {
    padding: 8px;
  }

  th {
    border-bottom: 2px solid rgba(255,255,255,0.2);
    text-align: left;
  }

  .radio {
    margin-top: 5px;
  }

  input[type="submit"] {
    background-color: #ffffff;
    color: #004b8d;
    font-weight: 600;
    border: none;
    border-radius: 6px;
    padding: 15px 35px; /* 🔹 Slightly bigger button */
    cursor: pointer;
    transition: 0.3s;
  }

  input[type="submit"]:hover {
    background-color: #1da1f2;
    color: white;
  }

  /* ----------- FOOTER ----------- */
  footer {
    text-align: center;
    padding: 25px 0;
    font-size: 14px;
    color: #777;
    margin-top: 50px;
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
    main {
      padding: 30px 20px;
      margin: 40px 15px;
    }
  }
  </style>

  <script>
    function clearCheckBoxes() {
      var inputs = document.getElementsByTagName("input");
      for (var i = 0; i < inputs.length; i++) {
        if (inputs[i].type === 'radio') inputs[i].checked = false;
      }
    }
  </script>
</head>

<body onUnload="clearCheckBoxes()">

<header>
  <div class="logo">MALDX</div>
  <nav>
    <ul>
      <li><a href="home.php">Home</a></li>
      <li><a href="diagnosis.php">Diagnosis</a></li>
   <li><a href="result.php">Report</a></li>
      <li><a href="contact.php">Contact Us</a></li>
    </ul>
  </nav>
</header>

<main>
  <!-- 🔹 Motif overlay image -->
  <div class="motif"></div>

  <h2>Patient Diagnosis</h2>
  <p style="color:#fff; text-align:center; font-size:15px; margin-bottom:25px;">
    Please ensure to answer the following questions correctly.
  </p>

  <form action="diagnosis-result.php" method="post" class="diagnosis-test">
    <table>
      <tr>
        <th>S/N</th>
        <th>Questions</th>
        <th>Select Answer</th>
      </tr>

      <?php
      $symptoms = [
        'fever' => 'Fever: Do You Feel Feverish?',
        'shaking_chill' => 'Shaking Chill: Do You Have Shaking Chill?',
        'headache' => 'Headache: Do You Feel Headache?',
        'weakness' => 'Weakness: Do You Feel Weakness of The Body?',
        'malaise' => 'General Body Malaise: Do You Feel Body Malaise?',
        'dizziness' => 'Dizziness: Do You Feel Frequent Dizziness?',
        'diarrhea' => 'Diarrhea: Do You Have Diarrhea?',
        'abdominal_pain' => 'Abdominal Pain: Do You Feel Abdominal Pains?',
        'nausea' => 'Nausea: Do You Have Nausea?',
        'anaemia' => 'Anaemia: Do You Have Anaemia?',
        'flu_like_symptoms' => 'Flu-Like Symptoms: Do You Feel Flu Like Symptoms?'
      ];

      $sn = 1;
      foreach ($symptoms as $name => $question) {
        echo "<tr>
          <td>{$sn}</td>
          <td>{$question}</td>
          <td>
            Yes <input type='radio' name='{$name}' value='Yes' class='radio' required>
            &nbsp;&nbsp;
            No <input type='radio' name='{$name}' value='No' class='radio' required>
          </td>
        </tr>";
        $sn++;
      }
      ?>

      <tr>
        <td colspan="7" style="text-align:center; padding-top:20px;">
          <input type="submit" value="Diagnose" name="submit" />
        </td>
      </tr>
    </table>
  </form>
</main>

<footer>
  © 2025 MALDX | Privacy Policy | Design by Oyediya O.G Azu
</footer>

</body>
</html>
