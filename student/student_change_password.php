<?php
//session_start();
include('../db.php');

if (!isset($_SESSION['student_id'])) 
{
    header('Location: ../student_login.php');
    exit();
}

$msg = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') 
{
    $student_id = $_SESSION['student_id'];
    $current = $_POST['current_password'];
    $new = $_POST['new_password'];
    $confirm = $_POST['confirm_password'];

    $sql = "SELECT password FROM students WHERE id = $student_id";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();

    //hased password
    $stored_hashed = $row['password'];


    if (!password_verify($current, $stored_hashed)) 
    {
        $msg = "❌ Current password is incorrect!";
    } 
    elseif ($new != $confirm) 
    {
        $msg = "❌ New passwords do not match!";
    } 
    else 
    {
        // Hash the new password
        $hashed_new = password_hash($new, PASSWORD_DEFAULT);

        $update = "UPDATE students SET password = '$hashed_new' WHERE id = $student_id";
        
        if ($conn->query($update)) 
        {
            $msg = "✅ Password changed successfully!";
        } 
        else 
        {
            $msg = "❌ Error: " . $conn->error;
        }
    }
}

?>
<div class="student">

    <div class="add"><i class="fa-solid fa-key"></i> Change Password</div>


    <form method="POST" class="form-box">
        <label>Current Password : </label>
        <input type="password" name="current_password" required>
        
        <label>New Password : </label>
        <input type="password" name="new_password" required>
        
        <label>Confirm New Password : </label>
        <input type="password" name="confirm_password" required>
        <input type="submit" value="Change Password">
    </form><br>
    <?php if ($msg) echo "<p>$msg</p>"; ?>
</div>
    <!-- <a href="student_dashboard.php">← Back to Dashboard</a><br><br> -->