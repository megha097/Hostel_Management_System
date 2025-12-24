<?php
session_start();
include('../db.php'); // make sure this connects to your database

$current_page = basename($_SERVER['PHP_SELF']); // gets current filename like index.php, about.php etc.

$msg = "";
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];

    $sql = "INSERT INTO feedback (name,email,message) VALUES ('$name','$email','$message')";

    if (mysqli_query($conn,$sql)) 
    {
          $_SESSION['feedback_msg'] = "Thank you! Your feedback has been submitted.";
          header("Location: feedback.php");
          exit();
    } 
    else 
    {
        $_SESSION['feedback_msg'] = "Error! Please try again.";
        header("Location: feedback.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Feedback - Hostel</title>
    <style>
        /* ====== Dark Neon Theme for Feedback Page ====== */
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

/* Feedback Form Box */
.form-box {
  max-width: 500px;
  margin: 40px auto;
  padding: 30px 40px;
  background: rgba(255,255,255,0.05);
  backdrop-filter: blur(12px);
  border-radius: 16px;
  box-shadow: 0 8px 25px rgba(0,0,0,0.4);
  border: 1px solid rgba(255,255,255,0.1);
  margin-bottom: 80px;
}

/* Inputs & Textarea */
input[type=text],
input[type=email],
textarea {
  width: 100%;
  padding: 12px 14px;
  margin: 10px -15px;
  border: 1px solid rgba(255,255,255,0.2);
  border-radius: 8px;
  background: rgba(255,255,255,0.05);
  color: #fff;
  font-size: 15px;
  outline: none;
  transition: 0.3s;
}

input[type=text]::placeholder,
input[type=email]::placeholder,
textarea::placeholder {
  color: #aaa;
}

input[type=text]:focus,
input[type=email]:focus,
textarea:focus {
  border-color: #00eaff;
  box-shadow: 0 0 12px rgba(0,234,255,0.6);
}

/* Submit Button */
input[type=submit] {
  background: linear-gradient(135deg, #00eaff, #0066ff);
  color: #fff;
  padding: 12px 20px;
  border: none;
  border-radius: 8px;
  cursor: pointer;
  font-size: 16px;
  font-weight: bold;
  transition: 0.3s;
  width: 100%;
}

input[type=submit]:hover {
  box-shadow: 0 0 15px rgba(0,234,255,0.8);
  transform: translateY(-2px);
}

/* Success/Error Message */
p.msg {
  color: #00eaff;
  font-weight: bold;
  margin-bottom: 15px;
  text-align: center;
  text-shadow: 0 0 8px rgba(0,234,255,0.7);
}
/* ====== Feedback Section ====== */
.feedbacks {
  padding: 30px 50px; 
  margin-top: -15px;   
  text-align: center;
  color: #fff;
}

.feedbacks h2 {
  font-size: 28px;
  margin-left: -3px;
  margin-bottom: 25px;
  color: #00eaff;
  text-shadow: 0 2px 8px rgba(0,0,0,0.6);
}

.feedback-box {
  background: rgba(255,255,255,0.05);
  backdrop-filter: blur(10px);
  border-radius: 16px;
  padding: 20px;
  margin: 15px auto;
  max-width: 600px;
  text-align: left;
  box-shadow: 0 8px 25px rgba(0,0,0,0.3);
  border: 1px solid rgba(255,255,255,0.1);
  transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.feedback-box:hover {
  transform: scale(1.02);
  box-shadow: 0 0 15px rgba(0,234,255,0.5);
}

.feedback-box p {
  margin: 8px 0;
  font-size: 16px;
  color: #ddd;
}

.feedback-box strong {
  color: #00eaff;
  font-size: 17px;
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
    <h1>Feedback&nbsp;</h1>
</section>

<div class="form-box">
    <form method="POST">
        <input type="text" name="name" placeholder="Your Name" required>
        <input type="email" name="email" placeholder="Your Email" required>
        <textarea name="message" rows="5" placeholder="Your Feedback or Suggestion" required></textarea><br><br>
        <input type="submit" value="Submit Feedback"><br><br>
        <?php 
        if (isset($_SESSION['feedback_msg'])) 
        {
            echo "<p class='msg'>".$_SESSION['feedback_msg']."</p>";
            unset($_SESSION['feedback_msg']);  // remove message after showing
        }
        ?>
    </form>
</div>


<!-- Feedback Section -->
<section class="feedbacks">
    <h2>Feedbacks&nbsp;</h2>
    <?php
    $result = $conn->query("SELECT name, message FROM feedback ORDER BY id DESC LIMIT 3");
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            echo "<div class='feedback-box'>";
            echo "<p><strong>" . htmlspecialchars($row['name']) . " :</strong></p>";
            echo "<p>" . htmlspecialchars($row['message']) . "</p>";
            echo "</div>";
        }
    } else {
        echo "<p>No feedback yet. Be the first to share!</p>";
    }
    ?>
</section>

</body>
</html>