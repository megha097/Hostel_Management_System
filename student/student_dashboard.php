<?php
ob_start(); // ✅ Prevent "headers already sent" warning
session_start();
include('../db.php');

// 🔒 Prevent browser from showing cached pages after logout
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");

// Show welcome dialog only once per login
$show_welcome_dialog = false;
if (!isset($_SESSION['welcome_shown'])) {
    $show_welcome_dialog = true; // First time this session
    $_SESSION['welcome_shown'] = true; // Set flag
}


if (!isset($_SESSION['student_id'])) 
{
    header('Location: ../student_login.php');
    exit();
}
$current_page = isset($_GET['page']) ? $_GET['page'] : 'home';

$student_id = $_SESSION['student_id'];

// Count unread announcements
$unread_count = $conn->query("
    SELECT COUNT(*) as total 
    FROM announcements a
    WHERE NOT EXISTS (
        SELECT 1 FROM announcement_views av 
        WHERE av.announcement_id = a.id AND av.student_id = $student_id
    )
")->fetch_assoc()['total'];
?>

<!DOCTYPE html>
<html>
<head>
    <title>Student Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="style.css">
<style>
/* ==== START OF YOUR CSS ==== */
.sidebar h2 {
    color: #00eaff;
    text-align: center;
    margin-bottom: 20px;
}

/* === Welcome Dialog Box Styling === */
.dialog-overlay {
    position: fixed;
    top: 0; left: 0;
    width: 100%; height: 100%;
    background: rgba(0, 0, 0, 0.6);
    display: flex;
    justify-content: center;
    align-items: center;
    z-index: 9999;
    animation: fadeInBg 0.4s ease;
}

.dialog-box {
    position: relative;
    width: 420px;
    background: rgba(255,255,255,0.05);
    backdrop-filter: blur(15px);
    border: 1px solid rgba(255,255,255,0.1);
    border-radius: 16px;
    padding: 30px 40px;
    text-align: center;
    box-shadow: 0 8px 25px rgba(0, 234, 255, 0.2);
    color: #fff;
    animation: slideIn 0.5s ease;
    font-family: 'Poppins', sans-serif;
}

.dialog-box h2 {
    color: #00eaff;
    font-weight: 600;
    font-size: 24px;
    margin-bottom: 10px;
    letter-spacing: 0.5px;
}

.dialog-box p {
    color: #ccc;
    font-size: 15px;
    line-height: 1.6;
}

.close-btn {
    position: absolute;
    top: 10px;
    right: 15px;
    background: rgba(255,255,255,0.1);
    border: none;
    border-radius: 50%;
    width: 32px;
    height: 32px;
    color: #00eaff;
    font-size: 20px;
    cursor: pointer;
    transition: 0.3s;
}

.close-btn:hover {
    background: rgba(0,234,255,0.2);
    box-shadow: 0 0 10px rgba(0,234,255,0.6);
    color: #fff;
}

/* Animations */
@keyframes slideIn {
    from { opacity: 0; transform: translateY(-30px) scale(0.95); }
    to { opacity: 1; transform: translateY(0) scale(1); }
}

@keyframes fadeInBg {
    from { opacity: 0; }
    to { opacity: 1; }
}

/* Responsive for mobile */
@media (max-width: 500px) {
    .dialog-box {
        width: 90%;
        padding: 25px 20px;
    }
    .dialog-box h2 {
        font-size: 20px;
    }
}

/* Hide other topbar on large screens */
.other-topbar {
  display: none;
}

/* Show only on small screens */
@media (max-width: 900px) {
  .other-topbar {
    display: flex;
    align-items: center;
    justify-content: flex-start;
    padding: 10px 15px;
    background: rgba(255, 255, 255, 0.05);
    backdrop-filter: blur(10px);
    border-radius: 12px;
    color: #fff;
  }

  .other-topbar .menu-toggle {
    font-size: 24px;
    cursor: pointer;
    transition: 0.3s;
  }
}

.close-sidebar-btn {
    display: none; /* hidden on large screens */
    position: absolute;
    margin-top: 4px;
    right: 15px;
    width: 32px;
    height: 32px;
    border-radius: 50%;
    background: rgba(255,255,255,0.1);
    border: none;
    color: #00eaff;
    font-size: 20px;
    text-align: center;
    line-height: 32px;
    cursor: pointer;
    transition: 0.3s;
    z-index: 1001;
}

.close-sidebar-btn:hover {
    background: rgba(0,234,255,0.2);
    color: #fff;
    box-shadow: 0 0 10px rgba(0,234,255,0.6);
}

/* Show only on mobile/tablet */
@media (max-width: 900px) {
    .othersidebar,
    .close-sidebar-btn {
        display: block;
    }
}

/* Footer Section */
.footer {
    display: flex;
    justify-content: center;
    align-items: center;
    padding: 12px 20px;
    background: rgba(255,255,255,0.05);
    backdrop-filter: blur(10px);
    border-radius: 12px;
    position: fixed;
    bottom: 25px;
    left: 263px;
    width: calc(100% - 280px);
    margin-top: 0;
}

/* Quote text styling */
.footer p {
    margin: 0;
    font-style: italic;
    letter-spacing: 0.5px;
    color: #e0f7ff;
    font-family: "Segoe UI", sans-serif;
}

#quoteText {
  opacity: 1;
  transition: opacity 1s ease-in-out;
}

