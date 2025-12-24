<?php
$current_page = basename($_SERVER['PHP_SELF']); // gets current filename like index.php, about.php etc.
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Staff</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        /* ====== Dark Neon Theme for Staff Page ====== */
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

/* Staff Grid */
.staff-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
  gap: 25px;
  padding: 50px;
  max-width: 1100px;
  margin: 0 auto;
}

/* Staff Cards */
.staff-card {
  background: rgba(255,255,255,0.05);
  backdrop-filter: blur(12px);
  border-radius: 16px;
  padding: 25px;
  text-align: center;
  box-shadow: 0 8px 25px rgba(0,0,0,0.4);
  transition: transform 0.3s ease, box-shadow 0.3s ease;
  border: 1px solid rgba(255,255,255,0.1);
}

.staff-card:hover {
  transform: translateY(-8px) scale(1.05);
  box-shadow: 0 0 20px rgba(0,234,255,0.6);
}

/* Staff Images 
.staff-card img {
  width: 110px;
  height: 110px;
  border-radius: 50%;
  margin-bottom: 15px;
  border: 3px solid #00eaff;
  box-shadow: 0 0 15px rgba(0,234,255,0.7);
}*/

/* Staff Text */
.staff-card h3 {
  margin: 10px 0 5px;
  font-size: 20px;
  color: #00eaff;
  text-shadow: 0 2px 6px rgba(0,0,0,0.6);
}

.staff-card p {
  margin: 4px 0;
  font-size: 15px;
  color: #ccc;
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
    <h1>Meet Our Staff</h1>
</section>

<div class="staff-grid">
    <div class="staff-card">
        <h3>Mrs. Roshni Bhatt</h3>
        <p>Warden</p>
        <p>Email: warden@hostel.com</p>
    </div>
    <div class="staff-card">
        <h3>Mrs. Riddhi Vyas</h3>
        <p>Mess Incharge</p>
        <p>Email: mess@hostel.com</p>
    </div>
    <div class="staff-card">
        <h3>Mrs. Kamla Vyas</h3>
        <p>Housekeeping</p>
        <p>Email: housekeeping@hostel.com</p>
    </div>
</div>

</body>
</html>