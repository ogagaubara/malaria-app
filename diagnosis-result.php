<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Define symptom labels
$symptomLabels = [
    'fever' => 'Fever',
    'shaking_chill' => 'Shaking Chill',
    'headache' => 'Headache',
    'weakness' => 'Weakness',
    'malaise' => 'General Body Malaise',
    'dizziness' => 'Dizziness',
    'diarrhea' => 'Diarrhea',
    'abdominal_pain' => 'Abdominal Pain',
    'nausea' => 'Nausea',
    'anaemia' => 'Anaemia',
    'flu_like_symptoms' => 'Flu-Like Symptoms'
];

// Collect and format input
$symptoms = [];
$positiveSymptoms = [];

foreach ($symptomLabels as $key => $label) {
    $value = $_POST[$key] ?? 'No';
    $symptoms[$key] = $value;
    if (strtolower($value) === 'yes') {
        $positiveSymptoms[] = $label;
    }
}

$inputLine = implode(",", array_values($symptoms));
file_put_contents("input.txt", $inputLine);

// Run classifier
shell_exec("run-diagnosis.bat \"$inputLine\"");
$rawDiagnosis = file_exists("output.txt") ? trim(file_get_contents("output.txt")) : "Diagnosis unavailable";

// Format diagnosis message
$types = ['p_falciparum', 'p_vivax', 'p_malariae', 'p_ovale'];

if (in_array(strtolower($rawDiagnosis), $types)) {
    $diagnosisMessage = "Patient symptoms suggest they have " . ucfirst(str_replace("_", " ", $rawDiagnosis)) . ".";
    $diagnosisClass = "positive";
} elseif (strtolower($rawDiagnosis) === "none") {
    $diagnosisMessage = "No malaria detected based on the symptoms provided.";
    $diagnosisClass = "negative";
} else {
    $diagnosisMessage = "Unable to determine diagnosis. Please check input or model configuration.";
    $diagnosisClass = "unknown";
}

$symptomSummary = count($positiveSymptoms) > 0
    ? implode(", ", $positiveSymptoms)
    : "No symptoms reported.";
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>MALDX - Diagnosis Result</title> <link rel="stylesheet" type="text/css" href="css/reset.css">
  <link rel="stylesheet" type="text/css" href="css/colorbox.css">

  <script src="js/jquery-1.7.min.js"></script>
  <script src="js/jquery.easing.1.3.js"></script>
  <script src="js/jquery.colorbox.js"></script>

  <style>
  /* ----------- RESET & BASE (FROM A) ----------- */
  body {
    margin: 0;
    font-family: "Segoe UI", Arial, sans-serif;
    background: linear-gradient(to bottom, #f1f4f8 80%, #e9edf1 100%);
    color: #333;
  }

  /* ----------- HEADER (FROM A) ----------- */
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

  /* ----------- NAVIGATION (FROM A) ----------- */
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

  /* ----------- PAGE CONTENT (FROM A) ----------- */
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

  /* ----------- MOTIF OVERLAY (FROM A) ----------- */
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

  /* ----------- FOOTER (FROM A) ----------- */
  footer {
    text-align: center;
    padding: 25px 0;
    font-size: 14px;
    color: #777;
    margin-top: 50px;
  }
  
  /* ----------- STYLES FROM B (ADAPTED) ----------- */
  .result-box {
    font-size: 16px;
    background-color: #FFFFFF;
    text-align: justify;
    border-radius: 10px;
    /* margin-left: -160px;  <-- Removed for layout A */
    /* width: 900px;         <-- Removed for layout A */
    padding: 20px;
    color: #333; /* 🔹 Added to override main's white text */
    position: relative; /* 🔹 Added to stay above motif */
    z-index: 2; /* 🔹 Added to stay above motif */
  }
  .diagnosis-message {
    padding: 15px;
    font-size: 1.2em;
    border-left: 5px solid #3498db;
    background-color: #ecf0f1;
  }
  .positive {
    border-left-color: #e74c3c;
    background-color: #fdecea;
  }
  .negative {
    border-left-color: #2ecc71;
    background-color: #eafaf1;
  }
  .unknown {
    border-left-color: #f39c12;
    background-color: #fff8e1;
  }
  .symptom-list {
    margin-top: 20px;
    font-size: 1em;
    background-color: #f9f9f9;
    padding: 10px;
    border-left: 5px solid #95a5a6;
  }
  .back-btn {
    display: inline-block;
    margin-top: 20px;
    text-decoration: none;
    background: #3498db;
    color: white;
    padding: 10px 20px;
    border-radius: 5px;
    transition: background 0.3s;
  }
  .back-btn:hover {
    background: #2980b9;
  }
  /* ----------- END OF STYLES FROM B ----------- */


  /* ----------- RESPONSIVE (FROM A) ----------- */
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

</head>

<body>

<header>
  <div class="logo">MALDX</div>
  <nav>
    <ul>
      <li><a href="home.php">Home</a></li>
      <li><a href="diagnosis.php">Diagnosis</a></li>
      <li><a href="#">Report</a></li>
      <li><a href="#">Contact Us</a></li>
    </ul>
  </nav>
</header>

<main>
  <div class="motif"></div>

  <h2>Diagnosis Result</h2> <div class="result-box">

    <div class="diagnosis-message <?php echo $diagnosisClass; ?>">
      <?php echo htmlspecialchars($diagnosisMessage); ?>
    </div>

    <div class="symptom-list"> <strong>Symptoms:</strong> <?php echo htmlspecialchars($symptomSummary); ?>
    </div>

    <center><a href="diagnosis.php" class="back-btn">← Back to Diagnosis</a></center>
  </div>
  </main>

<footer>
  © 2025 MALDX | Privacy Policy | Design by Oyediya O.G Azu   
</footer>

</body>
</html>