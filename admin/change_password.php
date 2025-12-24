<?php
//session_start();
include('../db.php');

if (!isset($_SESSION['admin'])) 
{
    header('Location: ../index.php');
    exit();
}

$msg = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') 
{
    $username = $_SESSION['admin'];
    $current = $_POST['current_password'];
    $new = $_POST['new_password'];
    $confirm = $_POST['confirm_password'];

    $sql = "SELECT password FROM admins WHERE username = '$username'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();

    // *** ADDED: verify hashed password ***
    if (!password_verify($current, $row['password'])) 
    {
        $msg = "❌ Current password is incorrect!";
    } 
    elseif ($new != $confirm) 
    {
        $msg = "❌ New passwords do not match!";
    } 
    else 
    {
        // *** ADDED: hash new password before saving ***
        $hashed_new = password_hash($new, PASSWORD_DEFAULT);

        $update = "UPDATE admins SET password = '$hashed_new' WHERE username = '$username'";
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

<div class="change-password">
    <h2 class="add"><i class="fa-solid fa-key"></i> Change Password</h2>

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
</body>
</html>