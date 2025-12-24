<?php
$current_page = basename($_SERVER['PHP_SELF']); // gets current filename like index.php, about.php etc.
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>About Us</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        /* ====== Dark Neon Theme for About Page ====== */
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

/* About Content */
.content {
  max-width: 900px;
  margin: 40px auto;
  padding: 30px;
  background: rgba(255,255,255,0.05);
  backdrop-filter: blur(12px);
  border-radius: 16px;
  box-shadow: 0 8px 25px rgba(0,0,0,0.4);
  border: 1px solid rgba(255,255,255,0.1);
  margin-bottom: 80px;
}

.content h2{
  color: #00eaff;
  margin-bottom: 15px;
  font-size: 26px;
  text-shadow: 0 2px 6px rgba(0,0,0,0.6);
}
.content h5{
  color: #00eaff;
  margin-bottom: 10px;
  margin-top: 10px;
  font-size: 20px;
  text-shadow: 0 2px 6px rgba(0,0,0,0.6);
}
.content p {
  line-height: 1.7;
  font-size: 17px;
  color: #ddd;
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
    <h1>Rules & Regulations</h1>
</section>

<div class="content">
    <h2>Our Rules & Regulations</h2>
    <p>1. In the hostel, students must take permission from the warden (Gruh Mata) before going out for meals.</p>

    <p>2. Breakfast should be completed by 9:00 AM. Lunch time will be start from 11:30 AM and ends at 4:00 PM. Early school and college students can have their meals earlier as per their convenience.

    <p>3. Dinner time will be 8:00 PM to 9:30 PM.</p>
    
    <p>4. We all have a hostel, so we have to take care of its resources and live together like a family. If there is any complaint, it has to be made to the Managing Trustee.</p>
    
    <p>5. Cleaning one’s own room. If not possible than inform us our workers will be clean your room at your time.</p>
    
    <p>6. The instructions of the warden (Gruh Mata) must be followed.</p>
</div>

</body>
</html>