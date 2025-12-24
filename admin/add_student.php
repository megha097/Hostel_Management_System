<?php
// session_start();
include('../db.php');

if (!isset($_SESSION['admin'])) 
{
    header('Location: ../index.php');
    exit();
}

$msg=" ";

if ($_SERVER['REQUEST_METHOD'] == 'POST') 
{
    $name = $_POST['name'];
    $email = $_POST['email'];
    $room = $_POST['room_no'];
    $password = $_POST['password'];

    // ⭐ ADDED: Hash student password BEFORE saving
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // ✅ Double check room exists
    $check_room = $conn->query("SELECT * FROM rooms WHERE room_no = '$room'");
    
    if ($check_room->num_rows == 0) 
    {
        $msg = "❌ Room $room does not exist in Room Management.";
    } 
    else 
    {
        // ✅ Check capacity
        $check_capacity = $conn->query("SELECT COUNT(*) AS total FROM students WHERE room_no = '$room'");
        $count = $check_capacity->fetch_assoc();

        if ($count['total'] >= 3) 
        {
            $msg = "❌ Cannot add student. Room $room is already FULL (3/3).";
        } 
        else 
        {
            // ⭐ Changed ONLY password field to hashed
            $sql = "INSERT INTO students (name, email, room_no, password) 
                    VALUES ('$name', '$email', '$room', '$hashed_password')";

            if ($conn->query($sql)) 
            {
                $msg = "✅ Student added successfully.";
            } 
            else 
            {
                $msg = "❌ Error : " . $conn->error;
            }
        }
    }
}

// ✅ Fetch only rooms that exist and have seats < 3
$available_rooms = $conn->query("
    SELECT r.room_no, 
           (SELECT COUNT(*) FROM students s WHERE s.room_no = r.room_no) AS total_students
    FROM rooms r
    ORDER BY r.room_no ASC
");
?>

<div class="add-student">
    <h2 class="add"><i class="fa-solid fa-user-plus"></i> Add New Student</h2>

    <form method="POST" class="form-box">
        
        <label>Full Name</label>
        <input type="text" name="name" required>

        <label>Email</label>
        <input type="email" name="email" required>
        
        <label>Room No</label>
        <select name="room_no" required>
            <option value="">-- Select Room --</option>
            <?php while ($row = $available_rooms->fetch_assoc()) 
            { 
                $total = $row['total_students'];
                $remaining = 3 - $total;
                if ($remaining > 0) { ?>
                    <option value="<?= $row['room_no'] ?>">
                        Room <?= $row['room_no'] ?> (<?= $remaining ?> seat<?= $remaining>1?'s':'' ?> left)
                    </option>
            <?php } } ?>
        </select>

        <label>Password</label>
        <input type="text" name="password" required>

        <input type="submit" value="Add Student">
    </form><br>
    
    <?php if ($msg) echo "<p>$msg</p>"; ?>

    <!-- <a href="dashboard.php">← Back to Dashboard</a> -->
</div>