/* Responsive adjustment when sidebar collapses */
@media (max-width: 900px) {
    .footer {
        left: 0;
        width: 100%;
    }
}
/* ==== END OF YOUR CSS ==== */
</style>
</head>
<body>

<div class="sidebar" id="sidebar">
    <h2><i class="fa-solid fa-home" style="margin-bottom: 10px;"></i>Hostel</h2>
    <span class="close-sidebar-btn" onclick="closeSidebar()">×</span>

    <a href="student_dashboard.php?page=home" 
       class="<?= $current_page == 'home' ? 'active' : '' ?>">
       <i class="fa-solid fa-gauge-high"></i> Dashboard
    </a>

    <a href="student_dashboard.php?page=student_profile" 
       class="<?= $current_page == 'student_profile' ? 'active' : '' ?>">
       <i class="fa-solid fa-user"></i> View Profile
    </a>

    <a href="student_dashboard.php?page=submit_complaint" 
       class="<?= $current_page == 'submit_complaint' ? 'active' : '' ?>">
       <i class="fa-solid fa-envelope"></i> Submit Complaint
    </a>

    <a href="student_dashboard.php?page=view_fees_student" 
       class="<?= $current_page == 'view_fees_student' ? 'active' : '' ?>">
       <i class="fa-solid fa-wallet"></i> My Fees
    </a>

    <a href="student_dashboard.php?page=view_announcements" 
       class="<?= $current_page == 'view_announcements' ? 'active' : '' ?>">
       <i class="fa-solid fa-bullhorn"></i> Announcements
       <?php if ($unread_count > 0) { ?>
           <span style="color:red; font-weight:bold; font-size:14px;">
               (<?= $unread_count ?>)
           </span>
       <?php } ?>
    </a>

    <a href="student_dashboard.php?page=student_change_password" 
       class="<?= $current_page == 'student_change_password' ? 'active' : '' ?>">
       <i class="fa-solid fa-key"></i> Change Password
    </a>

</div>

