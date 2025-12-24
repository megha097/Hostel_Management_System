<?php
session_start();
include('../db.php');

if (!isset($_SESSION['admin'])) 
{
    header("Location: ../index.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') 
{
    $complaint_id = intval($_POST['complaint_id']);
    $new_status = $_POST['status'];

    $sql = "UPDATE complaints SET status = '$new_status' WHERE id = $complaint_id";

    if ($conn->query($sql)) 
    {
        $_SESSION['msg'] = "Status updated successfully.";
    } 
    else 
    {
        $_SESSION['msg'] = "Error updating status: " . $conn->error;
    }

    header("Location: dashboard.php?page=view_complaint");
    exit();
}

?>