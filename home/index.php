<?php
session_start();
$current_page = basename($_SERVER['PHP_SELF']); // gets current filename like index.php, about.php etc.
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Home</title>
    <style>
/* ====== Dark Neon Dashboard Theme ====== */
body {
  margin: 0;
  font-family: "Poppins", sans-serif;
  background: linear-gradient(135deg, #0a0a14, #14142b, #0a0a14, #14142b, #0a0a14);
/*  background: linear-gradient(135deg, #1c2541, #2a3a60, #1c2541, #2a3a60, #1c2541);*/
  background-size: 400% 400%;
  animation: gradientBG 15s ease infinite;
  min-height: 100vh;
  display: flex;
  flex-direction: column;
  color: #fff;
}

/* Animated Gradient Background */
@keyframes gradientBG {
  0% { background-position: 0% 50%; }
  50% { background-position: 100% 50%; }
  100% { background-position: 0% 50%; }
}

/* Header / Navbar*/ 
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
}

.hero h1 {
  font-size: 46px;
  margin-bottom: 15px;
  color: #00eaff;
  text-shadow: 0 2px 8px rgba(0,0,0,0.6);
}

.hero p {
  font-size: 20px;
  opacity: 0.95;
  color: #ccc;
}

/* Modules / Cards */
.modules {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
  gap: 25px;
  padding: 50px;
  margin-bottom: 20px;
}

.card {
  background: rgba(255,255,255,0.05);
  backdrop-filter: blur(12px);
  border-radius: 16px;
  padding: 30px;
  color: #fff;
  text-align: center;
  box-shadow: 0 8px 25px rgba(0,0,0,0.4);
  transition: transform 0.3s ease, box-shadow 0.3s ease;
  border: 1px solid rgba(255,255,255,0.1);
}

.card:hover {
  transform: scale(1.05);
  box-shadow: 0 0 20px rgba(0,234,255,0.6);
}

.card h3 {
  margin-bottom: 12px;
  font-size: 22px;
  color: #00eaff;
}

.card a {
  display: inline-block;
  margin-top: 12px;
  padding: 10px 20px;
  border-radius: 8px;
  background: linear-gradient(135deg, #00eaff, #0066ff);
  color: #fff;
  text-decoration: none;
  font-weight: bold;
  transition: 0.3s;
}

.card a:hover {
  box-shadow: 0 0 15px rgba(0,234,255,0.8);
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
    <h1>Welcome to Moonlight Manor</h1>
    <p>Providing a safe and comfortable living environment for students</p>
</section>

<section class="modules">
    <div class="card">
        <h3>ℹ️ About Us</h3>
        <p>Know about our hostel facilities, environment and rules.</p>
        <a href="about.php">Read More</a>
    </div>
    <div class="card">
        <h3>👩‍🏫 Staff</h3>
        <p>Meet our hostel staff and warden who manage daily operations.</p>
        <a href="staff.php">View Staff</a>
    </div>
    <div class="card">
        <h3>📞 Contact</h3>
        <p>Reach us for inquiries, location, and emergency contacts.</p>
        <a href="contact.php">Get in Touch</a>
    </div>
    <div class="card">
        <h3>💬 Feedback</h3>
        <p>Share your experience or suggestions with us.</p>
        <a href="feedback.php">Give Feedback</a>
    </div>
</section>

</body>
</html>