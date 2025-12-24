<?php
include('../db.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') 
{
    $email = $_POST['email'];
    $new_pass = $_POST['new_password'];
    $confirm_pass = $_POST['confirm_password'];

    // Check if the student email exists
    $check = "SELECT * FROM students WHERE email = '$email'";
    $result = $conn->query($check);

    if ($result->num_rows != 1) 
    {
        $error = "❌ Email not found!";
    } 
    elseif ($new_pass != $confirm_pass) 
    {
        $error = "❌ Passwords do not match!";
    } 
    else 
    {
        // Hash the new password before storing
        $hashed_pass = password_hash($new_pass, PASSWORD_DEFAULT);

        // Update the password
        $update = "UPDATE students SET password = '$hashed_pass' WHERE email = '$email'";
        
        if ($conn->query($update)) 
        {
            $success = "✅ Password updated successfully.";
        } 
        else 
        {
            $error = "❌ Error updating password.";
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Forgot Password - Student</title>
<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        height: 100vh;
        background: url('../images/photo2.jpg') no-repeat center center/cover;
        display: flex;
        align-items: center;
        justify-content: center;
        font-family: 'Segoe UI', sans-serif;
        position: relative;
    }

    body::before {
        content: "";
        position: absolute;
        top: 0;
        left: 0;
        height: 100%;
        width: 100%;
        background: rgba(255, 255, 255, 0.2);
        backdrop-filter: blur(5px);
        z-index: 0;
    }

    .student-login {
        position: relative;
        z-index: 1;
        background: rgba(255, 255, 255, 0.3);
        backdrop-filter: blur(15px);
        border-radius: 20px;
        padding: 40px 30px;
        width: 360px;
        box-shadow: 0 12px 30px rgba(0, 0, 0, 0.3);
        text-align: center;
        color: #333;
        animation: float 6s ease-in-out infinite;
    }

    .student-login img 
    {
        width: 75px;
        margin-bottom: 15px;
    }

    .student-login h2 {
        font-size: 24px;
        font-weight: bold;
        margin-bottom: 20px;
        color: #1f3a93;
    }

    .student-login input[type="email"],
    .student-login input[type="password"] {
        width: 100%;
        padding: 12px;
        margin: 12px 0;
        border: none;
        border-radius: 10px;
        background: rgba(255, 255, 255, 0.85);
        font-size: 15px;
        outline: none;
        box-shadow: inset 1px 1px 5px rgba(0, 0, 0, 0.1);
    }

    .student-login input::placeholder {
        color: #888;
    }

    .student-login input[type="submit"] {
        width: 100%;
        padding: 12px;
        margin-top: 10px;
        margin-bottom: 10px;
        background: linear-gradient(135deg, #00c6ff, #0072ff);
        color: white;
        font-weight: bold;
        font-size: 16px;
        border: none;
        border-radius: 10px;
        cursor: pointer;
        transition: background 0.3s ease;
    }

    .student-login input[type="submit"]:hover {
        background: linear-gradient(135deg, #0072ff, #00c6ff);
    }

    .student-login .forgot {
        margin-top: 10px;
        font-size: 14px;
    }

    .student-login .forgot a {
        color: #1a1aff;
        text-decoration: none;
    }

    .student-login .forgot a:hover {
        text-decoration: underline;
    }

    @media screen and (max-width: 400px) {
        .student-login {
            width: 90%;
            padding: 30px 20px;
        }
    }
</style>

</head>
<body>
    <form method="POST" class="student-login">
    <img src="../images/1.png">

    <h2>Student Forgot Password</h2>

        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="new_password" placeholder="New Password" required>
        <input type="password" name="confirm_password" placeholder="Confirm Password" required>
        <input type="submit" value="Reset Password">
    
    <div class="forgot">
    <a href="../student_login.php">Back to Login</a>
    <div/><br>
<?php if (isset($error)) echo $error; ?>
<?php if (isset($success)) echo $success; ?>
</form>
</body>
</html>