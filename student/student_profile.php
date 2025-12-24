<?php
//session_start();
include('../db.php'); 

if (!isset($_SESSION['student_id'])) 
{
    header('Location: ../student_login.php');
    exit();
}

$student_id = $_SESSION['student_id'];

$sql = "SELECT * FROM students WHERE id = $student_id";
$result = $conn->query($sql);

if ($result->num_rows != 1) 
{
    echo "Student not found!";
    exit();
}

$student = $result->fetch_assoc();
?>

<div class="student">
    <div class="profile-card">
        <div class="profile-header">
            <i class="fa-solid fa-user-graduate"></i>
            <h2>Student Profile</h2>
        </div>

        <div class="profile-info">
            <p><span>Name :</span> <?= htmlspecialchars($student['name']) ?></p>
            <p><span>Email :</span> <?= htmlspecialchars($student['email']) ?></p>
            <p><span>Room No :</span>
                <?php if (!empty($student['room_no'])) { ?>
                    <?= htmlspecialchars($student['room_no']) ?>
                <?php } else { ?>
                    ⏳ Not Allotted Yet
                <?php } ?>
            </p>
        </div>

        <div class="profile-actions">
            <a href="student_dashboard.php?page=edit_profile" class="btn">Edit Profile</a>
        </div>
    </div>
</div>
<!-- &nbsp; | &nbsp;  -->
    <!-- <a href="student_dashboard.php">← Back to Dashboard</a> -->