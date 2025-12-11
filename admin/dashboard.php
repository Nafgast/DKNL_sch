<?php
session_start();
if (!isset($_SESSION['admin'])) { header("Location: login.php"); exit; }

require '../api/config.php';

if ($_FILES['csv']) {
    $file = $_FILES['csv']['tmp_name'];
    $handle = fopen($file, "r");
    fgetcsv($handle); // Skip header
    while ($row = fgetcsv($handle)) {
        $reg = $row[0];
        $name = $row[1];
        $eng = $row[2]; $math = $row[3]; $bio = $row[4]; $chem = $row[5]; $phy = $row[6];
        $total = $eng + $math + $bio + $chem + $phy;
        $grade = $total >= 180 ? 'A' : ($total >= 150 ? 'B' : 'C');

        $stmt = $mysqli->prepare("INSERT INTO results (reg_no, student_name, english, maths, biology, chemistry, physics, total, grade) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?) ON DUPLICATE KEY UPDATE student_name=VALUES(student_name), total=VALUES(total), grade=VALUES(grade)");
        $stmt->bind_param("ssiiiiiss", $reg, $name, $eng, $math, $bio, $chem, $phy, $total, $grade);
        $stmt->execute();
    }
    $msg = "Results uploaded successfully!";
}
?>
<!DOCTYPE html>
<html><head><title>Upload Results</title><link rel="stylesheet" href="../style.css"></head>
<body style="padding:30px;">
  <h2>Upload BECE/WAEC Results (CSV)</h2>
  <?php if ($msg) echo "<p style='color:green'>$msg</p>"; ?>
  <form method="POST" enctype="multipart/form-data">
    <input type="file" name="csv" accept=".csv" required><br><br>
    <button type="submit">Upload CSV</button>
  </form>
  <p><a href="logout.php">Logout</a></p>
  <hr>
  <small>CSV Format: reg_no, name, english, maths, biology, chemistry, physics</small>
</body></html>