<?php

session_start();
include('../db.php');

if (!isset($_SESSION['admin'])) 
{
    header('Location: ../index.php');
    exit();
}

$id = intval($_GET['id']);
$conn->query("DELETE FROM students WHERE id=$id");
header('Location: dashboard.php');

?>