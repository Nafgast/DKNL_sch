<?php
session_start();

// Simple demo login (replace with real student database later)
$valid_users = [
    "JSS3/2024/001" => ["name" => "Aisha Bello",       "class" => "JSS3", "password" => "aisha123"],
    "SSS2/2024/056" => ["name" => "Chinedu Okonkwo",   "class" => "SSS2", "password" => "chinedu2024"],
    "JSS1/2025/089" => ["name" => "Fatima Yusuf",      "class" => "JSS1", "password" => "fatima25"]
];

$error = "";

if ($_POST['reg_no'] && $_POST['password']) {
    $reg = trim($_POST['reg_no']);
    $pass = $_POST['password'];

    if (isset($valid_users[$reg]) && $valid_users[$reg]['password'] === $pass) {
        $_SESSION['student'] = $valid_users[$reg];
        $_SESSION['reg_no'] = $reg;
        header("Location: dashboard.php");
        exit;
    } else {
        $error = "Invalid Registration Number or Password";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Student Portal Login - NAFGAST Secondary School</title>
  <link rel="stylesheet" href="../style.css"/>
  <style>
    body {
      background: #f8f9fa url('../logo.jpg') center center fixed;
      background-size: cover;
      font-family: 'Segoe UI', sans-serif;
    }
    .login-container {
      max-width: 420px;
      margin: 80px auto;
      padding: 40px 30px;
      background: rgba(255, 255, 255, 0.97);
      border-radius: 16px;
      box-shadow: 0 15px 40px rgba(0,0,0,0.15);
      text-align: center;
      backdrop-filter: blur(10px);
    }
    .login-container img {
      width: 110px;
      margin-bottom: 20px;
    }
    .login-container h2 {
      color: #004d40;
      margin-bottom: 10px;
      font-size: 1.8rem;
    }
    .login-container p {
      color: #555;
      margin-bottom: 25px;
    }
    .form-group {
      margin-bottom: 20px;
      text-align: left;
    }
    .form-group label {
      display: block;
      margin-bottom: 8px;
      font-weight: 600;
      color: #333;
    }
    .form-group input {
      width: 100%;
      padding: 14px;
      border: 2px solid #a5d6a7;
      border-radius: 10px;
      font-size: 1rem;
      transition: all 0.3s;
    }
    .form-group input:focus {
      outline: none;
      border-color: #004d40;
      box-shadow: 0 0 0 4px rgba(0,77,64,0.1);
    }
    .login-btn {
      background: #004d40;
      color: white;
      padding: 14px;
      border: none;
      border-radius: 10px;
      width: 100%;
      font-size: 1.1rem;
      font-weight: bold;
      cursor: pointer;
      transition: 0.3s;
    }
    .login-btn:hover {
      background: #00332a;
    }
    .error {
      background: #ffebee;
      color: #c62828;
      padding: 12px;
      border-radius: 8px;
      margin: 15px 0;
      font-weight: 500;
    }
    .help {
      margin-top: 20px;
      font-size: 0.9rem;
      color: #666;
    }
    .help a {
      color: #004d40;
      text-decoration: none;
      font-weight: 600;
    }
  </style>
</head>
<body>

<div class="login-container">
  <img src="../logo.jpg" alt="NAFGAST Logo">
  <h2>Student Portal</h2>
  <p>Login with your Registration Number</p>

  <?php if ($error): ?>
    <div class="error"><?= htmlspecialchars($error) ?></div>
  <?php endif; ?>

  <form method="POST">
    <div class="form-group">
      <label>Registration Number</label>
      <input type="text" name="reg_no" placeholder="e.g. JSS3/2024/001" required>
    </div>
    <div class="form-group">
      <label>Password</label>
      <input type="password" name="password" placeholder="Your password" required>
    </div>
    <button type="submit" class="login-btn">Login to Portal</button>
  </form>

  <div class="help">
    <p>Forgot password? <a href="https://wa.me/2349165749205">Contact Admin on WhatsApp</a></p>
    <p><a href="../frame.html">← Back to Homepage</a></p>
  </div>
</div>

</body>
</html>