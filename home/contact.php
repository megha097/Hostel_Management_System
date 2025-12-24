<?php
$current_page = basename($_SERVER['PHP_SELF']); // gets current filename like index.php, about.php etc.
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Contact</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        /* ====== Dark Neon Theme for Contact Page ====== */
body {
  margin: 0;
  font-family: "Poppins", sans-serif;
  background: linear-gradient(135deg, #0a0a14, #14142b, #0a0a14, #14142b, #0a0a14);
  background-size: 400% 400%;
  animation: gradientBG 15s ease infinite;
  min-height: 100vh;
  display: flex;
  flex-direction: column;
  color: #fff;
}

/* Animated Gradient */
@keyframes gradientBG {
  0% { background-position: 0% 50%; }
  50% { background-position: 100% 50%; }
  100% { background-position: 0% 50%; }
}

/* Header / Navbar */
header {
  background: rgba(255,255,255,0.05);
  backdrop-filter: blur(12px);
  border-bottom: 1px solid rgba(255,255,255,0.1);
  padding: 15px 40px;
  display: flex;
  justify-content: space-between;
  align-items: center;
  color: #fff;
}

header h2 {
  margin: 0;
  font-weight: bold;
  color: #00eaff;
  text-shadow: 0 2px 6px rgba(0,0,0,0.6);
}

nav a {
  color: #ddd;
  margin: 0 12px;
  text-decoration: none;
  font-weight: 500;
  transition: 0.3s;
}

nav a:hover {
  color: #00eaff;
  background: rgba(0,234,255,0.15);
  padding: 6px 12px;
  border-radius: 8px;
}

/* Hero Section */
.hero {
  text-align: center;
  padding: 80px 20px;
  color: #fff;
  margin-top: -20px;
}

.hero h1 {
  font-size: 46px;
  margin-bottom: -50px;
  color: #00eaff;
  text-shadow: 0 2px 8px rgba(0,0,0,0.6);
}

/* Contact Content Box */
.content {
  max-width: 850px;
  margin: 40px auto;
  padding: 30px;
  background: rgba(255,255,255,0.05);
  backdrop-filter: blur(12px);
  border-radius: 16px;
  box-shadow: 0 8px 25px rgba(0,0,0,0.4);
  border: 1px solid rgba(255,255,255,0.1);
  margin-bottom: 80px;
}

.content h2 {
  color: #00eaff;
  margin-bottom: 12px;
  font-size: 24px;
  text-shadow: 0 2px 6px rgba(0,0,0,0.6);
}

.content p,
.content a {
  font-size: 16px;
  line-height: 1.7;
  color: #ddd;
  text-decoration: none;
}

.content a:hover {
  color: #00eaff;
  text-shadow: 0 0 6px rgba(0,234,255,0.8);
}

nav a.active {
  color: #00eaff !important;
  font-weight: bold;
}


    </style>
</head>
<body>

<header>
    <h2>🌙&nbsp; Moonlight Manor</h2>
    <nav>
      <a href="index.php" class="<?= $current_page == 'index.php' ? 'active' : '' ?>">Home</a>
      <a href="about.php" class="<?= $current_page == 'about.php' ? 'active' : '' ?>">About Us</a>
      <a href="rules.php" class="<?= $current_page == 'rules.php' ? 'active' : '' ?>">Rules</a>
      <a href="staff.php" class="<?= $current_page == 'staff.php' ? 'active' : '' ?>">Staff</a>
      <a href="contact.php" class="<?= $current_page == 'contact.php' ? 'active' : '' ?>">Contact</a>
      <a href="feedback.php" class="<?= $current_page == 'feedback.php' ? 'active' : '' ?>">Feedback</a>
      <a href="../student_login.php" class="<?= $current_page == 'student_login.php' ? 'active' : '' ?>">Login</a>
    </nav>
</header>

<section class="hero">
    <h1>Contact Us</h1>
</section>

<div class="content">
    <h2>Address</h2>
    <p>Moonlight Manor Hostel,
7 Skyline Road, Silver Park
Rajkot, Gujarat 360002, India
</p>
    <p>Phone: +91 72020 81187</p>
    <p>Email: hostel@gmail.com</p>

    <h2>Guidance on how to Reach Us</h2>
<p>Nearest Bus Stop: Silver Park Bus Stand (5 min walk)</p>
<p>Nearest Train Station: Rajkot Junction (10 min drive)</p>
<p>Taxi / Auto Available: 24/7</p>

  <h2>Visiting Hours</h2>
<p>Everyday : 8:00 AM – 9:00 PM</p>
</div>

</body>
</html>