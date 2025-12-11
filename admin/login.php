<?php
session_start();
if (isset($_SESSION['admin'])) {
    header("Location: dashboard.php");
    exit;
}

if ($_POST['password'] === 'Admin2025!') {  // CHANGE THIS
    $_SESSION['admin'] = true;
    header("Location: dashboard.php");
    exit;
}
?>
<!DOCTYPE html>
<html><head><title>Admin Login</title><link rel="stylesheet" href="../style.css"></head>
<body style="text-align:center; padding:50px;">
  <h2>Admin Login</h2>
  <form method="POST">
    <input type="password" name="password" placeholder="Enter Password" required><br><br>
    <button type="submit">Login</button>
  </form>
</body></html>