<div class="main-content">
    <?php 
    if ($current_page === 'home') { 
    ?>
    <div class="topbar">
        <span class="menu-toggle" onclick="toggleSidebar()">☰</span>
        <h2><i class="fa-solid fa-user-graduate"></i> 
            Welcome, <?= htmlspecialchars($_SESSION['student_name']) ?>!
        </h2>
        <form method="post" action="student_logout.php">
            <button class="logout" type="submit">Logout</button>
        </form>
    </div>
    <?php } ?>

    <div class="container">
        <?php
        if ($current_page === 'home') {
           ?> 
           <!-- Particle Canvas -->
           <canvas id="particleCanvas" style="position:absolute; top:0; left:0; width:100%; height:100%; z-index:-1;"></canvas>
           <script>
           const canvas = document.getElementById('particleCanvas');
           const ctx = canvas.getContext('2d');
           canvas.width = window.innerWidth;
           canvas.height = window.innerHeight;

           const particles = [];
           for(let i=0;i<100;i++){
               particles.push({
                   x: Math.random()*canvas.width,
                   y: Math.random()*canvas.height,
                   r: Math.random()*2+1,
                   dx: (Math.random()-0.5)*0.5,
                   dy: (Math.random()-0.5)*0.5
               });
           }

           function animate(){
               ctx.clearRect(0,0,canvas.width,canvas.height);
               particles.forEach(p=>{
                   p.x+=p.dx; p.y+=p.dy;
                   if(p.x<0||p.x>canvas.width) p.dx*=-1;
                   if(p.y<0||p.y>canvas.height) p.dy*=-1;
                   ctx.beginPath();
                   ctx.arc(p.x,p.y,p.r,0,Math.PI*2);
                   ctx.fillStyle='rgba(0,234,255,0.5)';
                   ctx.fill();
               });
               requestAnimationFrame(animate);
           }
           animate();
           </script>

           <?php if ($show_welcome_dialog) : ?>

           <!-- Welcome Dialog Box -->
           <div id="welcomeDialog" class="dialog-overlay">
             <div class="dialog-box">
               <button class="close-btn" onclick="closeDialog()">×</button>
               <h2> Moonlight Manor </h2>
               <p> “a safe, peaceful, and beautiful home-like place under the calming light of the moon”. </p>
             </div>
           </div>
           <script>
           function closeDialog() {
             document.getElementById("welcomeDialog").style.display = "none";
           }

           window.addEventListener("load", () => {
             const dialog = document.getElementById("welcomeDialog");
             if (dialog) {
               dialog.style.display = "flex";
             }
           });
           </script>

           <?php endif; ?>

           <!-- Footer Quote -->
           <div class="footer">
               <p id="quoteText"> 🌙 “May this place be your second home — where peace surrounds you and dreams take root.”</p>
           </div>

           <script>
           const quotes = [
             "🌙 “May this place be your second home — where peace surrounds you and dreams take root.”",  
             "🌸 “Here, every day is a step towards knowledge, friendship, and inner strength.”",
             "🪔 “This home is built not of bricks, but of care, trust, and togetherness.”",
             "💜 “Peaceful minds, safe hearts, and strong futures begin here.”"
           ];

           let quoteIndex = 0;
           const quoteElement = document.getElementById("quoteText");

           setInterval(() => {
             quoteElement.style.opacity = 0;
             setTimeout(() => {
               quoteIndex = (quoteIndex + 1) % quotes.length;
               quoteElement.textContent = quotes[quoteIndex];
               quoteElement.style.opacity = 1;
             }, 1000);
           }, 20000);
           </script>
<?php
        } else {
            $page = basename($current_page);
            $file = $page . ".php";
            if (file_exists($file)) { 
                ?>
                <div class="topbar other-topbar">
                  <span class="menu-toggle" onclick="toggleSidebar()">☰</span>
                </div>
            <?php   
             include($file);
            } else {
                echo "<p>Page not found!</p>";
            }
        }
        ?>
    </div>
</div>

<script>
function toggleSidebar() {
  document.getElementById("sidebar").classList.toggle("active");
}

function closeSidebar() {
  document.getElementById("sidebar").classList.remove("active");
}
</script>

</body>
</html>

<?php ob_end_flush(); // ✅ Flush output buffer ?>
