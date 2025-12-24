<?php
session_start();
include('../db.php');

if (!isset($_SESSION['admin'])) 
{
    header('Location: ../index.php');
    exit();
}

$id = $_GET['id'];
mysqli_query($conn, "DELETE FROM fees WHERE id=$id");
header('Location: dashboard.php?page=view_fees');
?>