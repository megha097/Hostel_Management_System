<?php
//session_start();
include('../db.php');

if (!isset($_SESSION['student_id'])) 
{
    header('Location: ../student_login.php');
    exit();
}

$student_id = $_SESSION['student_id'];

// Fetch all announcements
$announcements = $conn->query("SELECT * FROM announcements ORDER BY created_at DESC");
?>

<div class="fee-records">
    <div class="add"><i class="fa-solid fa-bullhorn"></i> Announcements</div>

<?php while ($row = $announcements->fetch_assoc()) { 

    // Check if this announcement is viewed by this student
    $check = $conn->query("SELECT * FROM announcement_views WHERE announcement_id=".$row['id']." AND student_id='$student_id'");
    $is_unread = ($check->num_rows == 0);

    // Mark as viewed if unread
    if ($is_unread) {
        $conn->query("INSERT INTO announcement_views (announcement_id, student_id) VALUES (".$row['id'].", '$student_id')");
    }
?>
    <div class="announcement-card <?php if($is_unread) echo 'unread'; ?>">
        <strong><?= htmlspecialchars($row['title']) ?></strong><br>
        <?= nl2br(htmlspecialchars($row['message'])) ?><br>
        <small>Posted on: <?= date('d-m-Y h:i', strtotime($row['created_at'])) ?></small>

    </div>
<?php } ?>

<!-- <a href="student_dashboard.php">⬅ Back to Dashboard</a> -->