<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>WAEC Result Checker - NAFGAST</title>
  <link rel="stylesheet" href="../style.css">
  <style>
    .result-container {
      max-width: 500px;
      margin: 40px auto;
      padding: 25px;
      background: white;
      border-radius: 12px;
      box-shadow: 0 4px 15px rgba(0,0,0,0.1);
      text-align: center;
    }
    .result-form input {
      width: 100%;
      padding: 12px;
      margin: 10px 0;
      border: 1px solid #ddd;
      border-radius: 6px;
      font-size: 1.1rem;
    }
    .result-form button {
      background: #004d40;
      color: white;
      padding: 12px 30px;
      border: none;
      border-radius: 6px;
      font-weight: bold;
      cursor: pointer;
    }
    .result-card {
      margin-top: 20px;
      padding: 15px;
      background: #e8f5e9;
      border-radius: 8px;
      border-left: 5px solid #004d40;
    }
    .grade-A { color: #1b5e20; font-weight: bold; }
    .grade-B { color: #33691e; }
    .grade-C { color: #827717; }
    .error { color: red; font-weight: bold; }
  </style>
</head>
<body>
  <header>
    <img src="../images/crest.png" alt="Logo" class="logo">
    <h1>St. Mary's Secondary School</h1>
  </header>

  <nav>
    <a href="../index.html">Home</a>
    <a href="../admissions.html">Admissions</a>
    <a href="checker.php">Result Checker</a>
    <a href="../contact.html">Contact</a>
  </nav>

  <div class="container">
    <div class="result-container">
      <h2>Check WAEC/BECE Result</h2>
      <form method="POST" class="result-form">
        <input type="text" name="reg_no" placeholder="Enter Registration Number (e.g. JSS3/2024/001)" required>
        <button type="submit">Check Result</button>
      </form>

      <?php
      if ($_POST['reg_no']) {
          require '../api/config.php';
          $reg = trim($_POST['reg_no']);
          $stmt = $mysqli->prepare("SELECT * FROM results WHERE reg_no = ?");
          $stmt->bind_param("s", $reg);
          $stmt->execute();
          $result = $stmt->get_result();
          $row = $result->fetch_assoc();

          if ($row) {
              $gradeClass = 'grade-' . $row['grade'];
              echo "<div class='result-card'>";
              echo "<h3>{$row['student_name']}</h3>";
              echo "<p><strong>Reg No:</strong> {$row['reg_no']}</p>";
              echo "<p>English: <strong>{$row['english']}</strong> | Maths: <strong>{$row['maths']}</strong></p>";
              echo "<p>Total: <strong>{$row['total']}</strong> | Grade: <span class='$gradeClass'>{$row['grade']}</span></p>";
              echo "</div>";
          } else {
              echo "<p class='error'>Result not found. Check Reg No or try later.</p>";
          }
          $stmt->close();
      }
      ?>
    </div>
  </div>

  <footer>
    <p>© NAFGAST School, Ikeja | 09165749205</p>
  </footer>
</body>
</html>