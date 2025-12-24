<?php
//session_start();
include('../db.php'); 

if (!isset($_SESSION['student_id'])) 
{
    header('Location: ../student_login.php');
    exit();
}

$student_id = $_SESSION['student_id'];

$result = $conn->query("SELECT * FROM students WHERE id = $student_id");
if ($result->num_rows != 1) 
{
    echo "Student not found!";
    exit();
}

$msg=" ";
$student = $result->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] === 'POST') 
{
    $name     = $_POST['name'];
    $email    = $_POST['email'];
    $password = $_POST['password'];

    // Hash new password
    $hashed_pass = password_hash($password, PASSWORD_DEFAULT);

    $sql = "UPDATE students SET 
                name = '$name',
                email = '$email',
                password = '$hashed_pass'
            WHERE id = $student_id";

    if ($conn->query($sql)) 
    {
        $_SESSION['student_name'] = $name;
        $msg = "✅ Profile updated successfully!";
        
        /*header("Location: student_profile.php");
        exit();*/
    } 
    else 
    {
        $msg = "❌ Error: " . $conn->error;
    }
}

?>
<div class="student">

    <div class="add"><i class="fa-solid fa-user-pen"></i> Edit Your Profile</div> 

    <form method="POST" class="form-box">
        <label>Name : </label>
        <input type="text" name="name" value="<?= htmlspecialchars($student['name']) ?>" required>
        
        <label>Email : </label>
        <input type="email" name="email" value="<?= htmlspecialchars($student['email']) ?>" required>

        <label>Password : </label>
        <input type="text" name="password">

        <input type="submit" value="Update Profile"><br>

        <center><?php if ($msg) echo "<p>$msg</p>"; ?></center>

    </form>
    
    <a href="student_dashboard.php?page=student_profile" class="btn">Back to Profile</a></div>