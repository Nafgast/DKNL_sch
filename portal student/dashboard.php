<?php
session_start();
if (!isset($_SESSION['student'])) {
    header("Location: login.php");
    exit;
}
$student = $_SESSION['student'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Portal - <?= $student['name'] ?></title>
  <link rel="stylesheet" href="../style.css">
  <style>
    .dashboard { max-width: 800px; margin: 40px auto; padding: 30px; background: white; border-radius: 16px; box-shadow: 0 10px 30px rgba(0,0,0,0.1); }
    .welcome { color: #004d40; font-size: 1.8rem; margin-bottom: 20px; }
    .info { background: #e8f5e9; padding: 20px; border-radius: 12px; margin: 20px 0; }
    .logout { display: inline-block; margin-top: 20px; background: #c62828; color: white; padding: 10px 20px; border-radius: 8px; text-decoration: none; }
  </style>
</head>
<body>
<div class="dashboard">
  <h2 class="welcome">Welcome back, <?= htmlspecialchars($student['name']) ?>!</h2>
  <div class="info">
    <p><strong>Class:</strong> <?= $student['class'] ?></p>
    <p><strong>Reg No:</strong> <?= $_SESSION['reg_no'] ?></p>
  </div>
  <p>Coming soon: View results, pay fees, download report card.</p>
  <a href="logout.php" class="logout">Logout</a>
  <p><a href="../index.html">← Back to School Website</a></p>
</div>
</body>
</html>