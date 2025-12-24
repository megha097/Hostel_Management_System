<?php
//session_start();
include('../db.php');

if (!isset($_SESSION['admin'])) 
{
    header('Location: ../index.php');
    exit();
}

if (!isset($_GET['id'])) 
{
    echo "Student ID missing.";
    exit();
}

$id = intval($_GET['id']);
$result = $conn->query("SELECT * FROM students WHERE id = '$id'");
if ($result->num_rows != 1) 
{
    echo "Student not found.";
    exit();
}

$msg=" ";
$student = $result->fetch_assoc();

// Handle Update
if ($_SERVER['REQUEST_METHOD'] == 'POST') 
{
    $name  = $_POST['name'];
    $email = $_POST['email'];
    $room  = $_POST['room_no'];
    $password = $_POST['password'];

    // ⭐ ADDED: Hash password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // ✅ Check if room exists
    $check_room = $conn->query("SELECT * FROM rooms WHERE room_no='$room'");
    
    if ($check_room->num_rows == 0) 
    {
        $error = "Room $room does not exist.";
    } 
    else 
    {
        // ✅ Check capacity (ignore this student’s current room)
        $check_capacity = $conn->query("SELECT COUNT(*) AS total FROM students WHERE room_no='$room' AND id != '$id'");
        $count = $check_capacity->fetch_assoc();

        if ($count['total'] >= 3) 
        {
            $msg = "❌ Cannot add student. Room $room is already FULL (3/3).";
        } 
        else 
        {
             // ⭐ CHANGED ONLY password='$hashed_password'
            $sql = "UPDATE students SET name='$name', email='$email', room_no='$room', password='$hashed_password' WHERE id='$id'";
            
            if ($conn->query($sql)) 
            {
                header("Location: dashboard.php");
                exit();
            } 
            else {
                $msg = "❌ Error: " . $conn->error;
            }
        }
    }
}

// ✅ Fetch available rooms
$available_rooms = $conn->query("
    SELECT r.room_no,
           (SELECT COUNT(*) FROM students s WHERE s.room_no = r.room_no AND s.id != '$id') AS total_students
    FROM rooms r
    ORDER BY r.room_no ASC
");
?>

<div class="add-student">
    <h2 class="add"><i class="fa-solid fa-user-pen"></i> Edit Student</h2>

<form method="POST" class="form-box">

    <label>Name : </label>
    <input type="text" name="name" value="<?= htmlspecialchars($student['name']) ?>" required>
    
    <label>Email : </label>
    <input type="email" name="email" value="<?= htmlspecialchars($student['email']) ?>" required>
    
    <label>Room No :</label>
    <select name="room_no" required>
        <?php while ($row = $available_rooms->fetch_assoc()) { 
            $total = $row['total_students'];
            $remaining = 3 - $total;
            $selected = ($row['room_no'] == $student['room_no']) ? "selected" : "";
            if ($remaining > 0 || $row['room_no'] == $student['room_no']) { ?>
                <option value="<?= $row['room_no'] ?>" <?= $selected ?>>
                    Room <?= $row['room_no'] ?> (<?= $remaining ?> seat<?= $remaining!=1?"s":"" ?> left)
                </option>
        <?php } } ?>
    </select>
    
    <label>Password : </label>
    <input type="text" name="password">
    
    <input type="submit" value="Update Student">

</form><br>
<?php if ($msg) echo "<p>$msg</p>"; ?>
</div>
<!-- <a href="dashboard.php">← Back to Dashboard</a><br><br> -->