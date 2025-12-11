<?php
// forms/admission.php
if ($_POST['submit']) {
    $name = htmlspecialchars($_POST['name']);
    $phone = htmlspecialchars($_POST['phone']);
    $email = htmlspecialchars($_POST['email']);
    $class = htmlspecialchars($_POST['class']);
    $message = htmlspecialchars($_POST['message']);

    $to = "admin@nafgsat.sch.ng";
    $subject = "New Admission Application - $name";
    $body = "Name: $name\nPhone: $phone\nEmail: $email\nClass: $class\nMessage: $message";
    $headers = "From: no-reply@nafgsat.sch.ng";

    // In real hosting, use mail() or Formspree
    // mail($to, $subject, $body, $headers);
    // For now, show success
    $success = true;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Admission Form - NAFGAST Secondary School</title>
  <link rel="stylesheet" href="../style.css"/>
  <style>
    .admission-container {
      max-width: 600px; margin: 40px auto; padding: 30px;
      background: #fff; border-radius: 14px; box-shadow: 0 6px 20px rgba(0,0,0,0.1);
    }
    .admission-container h2 {
      color: #004d40; text-align: center; margin-bottom: 20px;
    }
    .form-group { margin-bottom: 15px; }
    .form-group label {
      display: block; margin-bottom: 5px; font-weight: 600; color: #333;
    }
    .form-group input, .form-group select, .form-group textarea {
      width: 100%; padding: 12px; border: 1.5px solid #a5d6a7;
      border-radius: 8px; font-size: 1rem;
    }
    .form-actions {
      display: flex; gap: 10px; margin-top: 20px; flex-wrap: wrap;
    }
    .btn {
      flex: 1; padding: 14px; border-radius: 8px; text-decoration: none;
      font-weight: bold; text-align: center; min-width: 140px;
    }
    .btn-wa { background: #25d366; color: white; }
    .btn-download { background: #004d40; color: white; }
    .btn-submit { background: #1976d2; color: white; border: none; cursor: pointer; }
    .success-msg {
      background: #e8f5e9; color: #1b5e20; padding: 15px;
      border-radius: 8px; margin: 20px 0; text-align: center;
    }
    .pdf-preview {
      text-align: center; margin: 20px 0;
    }
    .pdf-preview img {
      width: 100%; max-width: 400px; border: 1px solid #ddd; border-radius: 8px;
    }
  </style>
</head>
<body>

<header>
  <div class="container header-content">
    <img src="../crest.png" alt="Logo" class="logo">
    <h1 class="school-name">NAFGAST Secondary School</h1>
  </div>
</header>

<nav class="main-nav">
  <a href="../index.html">Home</a>
  <a href="admission.php">Admissions</a>
  <a href="../results/checker.php">Results</a>
  <a href="../contact.html">Contact</a>
</nav>

<div class="container">
  <div class="admission-container">
    <h2>2025/2026 Admission Form</h2>

    <!-- PDF Preview -->
    <div class="pdf-preview">
      <p><strong>Download & Print Form</strong></p>
      <a href="admission-form.pdf" class="btn btn-download" download>
        Download PDF Form
      </a>
      <p style="margin-top:10px; font-size:0.9rem;">
        Or fill online below
      </p>
    </div>

    <!-- Success Message -->
    <?php if (isset($success)): ?>
      <div class="success-msg">
        <strong>Application received!</strong><br>
        We’ll contact you on <?= $phone ?> within 24 hours.
      </div>
    <?php endif; ?>

    <!-- Online Form -->
    <form method="POST">
      <div class="form-group">
        <label>Full Name *</label>
        <input type="text" name="name" required>
      </div>
      <div class="form-group">
        <label>Phone Number *</label>
        <input type="tel" name="phone" required>
      </div>
      <div class="form-group">
        <label>Email (Optional)</label>
        <input type="email" name="email">
      </div>
      <div class="form-group">
        <label>Applying For *</label>
        <select name="class" required>
          <option value="">Select Class</option>
          <option>JSS1</option>
          <option>JSS2</option>
          <option>JSS3</option>
          <option>SSS1</option>
          <option>SSS2</option>
          <option>SSS3</option>
        </select>
      </div>
      <div class="form-group">
        <label>Message / Previous School</label>
        <textarea name="message" rows="3"></textarea>
      </div>

      <div class="form-actions">
        <button type="submit" name="submit" class="btn btn-submit">
          Submit Online
        </button>
        <a href="https://wa.me/2349165749205?text=Hello,%20I%20want%20to%20apply%20for%20admission" 
           class="btn btn-wa" target="_blank">
          Apply via WhatsApp
        </a>
      </div>
    </form>
  </div>
</div>

<footer>
  <p>© 2025 NAFGAST Secondary School | 09165749205</p>
</footer>

</body>
</html>