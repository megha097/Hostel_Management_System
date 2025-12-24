<?php
//session_start();
include('../db.php');

if (!isset($_SESSION['admin'])) 
{
    header('Location: ../index.php');
    exit();
}

if (!isset($_GET['room_no'])) 
{
    echo "Room number missing.";
    exit();
}

$room_no = $_GET['room_no'];

// ✅ Prevent delete if students exist in room
$check_students = $conn->query("SELECT COUNT(*) AS total FROM students WHERE room_no='$room_no'");
$count = $check_students->fetch_assoc();

if ($count['total'] > 0) 
{
    echo "<script>
            alert('❌ Cannot delete Room $room_no. There are still {$count['total']} students assigned!');
            window.location.href='dashboard.php?page=rooms';
          </script>";
    exit();
}

// ✅ Delete room
$conn->query("DELETE FROM rooms WHERE room_no='$room_no'");
header("Location: dashboard.php?page=rooms");
exit();
?>