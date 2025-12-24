<?php
//session_start();
include('../db.php');

if (!isset($_SESSION['student_id'])) 
{
    header("Location: ../student_login.php");
    exit();
}
$msg=" ";

if ($_SERVER['REQUEST_METHOD'] == 'POST') 
{
    $complaint = $_POST['complaint'];
    $student_id = $_SESSION['student_id'];

    $sql = "INSERT INTO complaints (student_id, complaint) VALUES ('$student_id', '$complaint')";
    if ($conn->query($sql)) 
    {
        $msg = "✅ Complaint submitted successfully!";
    } 
    else 
    {
        $msg = "❌ Error : " . $conn->error;
    }
}

?>

<div class="student">
    <div class="add">
    <i class="fa-solid fa-pen"></i> Submit a Complaint    
    </div>

    <form method="POST" class="form-box">

        <textarea name="complaint" rows="5" cols="50" placeholder="Enter your complaint" required></textarea>
        <input type="submit" value="Submit Complaint">
    
    </form><br>

    <?php if (isset($msg)) echo "<p>$msg</p>"; ?>
    <?php if (!isset($msg)) echo "<p>$msg</p>"; ?>
    <!-- <a href="student_dashboard.php">← Back to Dashboard</a><br><br> -->
</div>