<?php
include('../db.php');

$msg = "";
$success = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') 
{
    $username = $_POST['username'];
    $new_pass = $_POST['new_password'];
    $confirm_pass = $_POST['confirm_password'];

    $check = "SELECT * FROM admins WHERE username = '$username'";
    $result = $conn->query($check);

    if ($result->num_rows != 1) 
    {
        $msg = "❌ Username not found!";
    } 
    elseif ($new_pass != $confirm_pass) 
    {
        $msg = "❌ Passwords do not match!";
    } 
    else 
    {
        // ⭐ ADDED: hash new password
        $hashed_pass = password_hash($new_pass, PASSWORD_DEFAULT);

        // ⭐ ADDED hashed password into update query (your query unchanged except value)
        $update = "UPDATE admins SET password = '$hashed_pass' WHERE username = '$username'";
        
        if ($conn->query($update)) 
        {
            $success = "✅ Password updated successfully.";
        } 
        else 
        {
            $msg = "❌ Error updating password.";
        }
    }
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Forgot Password - Admin</title>
  <style>
        /* Reset default styles */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body 
        {
            height: 100vh;
            background: linear-gradient(135deg, #0f2027, #203a43, #2c5364);
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .login-box 
        {
            background: rgba(255, 255, 255, 0.08);
            backdrop-filter: blur(15px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 20px;
            padding: 40px 30px;
            width: 350px;
            color: white;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.4);
            text-align: center;
        }

        .login-box img 
        {
            width: 80px;
            margin-bottom: 20px;
            filter: drop-shadow(0 0 5px white);
        }

        .login-box h2 
        {
            margin-bottom: 25px;
            font-size: 26px;
            font-weight: 600;
        }

        .login-box input[type="text"],
        .login-box input[type="password"] 
        {
            width: 100%;
            padding: 12px;
            margin: 12px 0;
            border-radius: 10px;
            border: 1px solid rgba(255, 255, 255, 0.3);
            background: rgba(255, 255, 255, 0.05);
            color: #fff;
            font-size: 15px;
            outline: none;
            transition: all 0.3s ease;
        }

        .login-box input[type="text"]::placeholder,
        .login-box input[type="password"]::placeholder 
        {
            color: rgba(255, 255, 255, 0.7);
        }

        .login-box input[type="text"]:focus,
        .login-box input[type="password"]:focus 
        {
            border: 1px solid #00c6ff;
            background: rgba(255, 255, 255, 0.1);
        }

        .login-box input[type="submit"] 
        {
            width: 100%;
            padding: 12px;
            border-radius: 10px;
            border: none;
            background: linear-gradient(135deg, #00c6ff, #0072ff);
            color: white;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: background 0.3s ease;
            margin-top: 15px;
            margin-bottom: 15px;
            box-shadow: 0 4px 15px rgba(0, 198, 255, 0.3);
        }

        .login-box input[type="submit"]:hover 
        {
            background: linear-gradient(135deg, #0072ff, #00c6ff);
        }

        .error 
        {
            color: #ff4d4d;
            font-size: 14px;
            margin-top: 5px;
        }

        .success 
        {
            color: #4CAF50; /* bright green */
            font-size: 14px;
            margin-top: 5px;
        }

        .forgot 
        {
            margin-top: 12px;
            font-size: 14px;
        }

        .forgot a 
        {
            color: #a3cfff;
            text-decoration: none;
            transition: 0.2s ease;
        }

        .forgot a:hover 
        {
            color: #ffffff;
            text-decoration: underline;
        }

        @media screen and (max-width: 400px) 
        {
            .login-box 
            {
                width: 90%;
                padding: 30px;
            }
        }
    </style>
</head>
<body>

<form method="POST" class="login-box">
    <img src="../images/forgot.png">
    <h2>Forgot Password</h2>

        <input type="text" name="username" placeholder="Username" required>
        <input type="password" name="new_password" placeholder="New Password" required>
        <input type="password" name="confirm_password" placeholder="Confirm Password" required>
        <input type="submit" value="Reset Password">
    
    <div class="forgot">
    <a href="../index.php">Back to Login</a>
</div>
<br>
<?php if ($msg) echo "<p class='error'>$msg</p>";
      else  echo "<p class='success'>$success</p>";?>
</form>
</body>
</html>